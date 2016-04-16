@extends('users::layouts.masterlogin')
@section('title') ShineOS+ | Registration @stop
@section('content')

<?php
    //RJBS solution for form data
    //for clean-up
    $enteredData = Session::get('enteredData');
    if($enteredData) {
        $DOH_facility_code = $enteredData['DOH_facility_code'];
        $facility_name = $enteredData['facility_name'];
        $provider_type = $enteredData['provider_type'];
        $ownership_type = $enteredData['ownership_type'];
        $facility_type = $enteredData['facility_type'];
        $phic_accr_id = $enteredData['phic_accr_id'];
        $first_name = $enteredData['first_name'];
        $last_name = $enteredData['last_name'];
        $email = $enteredData['email'];
        $phone = $enteredData['phone'];
        $mobile = $enteredData['mobile'];
    } else {
        $DOH_facility_code = '';
        $facility_name = '';
        $provider_type = '';
        $ownership_type = '';
        $facility_type = '';
        $phic_accr_id = '';
        $first_name = '';
        $last_name = '';
        $email = '';
        $phone = '';
        $mobile = '';
    }
?>
<style>
    .form-control {
        background-color: rgba(250,250,250,.1) !important;
        border-color: #666 !important;
        color: #fff;
    }
    .input-group .input-group-addon {
        background-color: rgba(250,250,250,.1) !important;
        border-color: #666 !important;
        color: #999;
    }
    i.fa {
        width: 14px;
    }
    .required {
        background-color: rgba(250,250,250,.3) !important;
    }
    #captcha-image {
        opacity: 0.3 !important;
    }
    form label.error {
        color: #FC0 !important;
    }
    .popover {
        color: #000 !important;
    }
    .fa-refresh {
        margin-left: 10px;
    }
    select option {
        color: #000;
    }
    .help-block {
        display:none !important;
    }
