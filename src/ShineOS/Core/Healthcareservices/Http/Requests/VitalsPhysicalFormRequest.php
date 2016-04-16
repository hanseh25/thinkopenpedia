<?php namespace ShineOS\Core\Healthcareservices\Http\Requests;

use Response;
use Illuminate\Foundation\Http\FormRequest;

class VitalsPhysicalFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'temperature'     => array('required','regex:/[\d]*,?[\d]*/'),
            'heart_rate'     => 'integer',
            'bloodpressure_systolic'     => 'integer|min:50|max:300',
            'bloodpressure_diastolic'     => 'integer|min:50|max:300',
            'height'     => 'integer',
            'weight'     => 'integer',
            'waist'     => 'integer'
        ];
    }

    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }
}
