<?php namespace ShineOS\Core\Reminders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReminderMessage extends Model {
    use SoftDeletes;
    protected $fillable = [];
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reminder_message';
    protected static $static_table = 'reminder_message';
    /**
     * Override primary key used by model
     *
     * @var string
     */
    protected $primaryKey = 'remindermessage_id';

    public function reminders() {
        return $this->hasMany('ShineOS\Core\Reminders\Entities\Reminders', 'reminder_id');
    }
}
