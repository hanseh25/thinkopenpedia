<?php namespace Modules\Pedia\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Pedia\Entities\Pedia; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;
use Shine\Repositories\Eloquent\UserRepository as UserRepository;
use Shine\Repositories\Eloquent\HealthcareRepository as HealthcareRepository;

use View, Response, Input, Datetime;

class PediaController extends Controller {

    private $facility_id;

    public function __construct(UserRepository $UserRepository, HealthcareRepository $healthcareRepository) {
        $this->middleware('auth');
        $this->user = UserHelper::getUserInfo();
        $this->facility = FacilityHelper::facilityInfo();
        $this->UserRepository = $UserRepository;
        $this->HealthcareRepository = $healthcareRepository;

    }

    public function index()
    {

        $facilityInfo = FacilityHelper::facilityInfo();
        $patients = getAllPatientsByFacility();


        $visits = json_decode($this->HealthcareRepository->findHealthcareByFacilityID($facilityInfo->facility_id));

        foreach ($visits as $k => $v) {
            $v->seen_by = json_decode($this->UserRepository->findUserByFacilityUserID($v->seen_by));
            $v->healthcare_disposition = json_decode($this->HealthcareRepository->findDispositionByHealthcareserviceid($v->healthcareservice_id));
        }


        return view('pedia::index', compact('patients', 'visits'));
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


