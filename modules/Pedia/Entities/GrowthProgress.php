<?php namespace Modules\Calendar\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class GrowthProgress extends Model {

    protected $table = 'growth_progress';
    protected static $static_table = 'growth_progress';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
