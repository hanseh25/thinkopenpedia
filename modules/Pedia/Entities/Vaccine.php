<?php namespace Modules\Pedia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Vaccine extends Model {

    protected $table = 'vaccines';
    protected static $static_table = 'vaccines';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
