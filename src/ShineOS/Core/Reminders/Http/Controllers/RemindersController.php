<?php namespace ShineOS\Core\Reminders\Http\Controllers;

use Illuminate\Routing\Controller;
use ShineOS\Core\Reminders\Http\Requests\ReminderFormRequest;
use ShineOS\Core\Reminders\Http\Requests\BroadcastFormRequest;

use ShineOS\Core\Reminders\Entities\Reminders;
use ShineOS\Core\Reminders\Entities\ReminderMessage;
use Shine\Libraries\EmailHelper;
use Shine\Libraries\IdGenerator;
use Shine\Libraries\UserHelper;
use Shine\Libraries\FacilityHelper;
use Shine\Libraries\ChikkaSMS;
use Shine\Libraries\Utils;

use ShineOS\Core\Facilities\Entities\Facilities;
use ShineOS\Core\Facilities\Entities\FacilityUser as facilityUser;
use ShineOS\Core\Facilities\Entities\FacilityPatientUser as facilityPatientUser;
use ShineOS\Core\Patients\Entities\Patients;
use ShineOS\Core\Patients\Entities\PatientContacts;
use ShineOS\Core\Users\Entities\Users;
use ShineOS\Core\Users\Entities\UserContact;

use View, Response, Validator, Input, Mail, Session, Redirect, Hash, Auth, DB, Datetime, Request;
/**
 * Reminder's and Broadcast's Controller
 */
class RemindersController extends Controller {

    /**
     * Reminders table
     * @var string
     */
    protected $table_name = 'reminders';
    protected $moduleName = 'Reminders';
    protected $modulePath = 'reminders';

    public function __construct() {
        /**
         * User Session or Authenticaion
         */
        $this->middleware('auth');

        $this->curr_time = new DateTime('NOW');

        /**
         * Reminder Types, as Email's subject
         * @var array
         */
        $this->subject = [
            "1" => "Prescription Schedule",
            "2" => "Follow-up Consultation Shineointment",
            "3" => "Lab Exam Results"
        ];
        $modules =  Utils::getModules();

        // variables to share to all view
        View::share('modules', $modules);
        View::share('moduleName', $this->moduleName);
        View::share('modulePath', $this->modulePath);

    }

    /**
     * Reminder's Listings
     * @return array
     */
    public function index() {
        $data = $this->listings(array(1,2,3));
        return view('reminders::index')->with($data);
    }

    /**
     * Facility Session
     * @return array
     */
    public function facility() {
        return FacilityHelper::facilityInfo();
    }
    /**
     * User's session
     * @return array
     */
    public function currUser(){
        return UserHelper::getUserInfo();
    }
    /**
     * Broadcast's Listings
     * @return array
     */
    public function broadcastlist() {
        $data = $this->listings(array(4));
        // echo "<pre>"; print_r($data); echo "</pre>";
        return view('reminders::broadcast')->with($data);
    }

    /**
     * Listings for Reminders and Broadcasts
     * @param  array $arrType Reminder Type
     * @return array
     */
    public function listings($arrType) {
        /**
         * Current Facility Id
         * @var string
         */
        $c_facility_id = isset($this->facility()->facility_id) ? $this->facility()->facility_id : false;
        /**
         * get all facilityuserid  to get all patient's data connected to the current Facility
         * @var array
         */
        $all_facilityUser = facilityUser::where('facility_id',$c_facility_id)->lists('facilityuser_id');

        /** For Broadcasts Listings */
        if(in_array('4', $arrType)) {
            $data['join'] = Reminders:: whereIn('reminder_message.reminder_type', $arrType)
                    ->whereIn('facilityuser_id', $all_facilityUser)
                    ->join('reminder_message', 'reminders.remindermessage_id','=','reminder_message.remindermessage_id')
                    ->groupBy('reminders.remindermessage_id')
                    ->orderBy('reminder_message.updated_at', 'desc')
                    ->get();
        }
        /**  Fro Reminders Listings */
        else {
            $data['join'] = Reminders:: whereIn('reminder_message.reminder_type', $arrType)
                    ->whereIn('facilityuser_id', $all_facilityUser)
                    ->join('reminder_message', 'reminders.remindermessage_id','=','reminder_message.remindermessage_id')
                    ->join('patients', 'patients.patient_id','=','reminders.patient_id')
                    ->select('reminders.*', 'reminder_message.*', 'patients.first_name', 'patients.middle_name', 'patients.last_name')
                    ->orderBy('reminder_message.updated_at', 'desc')
                    ->get();
        }
        return $data;
    }

