<?php namespace Modules\Pedia\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Calendar\Entities\Calendar; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;

use View, Response, Input, Datetime;

class GrowthProgressController extends Controller {

    protected $_id;
    protected $_age;
    protected $_child_weight;
    protected $_child_length;
    protected $_head;
    protected $_chest;
    protected $_patient_id;
    protected $_notes;


    public function __construct() {
        $this->middleware('auth');
        $this->user = UserHelper::getUserInfo();
    }

    public function index()
    {
        $data['user'] = $this->user;

        return view('pedia::index')->with($data);
    }

    public function browse()
    {
        $data['user'] = $this->user;

        return view('pedia::growth.index')->with($data);
    }
    
    public function read($id)
    {
        $data['user'] = $this->user;

        return view('pedia::growth.index')->with($data);
    }
    
    public function addEdit()
    {

        if($this->growthValidator()) {
            
            // get inputs
            $this->setInfo();

            //create data
            $growth_progress = $this->createUpdate();

            if ($growth_progress) {
                if($this->_id) {
                    throw new Symfony\Component\HttpKernel\Exception\HttpException(200, 'Successfully updated a growth progress.');
                } else {
                    throw new Symfony\Component\HttpKernel\Exception\HttpException(200, 'Successfully created a growth progress.');
                }
            }

        }
    }
    private function growthValidator()
    {
        $rules = array(
            'age' => 'required|numeric',
            'child_weight' => 'required|numeric',
            'child_height' => 'required|numeric',
            'head' => 'required|numeric',
            'chest' => 'required|numeric',
            'patient_id' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            return true;
        }else{
            return ($validator->errors()->first(), $validator->errors());
        }
    }

    private function setInfo()
    {
        $this->_id = Input::get('id');
        $this->_age = Input::get('age');
        $this->_child_weight = Input::get('child_weight');
        $this->_child_height = Input::get('child_height');
        $this->_head = Input::get('head');
        $this->_chest = Input::get('chest');
        $this->_patient_id = Input::get('patient_id');
        $this->_notes = Input::get('notes');
    }

    private function createUpdate()
    {
        
        if($this->_id) {
            $growth_progress = GrowthProgress::findOrFail($this->_id);
        } else {
            $growth_progress = new GrowthProgress();
        }

        $growth_progress->patient_id = $this->_patient_id;

        $growth_progress->age = $this->_age;
        $growth_progress->child_weight = $this->_child_weight;
        $growth_progress->child_height = $this->_child_height;
        $growth_progress->head = $this->_head;
        $growth_progress->chest = $this->_chest;
        $growth_progress->notes = $this->_notes;

        $growth_progress->save();

        return $growth_progress;

    }

}


