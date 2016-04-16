<?php
namespace Shine\Repositories\Eloquent;

use Shine\Repositories\Eloquent\BaseRepository as AbstractRepository;
use Shine\Repositories\Contracts\HealthcareRepositoryInterface;
use Illuminate\Container\Container as App;
use Shine\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use ShineOS\Core\Healthcareservices\Entities\Healthcareservices;
use ShineOS\Core\Healthcareservices\Entities\Diagnosis;
use ShineOS\Core\Healthcareservices\Entities\MedicalOrder;
use ShineOS\Core\Healthcareservices\Entities\MedicalOrderPrescription;

/**
 * This class only implements methods specific to the User Module
 */
class HealthcareRepository extends AbstractRepository implements HealthcareRepositoryInterface
{

    /**
     * @var App
     */
    private $app;

     /**
     * @var Model
     */
    protected $modelClassName;

    /**
     * [__construct description]
     * @param App $app [description]
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }
    public function model() {
        return 'ShineOS\Core\Healthcareservices\Entities\Healthcareservices';
    }

    /**
     * Find by healthcareservice_id
     * @return  json
     */
    public function findVitalsPhysicalByHealthcareserviceid($healthcareservice_id) {
        $data = Healthcareservices::with('VitalsPhysical')->has('VitalsPhysical')->where('healthcareservice_id', $healthcareservice_id)->first();
        return json_encode($data);
    }

    public function findDiagnosisByHealthcareserviceid($healthcareservice_id) {
        $data = Diagnosis::with('DiagnosisICD10')->where('healthcareservice_id', $healthcareservice_id)->get();
        return json_encode($data);
    }

    public function findExaminationByHealthcareserviceid($healthcareservice_id) {
        $data = Healthcareservices::with('Examination')->has('Examination')->where('healthcareservice_id', $healthcareservice_id)->first();
        return json_encode($data);
    }

    public function findMedicalOrderByHealthcareserviceid($healthcareservice_id) {
        $data = MedicalOrder::has('MedicalOrderLabExam','MedicalOrderPrescription','MedicalOrderProcedure')->with('MedicalOrderLabExam')->with('MedicalOrderPrescription')->with('MedicalOrderProcedure')->where('healthcareservice_id', $healthcareservice_id)->get();
        return json_encode($data);
    }

    public function findDispositionByHealthcareserviceid($healthcareservice_id) {
        $data = Healthcareservices::with('Disposition')->has('Disposition')->where('healthcareservice_id', $healthcareservice_id)->first();
        return json_encode($data);
    }

    public function findGeneralConsultationByHealthcareserviceid($healthcareservice_id) {
        $data = Healthcareservices::with('GeneralConsultation')->has('GeneralConsultation')->where('healthcareservice_id', $healthcareservice_id)->first();
        return json_encode($data);
    }

    public function allFormsByHealthcareserviceid($healthcareservice_id) {
        $data = Healthcareservices::with(array('GeneralConsultation', 'VitalsPhysical', 'Diagnosis' => function($query) {
                $query->with('DiagnosisICD10');
            },
            'Examination', 'MedicalOrder', 'Disposition', 'Addendum' => function($query) {
                $query->orderBy('created_at', 'DESC');
            }))
        ->where('healthcareservice_id', $healthcareservice_id)->get();
        return json_encode($data);
    }

    /**
     * Find by Facility
     * @return  json
     */
    public function findHealthcareByFacilityID($facility_id, $limit = NULL) {
        $healthcare = Healthcareservices::join('facility_patient_user','healthcare_services.facilitypatientuser_id','=','facility_patient_user.facilitypatientuser_id')
                ->join('facility_user','facility_patient_user.facilityuser_id','=','facility_user.facilityuser_id')
                ->join('facilities','facilities.facility_id','=','facility_user.facility_id')
                ->join('patients','patients.patient_id','=','facility_patient_user.patient_id')
                ->where('facilities.facility_id', $facility_id)
                ->orderBy('healthcare_services.encounter_datetime', 'DESC')
                ->take($limit)
                ->get();
        return $healthcare->toJson();
    }

    public function findHealthcareByPatientID($patient_id, $limit = NULL) {
        $healthcare = Healthcareservices::join('facility_patient_user','healthcare_services.facilitypatientuser_id','=','facility_patient_user.facilitypatientuser_id')
                ->join('facility_user','facility_patient_user.facilityuser_id','=','facility_user.facilityuser_id')
                ->join('facilities','facilities.facility_id','=','facility_user.facility_id')
                ->join('patients','patients.patient_id','=','facility_patient_user.patient_id')
                ->where('patients.patient_id', $patient_id)
                ->orderBy('healthcare_services.encounter_datetime', 'DESC')
                ->take($limit)
                ->get();
        return $healthcare->toJson();
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->modelClassName = $model;
    }
}
