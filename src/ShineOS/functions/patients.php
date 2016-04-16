<?php

/* Functions for Patients */

use Shine\Libraries\FacilityHelper;
use ShineOS\Core\Patients\Entities\Patients;
use ShineOS\Core\Patients\Entities\FacilityPatientUser;
use ShineOS\Core\Healthcareservices\Entities\Healthcareservices;

    /**
     * Get a patient record using Patient ID
     * @param  [string] $id        patient_id
     * @param  [string] $attribute modelObject name
     * @return mixed
     */
    function findPatientByPatientID($id)
    {
        return patients::where('patient_id', '=', $id)->first();
    }

    function findPatient($id)
    {

    }

    /**
     * Get complete patient record including all related information
     * Alerts; Allergies; Disabilities; Contact; DeathInfo
     * using Patient ID
     * @param  [string] $id Patient ID
     * @return [array] Complete Patient record
     */
    function getCompletePatientByPatientID($id)
    {
        return Patients::with('patientAlert','patientAllergies','patientDisabilities','patientContact','patientDeathInfo')->where('patient_id','=', $id)->first();
    }

    /**
     * Get all patients of the Facility of current user
     * @return [array] Array of patient records
     */
    function getAllPatientsByFacility()
    {
        $facilityInfo = FacilityHelper::facilityInfo();

        $patients = Patients::with('patientContact','facilityUser','patientDeathInfo')
                ->whereHas('facilityUser', function($query) use ($facilityInfo) {
                    $query->where('facility_id', '=', $facilityInfo->facility_id);
                })
                ->get();

        return $patients;
    }

    function getPatientIDByHealthcareserviceID($id)
    {
        $hc_service = Healthcareservices::where('healthcareservice_id','=',$id)->first();
        $facilitypatientuser_id = $hc_service->facilitypatientuser_id;
        $facility_patient_user = FacilityPatientUser::where('facilitypatientuser_id','=',$facilitypatientuser_id)->first();
        $patient_id = $facility_patient_user->patient_id;
        return $patient_id;
    }
