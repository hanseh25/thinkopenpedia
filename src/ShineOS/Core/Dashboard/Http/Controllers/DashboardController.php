<?php namespace ShineOS\Core\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Users\Entities\Users;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\Utils;
use Shine\Libraries\UserHelper;
use View, Config;

class DashboardController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $modules =  Utils::getModules();

        # variables to share to all view
        View::share('modules', $modules);
    }

    public function index()
    {
        $id = UserHelper::getUserInfo();
        $facilityInfo = FacilityHelper::facilityInfo(); // get user id
        $userFacilities = FacilityHelper::getFacilities($id);

        return view('dashboard::index', compact('facilityInfo','userFacilities'));
    }

}
