<?php
namespace Plugins\FamilyPlanning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class FamilyPlanningModel extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'familyplanning_service';
    protected static $table_name = 'familyplanning_service';
    protected $primaryKey = 'familyplanning_id';

}
