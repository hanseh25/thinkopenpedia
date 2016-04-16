<?php
namespace ShineOS\Controllers;

use ShineOS\View;
use ShineOS\Install;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use \Cache;
use \Event;
use \Session;
use \Redirect;
use Module;

class InstallController extends Controller
{
    public $app;

    public function __construct($app = null)
    {
        if (!is_object($this->app)) {

            if (is_object($app)) {
                $this->app = $app;
            } else {
                $this->app = shineos();
            }
        }
    }


    public function index($input = null)
    {
        if (!is_array($input) || empty($input)) {
            $input = Input::all();
        }

        $allowed_configs = array('database', 'shineos');

        $is_installed = shineos_is_installed();
        if ($is_installed) {
            return redirect(url('/'));
        }

        $view = SHINEOS_PATH . 'Views/install.php';

        $connection = Config::get('database.connections');
        $this->install_log("Preparing to install.");

        if (isset($input['make_install'])) {
            if (!isset($input['db_pass'])) {
                $input['db_pass'] = '';
            }
            if (!isset($input['table_prefix'])) {
                $input['table_prefix'] = '';
            }

            $errors = array();
            if (!isset($input['db_host'])) {
                $errors[] = 'Parameter "db_host" is required';
            } 
            else {
                $input['db_host'] = trim($input['db_host']);
            }

            if (!isset($input['db_name'])) {
                $errors[] = 'Parameter "db_name" is required';
            } 
            else {
                $input['db_name'] = trim($input['db_name']);
            }

            if (!isset($input['db_user'])) {
                $errors[] = 'Parameter "db_user" is required';
            }

            if (!empty($errors)) {
                return implode("\n", $errors);
            }

            if (isset($input['db_driver'])) {
                $dbDriver = $input['db_driver'];
            } else {
                $dbDriver = 'mysql';
            }

            Config::set("database.default", $dbDriver);
            if ($dbDriver == 'sqlite') {

                if (isset($input['db_name_sqlite'])) {
                    $input['db_name'] = $input['db_name_sqlite'];
                }
                Config::set("database.connections.$dbDriver.database", $input['db_name']);
                if (!file_exists($input['db_name'])) {
                    touch($input['db_name']);
                }
            }

            Config::set("database.connections.$dbDriver.host", $input['db_host']);
            Config::set("database.connections.$dbDriver.username", $input['db_user']);
            Config::set("database.connections.$dbDriver.password", $input['db_pass']);
            Config::set("database.connections.$dbDriver.database", $input['db_name']);
            Config::set("database.connections.$dbDriver.prefix", $input['table_prefix']);

            if (isset($input['default_template']) and $input['default_template'] != false) {
                Config::set('shineos.install_default_template', $input['default_template']);
            }
            if (isset($input['with_default_content']) and $input['with_default_content'] != false) {
                Config::set('shineos.install_default_template_content', 1);
            }

            if (Config::get('app.key') == 'YourSecretKey!!!') {
                if (!$this->app->runningInConsole()) {
                    $_SERVER['argv'] = array();
                }
                Artisan::call('key:generate');
            }

            $this->install_log("Saving config");

            Config::save($allowed_configs);
            Cache::flush();

            $install_finished = false;
            try {
                DB::connection($dbDriver)->getDatabaseName();
            } catch (\PDOException $e) {
                return ('Error: ' . $e->getMessage() . "\n");
            } catch (\Exception $e) {
                return ('Error: ' . $e->getMessage() . "\n");
            }

            if (function_exists('set_time_limit')) {
                @set_time_limit(0);
            }

            $this->install_log("Setting up Database: Standard Libraries");
            $installer = new Install\DbInstaller();
            $installer->run();

            $this->install_log("Setting up Database: Users");
            $installer->run('users.sql');

            $this->install_log("Setting up Database: Facilities");
            $installer->run('facilities.sql');

            $this->install_log("Setting up Database: Patients");
            $installer->run('patients.sql');

            $this->install_log("Setting up Database: Healthcare");
            $installer->run('healthcare.sql');

            $this->install_log("Setting up Database: Reminder");
            $installer->run('reminder.sql');

            $this->install_log("Setting up Database: Referrals");
            $installer->run('referral.sql');

            $this->install_log("Setting up Database: Miscellaneous");
            $installer->run('misc.sql');

            $this->install_log("Setting up Database: Done");
            $installer->donothing();

            Config::set('shineos.is_installed', 1);

            $this->install_log("Saving config");
            Config::save($allowed_configs);

            $this->install_log("done");

            return 'done';
        }

        $layout = new View($view);

        $defaultDbEngine = Config::get('database.default');
        if (extension_loaded('pdo_sqlite')) {
            // $defaultDbEngine = 'sqlite';
        }

        $dbEngines = Config::get('database.connections');
        foreach ($dbEngines as $driver => $v) {
            if (!extension_loaded("pdo_$driver")) {
                unset($dbEngines[$driver]);
            }
        }
        $viewData = [
            'config' => $dbEngines[$defaultDbEngine],
            'dbDefaultEngine' => $defaultDbEngine,
            'dbEngines' => array_keys($dbEngines),
            'dbEngineNames' => [
                'mysql' => 'MySQL',
                'sqlite' => 'SQLite',
                'sqlsrv' => 'Microsoft SQL Server',
                'pgsql' => 'PostgreSQL'
            ]
        ];
        $domain = false;
        if (isset($_SERVER['HTTP_HOST'])) {
            $domain = $_SERVER['HTTP_HOST'];
            $domain = str_replace('www.', '', $domain);
            $domain = str_replace('.', '_', $domain);
            $domain = str_replace('-', '_', $domain);
            $domain = substr($domain, 0, 10);
        }
        if (!$viewData['config']['prefix'] and $domain) {

            $viewData['config']['prefix'] = $domain . '_';
        }
        if (extension_loaded('pdo_sqlite') and $domain) {
            $sqlite_path = normalize_path(storage_path() . DS . $domain . '.sqlite', false);
            $viewData['config']['db_name_sqlite'] = $sqlite_path;
        }


        $layout->set($viewData);

        $is_installed = shineos_is_installed();
        if ($is_installed) {
            App::abort(403, 'Unauthorized action. ShineOS is already installed.');
        }
        $layout->assign('done', $is_installed);
        $layout = $layout->__toString();
        return $layout;
    }


    private function install_log($text)
    {
        $log_file = userfiles_path() .  'install_log.txt';
        if (!is_file($log_file)) {
            @touch($log_file);

        }
        if (is_file($log_file)) {
            $json = array('date' => date('H:i:s'), 'msg' => $text);

            if ($text == 'done' or $text == 'Preparing to install') {
                @file_put_contents($log_file, $text . "\n");
            } else {
                @file_put_contents($log_file, $text . "\n", FILE_APPEND);

            }
        }
    }
}