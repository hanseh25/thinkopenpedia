<?php namespace Modules\Calendar\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Calendar\Entities\Calendar; //model
use Shine\Libraries\IdGenerator;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\UserHelper;

use View, Response, Input, Datetime;

class CalendarController extends Controller {

    private $facility_id;

    public function __construct() {
        $this->middleware('auth');
        $this->user = UserHelper::getUserInfo();
        $this->facility = FacilityHelper::facilityInfo();

    }

    public function index()
    {
        $data['user'] = $this->user;
        $data['facilityInfo'] = $this->facility;

        return view('calendar::index')->with($data);
    }

    public function getEventData () {

        $data = Calendar::where('facility_id', '=', $this->facility->facility_id)
            ->where('user_id', $this->user->user_id)
            ->where('start', '>=', $_GET['start'])
            ->where('end', '<=', $_GET['end'])
            ->get();
        $caldata = json_encode($data);
        echo $caldata;
    }

    public function insertNewEvent () {

        $title = Input::get('title');
        $description = Input::get('description');
        $color = Input::get('color');
        $textcolor = Input::get('textcolor');
        $allday = Input::get('allday');
        $start = date('Y-m-d H:i:s', strtotime(Input::get('start')));
        $end = date('Y-m-d H:i:s', strtotime(Input::get('end')));

        $cal = new Calendar;

        $cal->calendar_id = IdGenerator::generateId();
        $cal->facility_id = $this->facility->facility_id;
        $cal->user_id = $this->user->user_id;
        $cal->title = $title;
        $cal->description = $description;
        $cal->start = $start;
        $cal->end = $end;
        $cal->allday = $allday ? 1 : 0;
        $cal->color = $color;
        $cal->textcolor = $textcolor;
        $cal->save();

        return Response::json('success', 200);
    }

    public function update () {

        $title = Input::get('title');
        $description = Input::get('description');
        $color = Input::get('color');
        $textcolor = Input::get('textcolor');
        $allday = Input::get('allday');
        $start = Input::get('start');
        $end = Input::get('end');

        $cal = new Calendar;

        $updateCal = array(
            "title" => $title,
            "description" => $description,
            "start" => date('Y-m-d H:i:s', strtotime($start)),
            "end" => date('Y-m-d H:i:s', strtotime($end)),
            "color" => $color,
            "textcolor" => $textcolor
        );
        $cal->where('calendar_id', Input::get('calendar_id'))
            ->update($updateCal);
    }

    public function moved () {

        $updateCal = array(
            "start" => Input::get('start'),
            "end" => Input::get('end')
        );

        $cal = new Calendar;

        $cal->where('calendar_id', Input::get('calendar_id'))
            ->update($updateCal);

    }

    public function delete () {

        $cal = new Calendar;

        $cal->where('calendar_id', Input::get('calendar_id'))
            ->delete();

    }

}


