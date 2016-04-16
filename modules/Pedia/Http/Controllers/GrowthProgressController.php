<?php namespace Modules\Pedia\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Pedia\Entities\GrowthProgress; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;
use Illuminate\Support\Facades\Request;

use View, Response, Input, Datetime;

class GrowthProgressController extends Controller {

    public function read($growth_id)
    {
        $growthProgress = GrowthProgress::where('id', '=', $growth_id)->get();
        
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

        $childLengthData = $this->_formatGraphData('Child Length', $processPatientData, $childLength);
        $childWeightData = $this->_formatGraphData('Child Weight', $processPatientData, $childWeight);
        $headCircumferenceData = $this->_formatGraphData('Head Circumference', $processPatientData, $headCircumference);
        $chestCircumferenceData = $this->_formatGraphData('Chest Circumference', $processPatientData, $chestCircumference);

        return view('pedia::growth.browse', array(
            'childWeight' => $childWeightData,
            'childLength' => $childLengthData,
            'headCircumference' => $headCircumferenceData,
            'chestCircumference' => $chestCircumferenceData
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

            DB::table('growth_progress')
            ->where('patient_id', $patient_id)
            ->insert($request);

            return view('pedia::growth.browse' . $patient_id, array( 'patient_id' => $patient_id));            
        }

        return view('pedia::growth.add', array( 'patient_id' => $patient_id));
    }

    public function edit($growth_id)
    {
        $request = Request::all();

        if(count($request)) {

            $growth = DB::table('growth_progress')
                    ->where('id', $growth_id)
                    ->update($request);

            return view('pedia::growth.edit' . $growth_id, array( 'growth' => $growth));   
        }

        return view('pedia::growth.add', array());
    }

    public function delete($growth_id)
    {
        $growthProgress = new GrowthProgress();
        $result = $growthProgress->delete($growth_id);

        return redirect()->back()->withInput()->withFlashSuccess($result->message);

    }
}