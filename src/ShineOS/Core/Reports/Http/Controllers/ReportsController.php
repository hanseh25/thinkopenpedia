<?php namespace ShineOS\Core\Reports\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Patients\Entities\Patients;
use ShineOS\Core\Healthcareservices\Entities\Healthcareservices;
use ShineOS\Core\Healthcareservices\Entities\Diagnosis;
use ShineOS\Core\Referrals\Entities\Referrals;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\Utils;
use ShineOS\Core\Reports\Entities\Reports;

use View,
    Response,
    Validator,
    Input,
    Mail,
    Session,
    Redirect,
    Hash,
    Auth,
    DateTime,
    DB;

class ReportsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

        $modules =  Utils::getModules();

        # variables to share to all view
        View::share('modules', $modules);

        //View::addNamespace('analytics', 'src/ShineOS/Core/Analytics/Resources/Views');
    }

    public function index()
    {

        $reportData = Reports::getReportData();

        $data['latest_patients'] = $reportData['latest_patients'];
        $data['top_patients'] = $reportData['top_patients'];
        $data['total_patients_by_sex'] = $reportData['count_by_gender_sex'];
        $data['count_by_gender_sex'] = isset($reportData['count_by_gender_sex'][0]) ? $reportData['count_by_gender_sex'][0]->total : 0;
        $data['count_by_gender_age'] = $reportData['count_by_gender_age'];

        //dd($data['count_by_gender_age']);

        $data['count_by_services_rendered'] = isset($reportData['count_by_services_rendered'][0]) ? $reportData['count_by_services_rendered'][0]->total : 0;
        $data['count_by_disease'] = isset($reportData['count_by_disease'][0]) ? $reportData['count_by_disease'][0]->total : 0;

        //Graph
        $maxdate = date('Y-m-d H:i:s');
        $xdate = strtotime($maxdate .' -6 months');
        $mindate=date('Y-m-d', $xdate);
        $data['services'] = Healthcareservices::select('healthcareservicetype_id', DB::raw('count(*) as counter'))->where('created_at', '<=', $maxdate)->where('created_at', '>', $mindate)->groupBy('healthcareservicetype_id')->orderBy('counter')->get();
        $data['diagnosis'] = Diagnosis::select('diagnosis_type','diagnosislist_id', DB::raw('count(*) as bilang'))->where('created_at', '<=', $maxdate)->where('created_at', '>', $mindate)->groupBy('diagnosislist_id')->orderBy('bilang')->take(4)->get();
        $data['total'] = Healthcareservices::where('created_at', '<=', $maxdate)->where('created_at', '>', $mindate)->count();
        $data['cs_stats'] = [];

        for($d = 1; $d <= 6; $d++) {
            $xr = strtotime($mindate .' +'.$d.' months');
            $ranges[$d] = date('Y-m-d', $xr);
        }
        $data['ranges'] = $ranges;

        foreach($data['services'] as $service) {
            foreach($ranges as $range) {
                $max = date('Y-m-30 11:00:00', strtotime($range));
                $min = date('Y-m-01 00:00:00', strtotime($range));

                $bils = Healthcareservices::select(DB::raw('count(*) as bilang'))->where('created_at', '<=', $max)->where('created_at', '>', $min)->where('healthcareservicetype_id', $service->healthcareservicetype_id)->get();

                foreach($bils as $k=>$bil) {
                    $data['cs_stats'][$service->healthcareservicetype_id][$range] = $bil->bilang;
                }
            }
        }

        //exit;
        $facility_id = FacilityHelper::facilityInfo();
        $data['chart'] = $this->getData();
        $data['patient_count'] = Patients::count();
        $data['visit_count'] = Healthcareservices::count();
        $data['referral_count'] = Referrals::where('facility_id', '=', $facility_id->facility_id)->count(); // change this to facility ID

        return view('analytics::index')->with($data);
    }

    public function getFilteredResults ()
    {
        $from = Input::get('from');
        $to = Input::get('to');
        $filterBy = Input::get('filterBy');

        echo Reports::getGraphByAge($from,$to);
    }

    public function getData ($type=NULL, $from=NULL, $to=NULL)
    {
        if ($type == 'patient'):
            $patient_stats = Reports::getPatientData($from, $to);
            $patient_stats1 = Reports::getVisitData($from, $to);
            //dd($patient_stats1);
        else:
            Reports::getVisitData($from, $to);
        endif;
    }

    public function getReportDataJSON()
    {
        $data = array();

        if (Input::get('from') == NULL):
            $from = new DateTime('tomorrow -1 week');
            $from = $from->format('Y-m-d H:i:s');
            $to = new DateTime();
            $to = $to->format('Y-m-d H:i:s');
        else:
            $from = Input::get('from');
            $to = Input::get('to');
        endif;

        /**
         * Change query / variable name
         */
        $data['top_patients'] = DB::select('SELECT patients.last_name, patients.first_name, patients.middle_name, count(*) as visits FROM healthcare_services JOIN facility_patient_user ON healthcare_services.facilitypatientuser_id = facility_patient_user.facilitypatientuser_id JOIN patients ON facility_patient_user.patient_id = patients.patient_id WHERE healthcare_services.created_at BETWEEN :from_date AND :to_date GROUP BY healthcare_services.facilitypatientuser_id ORDER BY count(*) DESC LIMIT 10', ['from_date' => $from, 'to_date', $to]);

        $data['count_by_gender_sex'] = DB::select('SELECT last_name, first_name, middle_name, patient_id, gender, age, count(*) as total FROM patients WHERE patients.created_at BETWEEN :from_date AND :to_date group by age, gender', ['from_date' => $from, 'to_date', $to]);
        $data['count_by_gender_sex'] = isset($data['count_by_gender_sex'][0]) ? $data['count_by_gender_sex'][0]->total : 0;

        $data['count_by_services_rendered'] = DB::select('SELECT healthcareservicetype_id, count(*) as total FROM healthcare_services WHERE healthcare_services.created_at BETWEEN :from_date AND :to_date group by facilitypatientuser_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);
        $data['count_by_services_rendered'] = isset($data['count_by_services_rendered'][0]) ? $data['count_by_services_rendered'][0]->total : 0;

        $data['count_by_disease'] = DB::select('SELECT healthcareservicetype_id, count(*) as total FROM healthcare_services JOIN general_consultation ON healthcare_services.healthcareservice_id = general_consultation.healthcareservice_id JOIN diagnosis ON healthcare_services.healthcareservice_id = diagnosis.healthcareservice_id JOIN lov_diseases ON diagnosis.diagnosislist_id = lov_diseases.disease_id WHERE healthcare_services.created_at BETWEEN :from_date AND :to_date group by facilitypatientuser_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);
        $data['count_by_disease'] = isset($data['count_by_disease'][0]) ? $data['count_by_disease'][0]->total : 0;

        echo json_encode($data);
    }

}
