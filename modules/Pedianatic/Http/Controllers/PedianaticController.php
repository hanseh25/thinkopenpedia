<?php namespace Modules\Pedianatic\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Pedianatic\Entities\Pedianatic; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;
use Shine\Repositories\Eloquent\UserRepository as UserRepository;

use View, Response, Input, Datetime;

class PedianaticController extends Controller {

    public function index()
    {
    	// var_dump('Pedianatic');exit;
        
        return view('pedianatic::index',array());
    }


}