    /**
     * View:: Create a Patient's Reminder
     * @param  string $patient_id
     * @return array
     */
    public function createReminder($patient_id) {
        $data['Patients'] = Patients::with('patientContact')->where('patient_id', $patient_id)->first();
        // echo "<pre>"; print_r($data['Patients']); echo "</pre>";
        if($data['Patients']->patientContact['mobile'] != NULL || $data['Patients']->patientContact['email'] != NULL) {
            return view('reminders::createreminder')->with($data);
        } else {
            return Redirect::back()
                         ->with('flash_message', 'Error: No contacts found, unable to create a reminder.')
                         ->with('flash_type', 'alert-danger');
        }
    }

    /**
     * Insert patient's reminder
     * @param  ReminderFormRequest $request form validation
     * @return flash message
     */
    public function insertReminder(ReminderFormRequest $request) {
        $newId = IdGenerator::generateId();
        $userId = $this->currUser()->user_id;
        $facilityId = $this->facility()->facility_id;
        $facilityUserId = facilityUser::where(array('user_id'=>$userId,'facility_id'=>$facilityId))->pluck('facilityuser_id');

        /** Reminders */
        $patientId = Input::has('patientId') ? Input::get('patientId')  : false;
        $type = Input::has('reminder-type') ? Input::get('reminder-type')  : false;

        /** Reminder Messages */
        $datetime = new DateTime(Input::get('date') . ' ' . Input::get('time'));
        $datetime = $datetime->format('Y-m-d H:i:s');
        $send_days = Input::get('send_days');
        $mobile = Input::get('mobile-number');
        $email = Input::has('email') ? Input::get('email')  : false;
        $message = Input::has('message') ? Input::get('message')  : false;

        $ReminderMessage = new ReminderMessage;
        $ReminderMessage->remindermessage_id = $newId;
        $ReminderMessage->reminder_message = $message;
        $ReminderMessage->daysbeforesending = $send_days;
        $ReminderMessage->reminder_subject = $this->subject[$type];
        $ReminderMessage->appointment_datetime = $datetime;
        $ReminderMessage->status = '1';
        $ReminderMessage->sent_status = 'pending';
        $ReminderMessage->reminder_type = $type;
        $remindermessage_id = $ReminderMessage->remindermessage_id;
        $ReminderMessagesave = $ReminderMessage->save();

        $Reminders = new Reminders();
        $Reminders->reminder_id = $newId;
        $Reminders->facilityuser_id = $facilityUserId;
        $Reminders->patient_id = $patientId;
        $Reminders->user_id = '';

        $Reminders->remindermessage_id = $remindermessage_id;
        $Reminderssave = $Reminders->save();


        if($ReminderMessagesave && $Reminderssave) {

            /** Email Sending */
            $patientsDtls = Patients::where('patient_id', $patientId)->first();
            $patientName =  $patientsDtls['first_name'].' '.$patientsDtls['middle_name'].' '.$patientsDtls['last_name'];
            if($email) {
                $sendEmail = $this->sendToEmail($patientName, $email, $this->subject[$type], $message, $datetime);
            }
            /** INSERT SMS CHIKKA */
            if($mobile) {
                // $ChikkaSMS = new ChikkaSMS;
                // $sendText = $ChikkaSMS->sendText($newId, $mobile, $message);
            }

            $flash_type = 'alert-success';
            $flash_message = 'Well done! You successfully added new reminder.';
        } else {
            $flash_type = 'alert-danger';
            $flash_message = 'Failed to add';
        }

        return redirect('reminders')
                ->with('flash_message', $flash_message)
                ->with('flash_type', $flash_type);
    }

    /**
     * View:: Create a Broadcast to either User or Patient
     */
    public function createBroadcast() {
        return view('reminders::createbroadcast');
    }

