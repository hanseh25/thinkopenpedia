<?php namespace ShineOS\Core\Facilities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB, DateTime;

class facilityPatientUser extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facility_patient_user';
    protected static $table_name = 'facility_patient_user';
    /**
     * Override primary key used by model
     *
     * @var int
     */
    protected $primaryKey = 'facilitypatientuser_id';

    protected $fillable = [];


    public function healthCareServices() {
        return $this->belongsToMany('ShineOS\Core\Healthcareservices\Entities\Healthcareservices','facility_patient_user','facilitypatientuser_id','facilitypatientuser_id')->withPivot('facilitypatientuser_id');
    }

    public function healthCare() {
        return $this->hasMany('ShineOS\Core\Healthcareservices\Entities\Healthcareservices','facilitypatientuser_id');
    }

    public function facilityUser()
    {
        return $this->belongsToMany('ShineOS\Core\Facilities\Entities\FacilityUser', 'facility_patient_user', 'facilitypatientuser_id', 'facilityuser_id');
    }

    public function patients()
    {
        DB::enableQueryLog();
        return $this->hasMany('ShineOS\Core\Patients\Entities\Patients', 'patient_id', 'patient_id');
    }

    public function patientContact()
    {
        DB::enableQueryLog();
        return $this->hasMany('ShineOS\Core\Patients\Entities\PatientContacts', 'patient_id', 'patient_id');
    }

    public function diagnosis()
    {
        DB::enableQueryLog();
        return $this->belongsToMany('ShineOS\Core\Healthcareservices\Entities\Diagnosis','healthcare_services','facilitypatientuser_id', 'healthcareservice_id')->withPivot('created_at');
    }

    public function medicalOrder()
    {
        DB::enableQueryLog();
        return $this->belongsToMany('ShineOS\Core\Healthcareservices\Entities\MedicalOrder','healthcare_services','facilitypatientuser_id', 'healthcareservice_id')->withPivot('created_at');
    }

    // DYNAMIC SCOPE

    public function scopeName($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('patients', function ($q) use ($type)
            {
                $q->where('first_name','LIKE','%'.$type.'%')->orwhere('middle_name','LIKE','%'.$type.'%')->orwhere('last_name','LIKE','%'.$type.'%');
            });
        endif;

        return false;
    }

    public function scopeAgeRange($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('patients', function ($q) use ($type)
            {
                $dateNow = new DateTime();
                $year = $dateNow->format("Y");
                $maxAge = $year - $type[0];
                $minAge = $year - $type[1];

                $q->where(DB::raw('YEAR(birthdate)'),'>', $minAge)->where(DB::raw('YEAR(birthdate)'),'<=', $maxAge);
            });
        endif;

        return false;

    }

    public function scopeSex($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('patients', function ($q) use ($type)
            {
                $q->where('gender',$type);
            });
        endif;

        return false;
    }

    public function scopeHasBarangay($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('patientContact', function ($q) use ($type)
            {
                $q->where('barangay', $type);
            });
        endif;

        return false;
    }

    public function scopeHasCityMun($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('patientContact', function ($q) use ($type)
            {
                $q->where('city', $type);
            });
        endif;

        return false;
    }

    public function scopeHasDiagnosis($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('diagnosis', function ($q) use ($type)
            {
                $q->where('diagnosislist_id','LIKE', '%'.$type.'%');
            });
        endif;

        return false;
    }

    public function scopeHasMedicalOrder($query, $type)
    {
        DB::enableQueryLog();
        if ($type != null) :
            return $query->whereHas('medicalorder', function ($q) use ($type)
            {
                $q->where('medicalorder_type', $type);
            });
        endif;

        return false;
    }
}
