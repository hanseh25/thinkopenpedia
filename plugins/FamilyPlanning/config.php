<?php

$plugin_name = 'FamilyPlanning';                     //plugin name
$plugin_id = 'familyplanning';                       //plugin ID
$plugin_module = 'healthcareservices';          //module owner
$plugin_location = 'dropdown';                  //UI location where plugin will be accessible
$plugin_primaryKey = 'healthcareservice_id';        //primary_key used to find data
$plugin_table = 'familyplanning_service';            //plugintable default; table_name custom table
$plugin_tabs_child = array('addservice', 'vitals', 'familyplanning_plugin', 'medicalorders', 'disposition'); //,

$plugin_relationship = array();
$plugin_folder = 'FamilyPlanning'; //module owner
$plugin_title = 'Family Planning';            //plugin title
$plugin_description = 'Family Planning';
$plugin_version = '1.0';
$plugin_developer = 'ShineLabs';
$plugin_url = 'http://www.shine.ph';
$plugin_copy = "2016";

$plugin_tabs = [
    'addservice' => 'Basic Information',
    'disposition' => 'Disposition',
    'medicalorders' => 'Medical Orders',
    'vitals' => 'Vitals & Physical',
    'familyplanning_plugin' => 'Family Planning'
];

$plugin_tabs_models = [
    'disposition' => 'Disposition',
    'medicalorders' => 'MedicalOrder',
    'vitals' => 'VitalsPhysical',
    'familyplanning_plugin' => 'FamilyPlanningModel'
];

//============
// DB Table definition
//
$dbtable = "CREATE TABLE IF NOT EXISTS `familyplanning_service` (
  `familyplanning_id` VARCHAR(32) UNIQUE NOT NULL,
  `healthcareservice_id` VARCHAR(32) UNIQUE NOT NULL,
  `conjunctiva` VARCHAR(60) DEFAULT NULL,
  `neck` VARCHAR(60) DEFAULT NULL,
  `breast` VARCHAR(60) DEFAULT NULL,
  `thorax` VARCHAR(60) DEFAULT NULL,
  `abdomen` VARCHAR(60) DEFAULT NULL,
  `extremities` VARCHAR(60) DEFAULT NULL,
  `perineum` VARCHAR(60) DEFAULT NULL,
  `vagina` VARCHAR(60) DEFAULT NULL,
  `cervix` VARCHAR(60) DEFAULT NULL,
  `consistency` VARCHAR(60) DEFAULT NULL,
  `uterus_position` VARCHAR(60) DEFAULT NULL,
  `uterus_size` VARCHAR(60) DEFAULT NULL,
  `uterus_depth` VARCHAR(60) DEFAULT NULL,
  `adnexa` VARCHAR(60) DEFAULT NULL,
  `full_term` VARCHAR(60) DEFAULT NULL,
  `abortions` VARCHAR(60) DEFAULT NULL,
  `premature` VARCHAR(60) DEFAULT NULL,
  `living_children` VARCHAR(60) DEFAULT NULL,
  `date_of_last_delivery` VARCHAR(60) DEFAULT NULL,
  `type_of_last_delivery` VARCHAR(60) DEFAULT NULL,
  `past_menstrual_period` VARCHAR(60) DEFAULT NULL,
  `last_menstrual_period` VARCHAR(60) DEFAULT NULL,
  `number_of_days_menses` VARCHAR(60) DEFAULT NULL,
  `character_of_menses` VARCHAR(60) DEFAULT NULL,
  `history_of_following` TEXT DEFAULT NULL,
  `with_history_of_multiple_partners` VARCHAR(15) DEFAULT NULL,
  `sti_risks_women` TEXT DEFAULT NULL,
  `sti_risks_men` TEXT DEFAULT NULL,
  `violence_against_women` TEXT DEFAULT NULL,
  `referred_to` TEXT DEFAULT NULL,
  `referred_to_others` TEXT DEFAULT NULL,
  `planning_start` VARCHAR(60) DEFAULT NULL,
  `no_of_living_children` VARCHAR(60) DEFAULT NULL,
  `plan_more_children` VARCHAR(15) DEFAULT NULL,
  `reason_for_practicing_fp` TEXT DEFAULT NULL,
  `client_type` VARCHAR(60) DEFAULT NULL,
  `client_sub_type` VARCHAR(60) DEFAULT NULL,
  `previous_method` VARCHAR(60) DEFAULT NULL,
  `current_method` VARCHAR(60) DEFAULT NULL,
  `remarks` TEXT DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

DB::statement($dbtable);
