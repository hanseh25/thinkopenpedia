<?php namespace ShineOS\Core\Healthcareservices\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Healthcareservices\Entities\GeneralConsultation; //model
use ShineOS\Core\Healthcareservices\Http\Requests\ComplaintsFormRequest;

use ShineOS\Core\Patients\Entities\Patients;
use Shine\Libraries\IdGenerator;
use View, Response, Validator, Input, Mail, Session, Redirect, Hash, Auth, DB, Datetime, Request;

class ComplaintsController extends Controller {

    protected $facility_name = "samplefacility name";
    protected $tb_unique_id = "";
    protected $diag_unique_id = "";
    protected $current_timestamp;

    protected $default_tbl = "general_consultation";
    protected $txt_hservices_id;

    private $txt_action;
    private $params;

    public function __construct() {
        $date = new Datetime('now');
        $this->current_timestamp = strtotime($date->format('Y-m-d H:i:s'));
        $this->tb_unique_id =  IdGenerator::generateId();

        $this->action = Input::has('action') ? Input::get('action')  : false;
        $this->txt_hservices_id = Input::has('healthcareservice_id') ? Input::get('healthcareservice_id')  : false;

        $medicalcategory_id = Session::get('medicalcategory_id');

        $this->params = array(
            "txt_id" => Input::has('generalconsultation_id') ? Input::get('generalconsultation_id')  : '',
            "txt_complaint" => Input::has('complaint') ? Input::get('complaint')  : '',
            "txt_complaint_history" => Input::has('complaint_history') ? Input::get('complaint_history')  : '',
            "txt_physical_exam" => Input::has('physical_examination') ? Input::get('physical_examination')  : '',
            "txt_remarks" => Input::has('remarks') ? Input::get('remarks')  : '',
        );
    }

    public function add(ComplaintsFormRequest $request) {
        $query = GeneralConsultation::find($this->params['txt_id']);
        $query->healthcareservice_id = $this->txt_hservices_id;
        $query->complaint = $this->params['txt_complaint'];
        $query->complaint_history = $this->params['txt_complaint_history'];
        $query->physical_examination = $this->params['txt_physical_exam'];
        $query->remarks = $this->params['txt_remarks'];

        if ($query->save()) {
            return Redirect::back()
                 ->with('flash_message', 'Well done! You successfully Added Complaints Information.')
                    ->with('flash_type', 'alert-success alert-dismissible')
                        ->with('flash_tab', 'complaints');
        }

        return Redirect::back()
                 ->with('flash_message', 'Please try again')
                    ->with('flash_type', 'alert-error alert-dismissible')
                        ->with('flash_tab', 'complaints');
    }

    public function edit(ComplaintsFormRequest $request) {
        $query = GeneralConsultation::find($this->params['txt_id']);
        $query->healthcareservice_id = $this->txt_hservices_id;
        $query->complaint = $this->params['txt_complaint'];
        $query->complaint_history = $this->params['txt_complaint_history'];
        $query->physical_examination = $this->params['txt_physical_exam'];
        $query->remarks = $this->params['txt_remarks'];

        if ($query->save()) {
            return Redirect::back()
                 ->with('flash_message', 'Well done! You successfully Updated Complaints Information.')
                    ->with('flash_type', 'alert-success alert-dismissible')
                        ->with('flash_tab', 'complaints');
        }

        return Redirect::back()
                 ->with('flash_message', 'Please try again')
                    ->with('flash_type', 'alert-error alert-dismissible')
                        ->with('flash_tab', 'complaints');
    }

}
