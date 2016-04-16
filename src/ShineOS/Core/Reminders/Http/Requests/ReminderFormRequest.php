<?php namespace ShineOS\Core\Reminders\Http\Requests;

use Response;

use Illuminate\Foundation\Http\FormRequest;

class ReminderFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'reminder-type'     => 'required',
            'message'           => 'required|min:5|max:450',
            'date'              => 'required',
            'email'             => 'required_without_all:mobile-number|email',
            'mobile-number'     => 'required_without_all:email|max:20|min:10'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
