<?php namespace Modules\Pedianatic\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pedianatic extends Model {

    protected $table = 'pedianatic';
    protected static $static_table = 'pedianatic';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
