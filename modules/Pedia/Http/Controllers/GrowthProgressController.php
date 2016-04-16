<?php namespace Modules\Pedia\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Calendar\Entities\Calendar; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;

use View, Response, Input, Datetime;

class GrowthProgressController extends Controller {

    public function read($growth_id)
    {
        $growthProgress = GrowthProgress::;
        
        $growth = $growthProgress->read($patient_id);

        return view('pedia::growth.read', array('result' => $growth->data));
    }

    public function browse($patient_id)
    {
        
        $growthProgress = GrowthProgress::where('patient_id', '=', $patient_id)->get();

        return view('pedia::growth.browse', array('result' => $growthProgress));
    }

    public function add($patient_id)
    {
        $request = Request::all();

        if(count($request)) {

            DB::table('growth_progress')
            ->where('patient_id', $patient_id)
            ->insert($request);

            return view('pedia::growth.browse', array( 'patient_id' => $patient_id);            
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

            return view('pedia::growth.edit' . $growth_id, array( 'growth' => $growth);   
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