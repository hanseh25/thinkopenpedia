<?php namespace Modules\Pedia\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Pedia\Entities\Pedia; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;

use View, Response, Input, Datetime;

class PediaController extends Controller {

    private $facility_id;

    public function __construct() {
        $this->middleware('auth');
        $this->user = UserHelper::getUserInfo();
        $this->facility = FacilityHelper::facilityInfo();

    }

    public function index()
    {
        $data['user'] = $this->user;
        $data['facilityInfo'] = $this->facility;

        return view('pedia::index')->with($data);
    }

    public function insertNewEvent()
    {
        $pedia = new Pedia;

        $childLength = $pedia->getChildLengthStandard();
        $childWeight = $pedia->getChildWeightStandard();
        $headCircumference = $pedia->getHeadCircumference();
        $chestCircumference = $pedia->getChestCircumference();

        $childLengthData = $this->_formatGraphData('Child Length', $childLength);
        $childWeightData = $this->_formatGraphData('Child Weight', $childWeight);
        $headCircumferenceData = $this->_formatGraphData('Head Circumference', $headCircumference);
        $chestCircumferenceData = $this->_formatGraphData('Chest Circumference', $chestCircumference);

        return view('pedia::read', array(
            'childWeight' => $childWeightData,
            'childLength' => $childLengthData,
            'headCircumference' => $headCircumferenceData,
            'chestCircumference' => $chestCircumferenceData
        ));
    }

}


