<?php
namespace ShineOS\Core\Users\Libraries;

// User Entities
use ShineOS\Core\Users\Entities\Users;
use ShineOS\Core\Users\Entities\Contact;
use ShineOS\Core\Users\Entities\MDUsers;
use ShineOS\Core\Users\Entities\FacilityUser;

// Facility Entities
use ShineOS\Core\Facilities\Entities\Facilities;
use ShineOS\Core\Facilities\Entities\FacilityContact;
use ShineOS\Core\Facilities\Entities\DOHFacilityCode;

//Role
use ShineOS\Core\Users\Entities\RolesAccess;

// others
use ShineOS\Core\Users\Libraries\Salt;
use ShineOS\Core\Users\Libraries\UserActivation;
use Input, Hash;
use Shine\Libraries\IdGenerator;

class Register {

    function __construct(){

    }

    /**
     * Inserts facility info
     *
     * @return int
     */
    protected static function addFacility( $user_id ) {
        // sync ids
        $facility_id = IdGenerator::generateId();
        $facilitycontact_id = IdGenerator::generateId();

        // facility info
        $facility = new Facilities();
        $facility->facility_id = $facility_id; // change to hashed id
        $facility->phic_accr_id = Input::get('phic_accr_id');

        // facility contact
        $facilityContact = new FacilityContact();

        //if government, let us take the official information from the lov_doh_facility_codes
        if(Input::get('ownership_type') == 'government') {
            $doh = DOHFacilityCode::checkDoh(Input::get('DOH_facility_code'));
            $facility->facility_name = $doh->name;
            $facility->provider_type = Input::get('provider_type');
            $facility->ownership_type = Input::get('ownership_type');
            $facility->facility_type = $doh->type;
            $facility->DOH_facility_code = $doh->code;

            $facilityContact->address = $doh->address;
            $facilityContact->barangay = $doh->barangay;
            $facilityContact->city = $doh->city;
            $facilityContact->province = $doh->province;
            $facilityContact->region = $doh->region;
            $facilityContact->zip = $doh->zip;
            $facilityContact->country = "Philippines";
        } else {
            $facility->facility_name = Input::get('facility_name');
            $facility->provider_type = Input::get('provider_type');
            $facility->ownership_type = Input::get('ownership_type');
            $facility->facility_type = Input::get('facility_type');
            $facility->DOH_facility_code = Input::get('DOH_facility_code');
        }
        $facility->save();

        $facilityContact->facilitycontact_id = $facilitycontact_id;
        $facilityContact->facility_id = $facility_id;
        $facilityContact->save();

        return $facility_id;
    }

    /**
     * Add admin user
     *
     * @return array
     */
    protected static function addAdminUser() {
        // password and salt
        $password = Input::get('password');
        $salt = Salt::generateRandomSalt(10);

        // activation code
        $activation_code = UserActivation::generateActivationCode();

        // sync ids
        $user_id = IdGenerator::generateId();
        $usercontact_id = IdGenerator::generateId();
        $usermd_id = IdGenerator::generateId();

        // add user
        $users = new Users();
        $users->user_id = $user_id;
        $users->activation_code = $activation_code;
        $users->first_name = Input::get('first_name');
        $users->last_name = Input::get('last_name');
        $users->email = Input::get('email');
        $users->status = 'Active'; //auto-active for Developer Edition
        $users->user_type = 'Developer'; //set to Developer for Developer Edition
        $users->salt = $salt;
        $users->password = Hash::make($password.$salt);
        $users->save();

        // add user contact
        $contact = new Contact();
        $contact->phone = Input::get('phone');
        $contact->mobile = Input::get('mobile');
        $contact->user_id = $user_id;
        $contact->usercontact_id = $usercontact_id;
        $contact->save();

        // add user md info
        $md = new MDUsers();
        $md->user_id = $user_id;
        $md->usermd_id = $usermd_id;
        $md->save();

        $data = array();
        $data['users'] = $users;
        $data['user_id'] = $user_id;
        return $data;
    }

    /**
     * Establish relationship between user and facility
     *
     * @return null
     */
    public static function addFacilityUser ( $user_id, $facility_id ) {
        // add facility and user relationship

        $FacilityUser = new FacilityUser();
        $FacilityUser->facilityuser_id = IdGenerator::generateId();
        $FacilityUser->user_id = $user_id;
        $FacilityUser->facility_id = $facility_id;
        $FID = $FacilityUser->facilityuser_id;
        $FacilityUser->save();

        return $FID;
    }

    /**
     * Assign role to user
     *
     * @return null
     */
    public static function addRole ( $facilityUserID ) {
        // add role
        $userRole = new RolesAccess();
        $userRole->role_id = 0;
        $userRole->facilityuser_id = $facilityUserID;
        $userRole->save();

        return $userRole;
    }

    /**
     * Add admin user
     *
     * @return null
     */
    public static function initializeRegistration () {
        // add facility
        $users = self::addAdminUser();
        $facility_id = self::addFacility($users['user_id']);
        $facilityUser = self::addFacilityUser( $users['user_id'], $facility_id );
        $userRole = self::addRole($facilityUser);

        // send email
        //removed on Developer Edition
        //UserActivation::sendAdminActivationCode($users['users']);
    }

    private static function print_this( $object = array(), $title = '' ) {
        echo "<hr><h2>{$title}</h2><pre>";
        print_r($object);
        echo "</pre>";
    }
}
