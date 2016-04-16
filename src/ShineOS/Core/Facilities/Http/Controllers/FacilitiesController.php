<?php namespace ShineOS\Core\Facilities\Http\Controllers;

use Shine\Libraries\Utils;
use Shine\Libraries\Utils\Lovs;
use Illuminate\Routing\Controller;
use ShineOS\Core\Facilities\Entities\Facilities;
use ShineOS\Core\Facilities\Entities\FacilityContact;
use ShineOS\Core\Facilities\Entities\DOHFacilityCode;
use ShineOS\Core\Users\Entities\Users;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session,
    Redirect,
    Hash,
    Auth;

class FacilitiesController extends Controller {

    protected $moduleName = 'Facilities';
    protected $modulePath = 'facilities';
    protected $viewPath = 'facilities::';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $modules =  Utils::getModules();

        # variables to share to all view
        View::share('modules', $modules);
        View::share('moduleName', $this->moduleName);
        View::share('modulePath', $this->modulePath);
    }

    //UNCOMMENT TO ENABLE

    /**
     * Display a user listing.
     *
     * @return Response
     */
    public function facilities()
    {
        //get this facility info from session
        $thisfacility = json_decode(Session::get('_global_facility_info'));
        $thisUser = Session::get('_global_user');
        $facilities = Facilities::with('facilityContact')->get();

        // get current user ID
        //$curUser = UserHelper::getUserInfo();
        $data['currentID'] = $thisUser->user_id;

        $data = array();
        $data['currentFacility'] = $thisfacility;
        $facilityContact = FacilityContact::getContact($thisfacility->facility_id);
        $data['facilityContact'] = $facilityContact;
        $data['doh'] = $thisfacility->DOH_facility_code;
        $data['userInfo'] = $thisUser;
        $data['profile_completeness'] = Users::computeProfileCompleteness($thisUser->user_id);

        $data['equipments'] = Lovs::getEnumsByType('EQUIPMENT_TYPE');
        $data['specialties'] = Lovs::getEnumsByType('SPECIALTY_TYPE');
        $data['services'] = Lovs::getEnumsByType('SERVICES_TYPE');

        return view($this->viewPath.'facilities')->with($data);
    }

    /**
     * Add facilities
     *
     * @return Response
     */
    public function add_facility () {
        $data = array();
        return view($this->viewPath.'index')->with($data);
    }

    /**
     * Update Facility Info
     *
     * @return Response
     */
    public function updatefacilityinfo ( $facility_id = 0 ) {
        $data = array();

        Facilities::updateFacilityById($facility_id);

        //let us update session values
        $facility = json_encode(Facilities::getCurrentFacility($facility_id));
        Session::put('_global_facility_info', $facility);

        // redirect
        Session::flash('message', 'Successfully updated Facility Information!');
        return Redirect::to($this->modulePath);
    }

    /**
     * Update Facility Contact
     *
     * @return Response
     */
    public function updatefacilitycontact ( $facility_id = 0 ) {
        $data = array();

        FacilityContact::updateContactByFacilityId($facility_id);

        // redirect
        Session::flash('message', 'Successfully updated Facility Contact!');
        return Redirect::to($this->modulePath);
    }

    /**
     * Update Facility Specialization
     *
     * @return Response
     */
    public function updatespecialization ( $facility_id = 0 ) {
        $data = array();
        Facilities::updateFacilitySpecializationById($facility_id);

        //let us update session values
        $facility = json_encode(Facilities::getCurrentFacility($facility_id));
        Session::put('_global_facility_info', $facility);

        // redirect
        Session::flash('message', 'Successfully updated Facility Specialization!');
        return Redirect::to($this->modulePath);
    }



    public function auditTrail()
    {
        return view($this->viewPath.'userlogs');
    }

    public function permissions()
    {
        return view($this->viewPath.'userpermissions');
    }


    private function print_this( $object = array(), $title = '' ) {
        echo "<hr><h2>{$title}</h2><pre>";
        print_r($object);
        echo "</pre>";
    }

}
