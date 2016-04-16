@section('heads')
{!! HTML::style('public/dist/css/prettify.css') !!}
{!! HTML::style('public/dist/plugins/datepicker/datepicker3.css') !!}
{!! HTML::style('public/dist/plugins/timepicker/bootstrap-timepicker.min.css') !!}
{!! HTML::style('public/dist/plugins/camera/styles.css') !!}
@stop

@extends('patients::layouts.inner')
@section('header-content') Patient's Profile @stop
@section('patient-title') Editing Profile of {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }} @stop

@section('patient-content')
    @if(Session::has('message'))
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

    <div class="nav-tabs-custom">
      @include('patients::partials.tab_nav')
      {!! Form::model($patient, array('url' => 'patients/'.$patient->patient_id.'/update/','class'=>'form-horizontal', 'enctype'=>"multipart/form-data")) !!}

        <div class="tab-content">
          @include('patients::pages.forms.basic_info')
          @include('patients::pages.forms.location')
          @include('patients::pages.forms.allergies_alerts')
          @include('patients::pages.forms.notification_settings')
          @include('patients::pages.forms.photos')

        </div><!-- /.tab-content -->

        <div class="form-group pull-right tab-buttons">
            <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/records') }}'">Cancel</button>
            <button type="submit" value="submit" class="btn btn-success">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('scripts')
  {!! HTML::script('public/dist/plugins/camera/webcam.js') !!}

  <!-- Modal form-->
    <div class="modal fade" id="deathModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Declare Patient Dead</h4>
          </div>
            @if (isset($patient))
            {!! Form::model($patient, array('url' => 'patients/'.$patient->patient_id.'/saveDeathInfo','class'=>'form-horizontal', 'method'=>'PATCH' )) !!}
            @else
            {!! Form::open(array('url' => 'patients/viewDeathInfo','class'=>'form-horizontal')) !!}
            @endif
          <div class="modal-body" id="modal-body">
            <div class="form-group">
              <label for="inputCauseofDeath">Cause of Death</label>
              <input type="text" class="form-control" name="inputCauseofDeath" id="inputCauseofDeath" placeholder="Cause of Death">
            </div>

            <div class="form-group">
              <label for="inputPlaceofDeath">Place of Death</label>
              <input type="text" class="form-control" name="inputPlaceofDeath" id="inputPlaceofDeath" placeholder="Place of Death">
            </div>

            <div class="form-group">
              <label for="exampleInputFile">Date and Time of Death</label>
              <input type="text" class="form-control" name="inputDateTimeDeath" id="datetimepicker" placeholder="Death Time and Day" value="{{ date("m/d/Y h:i A") }}">
            </div>

            <div class="form-group">
              <label for="inputCauseofDeathNotes">Notes</label>
              <textarea class="form-control" name="inputCauseofDeathNotes" id="inputCauseofDeathNotes"></textarea>
            </div>

            <div class="form-group">
              <label for="inputDeathCertificate">Death Certificate</label>
              <input type="file" id="inputDeathCertificate" name="inputDeathCertificate">
            </div>
          </div>
          <div class="modal-footer" id="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end of modal ------------------------------>

    <div class="modal fade" id="camerabox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Take Photo</h4>
          </div>
          <div class="modal-body" id="modal-body">
                <h2>Photo</h2>
                <div id="camera">
                    <div id="screen"></div>
                    <div id="buttons">
                        <div class="buttonPane">
                            <a id="shootButton" href="" class="blueButton">Shoot!</a>
                        </div>
                        <div class="buttonPane" style="display:none;">
                            <a id="cancelButton" href="" class="blueButton">Cancel</a> <a id="uploadButton" href="" class="greenButton">Upload!</a>
                        </div>
                    </div>
                    <span class="settings"></span>
                </div>
          </div>
        </div>
      </div>
    </div>

  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var patientId = "{{ $patient->patient_id }}";

    function show_maiden()
    {
        var marital_status = $("#marital_status_field").val();
        var gender = $(".gender:checked").val();

        console.log(gender);
        if (marital_status == 'M')
        {
            $('.maiden').show();
        }
        else
        {
            $('.maiden').hide();
        }
    }

    $(document).ready(function () {
        $(".masked").inputmask();
        $(".email").inputmask("email");

        show_maiden();

        webcam.set_api_url('{{ site_url() }}patients/uploadCameraPhoto/{{ $patient->patient_id }}');

    });
  </script>
  {!! HTML::script('public/dist/plugins/camera/pat_script.js') !!}
  {!! HTML::script('public/dist/js/pages/patients/patients.js') !!}
@stop
