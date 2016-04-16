<?php
namespace ShineOS\Core\Reports\Entities;

use Shine\Libraries\FacilityHelper;
use ShineOS\Core\Patients\Entities\Patients;
use Shine\Libraries\UserHelper;
use ShineOS\Core\Facilities\Entities\FacilityUser;
use App\Libraries\CSSColors;
use DB, Input, DateTime;

class Reports {


    /**
     * Returns table name
     *
     * @return object
     */
    public static function getReportsByAge ()
    {
        return DB::table(self::$table_name)->simplePaginate(15);
    }

    public static function getGraphByAge ( $from=NULL, $to=NULL )
    {//CSSColors::random_color()
        $data = array();
        $labels = array();
        $patientData = array();
        $femaleData = array();
        $maleData = array();

        if ($from == NULL):
            $from = new DateTime('tomorrow -1 week');
            $from = $from->format('Y-m-d H:i:s');
            $to = new DateTime();
            $to = $to->format('Y-m-d H:i:s');
        else:
            $from = $from;
            $to = $to;
        endif;

        $patientsFemale = DB::select("
            SELECT age, gender, patients.created_at, MONTHNAME(patients.created_at) as month
            FROM patients
            WHERE patients.deleted_at IS NULL AND patients.created_at BETWEEN DATE('{$from}') AND DATE('{$to}')
            AND gender='F'
            GROUP BY age
            ORDER BY created_at ASC
        ");

        foreach ( $patientsFemale as $female ) {
            $femaleData[] = $female->age;
            if ( !in_array($female->month, $labels) ) {
                $labels[] = $female->month;
            }
        }

        $patientsMale = DB::select("
            SELECT age, gender, patients.created_at, MONTHNAME(patients.created_at) as month
            FROM patients
            WHERE patients.deleted_at IS NULL AND patients.created_at BETWEEN DATE('{$from}') AND DATE('{$to}')
            AND gender='M'
            GROUP BY age
            ORDER BY created_at ASC
        ");
        foreach ( $patientsMale as $male ) {
            $maleData[] = $male->age;
            if ( !in_array($male->month, $labels) ) {
                $labels[] = $male->month;
            }
        }

        $patientData[] = array(
            'label' => "Female",
            'fillColor' => "rgb(255, 128, 0)",
            'strokeColor' => "rgb(255, 128, 0)",
            'pointColor' => "rgb(255, 128, 0)",
            'pointStrokeColor' => "#c1c7d1",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgb(220,220,220)",
            'data' => $femaleData
        );
        $patientData[] = array(
            'label' => "Male",
            'fillColor' => "rgba(128,255,0)",
            'strokeColor' => "rgba(128,255,0)",
            'pointColor' => "rgb(255, 128, 0)",
            'pointStrokeColor' => "#3b8bba",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgb(220,220,220)",
            'data' => $maleData
        );

        $data['labels'] = $labels;
        $data['patientData'] = $patientData;


        return json_encode($data);
    }


    public static function getReportData($from=NULL, $to=NULL)
    {
        $data = array();
        //default date range is from 10 years ago
        if ($from == NULL):
            $from = new DateTime('tomorrow -10 year');
            $from = $from->format('Y-m-d H:i:s');
            $to = new DateTime();
            $to = $to->format('Y-m-d H:i:s');
        else:
            $from = $from;
            $to = $to;
        endif;

        $facility = FacilityHelper::facilityInfo();
        $user = UserHelper::getUserInfo();

        $facilityuser_id = FacilityUser::where('facility_id',$facility->facility_id)->where('user_id',$user->user_id)->pluck('facilityuser_id');

        /**
         * Change query / variable name
         */
        $data['latest_patients'] = DB::select('SELECT patients.patient_id, patients.last_name, patients.first_name, patients.middle_name, patients.photo_url, patients.created_at
        FROM patients
        JOIN facility_patient_user ON patients.patient_id = facility_patient_user.patient_id
        WHERE patients.deleted_at IS NULL
        AND facility_patient_user.facilityuser_id = "'.$facilityuser_id.'"
        ORDER BY created_at DESC LIMIT 8');

        $data['top_patients'] = DB::select('SELECT patients.patient_id, patients.last_name, patients.first_name, patients.middle_name, patients.photo_url, count(*) as visits FROM healthcare_services JOIN facility_patient_user ON healthcare_services.facilitypatientuser_id = facility_patient_user.facilitypatientuser_id JOIN patients ON facility_patient_user.patient_id = patients.patient_id WHERE patients.deleted_at IS NULL AND healthcare_services.created_at BETWEEN :from_date AND :to_date AND facility_patient_user.facilityuser_id = "'.$facilityuser_id.'" GROUP BY healthcare_services.facilitypatientuser_id ORDER BY count(*) DESC LIMIT 10', ['from_date' => $from, 'to_date', $to]);

        $data['count_by_gender_sex'] = Patients::select('birthdate', 'gender', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$from, $to])
            ->where('deleted_at', NULL)
            ->groupby('gender')
            ->whereHas('facilityUser', function($query) use ($facility) {
                    $query->where('facility_id', '=', $facility->facility_id);
            })
            ->get();

        //count patients by age range
        $data['count_by_gender_age'] = DB::select('SELECT
             CASE
                WHEN age < 10 THEN "A"
                WHEN age BETWEEN 10 and 19 THEN "B"
                WHEN age BETWEEN 20 and 59 THEN "C"
                WHEN age BETWEEN 60 and 79 THEN "D"
                WHEN age >= 80 THEN "E"
                WHEN age IS NULL THEN "Not Filled In (NULL)"
            END as age_range,
            COUNT(*) AS count
              FROM (SELECT TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM patients
              JOIN facility_patient_user ON patients.patient_id = facility_patient_user.patient_id
              WHERE patients.deleted_at IS NULL
              AND patients.created_at BETWEEN :from_date AND :to_date
              AND facility_patient_user.facilityuser_id = "'.$facilityuser_id.'"
              ) as derived
              GROUP BY age_range',
               ['from_date' => $from, 'to_date', $to]);

        $data['count_by_services_rendered'] = DB::select('SELECT healthcareservicetype_id, count(*) as total
        FROM healthcare_services
        WHERE facilitypatientuser_id = "'.$facilityuser_id.'"
        AND healthcare_services.deleted_at IS NULL AND healthcare_services.created_at BETWEEN :from_date AND :to_date
        GROUP BY facilitypatientuser_id
        ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        $data['count_by_disease'] = DB::select('SELECT healthcareservicetype_id, count(*) as total FROM healthcare_services JOIN general_consultation ON healthcare_services.healthcareservice_id = general_consultation.healthcareservice_id JOIN diagnosis ON healthcare_services.healthcareservice_id = diagnosis.healthcareservice_id JOIN lov_diseases ON diagnosis.diagnosislist_id = lov_diseases.disease_id
        WHERE healthcare_services.deleted_at IS NULL
        AND facilitypatientuser_id = "'.$facilityuser_id.'"
        AND healthcare_services.created_at BETWEEN :from_date AND :to_date
        GROUP BY facilitypatientuser_id
        ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        return $data;
    }


    public static function getVisitData($from=NULL, $to=NULL)
    {
        $data = array();

        if ($from == NULL):
            $from = new DateTime('tomorrow -1 week');
            $to = new DateTime();
        else:
            $from = $from;
            $to = date("Y-m-d H:i:s", $to);
        endif;

        /**
         * Change query / variable name
         */
        $data['query_1a'] = DB::select('SELECT healthcareservicetype_id,count(*) as visits FROM healthcare_services WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date group by healthcare_services.healthcareservicetype_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        $data['query_2a'] = DB::select('SELECT count(*) as a FROM healthcare_services WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date ORDER BY a DESC', ['from_date' => $from, 'to_date', $to]);

        $data['query_3a'] = DB::select('SELECT lov_diseases.disease_name, count(*) FROM healthcare_services JOIN diagnosis ON healthcare_services.healthcareservice_id = diagnosis.healthcareservice_id JOIN lov_diseases ON diagnosis.diagnosislist_id = lov_diseases.disease_id WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date GROUP BY healthcare_services.healthcareservicetype_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        return $data;
    }

    public static function getPatientData($from=NULL, $to=NULL)
    {
        $data = array();

        if ($from == NULL):
            $from = new DateTime('tomorrow -1 week');
            $to = new DateTime();
        else:
            $from = $from;
            $to = date("Y-m-d H:i:s", $to);
        endif;

        /**
         * Change query / variable name
         */
        $data['query_1'] = DB::select('SELECT patients.last_name, count(*) as visits FROM healthcare_services JOIN facility_patient_user ON healthcare_services.facilitypatientuser_id = facility_patient_user.facilitypatientuser_id JOIN patients ON facility_patient_user.patient_id = patients.patient_id WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date GROUP BY healthcare_services.facilitypatientuser_id ORDER BY count(*) DESC LIMIT 10', ['from_date' => $from, 'to_date', $to]);

        $data['query_2'] = DB::select('SELECT last_name, first_name, middle_name, patient_id, gender, age, count(*) as total FROM patients WHERE patients.deleted_at IS NULL AND patients.created_at > :from_date AND patients.created_at < :to_date group by age, gender', ['from_date' => $from, 'to_date', $to]);

        $data['query_3'] = DB::select('SELECT healthcare_servicetype_name, count(*) FROM healthcare_services WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date group by facilitypatientuser_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        $data['query_4'] = DB::select('SELECT healthcare_servicetype_name, count(*) FROM healthcare_services JOIN general_consultation ON healthcare_services.healthcareservice_id = general_consultation.healthcareservice_id JOIN diagnosis ON healthcare_services.healthcareservice_id = diagnosis.healthcareservice_id JOIN lov_diseases ON diagnosis.diagnosislist_id = lov_diseases.disease_id WHERE healthcare_services.deleted_at IS NULL AND healthcare_services.created_at > :from_date AND healthcare_services.created_at < :to_date group by facilitypatientuser_id ORDER BY count(*) DESC', ['from_date' => $from, 'to_date', $to]);

        return $data;
    }


    private static function print_this( $object = array(), $title = '' ) {
        echo "<hr><h2>{$title}</h2><pre>";
        print_r($object);
        echo "</pre>";
    }
}
