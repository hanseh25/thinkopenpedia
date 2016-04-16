<?php namespace Modules\Pedia\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pedia extends Model {

    protected $table = 'pedia';
    protected static $static_table = 'pedia';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function getChildWeightStandard($gender = 0) {
    	return db::table('child_weights')
    		->where('gender', $gender)
    		->where('number_of_weeks', '<=', 120)
            ->orderBy('number_of_weeks', 'ASC')
    		->get();
    }

    public function getChildLengthStandard($gender = 0) {
    	return db::table('child_lengths')
    		->where('gender', $gender)
    		->where('number_of_weeks', '<=', 120)
            ->orderBy('number_of_weeks', 'ASC')
    		->get();
    }

    public function getHeadCircumference($gender = 0) {
    	return db::table('head_circumferences')
    		->where('gender', $gender)
    		->where('number_of_weeks', '<=', 120)
            ->orderBy('number_of_weeks', 'ASC')
    		->get();
    }

    public function getChestCircumference($gender = 0) {
    	return db::table('head_circumferences')
    		->where('gender', $gender)
    		->where('number_of_weeks', '<=', 120)
            ->orderBy('number_of_weeks', 'ASC')
    		->get();
    }

    public function getPatientGender($patient_id)
    {
        $patient = DB::table('patients')
            ->where('id', $patient_id)->first();

        return ($patient->gender == 'M') ? 1 : 0;
    }

}
