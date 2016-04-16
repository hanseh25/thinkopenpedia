<?php

use ShineOS\Core\Patients\Entities\Patients;
use Shine\Repositories\Eloquent\UserRepository as UserRepository;
use Shine\Repositories\Contracts\UserRepositoryInterface;
use Shine\Http\Controllers\Controller;
use Shine\Libraries\IdGenerator;
use Shine\User;
use Shine\Plugin;

class FamilyController extends Controller
{

    protected $moduleName = 'Patients';
    protected $modulePath = 'patients';

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
        View::addNamespace('patients', 'src/ShineOS/Core/Patients/Resources/Views');
    }

    public function index()
    {
        //no index
    }

    public function view($id)
    {
        $patient = Patients::where('patient_id','=', $id)->first();
        $plugdata = Plugin::where('primary_key_value',$id)->first();

        View::addNamespace('pluginform', plugins_path().'ShineLab_Family');
        echo View::make('pluginform::master', array('patient'=>$patient, 'plugdata'=>$plugdata))->render();

    }
}
