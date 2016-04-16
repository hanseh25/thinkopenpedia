<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class lov_medicalcategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // lov_medicalcategory
    	DB::table('lov_medicalcategory')->insert(array(
    		array('medicalcategory_id' => '1','medicalcategory_code' => 'GC_ALLERGOLOGY', 'medicalcategory_name' => 'Allergology'),
    		array('medicalcategory_id' => '2','medicalcategory_code' => 'GC_ANESTHESIA', 'medicalcategory_name' => 'Anesthesia'),
    		array('medicalcategory_id' => '3','medicalcategory_code' => 'GC_BLOOD_BANK', 'medicalcategory_name' => 'Blood Bank'),
    		array('medicalcategory_id' => '4','medicalcategory_code' => 'GC_CARDIOLOGY', 'medicalcategory_name' => 'Cardiology'),
    		array('medicalcategory_id' => '5','medicalcategory_code' => 'GC_CARDIO_SURGERY', 'medicalcategory_name' => 'Cardiothoracic Surgery'),
    		array('medicalcategory_id' => '6','medicalcategory_code' => 'GC_DENTAL', 'medicalcategory_name' => 'Dental'),
    		array('medicalcategory_id' => '7','medicalcategory_code' => 'GC_DERMATOLOGY', 'medicalcategory_name' => 'Dermatology'),
    		array('medicalcategory_id' => '8','medicalcategory_code' => 'GC_ENT', 'medicalcategory_name' => 'ENT'),
    		array('medicalcategory_id' => '9','medicalcategory_code' => 'GC_ENDOCRINOLOGY', 'medicalcategory_name' => 'Endocrinology'),
    		array('medicalcategory_id' => '10','medicalcategory_code' => 'GC_FAMILY_MEDICINE', 'medicalcategory_name' => 'Family Medicine'),
    		array('medicalcategory_id' => '11','medicalcategory_code' => 'GC_GASTROENTEROLOGY', 'medicalcategory_name' => 'Gastroenterology'),
    		array('medicalcategory_id' => '12','medicalcategory_code' => 'GC_GEN_SURGERY', 'medicalcategory_name' => 'General Surgery'),
    		array('medicalcategory_id' => '13','medicalcategory_code' => 'GC_GERIATRICS', 'medicalcategory_name' => 'Geriatrics'),
    		array('medicalcategory_id' => '14','medicalcategory_code' => 'GC_INF_DISEASE', 'medicalcategory_name' => 'Infectious Diseases'),
    		array('medicalcategory_id' => '15','medicalcategory_code' => 'GC_INT_MEDICINE', 'medicalcategory_name' => 'Internal Medicine'),
    		array('medicalcategory_id' => '16','medicalcategory_code' => 'GC_NEONATOLOGY', 'medicalcategory_name' => 'Neonatology'),
    		array('medicalcategory_id' => '17','medicalcategory_code' => 'GC_NEPHROLOGY', 'medicalcategory_name' => 'Nephrology'),
    		array('medicalcategory_id' => '18','medicalcategory_code' => 'GC_NEUROLOGY', 'medicalcategory_name' => 'Neurology'),
    		array('medicalcategory_id' => '19','medicalcategory_code' => 'GC_NEUROSURGERY', 'medicalcategory_name' => 'Neurosurgery'),
    		array('medicalcategory_id' => '20','medicalcategory_code' => 'GC_NEWBORN', 'medicalcategory_name' => 'Newborn Screening'),
    		array('medicalcategory_id' => '21','medicalcategory_code' => 'GC_OBS_GYNECOLOGY', 'medicalcategory_name' => 'Obstetrics-Gynecology'),
    		array('medicalcategory_id' => '22','medicalcategory_code' => 'GC_ONCOLOGY', 'medicalcategory_name' => 'Oncology'),
    		array('medicalcategory_id' => '23','medicalcategory_code' => 'GC_OPTHALMOLOGY', 'medicalcategory_name' => 'Opthalmology'),
    		array('medicalcategory_id' => '24','medicalcategory_code' => 'GC_ORTHOPEDICS', 'medicalcategory_name' => 'Orthopedics'),
    		array('medicalcategory_id' => '25','medicalcategory_code' => 'GC_PLASTIC_SURGERY', 'medicalcategory_name' => 'Plastic Surgery'),
    		array('medicalcategory_id' => '26','medicalcategory_code' => 'GC_PSYCHIATRY', 'medicalcategory_name' => 'Psychiatry'),
    		array('medicalcategory_id' => '27','medicalcategory_code' => 'GC_PULMUNOLOGY', 'medicalcategory_name' => 'Pulmunology'),
    		array('medicalcategory_id' => '28','medicalcategory_code' => 'GC_RADIOLOGY', 'medicalcategory_name' => 'Radiology'),
    		array('medicalcategory_id' => '29','medicalcategory_code' => 'GC_REHAB_MEDICINE', 'medicalcategory_name' => 'Rehabilitation Medicine'),
    		array('medicalcategory_id' => '30','medicalcategory_code' => 'GC_RHEUMATOLOGY', 'medicalcategory_name' => 'Rheumatology'),
    		array('medicalcategory_id' => '31','medicalcategory_code' => 'GC_SURG_ONCOLOGY', 'medicalcategory_name' => 'Surgical Oncology'),
    		array('medicalcategory_id' => '32','medicalcategory_code' => 'GC_TUBERCULOSIS', 'medicalcategory_name' => 'Tuberculosis'),
    		array('medicalcategory_id' => '33','medicalcategory_code' => 'GC_UROLOGY', 'medicalcategory_name' => 'Urology'),
    		array('medicalcategory_id' => '34','medicalcategory_code' => 'GC_VASCULAR_SURGERY', 'medicalcategory_name' => 'Vascular Surgery'),
			));
		Model::reguard();
    }
}
