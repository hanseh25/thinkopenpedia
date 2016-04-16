<?php
namespace Shine\Repositories\Contracts;

/**
 * The HealthcareRepositoryInterface contains ONLY method signatures for methods
 * related to the Healthcare services object.
 *
 * Note that we extend from RepositoryInterface, so any class that implements
 * this interface must also provide all the standard eloquent methods (find, all, etc.)
 */
interface HealthcareRepositoryInterface extends BaseRepositoryInterface {
    /**
    * find by Healthcare service id
    */
    public function findVitalsPhysicalByHealthcareserviceid($healthcareservice_id);
    public function findDiagnosisByHealthcareserviceid($healthcareservice_id);
    public function findExaminationByHealthcareserviceid($healthcareservice_id);
    public function findMedicalOrderByHealthcareserviceid($healthcareservice_id);
    public function findDispositionByHealthcareserviceid($healthcareservice_id);
    public function findGeneralConsultationByHealthcareserviceid($healthcareservice_id);
    public function allFormsByHealthcareserviceid($healthcareservice_id);



    /**
    * find by facility id
    */
    public function findHealthcareByFacilityID($facility_id,$limit);
}
