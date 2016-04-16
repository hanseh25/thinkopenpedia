<?php namespace ShineOS\Core\Healthcareservices\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Healthcareservices\Entities\VitalsPhysical as VitalsPhysical;
use Shine\Libraries\IdGenerator;
use ShineOS\Core\Healthcareservices\Http\Requests\VitalsPhysicalFormRequest;
use ShineOS\Core\LOV\Http\Controllers\LOVController as LOVController;

use View, Response, Validator, Input, Mail, Session, Redirect, Hash, Auth, DB, Datetime, Request;

class VitalsController extends Controller {

    protected $facility_name = "samplefacility name";
    protected $tb_unique_id = "";
    protected $diag_unique_id = "";
    protected $current_timestamp;
    protected $default_tbl = "vital_physical";
    protected $txt_hservices_id;
    private $txt_action;
    private $params;

    public function __construct() {
        /** User Session or Authenticaion  */
        $this->middleware('auth');

        $date = new Datetime('now');
        $this->current_timestamp = strtotime($date->format('Y-m-d H:i:s'));

        $this->tb_unique_id =  IdGenerator::generateId();

        $this->action = Input::has('action') ? Input::get('action')  : false;
        $this->txt_hservices_id = Input::has('healthcareservice_id') ? Input::get('healthcareservice_id')  : false;

        $this->params = array(
            "txt_id" => Input::has('vitalphysical_id') ? Input::get('vitalphysical_id')  : false,
            "txt_temperature" => Input::has('temperature') ? Input::get('temperature')  : false,
            "txt_hr" => Input::has('heart_rate') ? Input::get('heart_rate')  : false,
            "txt_pulse" => Input::has('pulse_rate') ? Input::get('pulse_rate')  : false,
            "txt_respiratory" => Input::has('respiratory_rate') ? Input::get('respiratory_rate')  : false,
            "txt_systolic" => Input::has('bloodpressure_systolic') ? Input::get('bloodpressure_systolic')  : false,
            "txt_diastolic" => Input::has('bloodpressure_diastolic') ? Input::get('bloodpressure_diastolic')  : false,
            "txt_height" => Input::has('height') ? Input::get('height')  : false,
            "txt_weight" => Input::has('weight') ? Input::get('weight')  : false,
            "txt_bmi" => Input::has('bmiResult') ? Input::get('bmiResult')  : false,
            "txt_waist" => Input::has('waist') ? Input::get('waist')  : false,
            "txt_pregnant" => Input::has('Pregnant') ? Input::get('Pregnant')  : false,
            "txt_uterus" => Input::has('WithIntactUterus') ? Input::get('WithIntactUterus')  : false,
            "txt_weightloss" => Input::has('WeightLoss') ? Input::get('WeightLoss')  : false
        );
    }

    public function add(VitalsPhysicalFormRequest $request) {

            $vital = new VitalsPhysical;
            $vital->vitalphysical_id = $this->tb_unique_id;
            $vital->healthcareservice_id = $this->txt_hservices_id;
            $vital->bloodpressure_systolic = $this->params['txt_systolic'];
            $vital->bloodpressure_diastolic = $this->params['txt_diastolic'];
            $vital->heart_rate = $this->params['txt_hr'];
            $vital->pulse_rate = $this->params['txt_pulse'];
            $vital->respiratory_rate = $this->params['txt_respiratory'];
            $vital->temperature = $this->params['txt_temperature'];
            $vital->height = $this->params['txt_height'];
            $vital->weight = $this->params['txt_weight'];
            $vital->BMI_category = VitalsPhysical::computeBMICategory($this->params['txt_bmi']);
            $vital->waist = $this->params['txt_waist'];
            $vital->pregnant = $this->params['txt_pregnant'];
            $vital->with_intact_uterus = $this->params['txt_uterus'];
            $vital->weight_loss = $this->params['txt_weightloss'];

            /**
             * Blood pressure assessment
             * @var LOVController
             */
            $LOVController = new LOVController();
            if(!empty($this->params['txt_systolic']) AND !empty($this->params['txt_systolic'])) {
                $vital->bloodpressure_assessment = $LOVController->bloodpressure_assessment($this->params['txt_systolic'], $this->params['txt_diastolic']);
            }

            $vital->save();

            return Redirect::back()
                 ->with('flash_message', 'Well done! You successfully Added Vitals Information.')
                 ->with('flash_type', 'alert-success alert-dismissible')
                ->with('flash_tab', 'vitals');
    }

    public function edit(VitalsPhysicalFormRequest $request) {
        $vital = VitalsPhysical::find($this->params['txt_id']);
        $vital->vitalphysical_id = $this->tb_unique_id;
        $vital->healthcareservice_id = $this->txt_hservices_id;
        $vital->bloodpressure_systolic = $this->params['txt_systolic'];
        $vital->bloodpressure_diastolic = $this->params['txt_diastolic'];
        $vital->heart_rate = $this->params['txt_hr'];
        $vital->pulse_rate = $this->params['txt_pulse'];
        $vital->respiratory_rate = $this->params['txt_respiratory'];
        $vital->temperature = $this->params['txt_temperature'];
        $vital->height = $this->params['txt_height'];
        $vital->weight = $this->params['txt_weight'];
        $vital->BMI_category = VitalsPhysical::computeBMICategory($this->params['txt_bmi']);
        $vital->waist = $this->params['txt_waist'];
        $vital->pregnant = $this->params['txt_pregnant'];
        $vital->with_intact_uterus = $this->params['txt_uterus'];
        $vital->weight_loss = $this->params['txt_weightloss'];
            /**
             * Blood pressure assessment
             * @var LOVController
             */
            $LOVController = new LOVController();
            if(!empty($this->params['txt_systolic']) AND !empty($this->params['txt_systolic'])) {
                $vital->bloodpressure_assessment = $LOVController->bloodpressure_assessment($this->params['txt_systolic'], $this->params['txt_diastolic']);
            }

        $vital->save();

        return Redirect::back()
             ->with('flash_message', 'Well done! You successfully Updated Vitals Information.')
                ->with('flash_type', 'alert-success alert-dismissible')
                    ->with('flash_tab', 'vitals');
    }

}
