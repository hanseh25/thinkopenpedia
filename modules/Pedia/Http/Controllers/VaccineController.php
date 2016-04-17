<?php namespace Modules\Pedia\Http\Controllers;


use Illuminate\Routing\Controller;

use Modules\Pedia\Entities\GrowthProgress; //model
use Modules\Pedia\Entities\Pedia; //model
use Modules\Pedia\Entities\Vaccine; //model
use Modules\Pedia\Entities\Immune; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;
use Illuminate\Support\Facades\Request;

use View, Response, Input, Datetime, Redirect;
use DB;

class VaccineController extends Controller {

    public function read($immune_id)
    {
        $immune = Immune::find($immune_id);

        return view('pedia::vaccine.read', array('result' => $immune));
    }

    public function browse($patient_id)
    {
        $immune = Immune::where('patient_id', '=', $patient_id)
                        ->get();
        // dd($immune);
        return view('pedia::vaccine.browse', array('result' => $immune));
    }

    public function add($patient_id)
    {
        $request = Request::all();

        $vaccines = Vaccine::all();

        $vaccineList = array();

        foreach ($vaccines as $vaccine) {
            $vaccineList[$vaccine->name] = $vaccine->name;
        }

        if(count($request)) {

            $immune = new Immune;
            $immune->patient_id = $request['patient_id'];
            $immune->date = $request['date'];
            $immune->vaccine = $request['vaccine'];
            $immune->site = $request['site'];
            $immune->notes = $request['notes'];

            $immune->save();

            if ($immune) {
                return Redirect::to('pedia/vaccine/' . $request['patient_id'])->with('message', 'Successfully added.');
            }
            
        }

        return view('pedia::vaccine.add', array( 'patient_id' => $patient_id, 'vaccines' => $vaccineList));
    }

    public function edit($growth_id)
    {
        //
    }

    public function delete($growth_id)
    {
        //
    }
}