
<?php
    $father_firstname = NULL;
    $father_middlename = NULL;
    $father_lastname = NULL;
    $father_suffix = NULL;
    $father_alive = NULL;
    $mother_firstname = NULL;
    $mother_middlename = NULL;
    $mother_lastname = NULL;
    $mother_alive = NULL;
    $ctr_householdmembers_lt10yrs = NULL;
    $ctr_householdmembers_gt10yrs = NULL;
    $family_folder_name = NULL;
    $emergency_name = NULL;
    $emergency_relationship = NULL;
    $emergency_contact = NULL;
    $emergency_address = NULL;

    if($plugdata) {
        $family = json_decode($plugdata->values);

        $father_firstname = $family->father_firstname;
        $father_middlename = $family->father_middlename;
        $father_lastname = $family->father_lastname;
        $father_suffix = isset($family->father_suffix) ? $family->father_suffix : NULL;
        $father_alive = isset($family->father_alive) ? $family->father_alive: NULL;
        $mother_firstname = isset($family->mother_firstname) ? $family->mother_firstname : NULL;
        $mother_middlename = isset($family->mother_middlename) ? $family->mother_middlename : NULL;
        $mother_lastname = isset($family->mother_lastname) ? $family->mother_lastname : NULL;
        $mother_alive = isset($family->mother_alive) ? $family->mother_alive : NULL;
        $ctr_householdmembers_lt10yrs = isset($family->ctr_householdmembers_lt10yrs) ? $family->ctr_householdmembers_lt10yrs : NULL;
        $ctr_householdmembers_gt10yrs = isset($family->ctr_householdmembers_gt10yrs) ? $family->ctr_householdmembers_gt10yrs : NULL;
        $family_folder_name = isset($family->family_folder_name) ? $family->family_folder_name : NULL;
        $emergency_name = isset($family->emergency_name) ? $family->emergency_name : NULL;
        $emergency_relationship = isset($family->emergency_relationship) ? $family->emergency_relationship : NULL;
        $emergency_contact = isset($family->emergency_contact) ? $family->emergency_contact : NULL;
        $emergency_address = isset($family->emergency_address) ? $family->emergency_address : NULL;
    }

    $method = 'save';
    if($plugdata) {
        $method = 'update';
    }
