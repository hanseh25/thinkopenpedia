<?php
namespace ShineOS\Core\Records\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Patients\Entities\Patients;
use ShineOS\Core\Healthcareservices\Entities\Healthcareservices;
use ShineOS\Core\Facilities\Entities\Diagnosis;
use ShineOS\Core\Roles\Entities\Features as Features;
use ShineOS\Core\Facilities\Entities\FacilityUser;
use ShineOS\Core\Facilities\Entities\FacilityPatientUser;
use ShineOS\Core\Facilities\Entities\Facilities;
use ShineOS\Core\Referrals\Entities\Referrals;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\Utils;
use Shine\Libraries\HealthcareservicesHelper; 
use Shine\Repositories\Eloquent\UserRepository as UserRepository;
use Shine\Repositories\Eloquent\HealthcareRepository as HealthcareRepository;
use Shine\Repositories\Contracts\FacilityRepositoryInterface;

use DB, View, Input, DateTime;
/**
 * A class that acts as gateway to Patients and Healthcare Modules
 */
class RecordsController extends Controller {

    private $UserRepository;
    private $healthcareRepository;


    public function __construct(UserRepository $UserRepository, HealthcareRepository $healthcareRepository)
    {
        $this->middleware('auth');
        $this->UserRepository = $UserRepository;
        $this->HealthcareRepository = $healthcareRepository;

        $modules =  Utils::getModules();

        # variables to share to all view
        View::share('modules', $modules);
    }

    public function index() {

        $facilityInfo = FacilityHelper::facilityInfo();

        /**
         * Get patient records from referred and created patients
         * @var [type]
         */
        //$orig_patients = getAllPatientsByFacility();
        $patients = getAllPatientsByFacility();

        // $referred_patientsID = Referrals::select('healthcareservice_id')->where('facility_id', $facilityInfo->facility_id)->get();
        // $referred_patients = Patients::with('patientContact','facilityUser','patientDeathInfo','facilityUser')->where('patient_id', getPatientIDByHealthcareserviceID($referred_patientsID[0]->healthcareservice_id))->get();

        /*$referred_patientsID = Referrals::select('healthcareservice_id')->where('facility_id', $facilityInfo->facility_id)->get();
        $referred_patients = Patients::with('patientContact','facilityUser','patientDeathInfo','facilityUser')->where('patient_id', getPatientIDByHealthcareserviceID($referred_patientsID[0]->healthcareservice_id))->get();*/

        /**
         * Get patient records from referred and created patients
         * @var [type]
         */
        //$healthcare_patients = Healthcareservices::with('patients')->get();

        /**
         * Merge all arrays into one variable
         * @patients [array]
         */

       // $patients = $orig_patients->merge($referred_patients);


        // HEALTHCARE RECORDS
        $visits = json_decode($this->HealthcareRepository->findHealthcareByFacilityID($facilityInfo->facility_id));

        foreach ($visits as $k => $v) {
            $v->seen_by = json_decode($this->UserRepository->findUserByFacilityUserID($v->seen_by));
            $v->healthcare_disposition = json_decode($this->HealthcareRepository->findDispositionByHealthcareserviceid($v->healthcareservice_id));
        }

        return view('records::pages.index',compact('patients','visits'));
    }

    public function search()
    {
        return view('records::pages.search');
    }

    public function getResults()
    {
        $name = (Input::get('input_name') != '') ? Input::get('input_name') : null;
        $age = (Input::get('input_ageRange') != '') ? explode('-', Input::get('input_ageRange')) : null;
        $sex = (Input::get('input_sex') != '') ? Input::get('input_sex') : null;
        $barangay = (Input::get('input_barangay') != '') ? getBrgyCode(Input::get('input_barangay')) : null;
        $citymun = (Input::get('input_cityMun') != '') ? getCityCode(Input::get('input_cityMun')) : null;
        $diagnosis = (Input::get('input_diagnosis') != '') ? Input::get('input_diagnosis') : null;
        $medicalorder = (Input::get('input_medicalOrder') != '') ? Input::get('input_medicalOrder') : null;

        $results = FacilityPatientUser::name($name)->agerange($age)->sex($sex)->hasbarangay($barangay)->hascitymun($citymun)->hasdiagnosis($diagnosis)->hasmedicalorder($medicalorder)->orderBy('created_at')->get();
        $patients = array();

        if ($results) :
            foreach ($results as $key => $val):
                $patients[] = getCompletePatientByPatientID($val->patient_id);
            endforeach;
        endif;
        
        //dd(DB::getQueryLog());
        return view('records::pages.searchResults', compact('patients'));
    }
}
