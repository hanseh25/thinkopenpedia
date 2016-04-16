<?php
namespace Plugins\FamilyPlanning;

use Plugins\FamilyPlanning\FamilyPlanningModel as FamilyPlanning;
use ShineOS\Core\Helathcareservices\Entities\Healthcareservices;
use Shine\Repositories\Eloquent\HealthcareRepository as HealthcareRepository;
use Shine\Repositories\Contracts\HealthcareRepositoryInterface;
use Shine\Http\Controllers\Controller;
use Shine\Libraries\IdGenerator;
use Shine\User;
use Shine\Plugin;

class FamilyPlanningController extends Controller
{
    protected $moduleName = 'Healthcareservices';
    protected $modulePath = 'healthcareservices';

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //no index
    }

    public function testFunction()
    {
        return "Family Planning";
    }

    public function save()
    {
        $hservice_id = Input::get('hservice_id');
        $familyplanning_id = Input::get('fpservice_id');

        $familyplanning_service = FamilyPlanning::where('familyplanning_id','=',$familyplanning_id)->first();

        $familyplanning_service->conjunctiva = Input::get('Conjunctiva');
        $familyplanning_service->neck = Input::get('Neck');
        $familyplanning_service->breast = Input::get('Breast');
        $familyplanning_service->thorax = Input::get('Thorax');
        $familyplanning_service->abdomen = Input::get('Abdomen');
        $familyplanning_service->extremities = Input::get('Extremities');
        $familyplanning_service->perineum = Input::get('Perineum');
        $familyplanning_service->vagina = Input::get('Vagina');
        $familyplanning_service->cervix = Input::get('Cervix');
        $familyplanning_service->consistency = Input::get('Consistency');
        $familyplanning_service->uterus_position = Input::get('UterusPosition');
        $familyplanning_service->uterus_size = Input::get('UterusSize');
        $familyplanning_service->uterus_depth = Input::get('UterusDepth');
        $familyplanning_service->adnexa = Input::get('Adnexa');
        $familyplanning_service->full_term = Input::get('FullTerm');
        $familyplanning_service->abortions = Input::get('Abortions');
        $familyplanning_service->premature = Input::get('Premature');
        $familyplanning_service->living_children = Input::get('LivingChildren');
        $familyplanning_service->date_of_last_delivery = Input::get('DateOFLastDelivery');
        $familyplanning_service->type_of_last_delivery = Input::get('TypeOfLastDelivery');
        $familyplanning_service->past_menstrual_period = Input::get('PastMenstrualPeriod');
        $familyplanning_service->last_menstrual_period = Input::get('LastMenstrualPeriod');
        $familyplanning_service->number_of_days_menses = Input::get('NumberOfDaysMenses');
        $familyplanning_service->character_of_menses = Input::get('CharacterofMenses');
        $familyplanning_service->with_history_of_multiple_partners = Input::get('WithHistoryOfMultiplePartners');
        $familyplanning_service->referred_to_others = Input::get('ReferredtoOthers');
        $familyplanning_service->planning_start = Input::get('PlanningStart');
        $familyplanning_service->no_of_living_children = Input::get('NoOfLivingChildren');
        $familyplanning_service->plan_more_children = Input::get('PlanMoreChildren');
        $familyplanning_service->reason_for_practicing_fp = Input::get('ReasonForPracticingFP');
        $familyplanning_service->client_type = Input::get('ClientType');
        $familyplanning_service->client_sub_type = Input::get('ClientSubType');
        $familyplanning_service->previous_method = Input::get('PreviousMethod');
        $familyplanning_service->current_method = Input::get('CurrentMethod');
        $familyplanning_service->remarks = Input::get('Remarks');

        //HISTORY OF FOLLOWING
        $historyOFFollowing = Input::get('HistoryOfAnyOfTheFollowing');
        $historyFollowing = "";
        if(isset($historyOFFollowing))
        {
            foreach($historyOFFollowing as $key => $value)
            {
                if($key == 0)
                {
                    $historyFollowing .= $value;
                }
                else
                {
                    $historyFollowing .= "," . $value;
                }
            }
        }
        $familyplanning_service->history_of_following = $historyFollowing;

        //STI RISKS WOMEN
        $sti_women = (Input::get('STIRisksWomen') != null) ? Input::get('STIRisksWomen') : null;
        $stiRisksWomen = "";
        if(isset($sti_women))
        {
            foreach($sti_women as $key => $value)
            {
                if($key == 0)
                {
                    $stiRisksWomen .= $value;
                }
                else
                {
                    $stiRisksWomen .= "," . $value;
                }
            }
        }
        $familyplanning_service->sti_risks_women = $stiRisksWomen;


        //STI RISKS MEN
        $sti_men = Input::get('STIRisksMen');
        $stiRisksMen = "";
        if(isset($sti_men))
        {
            foreach($sti_men as $key => $value)
            {
                if($key == 0)
                {
                    $stiRisksMen .= $value;
                }
                else
                {
                    $stiRisksMen .= "," . $value;
                }
            }
        }
        $familyplanning_service->sti_risks_men = $stiRisksMen;

        //VIOLENCE AGAINTS WOMEN
        $violenceAgainstWomen = Input::get('ViolenceAgainstWomen');
        $violenceWomen = "";
        if(isset($violenceAgainstWomen))
        {
            foreach($violenceAgainstWomen as $key => $value)
            {
                if($key == 0)
                {
                    $violenceWomen .= $value;
                }
                else
                {
                    $violenceWomen .= "," . $value;
                }
            }
        }
        $familyplanning_service->violence_against_women = $violenceWomen;

        //REFERRED TO
        $referred = Input::get('Referredto');
        $referredTo = "";
        if(isset($referred))
        {
            foreach($referred as $key => $value)
            {
                if($key == 0)
                {
                    $referredTo .= $value;
                }
                else
                {
                    $referredTo .= "," . $value;
                }
            }
        }
        $familyplanning_service->referred_to = $referredTo;

        $familyplanning_service->save();

        $patient_id = getPatientIDByHealthcareserviceID($hservice_id);
        header('Location: '.site_url().'healthcareservices/edit/'.$patient_id.'/'.$hservice_id);
        exit;
    }
}
