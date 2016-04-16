<?php
$phone = NULL;
$phone_ext = NULL;
$mobile = NULL;
$email = NULL;
$street_address = NULL;
$region = NULL;
$province = NULL;
$city = NULL;
$barangay = NULL;
$zip = NULL;
$country = NULL;

if(isset($patient) AND $patient->patientContact) {
    $phone = $patient->patientContact->phone;
    $phone_ext = $patient->patientContact->phone_ext;
    $mobile = $patient->patientContact->mobile;
    $email = $patient->patientContact->email;
    $street_address = $patient->patientContact->street_address;
    $region = $patient->patientContact->region;
    $province = $patient->patientContact->province;
    $city = $patient->patientContact->city;
    $barangay = $patient->patientContact->barangay;
    $zip = $patient->patientContact->zip;
    $country = $patient->patientContact->country;
}
?>

<div class="tab-pane step" id="location">
    <fieldset>
        <legend>Contact Data</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Phone number</label>
            <div class="col-sm-4">
                <!-- <input type="text" class="form-control phonePH" name="inputPatientPhone"  placeholder="Telephone" value="" data-mask="" data-inputmask="'mask': '99-9999999'" /> -->
                {!! Form::text('phone', $phone, array('class' => 'form-control phonePH masked', 'name'=>'inputPatientPhone', 'data-mask'=>'', 'data-inputmask'=>'&quot;mask&quot;: &quot;99-9999999&quot;', 'placeholder'=>'02-5772886')) !!}
            </div>
            <label class="col-sm-2 control-label">Phone extension</label>
            <div class="col-sm-4">
                <!-- <input type="text" class="form-control digits" name="inputPatientPhoneExtension"  placeholder="Telephone Extension" value="" /> -->
                {!! Form::text('phone_ext', $phone_ext, array('class' => 'form-control digits', 'name'=>'inputPatientPhoneExtension')) !!}
            </div>
            <label class="col-sm-2 control-label">Mobile number</label>
            <div class="col-sm-4">
                <!-- <input type="text" class="form-control mobilePH" name="inputPatientMobile"  placeholder="Mobile Number" value="" data-mask="" data-inputmask="'mask': '0999-9999999'" /> -->
                {!! Form::text('mobile', $mobile, array('class' => 'form-control mobilePH masked', 'name'=>'inputPatientMobile', 'data-mask'=>'', 'data-inputmask'=>'&quot;mask&quot;: &quot;0999-9999999&quot;', 'placeholder'=>'0917-1234567')) !!}
            </div>
            <label class="col-sm-2 control-label">Email address</label>
            <div class="col-sm-4">
                <!-- <input type="text" class="form-control email" name="inputPatientEmail" placeholder="Email Address" value="" /> -->
                {!! Form::text('email', $email, array('class' => 'form-control email', 'name'=>'inputPatientEmail')) !!}
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Address Information</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Street Address</label>
            <div class="col-sm-4">
                {!! Form::text('street_address', $street_address, array('class' => 'form-control alpha', 'name'=>'inputPatientAddress')) !!}
            </div>
            <br clear="all" />

            <label class="col-sm-2 control-label">Region</label>
            <div class="col-sm-4">
                <select class="placeholder form-control required" name="region" id="region">
                    {{ Shine\Libraries\Utils::get_regions($region) }} 
                </select>
            </div>
            <label class="col-sm-2 control-label">Province</label>
            <div class="col-sm-4">
                <select class="populate placeholder form-control required" name="province" id="province"> 
                    {{ Shine\Libraries\Utils::get_provinces($region, $province) }} 
                </select>
            </div>

            <label class="col-sm-2 control-label">City / Municipality</label>
            <div class="col-sm-4">
                <select class="populate placeholder form-control required" name="city" id="city"> 
                    {{ Shine\Libraries\Utils::get_cities($region, $province, $city) }} 
                </select>
            </div>

            <label class="col-sm-2 control-label">Barangay</label>
            <div class="col-sm-4">
                <select class="populate placeholder form-control required" name="brgy" id="brgy"> 
                    {{ Shine\Libraries\Utils::get_brgys($region, $province, $city, $barangay) }} 
                </select>
            </div>

            <label class="col-sm-2 control-label">ZIP</label>
            <div class="col-sm-4">
                {!! Form::text('zip', $zip, array('class' => 'form-control', 'name'=>'inputPatientZip')) !!}
            </div>
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-4">
                <select class="populate placeholder form-control" name="inputPatientCountry" id="country">
                    <option value="PHL">Philippines</option>
                </select>
            </div>
        </div>
    </fieldset>
</div><!-- /.tab-pane -->
