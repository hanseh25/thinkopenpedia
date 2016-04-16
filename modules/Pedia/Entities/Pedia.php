<?php namespace Modules\Calendar\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pedia extends Model {

    protected $table = 'pedia';
    protected static $static_table = 'pedia';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
