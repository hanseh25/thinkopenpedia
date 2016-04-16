<?php namespace Modules\Calendar\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class GrowthProgress extends Model {

    protected $table = 'growth_progresses';
    protected static $static_table = 'growth_progresses';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