?>
<div class="tab-content">
 <div class="tab-pane step active" id="family">
    {!! Form::model($patient, array('url' => 'plugin/saveBlob/patients/ShineLab_Family/'.$patient->patient_id,'class'=>'form-horizontal')) !!}
    <fieldset>
        <input type="hidden" name="id" value="{{ $plugdata->id or NULL }}" />
        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" />
        <legend>Family Information</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Number of Households Members</label>
            <div class="col-sm-4">
                <label class="sublabel col-md-8">Less then 10 years old</label>
                {!! Form::text('ctr_householdmembers_lt10yrs', $ctr_householdmembers_lt10yrs, array('class' => 'form-control autowidth col-md-1', 'name'=>'ctr_householdmembers_lt10yrs','placeholder'=>'&lt; 10 years')) !!}
                <label class="sublabel col-md-8">More then 10 years old</label>
                {!! Form::text('ctr_householdmembers_gt10yrs', $ctr_householdmembers_gt10yrs, array('class' => 'form-control autowidth col-md-1', 'name'=>'ctr_householdmembers_gt10yrs','placeholder'=>'&gt; 10 years')) !!}
            </div>
            <label class="col-sm-2 control-label">Family Folder</label>
            <div class="col-sm-4">
                <input type="text" class="form-control alphanumeric" name="family_folder_name" placeholder="Enter Last Name of the patient" value="{{ $family_folder_name }}">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Parents Information</legend>
        <div class="form-group">
            <div class="col-md-6"><strong>Father Details</strong><hr /></div>
            <div class="col-md-6"><strong>Mother Details</strong><hr /></div>

            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-4">
                <div class="radio-inline">
                    <label>
                      <input type="radio" name="father_alive" id="" value="alive" <?php if($father_alive == 'alive') echo "checked"; ?>> Alive
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                      <input type="radio" name="father_alive" id="" value="deceased" <?php if($father_alive == 'deceased') echo "checked"; ?>> Deceased
                    </label>
                </div>
            </div>

            <label class="col-sm-2 control-label">Status</label>
            <div class="col-sm-4">
                <div class="radio-inline">
                    <label>
                      <input type="radio" name="mother_alive" id="" value="alive" <?php if($mother_alive == 'alive') echo "checked"; ?>> Alive
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                      <input type="radio" name="mother_alive" id="" value="deceased" <?php if($mother_alive == 'deceased') echo "checked"; ?>> Deceased
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <label class="col-sm-4 control-label">Firstname</label>
                <div class="col-sm-8">
                    {!! Form::text('father_firstname', $father_firstname, array('class' => 'form-control', 'name'=>'father_firstname')) !!}
                </div>

                <label class="col-sm-4 control-label">Middlename</label>
                <div class="col-sm-8">
                    {!! Form::text('father_middlename', $father_middlename, array('class' => 'form-control', 'name'=>'father_middlename')) !!}
                </div>

                <label class="col-sm-4 control-label">Lastname</label>
                <div class="col-sm-8">
                    {!! Form::text('father_lastname', $father_lastname, array('class' => 'form-control', 'name'=>'father_lastname')) !!}
                </div>

                <label class="col-sm-4 control-label">Suffix</label>
                <div class="col-sm-8">
                    <div class="btn-group toggler" data-toggle="buttons">
                      <label class="btn btn-default">
                        <input type="radio" name="father_suffix" id="" autocomplete="off"> Sr.
                      </label>
                      <label class="btn btn-default">
                        <input type="radio" name="father_suffix" id="" autocomplete="off"> Jr.
                      </label>
                      <label class="btn btn-default">
                        <input type="radio" name="father_suffix" id="" autocomplete="off"> III
                      </label>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                    <label class="col-sm-4 control-label">Firstname</label>
                    <div class="col-sm-8">
                        {!! Form::text('mother_firstname', $mother_firstname, array('class' => 'form-control', 'name'=>'mother_firstname')) !!}
                    </div>

                    <label class="col-sm-4 control-label">Middlename</label>
                    <div class="col-sm-8">
                        {!! Form::text('mother_middlename', $mother_middlename, array('class' => 'form-control', 'name'=>'mother_middlename')) !!}
                    </div>

                    <label class="col-sm-4 control-label">Lastname</label>
                    <div class="col-sm-8">
                        {!! Form::text('mother_lastname', $mother_lastname, array('class' => 'form-control', 'name'=>'mother_lastname')) !!}
                    </div>

            </div>
        </div>

    </fieldset>
    <fieldset>
        <legend>In Case of Emergency</legend>
        <div class="form-group has-feedback">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control alpha" placeholder="Name of Contact" name="emergency_name" value="{{ $emergency_name }}">
            </div>

            <label class="col-sm-2 control-label">Relationship</label>
            <div class="col-sm-4">
                <select class="form-control" name="emergency_relationship">
                    <option value="">-- Select --</option>
                    <option <?php if($emergency_relationship == 'Father') echo "selected"; ?>>Father</option>
                    <option <?php if($emergency_relationship == 'Mother') echo "selected"; ?>>Mother</option>
                    <option <?php if($emergency_relationship == 'Sibling') echo "selected"; ?>>Sibling</option>
                    <option <?php if($emergency_relationship == 'Spouse') echo "selected"; ?>>Spouse</option>
                    <option <?php if($emergency_relationship == 'Others') echo "selected"; ?>>Others</option>
                </select>
            </div>
            <label class="col-sm-2 control-label">Contact/Mobile No.</label>
            <div class="col-sm-4">
                {!! Form::text('emergency_contact', $emergency_contact, array('class' => 'form-control', 'name'=>'emergency_contact')) !!}
            </div>

            <label class="col-sm-2 control-label">Address</label>
            <div class="col-sm-4">
                <textarea class="form-control alphanumeric" rows="5" name="emergency_address">{{ $emergency_address }}</textarea>
            </div>
        </div>
    </fieldset>
     <div class="form-group pull-right ">
        <button type="button" class="btn btn-primary" onclick="location.href='{{ url('patients/view/'.$patient->patient_id) }}'">Close</button>
        <button type="submit" value="submit" class="btn btn-success">{{ ucfirst($method) }}</button>
    </div>
    {!! Form::close() !!}
    <br clear="all" />
  </div><!-- /.tab-pane -->
</div>
