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

    private function _formatGraphData($label, $whoStandard)
    {
        // dd($whoStandard);

        $number_of_weeks = [];
        $third = [];
        $fifteenth = [];
        $median = [];
        $eighty_fifth = [];
        $ninety_seventh = [];

        foreach ($whoStandard as $item) {
            $third[] = [
                $item->number_of_weeks,
                $item->third
            ];

            $fifteenth[] = [
                $item->number_of_weeks,
                $item->fifteenth
            ];

            $median[] = [
                $item->number_of_weeks,
                $item->median
            ];

            $eighty_fifth[] = [
                $item->number_of_weeks,
                $item->eighty_fifth
            ];

            $ninety_seventh[] = [
                $item->number_of_weeks,
                $item->ninety_seventh
            ];
        }

        return array(
            // array(
            //     'label' => $label,
            //     'data' => $graphCategory,
            //     'points' => array(
            //         'symbol' => 'circle',
            //         'fillColor' => '#3c8dbc'
            //     ),
            //     'color' => '#3c8dbc'
            // ),
            array(
                'label' => '3RD',
                'data' => $third,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#00c0ef'
                ),
                'color' => '#00c0ef'
            ),
            array(
                'label' => '15TH',
                'data' => $fifteenth,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#f39c12'
                ),
                'color' => '#f39c12'
            ),
            array(
                'label' => 'MEDIAN',
                'data' => $median,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#f56954'
                ),
                'color' => '#f56954'
            ),
            array(
                'label' => '18TH',
                'data' => $eighty_fifth,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#00ffe1'
                ),
                'color' => '#00ffe1'
            ),
            array(
                'label' => '97TH',
                'data' => $ninety_seventh,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#ffe500'
                ),
                'color' => '#ffe500'
            )
        );

    }

}


