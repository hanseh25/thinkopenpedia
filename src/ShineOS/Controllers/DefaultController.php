<?php

namespace ShineOS\Controllers;

use ShineOS\View;
use ShineOS\Install;
use Shine\Libraries\UserHelper;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use \Cache;
use \Event;
use \Session;
use \Redirect;
use \URL;

use Module;

class DefaultController extends Controller {

    public function __construct($app = null) {
        if (!is_object($this->app)){

            if (is_object($app)){
                $this->app = $app;
            } else {
                $this->app = shineos();
            }
        }

    }

    public function index() {
        $is_installed = shineos_is_installed();
        if (!$is_installed){
            $installer = new InstallController($this->app);
            return Redirect::to('install');
        }

        return $this->frontend();
    }


    public $return_data = false;
    public $page_url = false;
    public $create_new_page = false;
    public $render_this_url = false;
    public $isolate_by_html_id = false;
    public $functions = array();
    public $page = array();
    public $params = array();
    public $vars = array();
    public $app;

    public function track() {

        $log_file = userfiles_path() .  'track_log.txt';
        if (!is_file($log_file)) {
            @touch($log_file);
        }

        $curUser = UserHelper::getUserInfo();
        if(isset($curUser)) {
            $user = $curUser->user_id;
        } else {
            $user = NULL;
        }
        if (is_file($log_file)) {
            $json = array(
                'date' => date('m-d-Y H:i:s'),
                'url' => stripslashes($_POST['url']),
                'user_id' => $user,
                'element' => $_POST['element'],
                'element_type' => $_POST['type'],
                'element_name' => $_POST['name'],
                'element_id' => $_POST['ID'],
                'element_label' => $_POST['label'],
                'curvalue' => $_POST['curvalue'],
                'action' => $_POST['action'],
                'msg' => 'test'
            );
            $text = json_encode($json, JSON_UNESCAPED_SLASHES);
            @file_put_contents($log_file, $text . "\n", FILE_APPEND);
        }
        $results['result'] = "OK";
        echo json_encode($json);

    }

}
