@extends('healthcareservices::layouts.master')
@section('header-content') 
  New Healthcare Record 
@stop

@section('healthcareservices-content')
  <div class="row">
    <div class="col-xs-12">
    <?php
    if(empty($addendum_record)) { $addendumRead = ''; }
    else { $addendumRead = 'disabled'; }
    ?>

      @if (Session::has('flash_message'))
            <div class="alert {{Session::get('flash_type') }}">{{ Session::get('flash_message') }}</div>
        @endif

        @if(count($errors) > 0 )
          <div class="alert alert-danger">
             @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
          </div>
        @endif
      <!-- Create Addendum -->
        <div class="modal fade" id="createAddendum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            {!! Form::open(array('route' => 'addendum.add')) !!}
            @if($healthcareData)
            {!! Form::hidden('healthcareservice_id', $healthcareData->healthcareservice_id) !!}
            @endif
            @if(isset($session_user_id))
              {!! Form::hidden('session_user_id', $session_user_id) !!}
            @endif
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Add Addendum </h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    {!! Form::textarea('addendum_notes', NULL, ['class' => 'form-control required noresize', 'placeholder' => 'Addendum']) !!}
                  </div>
                </div>
                @if(isset($addendum_record))
                  @foreach($addendum_record as $k_addendum => $v_addendum)
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box no-border">
                            <div class="box-body">
                                <p>
                                <b> {{ dateFormat($v_addendum->created_at, "M. d, Y h:i a") }} </b> : {{ $v_addendum->addendum_notes }}
                                </p>
                            </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Send Addendum', ['class'=>'btn btn-primary', 'name'=>'sendAddendum']) !!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      <!-- End:: Create Addendum -->

      <div class="box box-primary">

        <div class="info-box padding-1p">
          <span class="info-box-icon no-bg patient-img">
            <img src="{{ asset('public/dist/img/noimage_male.png') }}">
          </span>
          <div class="info-box-content">
            <div class="col-md-5">
              <h2> {{$patient->last_name}}, {{$patient->first_name}} </h2>
              <!-- add by RJBS -->
              <p><a href="{{ url('patients/'.$patient->patient_id) }}" class="text-yellow"><i class="fa fa-external-link-square"></i> View Profile</a></p>
              <!-- end RJBS -->
              <h5> {{$patient->gender}} | {{ getAge($patient->birthdate) }} years old | {{dateFormat($patient->birthdate, 'F d, Y')}}</h5>
              @if ($patient->patientContact)
                 <p>{{($patient->patientContact->address) ?  $patient->patientContact->address . ', ' : ''}}
                 {{ getCityName($patient->patientContact->city) }}</p>
              @endif
            </div>
            <div class="col-md-7">
              @if($healthcareData)
              <h2 style="height:35px;">
                  @if(getModuleStatus('reminders') == 1)
                  <a class="ajax-link btn btn-social bg-blue btn-sm" href="{{ url('reminders/add', [$patient->patient_id]) }}">
                    <i class="glyphicon glyphicon-bell"></i> Create Appointment
                  </a>
                  @endif
                  @if(getModuleStatus('referrals') == 1)
                  <a class="ajax-link btn btn-social bg-blue btn-sm" href="{{ url('referrals/add', [$healthcareData->healthcareservice_id]) }}">
                    <i class="glyphicon glyphicon-send"></i> Create Referral
                  </a>
                  @endif
                  @if(!empty($disposition_record))
                  <a class="ajax-link btn btn-social bg-blue btn-sm" href="#" data-toggle="modal" data-target="#createAddendum">
                    <i class="glyphicon glyphicon-file"></i> Addendum
                  </a>
                  @endif
              </h2>
              <!-- add by RJBS -->
              <p>&nbsp;</p>
              <!-- end RJBS -->
              <h5>Attending Physician: {{ getUserFullNameByFacilityUserID($healthcareData->seen_by) }}</h5>
              <h5>Facility:  {{ getFacilityByFacilityUserID($healthcareData->seen_by, 'facility_name') }}</h5>

              @endif
            </div>
          </div>

        </div>

        <div class="box-body no-padding">
          <!-- Main content -->
            <div class="">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php //dd($tabs); ?>
                  @if (isset($tabs_child))
                    @foreach ($tabs_child as $key => $val)
                       <li class="{{($default_tabs == $val) ? 'active' : ''}}"><a href="#{{$val}}" data-toggle="tab">{{$tabs[$val]}}</a></li>
                     @endforeach
                  @else
                      <li class="active"><a href="#{{$default_tabs}}" data-toggle="tab">{{$tabs[$default_tabs]}}</a></li>

                  @endif
                </ul>
                <div class="tab-content">
                  @if (isset($tabs_child))
                    @foreach ($tabs_child as $key => $val)
                      <div class="tab-pane {{($default_tabs == $val) ? 'active' : ''}}" id="{{$val}}">

                        @if(strpos($val, '_plugin') > 0)
                          <?php 
                            View::addNamespace('pluginform', plugins_path().$plugin); 
                            echo View::make('pluginform::'.$plugin, array('data'=>$plugindata))->render();
                          ?>
                        @else
                            @include('pedia::healthcareservices.forms.' . $val)
                        @endif
                      </div><!-- /.tab-pane -->
                     @endforeach
                  @else
                     <div class="tab-pane active" id="{{$default_tabs}}">
                        @include('pedia::healthservices.forms.' . $default_tabs)
                      </div><!-- /.tab-pane -->

                  @endif
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
        </div>
        <div class="box-footer">
        </div>
    </div>

    <!-- <div class="box box-primary">Widgets</div>
    </div> -->

  </div><!-- /.row -->
@stop

@section('scripts')
    {!! HTML::script('public/dist/js/pages/healthcareservices/healthcare.js') !!}
    <script type="text/javascript">
        var patient_id = "{{$patient->patient_id}}";

        $( document ).ready(function() {
            var service_type = $('#healthcare_services').val();
            if(service_type == 'general_consultation') {
                $("#medicalcategory").removeClass('hidden');
                $("#consultation_type").removeClass('hidden');
            }
        });

        <?php if (Session::has('flash_tab')) { ?>
            var tab = '{{Session::get('flash_tab') }}';
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        <?php } ?>

    </script>
@stop
