<?php
namespace ShineOS\Core\Extensions\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use ShineOS\Core\Roles\Entities\Features as Features;
use ShineOS\Core\Facilities\Entities\Facilities as Facilities;
use Shine\Plugin;
use Shine\Libraries\Utils;
use DB,View, Input, Session, Redirect, Config, Module, File, Schema;

class ExtensionsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');

    }

    /* Display all extensions installed */
    public function index()
    {
        $a = Utils::getModules();

        //get installed modules
        $allModules = Module::all();

        //get installed plugins
        $patientPluginDir = plugins_path()."/";
        $plugins = directoryFiles($patientPluginDir);
        asort($plugins);
        $plugs = array();
        foreach($plugins as $k=>$plugin) {

            if(strpos($plugin, ".")===false) {
                //check if config.php exists
                if(file_exists(plugins_path().$plugin.'/config.php')){
                    $plugin_module = NULL;
                    $plugin_name = NULL;
                    $plugin_id = NULL;
                    $plugin_module = NULL;
                    $plugin_location = NULL;
                    $plugin_primaryKey = NULL;
                    $plugin_table = NULL;
                    $plugin_description = NULL;
                    $plugin_version = NULL;
                    $plugin_developer = NULL;
                    $plugin_url = NULL;
                    $plugin_copy = NULL;
                    //load the config file
                    include(plugins_path().$plugin.'/config.php');
                    $plugs[$k]['plugin_module'] = $plugin_module;
                    $plugs[$k]['plugin_name'] = $plugin_name;
                    $plugs[$k]['folder'] = $plugin;
                    $plugs[$k]['plugin'] = $plugin_id;
                    $plugs[$k]['plugin_description'] = $plugin_description;
                    $plugs[$k]['plugin_version'] = isset($plugin_version) ? 'Version: '.$plugin_version : NULL;
                    $plugs[$k]['plugin_developer'] = isset($plugin_developer) ? $plugin_developer : NULL;
                    $plugs[$k]['plugin_copy'] = isset($plugin_copy) ? $plugin_copy : NULL;
                    $plugs[$k]['plugin_url'] = isset($plugin_url) ? $plugin_url : NULL;
                }
            }
        }
        //sort array by plugin_name
        sortBy('plugin_name',   $plugs);
        $plugins = $plugs;

        //get all installed widgets


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

        return view('extensions::index',compact('plugins', 'enabled_modules'));
    }

    public function view($type)
    {
        echo $type;

        return view('settings::pages.modules',compact('extModules', 'enabled_modules'));
    }

    public function add($type)
    {
        echo $type;
    }

    public function install($type)
    {
        echo $type;
    }


}
