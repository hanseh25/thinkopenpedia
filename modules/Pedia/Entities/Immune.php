<?php namespace Modules\Pedia\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Immune extends Model {

    protected $table = 'immune';
    protected static $static_table = 'immune';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