    /**
     * Insert a broadcast
     * @param  BroadcastFormRequest $request form validation
     * @return flash message
     */
    public function insertBroadcast(BroadcastFormRequest $request) {
        $newId = IdGenerator::generateId();
        $userId = $this->currUser()->user_id;
        $facilityId = $this->facility()->facility_id;
        $facilityUserId = facilityUser::where(array('user_id'=>$userId,'facility_id'=>$facilityId))->pluck('facilityuser_id');

        $reminder_type = Input::get('reminder-reminder_type');
        $message = Input::get('message');
        $subject = Input::get('subject');

        if($reminder_type == 'BROADCAST_PATIENTS') {
            $List = facilityPatientUser::where('facilityuser_id',$facilityUserId)->select('patient_id as id')->get();
        } else {
            $List = facilityUser::where('facility_id', $facilityId)->select('user_id as id')->get();
        }
        // echo "<pre>"; print_r($List->count()); echo "</pre>";

        if($List->count() > 0) {
            $ReminderMessage = new ReminderMessage;
            $ReminderMessage->remindermessage_id = $newId;
            $ReminderMessage->reminder_message = $message;
            $ReminderMessage->reminder_subject = $subject;
            $ReminderMessage->reminder_type = '4'; //broadcast
            $ReminderMessage->remindermessage_type = $reminder_type;
            $ReminderMessage->status = 1;
            $ReminderMessage->sent_status = 'pending';

            $remindermessage_id = $ReminderMessage->remindermessage_id;
            $Reminderssave = $ReminderMessage->save();
            // echo "<pre>"; print_r($ReminderMessage); echo "</pre>";

            foreach ($List as $key => $value) {
                $Reminders = new Reminders();
                $Reminders->reminder_id = $newId.$key;
                $Reminders->facilityuser_id = $facilityUserId;

                /** Broadcast to Patients or to User */
                if($reminder_type == 'BROADCAST_PATIENTS') {
                    /** Patients List
                     * Insert to Patient Id field */
                    $Reminders->patient_id = $value['id'];
                    $Reminders->user_id = '';
                    $emailDetails = Patients::where('patients.patient_id',$value['id'])
                                            ->leftjoin('patient_contact', 'patients.patient_id','=','patient_contact.patient_id')
                                            ->select('patients.first_name', 'patients.last_name', 'patient_contact.email', 'patient_contact.mobile')
                                            ->first();
                    $numberDetails = $emailDetails->mobile;
                } else {
                    /** Users List
                     * Insert to User Id field */
                    $Reminders->patient_id = '';
                    $Reminders->user_id = $value['id'];
                    $emailDetails = Users::where('user_id',$value['id'])->first();
                    $num = UserContact::where('user_id',$value['id'])->first();
                    $numberDetails = $num->mobile;
                }


                $Reminders->remindermessage_id = $remindermessage_id;
                $ReminderMessagesave = $Reminders->save();

                /** Patients or Users with Email */
                if($ReminderMessagesave && $Reminderssave) {
                    $sendEmail = NULL;
                    $sendText = NULL;

                    $fullName = $emailDetails->first_name.' '.$emailDetails->middle_name.' '.$emailDetails->last_name;
                    if($numberDetails!=NULL) {
                        // $ChikkaSMS = new ChikkaSMS;
                        // $sendText = $ChikkaSMS->sendText($newId, $numberDetails, $message);
                    }
                    if($emailDetails->email) {
                        $sendEmail = $this->sendToEmail($fullName, $emailDetails->email, $subject, $message, NULL);
                    }

                    if($sendEmail || $sendText) {
                        $updateArr = ['sent_status'=>'sent'];
                        $this->updateStatus($remindermessage_id, $updateArr);
                    }
                }
            }

            if($ReminderMessagesave && $Reminderssave) {
                $flash_type = 'alert-success';
                $flash_message = 'Well done! You successfully added new broadcast.';
            } else {
                $flash_type = 'alert-danger';
                $flash_message = 'Failed to add';
            }
        } else {
            $flash_type = 'alert-danger';
            $flash_message = 'Failed to add. No record found.';
        }

        return redirect('broadcast')
                    ->with('flash_message', $flash_message)
                    ->with('flash_type', $flash_type);
    }

    public function sendToEmail($recipientName, $recipientEmail, $subject, $message, $appointment_datetime=NULL) {
        $FromUser = $this->currUser();
        $FromFacility = $this->facility();
        $data = array(
                'toUser_name' => $recipientName,
                'toUser_email' => $recipientEmail,
                'subj' => $subject,
                'msg' => $message,
                'appointment_datetime' => $appointment_datetime,
                'fromUser_name' => $FromUser->first_name.' '.$FromUser->middle_name.' '.$FromUser->last_name,
                'fromFacility' => $FromFacility->facility_name
                );
        $response = EmailHelper::SendReminderMessage($data);
        return $response;
    }

    /**
    *
    */
    public function updateStatus($remindermessage_id, $updateArr) {
        $stats = ReminderMessage::where('remindermessage_id', $remindermessage_id)->update($updateArr);
        return $stats;
    }

    /**
    *
    */
    public function deleteReminderBroadcast($reminder_id) {
        // dd($reminder_id);
        $query = Reminders::where('reminder_id', $reminder_id)
                            ->delete();

        if($query) {
            return Redirect::back()
                         ->with('flash_message', 'Successfully deleted')
                         ->with('flash_type', 'alert-success');
        } else {
            return Redirect::back()
                         ->with('flash_message', 'Error: Failed to delete.')
                         ->with('flash_type', 'alert-danger');
        }
    }
}
