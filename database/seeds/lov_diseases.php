<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Shine\Libraries\IdGenerator;

class lov_diseases extends Seeder
{ 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Model::unguard();
        
		# Medical History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Asthma',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Cancer',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Specified Cancer',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Cerebrovascular Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Coronary Artery Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Diabetes Mellitus',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Emphysema',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Epilepsy/Seizure Disorder',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Hepatitis',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Specified Hepatitis',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'With Hypertension',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'With Peptic Ulcer Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'With Pneumonia',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'With Thyroid Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Highest Blood Pressure - Diastolic',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Highest Blood Pressure - Systolic',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'If PTB, Category',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Urinary Tract Infection',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'With Other Past Medical History',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Medical History',
			'disease_name' => 'Other Specified',
			'disease_input_type' => 'text',
			]);
			
		
		// Surgical History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Surgical History',
			'disease_name' => 'Past Surgical Operation',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Surgical History',
			'disease_name' => 'Date of Operation',
			'disease_input_type' => 'text',
			]);
		
		// Family Medical History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Asthma',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Allergy',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Specific Allergy',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Diabetes Mellitus',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Cancer',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Specified Cancer - Organ',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Cerebrovascular Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Coronary Artery Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Emphysema',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Epilepsy/Seizure',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Heart Attack',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Hepatitis',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Hepatitis - Specified',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Hyperlipidemia',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Hypertension',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Peptic Ulcer Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Thyroid Disease',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Stroke',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Tuberculosis',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Tuberculosis - Specified Organ',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'If PTB - Category',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Kidney Diseases',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Medical History',
			'disease_name' => 'Others - Specified',
			'disease_input_type' => 'text',
			]);
		
		
		// Personal/Social History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Personal/Social History',
			'disease_name' => 'Smoking',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Personal/Social History',
			'disease_name' => 'Number of Packs per Year',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Personal/Social History',
			'disease_name' => 'Drinking Alcohol',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Personal/Social History',
			'disease_name' => 'Number of Bottles per Day',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Personal/Social History',
			'disease_name' => 'Taking Illicit Drugs',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown|Not Applicable',
			]);
		
		// Immunization History for Children
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'BCG',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'OPV 1',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'OPV 2',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'OPV 3',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'DPT 1',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'DPT 2',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'DPT 3',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'Measles',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'Hepatitis B1',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'Hepatitis B2',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'Hepatitis B3',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'Hepatitis A',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Children',
			'disease_name' => 'VARICELLA / Chicken Pox',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);

		// Immunization History for Young Women
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Young Women',
			'disease_name' => 'HPV',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Young Women',
			'disease_name' => 'MMR',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		
		
		// Immunization History for Young Women
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Young Women',
			'disease_name' => 'HPV',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Young Women',
			'disease_name' => 'MMR',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		
		// Immunization History for Pregnancy
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Immunization History for Pregnancy',
			'disease_name' => 'Tetanus Toxoid',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
			
		// Menstrual History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Menarche',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Last Mentrual Period',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Period Duration',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Interval/Cycle',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'No. of Pads/Day during Menstruation',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Onset of Sexual Intercourse',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Birth Control Method',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Menopaused?',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Menstrual History',
			'disease_name' => 'Menopausal Age',
			'disease_input_type' => 'text',
			]);
		
		// Pregnancy History
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Gravidity (Number of Pregnancies)',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Parity',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Type of Delivery',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Number of Full Term',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Number of Premature',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Number of Abortion',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Number of Living Children',
			'disease_input_type' => 'text',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Pregnancy History',
			'disease_name' => 'Induced Hypertension (Pre-eclampsia)',
			'disease_input_type' => 'text',
			]);
			
			
		// Family Planning Counseling
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Family Planning Counseling',
			'disease_name' => 'Access to Family Planning Counseling',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown|Not Applicable',
			]);
			
		// Drugs & Medicine Intake
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Drugs & Medicine Intake',
			'disease_name' => 'Intake of Oral Hypoglycemic Agents',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
		DB::table('lov_diseases')->insert([
			'disease_id' => IdGenerator::generateId(),
			'disease_category' => 'Drugs & Medicine Intake',
			'disease_name' => 'Intake of Hypertensive Medicine',
			'disease_input_type' => 'radio',
			'disease_radio_values' => 'Yes|No|Unknown',
			]);
			
			
        Model::reguard();
    }
}
