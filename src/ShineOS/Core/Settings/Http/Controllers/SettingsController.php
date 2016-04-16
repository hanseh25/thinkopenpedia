<?php 
namespace Modules\Settings\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Roles\Entities\Features as Features;
use Modules\Facilities\Entities\Facilities as Facilities;
use Shine\Plugin;
use Shine\Libraries\Utils;
use DB,View, Input, Session, Redirect;
use Config, Module, File;

class SettingsController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
		

		$features = Features::where('status','=',0)->orderBy('feature_name', 'asc')->orderBy('status','asc')->get();

		#variables to share to all view
		View::share('features', $features);
	}

	public function index()
	{
		$a = Utils::getModules();
		$plugins = Plugin::all();

		return view('settings::index',compact('plugins'));
	}
	
	public function save()
	{
		$plugins = Input::get('plugin');

		if ($plugins) :
			foreach ($plugins as $key => $val) {
				DB::table('plugins')
	            ->where('id', $val)
	            ->update(['status' => 1]);
			}
		endif;

		Session::flash('alert-class', 'alert-success');
        $message = "You have enabled a plugin";

        return Redirect::to('/settings')->with('message', $message);
	}

	public function getModules()
    {
    	//$this->checkModules();
        $allModules = Module::all();
        $extModules = array();

        $thisfacility = json_decode(Session::get('_global_facility_info'));

        if ($thisfacility):
        	$facilityModules = Facilities::where('facility_id', $thisfacility->facility_id)->select('enabled_modules')->get('enabled_modules');
        	$enabled_modules = json_decode($facilityModules[0]->enabled_modules);
    	endif;

        foreach ($allModules as $key => $val):
            $module = strtolower($key);
            $module_type = Config::get($module.'.type');  

            if ($module_type == 1):
                $extModules[] = $module;
            endif;
        endforeach;
        
        return view('settings::pages.modules',compact('extModules', 'enabled_modules'));
    }

    // Park this muna cams
    private function checkModules()
    {
    	$allModules = Module::all();
    	$directoryModules = File::directories('modules');

    	$newDirectoryModules = array();
    	$module = Module::findOrFail('LabResults');

    	$module->disable();
    	//echo "<pre>";print_r(Module::disabled());echo "</pre>";
    	// clean directory array
    	// foreach ($directoryModules as $k => $v):
    	// 	$module = explode("modules\\", $v);
    	// 	$newDirectoryModules[] = $module[1];
    	// endforeach;

    	// foreach ($allModules as $key => $val):
    	// 	foreach ($newDirectoryModules as $k => $v):
    	// 		if ($key != $v) :
    	// 			$module = Module::find($v);
    	// 			echo $module. "<br />";
    	// 			//$module->disable();
    	// 		endif;
    	// 	endforeach;
    	// endforeach;

    }

    public function saveModules()
    {
    	$allModules = Input::get('modules');
    	$facilityID = $thisfacility->facility_id;

    	/** Save checked modules */
    	$facilityModules = Facilities::find($facilityID);
		$facilityModules->enabled_modules = json_encode($allModules);
		$facilityModules->save();

		/** Boot Modules */
		Module::boot();
		
		/** Save modules to lov_modules */
		Session::flash('alert-class', 'alert-success');
        $message = "You have enabled a plugin";

        return Redirect::to('/settings/modules')->with('message', $message);
    }
}