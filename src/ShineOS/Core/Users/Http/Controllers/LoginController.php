<?php
namespace ShineOS\Core\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use ShineOS\Core\Users\Entities\Users;
use ShineOS\Core\Users\Entities\Contact;
use ShineOS\Core\Users\Entities\MDUsers;
use ShineOS\Core\Users\Entities\FacilityUser;
use ShineOS\Core\Users\Entities\UserLogs;
use ShineOS\Core\Users\Entities\ForgotPassword;
use ShineOS\Core\Users\Entities\Roles;
use ShineOS\Core\Facilities\Entities\Facilities;
use ShineOS\Core\Users\Libraries\Salt;
use Shine\Libraries\FacilityHelper;
use Carbon\Carbon;
use Shine\Libraries\EmailHelper;

use View,
    Response,
    Validator,
    Input,
    Mail,
    Session,
    Redirect,
    Hash,
    Auth,
    DB,
    Cache,
    File,
    Crypt;

class LoginController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display login form
     *
     * @return Response
     */
    public function index()
    {
        if ( !shineos_is_installed() ){
            return Redirect::to(site_url().'install');
        } else {
            $data = array();

            return view('users::pages.login')->with($data);
        }
    }

    /**
     * Validates login credentials
     *
     * @return redirect
     */
    public function checkLogin()
    {
        $email = Input::get('identity');
        $password = Input::get('password');
        $remember_me = Input::get('remember_me');

        $user = Users::getRecordByEmail($email);

        if ( $user && count($user) > 0 ) {
            //store $user to session
            Session::put('_global_user', $user);

            if ($user->status == 'Active') :

                if ( $remember_me != 1 ) {

                    if (Auth::attempt(['email' => $email, 'password' => $password.$user->salt]))
                    {
                        return Redirect::to('selectfacility');
                    } else {
                        Session::flash('warning', 'Incorrect Login Credentials');
                        return Redirect::to('login');
                    }

                } else {

                    if (Auth::attempt(['email' => $email, 'password' => $password.$user->salt]))
                    {
                        Auth::login(Auth::user(), true);
                        return Redirect::to('selectfacility');
                    } else {
                        Session::flash('warning', 'Incorrect Login Credentials');
                        return Redirect::to('login');
                    }

                }
            else:

                Session::flash('warning', 'Your account is not activated yet. Kindly check your email.');
                return Redirect::to('login');
            endif;
        } else {

            Session::flash('warning', 'Incorrect Login Credentials');
            return Redirect::to('login');
        }
    }


    /**
     * Have user select a facility -- Multiple facilities
     *
     * @return response
     */
    public function select_facility (Request $request)
    {
        $data = array();
        if ($request->user()) {
            $user_id = $request->user()->user_id;

            $user = Users::with('facilities','facilityUser')
                ->where('user_id', $user_id)
                ->first();
            $data['user'] = $user;

            Cache::forever('user_details', $user);
            Cache::forever('facility_details', $user->facilities);
            Cache::forever('facilityuser_details', $user->facilityUser);

            $this->saveLog('login', $user_id);

            if (count($user->facilities) > 1):

                $facility_id = $user->facilities[0]->facility_id;
                $this->assign_facility($facility_id);

                return view('users::pages.selectfacility')->with($data);
            else:

                $facility_id = $user->facilities[0]->facility_id;
                $this->assign_facility($facility_id);

                $this->getRoleAndAccess($user_id);

                return Redirect::to('dashboard');
            endif;
        } else {
            return Redirect::to('login');
        }
    }

    /**
     * Assigns a facility to a session
     *
     * @return response
     */
    public function assign_facility ( $facility_id = 0 )
    {
        $this->middleware('auth');
        $facility = json_encode(Facilities::getCurrentFacility($facility_id));
        Session::put('_global_facility_info', $facility);

        return Redirect::to('dashboard');
    }

    /**
     * Logs out user
     *
     * @return redirect
     */
    public function logout( $user_id = NULL )
    {
        //let us check if the user is logged in
        //if not just go to login page
        $loggedin = UserLogs::where('user_id', $user_id)->first();

        if($loggedin) {
            $this->saveLog('logout', $user_id);

            // clear cache
            Cache::forget('roles');
            Cache::forget('user_details');
            Cache::forget('facility_details');
            Cache::forget('facilityuser_details');

            // logout
            Auth::logout();

            // clear session
            Session::flush();

        }

        return Redirect::to('login');
    }

    /**
     * Display Forgot Password form
     *
     * @return Response
     */
    public function forgotpassword ()
    {
        $data = array();

        return view('users::pages.forgotpassword')->with($data);
    }

    public function forgotpasswordSend ()
    {
        $_param = array();
        $email = Input::get('email');
        $forgot_password_code = str_random(25);

        // save the forgot password code first
        ForgotPassword::insertChangePasswordRequest($forgot_password_code);

        // then send the change password link
        $changepassword_link = url('/')."/forgotpassword/changepassword/".$forgot_password_code;

        $_param['email'] = $email;
        $_param['forgot_password_code'] = $forgot_password_code;
        $_param['changepassword_link'] = $changepassword_link;

        EmailHelper::sendForgotPasswordEmail($_param);

        Session::flash('message', 'An email has been sent to update your password.');
        return Redirect::to('login');
    }

    public function changepassword ( $password_code = '' )
    {
        $forgotPassword = ForgotPassword::getPasswordCode($password_code);

        if ( $forgotPassword && count($forgotPassword) > 0 ) {

            $data = array();
            $data['forgotPassword'] = $forgotPassword;

            return view('users::pages.changepassword')->with($data);
        } else {
            return Redirect::to('login');
        }
    }

    public function changepassword_request ()
    {
        $password = Input::get('password');
        $verify_password = Input::get('verify_password');
        $password_code = Input::get('forgot_password_code');
        $forgotPassword = ForgotPassword::getPasswordCode($password_code);

        // make sure that both passwords are correct
        if ( $password != $verify_password ) {
            Session::flash('warning', 'Your passwords do not match.');
            return Redirect::to('forgotpassword/changepassword/'.$password_code);
        }

        if ( $forgotPassword && count($forgotPassword) > 0 ) {
            // get user by email
            $user = Users::getRecordByEmail($forgotPassword->email);

            $salt = Salt::generateRandomSalt(10);
            $newPassword = Hash::make($password.$salt);

            Users::updateUserPassword($user->user_id, $newPassword, $salt);

            Session::flash('message', 'You have successfully updated your password. Please try logging in.');
            return Redirect::to('login');
        } else {
            return Redirect::to('login');
        }
    }

    private function saveLog( $type=NULL, $user_id=NULL )
    {
        /**
         * NOTE: DO NOT FORGET TO INCLUDE FACILITY ID
         *
         */
        $datenow = Carbon::now();

        $logs = new UserLogs;
        $logs->userusagestat_id =
        $logs->user_id = $user_id;

        if ($type == 'login'):
            $logs->login_datetime = $datenow;
        else:
            $logs->logout_datetime = $datenow;
        endif;

        $logs->device = "Desktop"; //temp

        $logs->save();

        if ($logs->save() == true):
            return true;
        endif;

        return false;
    }

    /**
     * TRANSFER THIS CAMILLE
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    private function getRoleAndAccess($user_id = NULL)
    {
        $facilityuser_id = Users::with('facilityUser','facilities')->where('user_id', $user_id)->get();
        $fu_id = $facilityuser_id[0]->facilityUser[0]->facilityuser_id; // USE REPOSITORY CAMILLE

        $r = Roles::with('access')->whereHas('access', function($query) use ($fu_id) {
            $query->where('roles_access.facilityuser_id', $fu_id);
        })->get();

        $roles = array();

        foreach ($r as $role):
            $roles['role_name'] = $role->role_name;

            foreach ($role->access as $permission):
                $module = $this->getModuleName($permission->module_id);
                $roles['modules'] = array();
                // $roles['modules'][$module->module_name]['name'] = $module->module_name;
                // $roles['modules'][$module->module_name]['icon'] = $module->icon;
                // $roles['modules'][$module->module_name]['status'] = $module->status;
                // $roles['modules'][$module->module_name]['access'][] = $permission->module_access;
                // $roles['modules'][$module->module_name]['order'] = $module->menu_order;

                if ($role->role_name == 'Developer'): // FOR DEVELOPER VERSION ONLY; kindly clean up
                    $directoryModules = File::directories('modules');

                    foreach($directoryModules as $val):
                        $directory = explode(DS,$val); //changed DS to make it function on Linux and Windows
                        $directory_name = strtolower($directory[1]);
                        $roles['external_modules'][$directory_name] = $val;
                    endforeach;
                endif;
            endforeach;
        endforeach;

        sortby('order', $roles['modules']);

        Cache::forever('roles', $roles);
    }

    private function getModuleName($module_id)
    {
        $module = DB::table('lov_modules')->select('*')->where('id', $module_id)->first();

        return $module;
    }


}
