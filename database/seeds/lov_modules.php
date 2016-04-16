<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lov_modules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        // lov_referral_reasons
    	DB::table('lov_modules')->insert(array(
			array('module_name' => 'dashboard','menu_show'=> 1),
			array('module_name' => 'facilities'),
			array('module_name' => 'healthcareservices'),
			array('module_name' => 'patients'),
			array('module_name' => 'records','menu_show'=> 1),
			array('module_name' => 'referrals','menu_show'=> 1),
			array('module_name' => 'reminders','menu_show'=> 1),
			array('module_name' => 'reports','menu_show'=> 1),
			array('module_name' => 'roles','menu_show'=> 1),
			array('module_name' => 'users','menu_show'=> 1),
		));

        Model::reguard();
    }
}

