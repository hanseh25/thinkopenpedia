<?php namespace ShineOS\Core\Healthcareservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalOrderProcedure extends Model {
    use SoftDeletes;
    protected $dates = array('procedure_date','deleted_at','created_at','updated_at');
    protected $fillable = [
        'medicalorderprocedure_id',
        'medicalorder_id',
        'procedure_order',
        'procedure_date',
        'deleted_at'

    ];

    protected $table = 'medicalorder_procedure';
    protected $primaryKey = 'medicalorderprocedure_id';

    protected $touches = array('Healthcareservices');

    public function MedicalOrder() {
          return $this->belongsTo('ShineOS\Core\Healthcareservices\Entities\MedicalOrder', 'medicalorder_id', 'medicalorder_id');
      }

    public function Healthcareservices() {
        return $this->belongsTo('ShineOS\Core\Healthcareservices\Entities\Healthcareservices', 'healthcareservice_id');
    }

}