</style>
<div class="container">
    {!! Form::open(array( 'url'=>$modulePath.'/register', 'id'=>'crudForm', 'name'=>'crudForm', 'class'=>'form-horizontal' )) !!}
    <div class="row">
        <div class="col-md-6 top40">
            <div class="jumbotron reg-jumbotron">
                <img src="{{ asset('public/dist/img/logos/shinelogo-x-big.png') }}" class="img-responsive" />
                <h2>Developer Admin User Registration</h2>
                <h3>Please complete the information.</h3>
                <p>Registration is required for new providers and validation is required for existing Shine users.</p>
            </div>

        </div>

        <!--Space filler-->
        <div class="col-md-1">
        </div>

        <div class="col-md-5 top40 bottom40">
            @if (Session::has('message'))
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif
            @if (Session::has('warning'))
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session::get('warning') }}</p>
                </div>
            @endif

            <h4>REGISTRATION FORM</h4>
            <p>
                If your facility has a DOH Facility Code, enter the last 5 digits.
                If your code is less than 5 digits, add zeros before your code. If none, skip this field.
            </p>
            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="DOH Facility Code" data-content="This is your DOH Facility Code. This is optional but if you are a Government-owned facility, this is required for your compliance. If you typed in your correct Code, all pertinent fields will be pre-filled for you if data is available."><i class="fa fa-question-circle font20"></i></span>
                <input type="text" data-mask="" data-inputmask="'mask': 'DOH000000000099999'" placeholder="DOH Facility Code. Enter only last 5 digits. Optional." class="form-control" id="DOH_facility_code" name="DOH_facility_code" value="{{ $DOH_facility_code }}" />
            </div>


            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Facility Name" data-content="This is your Facility Name. Please enter your valid facility name here. This will identify you from other providers."><i class="fa fa-question-circle font20"></i></span>
                <input type="text" placeholder="Facility Name" class="form-control required" id="facility_name" value="{{ $facility_name }}" name="facility_name" required />
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Provider Type" data-content="Please indicate what type of provider you are."><i class="fa fa-question-circle font20"></i></span>
                <select name="provider_type" id="provider_type" class="required form-control" required>
                    <option value="">Select Provider Type</option>
                    <option value="facility">Facility</option>
                    <option value="individual">Individual</option>
                </select>
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Ownership Type" data-content="The ownership type of your facility whether you own it as a private clinic or owned by the government. Choose from the list."><i class="fa fa-question-circle font20"></i></span>
                <select name="ownership_type" id="ownership_type" class="required form-control" required>
                    <option value="">Select Ownership Type</option>
                    <option value="government">Government</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Facility Type" data-content="The type of facility you manage. Choose from the list."><i class="fa fa-question-circle font20"></i></span>
                <select name="facility_type" id="facility_type" class="populate placeholder required form-control">
                    <option value="">Select Facility Type</option>
                    <option class="ot_government" value="Barangay Health Station">Barangay Health Station</option>
                    <option class="ot_private" value="Birthing Home">Birthing Home</option>
                    <option class="ot_government" value="City Health Office">City Health Office</option>
                    <option class="ot_government" value="District Health Office">District Health Office</option>
                    <option class="ot_private" value="Hospital">Hospital</option>
                    <option class="ot_government" value="Main Health Center">Main Health Center</option>
                    <option class="ot_government" value="Municipal Health Office">Municipal Health Office</option>
                    <option class="ot_government" value="Provincial Health Office">Provincial Health Office</option>
                    <option class="ot_government" value="Rural Health Unit">Rural Health Unit</option>
                    <option class="ot_private" value="Private Clinic">Private Clinic</option>
                </select>
                </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Philhealth Accreditation NUmber" data-content="This is your PhilHealth Accreditation Number. This is required if your ownership type if Government."><i class="fa fa-question-circle font20"></i></span>
                <input type="text" placeholder="PhilHealth Accreditation Number" class="form-control" id="phic_accr_id" value="{{ $phic_accr_id }}" name="phic_accr_id" />
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Administrator Name" data-content="Please provide the first name and last name of your facility's administrator"><i class="fa fa-question-circle font20"></i></span>
                <div class="row col-md-6">
                    <input type="text" placeholder="Administrator First Name" class="form-control required" id="first_name" value="{{ $first_name }}" name="first_name" />
                </div>

                <div class="col-md-6">
                    <input type="text" placeholder="Administrator Last Name" class="form-control required" id="last_name" value="{{ $last_name }}" name="last_name" />
                </div>
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Administrator Email Address" data-content="The email address of your administrator."><i class="fa fa-question-circle font20"></i></span>
                <input type="text" placeholder="Administrator Email Address" class="form-control required" id="email" value="{{ $email }}" name="email" />
            </div>

            <div class="form-group input-group">
                <div class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Administrator Phone Number" data-content="The telephone number of your administrator.">
                <i class="fa fa-phone font20"></i>
                </div>
                <input type="text" name="phone" id="phone" data-mask="" data-inputmask="&quot;mask&quot;: &quot;99-9999999&quot;" class="form-control" placeholder="Telephone 02-5772886" value="{{ $phone }}" />
            </div><!-- /.input group -->

            <div class="form-group input-group">
                <div class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Administrator Mobile Number" data-content="The mobile number of your administrator.">
                <i class="fa fa-mobile font20"></i>
                </div>
                <input type="text" name="mobile" id="mobile" data-mask="" data-inputmask="&quot;mask&quot;: &quot;0999-9999999&quot;" class="form-control" placeholder="Mobile 0917-1234567" value="{{ $mobile }}" />
            </div><!-- /.input group -->

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Administrator Password" data-content="This is your Administrator Password. Enter a password for your account."><i class="fa fa-question-circle font20"></i></span>
                <input type="password" placeholder="Administrator Password" class="form-control required" id="password" value="" name="password" />
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Password Confirmation" data-content="Please confirm the password you entered above by repeating it here."><i class="fa fa-question-circle font20"></i></span>
                <input type="password" placeholder="Confirm Administrator Password" class="form-control required" id="password_confirm" value="" name="password_confirm" />
            </div>

            <div class="form-group input-group">
                <img src="{{ url('registration/captcha') }}" alt="Please verify if you are a human" id="captcha-image" />
                <a href="#" class="fa fa-refresh captcha-refresh">&nbsp;</a>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon" data-placement="left" data-toggle="popover" data-trigger="hover" title="Captcha" data-content="Please verify if you are a human."><i class="fa fa-question-circle font20"></i></span>
                <input id="test_captcha" placeholder="Copy the code above." name="test_captcha" value="" type="text" class="form-control required" />
            </div>

            <div class="form-group pull-right">
                <input type="submit" name="Register" id="btnRegister" class="btn btn-success" value="Register" />
                <a href="{{ url('/') }}" class="btn btn-warning">Cancel</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop


@section('footer')
    <script src="{{ asset('public/dist/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/input-mask/inputmask.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/input-mask/inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/input-mask/inputmask.extensions.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('public/dist/js/pages/registration.js') }}"></script>
@stop

