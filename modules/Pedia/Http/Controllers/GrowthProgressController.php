<?php namespace Modules\Pedia\Http\Controllers;


use Illuminate\Routing\Controller;

use Modules\Pedia\Entities\GrowthProgress; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;
use Illuminate\Support\Facades\Request;

use View, Response, Input, Datetime, Redirect;

class GrowthProgressController extends Controller {

    public function read($growth_id)
    {
        $growthProgress = GrowthProgress::find($growth_id);
        // dd($growthProgress->getRead($growth_id));

        return view('pedia::growth.read', array('result' => $growthProgress));
    }

    public function browse($patient_id)
    {
        $growthProgress = new GrowthProgress;

        $patientData = $growthProgress->getPatientDataBy($patient_id);

        $processPatientData = $this->_formatPatientData($patientData);

        $childLength = $growthProgress->getChildLengthStandard();
        $childWeight = $growthProgress->getChildWeightStandard();
        $headCircumference = $growthProgress->getHeadCircumference();
        $chestCircumference = $growthProgress->getChestCircumference();

        $childLengthData = $this->_formatGraphData('Child Length', $processPatientData['height'], $childLength);
        $childWeightData = $this->_formatGraphData('Child Weight', $processPatientData['weight'], $childWeight);
        $headCircumferenceData = $this->_formatGraphData('Head Circumference', $processPatientData['head'], $headCircumference);
        $chestCircumferenceData = $this->_formatGraphData('Chest Circumference', $processPatientData['chest'], $chestCircumference);

        return view('pedia::growth.browse', array(
            'childWeight' => $childWeightData,
            'childLength' => $childLengthData,
            'headCircumference' => $headCircumferenceData,
            'chestCircumference' => $chestCircumferenceData,
            'growthProgress' => $patientData,
            'patient_id' => $patient_id
        ));
    }

    private function _formatPatientData($response)
    {

        $dataWeight = array();

        $dataHeight = array();

        $dataHead = array();

        $dataChest = array();

        foreach ($response as $item) {
            $dataWeight[] = array(
                $item->age,
                $item->child_weight
            );

            $dataHeight[] = array(
                $item->age,
                $item->child_height
            );

            $dataChest[] = array(
                $item->age,
                $item->chest
            );

            $dataHead[] = array(
                $item->age,
                $item->head
            );
        }

        return [
            'weight' => $dataWeight,
            'height' => $dataHeight,
            'head' => $dataHead,
            'chest' => $dataChest
        ];
    }

    private function _formatGraphData($label, $graphCategory, $whoStandard)
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
            array(
                'label' => $label,
                'data' => $graphCategory,
                'points' => array(
                    'symbol' => 'circle',
                    'fillColor' => '#3c8dbc'
                ),
                'color' => '#3c8dbc'
            ),
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

    public function add($patient_id)
    {
        $request = Request::all();

        if(count($request)) {

            $growthProgress = new GrowthProgress;
            $growthProgress->patient_id = $request['patient_id'];
            $growthProgress->age = $request['age'];
            $growthProgress->child_weight = $request['child_weight'];
            $growthProgress->child_height = $request['child_height'];
            $growthProgress->head = $request['head'];
            $growthProgress->chest = $request['chest'];
            $growthProgress->notes = $request['notes'];

            $growthProgress->save();

            if ($growthProgress) {
                return Redirect::to('pedia/growth/' . $patient_id)->with('message', 'Successfully added.');
            }
            
        }

        return view('pedia::growth.add', array( 'patient_id' => $patient_id));
    }

    public function edit($growth_id)
    {
        $request = Request::all();

        if(count($request)) {

            $growthProgress = GrowthProgress::find($growth_id);
            $growthProgress->age = $request['age'];
            $growthProgress->child_weight = $request['child_weight'];
            $growthProgress->child_height = $request['child_height'];
            $growthProgress->head = $request['head'];
            $growthProgress->chest = $request['chest'];
            $growthProgress->notes = $request['notes'];

            $growthProgress->save();

            if ($growthProgress) {
                return Redirect::to('pedia/growth/' . $request['patient_id'])->with('message', 'Successfully updated.');
            }
            
        }
        $result = GrowthProgress::find($growth_id);
        return view('pedia::growth.edit', array('result' => $result));
    }

    public function delete($growth_id)
    {
        $growthProgress = GrowthProgress::find($growth_id);
        $patient_id = $growthProgress->patient_id;
        $result = $growthProgress->delete();

        return Redirect::to('pedia/growth/' . $patient_id)->with('message', 'Successfully delete.');

    }
}