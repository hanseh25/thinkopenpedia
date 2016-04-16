
{!! Form::open(array('route' => 'pedia.healthcare.insert')) !!}

{!! Form::hidden('patient_id', $patient->patient_id) !!}
{!! Form::hidden('hservices_id', $healthcareserviceid) !!}
{!! Form::hidden('follow_healthcareserviceid', $follow_healthcareserviceid) !!}

<?php
if(empty($disposition_record)) { $read = NULL; }
else { $read = 'disabled'; }

if(!$healthcareData):
    $disabled = "";
else:
    $disabled = "";
endif;
?>

<div class="tab-pane" id="tab_1">
    <legend>{{ $formTitle }} @if($follow_healthcareserviceid) <a href="{{ url( $follow_healthcareserviceid ) }}">{{ $recent_healthcare->encounter_datetime->format('M. d, Y') }}</a>@endif </legend>
    <fieldset {{ $disabled }}>
        <div class="col-sm-12">
            <label class="col-sm-2 control-label">Encounter Date &amp; Time</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <i class="fa fa-calendar inner-icon"></i>
                    {!! Form::text('e-date', (empty($healthcareData) ? getCurrentDate('m/d/Y') : date('m/d/Y', strtotime($healthcareData->encounter_datetime))), ['class' => 'form-control', 'id'=>'datepicker', $read]); !!}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <div class="iconed-input bootstrap-timepicker">
                    <i class="fa fa-clock-o inner-icon"></i>
                    <?php
                        if(empty($healthcareData)) {
                            $time = getCurrentDate('h:i A');
                        } else {
                            $time = date('h:i A', strtotime($healthcareData->encounter_datetime));
                        }
                    ?>
                    {!! Form::text('e-time', $time, ['class' => 'form-control', 'id'=>'timepicker', $read]); !!}
                    </div>
                </div>
            </div>
            <label class="col-md-2 control-label"> Consultation Service</label>
            <div class="col-md-4">
                <?php $hidden = "hidden"; //hide medical category first ?>
                @if (!$healthcareData)
                    {!! Form::select('healthcare_services', $healthcareservices, '',
                        ['class' => 'required form-control ui-wizard-content valid', 'id'=> 'healthcare_services', 'required'=>'required']) !!}
                @else
                    <?php
                        $hidden = ""; //show medical category
                    ?>
                    {!! Form::hidden('healthcare_services', $healthcareData->healthcareservicetype_id) !!}
                    @foreach($healthcareservices as $keyS => $valueS)
                        @if($healthcareData->healthcareservicetype_id == $keyS)
                            <?php $serviceTitle = $valueS; ?>
                        @endif
                    @endforeach
                    {!! Form::text(NULL, $serviceTitle, ['class' => 'form-control', 'readonly'=>'readonly']); !!}

                @endif

            </div>
        </div>
    </fieldset>
    <fieldset {{ $disabled }}>
        <div class="col-sm-12">
            <div id="consultation_type">
                <label class="col-md-2 control-label">Consultation Type</label>
                <div class="col-md-6">
                    <div class="btn-group toggler" data-toggle="buttons">
                        @if($healthcareType!='FOLLO')
                        <label id="consuTypeNewAdmit" class="btn btn-default required @if($healthcareType=='ADMIN') active @endif {{$read}}">
                            <i class="fa fa-check"></i> {!! Form::radio('consultationtype_id', 'ADMIN', ''); !!} New Admission
                        </label>
                        <label id="consuTypeNewConsu" class="btn btn-default required @if($healthcareType=='CONSU') active @endif {{$read}}">
                            <?php
                                $cchk = "";
                                if($healthcareType=='CONSU') $cchk = "checked";
                            ?>
                            <i class="fa fa-check"></i> {!! Form::radio('consultationtype_id', 'CONSU', $cchk); !!} New Consultation
                        </label>
                        @endif

                        @if($healthcareType=='FOLLO')
                        <label id="consuTypeFollow" class="btn btn-default required @if($healthcareType=='FOLLO') active @endif {{$read}}">
                            <i class="fa fa-check"></i> {!! Form::radio('consultationtype_id', 'FOLLO', ''); !!} Follow-up
                        </label>
                        @endif
                    </div>
                </div>
                <label class="col-md-1 control-label">Encounter Type</label>
                <div class="col-md-3">
                    <div class="btn-group toggler" data-toggle="buttons">
                        <label id="inPatient" class="btn btn-default disabled @if(!empty($healthcareData)) @if($healthcareData->encounter_type=='I') active @endif @endif {{$read}}">
                            <i class="fa fa-check"></i> {!! Form::radio('encounter_type', 'I', '') !!} In Patient
                        </label>
                        <label id="outPatient" class="btn btn-default disabled @if(!empty($healthcareData)) @if($healthcareData->encounter_type=='O') active @endif @else @if($healthcareType=='CONSU') active @endif @endif {{$read}}">
                            <?php
                                $chk = "";
                                if($healthcareType=='CONSU') $chk = "checked";
                            ?>
                            <i class="fa fa-check"></i> {!! Form::radio('encounter_type', 'O', $chk) !!} Out Patient
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    @if(!isset($nocategory))
    <fieldset {{ $disabled }}>
        <div class="col-sm-12">
            <div id="medicalcategory" class="{{ $hidden }}">
                <label class="col-md-2 control-label">Medical Category</label>
                <div class="col-md-4">
                    @if (!$healthcareData)
                        {!! Form::select('medical_category', $medicalCategory->lists('medicalcategory_name', 'medicalcategory_id'), '', ['class' => 'form-control', $read]) !!}
                    @else
                        {!! Form::hidden('medical_category', $generalConsultation->medicalcategory_id) !!}
                        @foreach($medicalCategory as $keyC => $valueC)
                            @if($generalConsultation->medicalcategory_id == $valueC->medicalcategory_id)
                                <?php $categoryTitle = $valueC->medicalcategory_name; ?>
                            @endif
                        @endforeach
                        {!! Form::text(NULL, $categoryTitle, ['class' => 'form-control', 'readonly'=>'readonly']); !!}
                    @endif
                </div>
            </div>

            <!--
            <label class="col-md-2 control-label"> Pediatric Category </label>
            <div class="col-md-4">
                <select id="pediatrics" name="medical_category" class="required form-control">
                    <option selected="selected" value="">Select one</option>
                    <option value="GC_PEDIA_ALLERGOLOGY">Pediatric Allergology</option>
                    <option value="GC_PEDIA_CARDIOLOGY">Pediatric Cardiology</option>
                    <option value="GC_PEDIA_ENDOCRINOLOGY">Pediatric Endocrinology</option>
                    <option value="GC_PEDIA_GASTROENTEROLOGY">Pediatric Gastroenterology</option>
                    <option value="GC_PEDIA_HAEMATOLOGY">Pediatric Haematology</option>
                    <option value="GC_PEDIA_INF_DISEASE">Pediatric Infectious Diseases</option>
                    <option value="GC_PEDIA_NEPHROLOGY">Pediatric Nephrology</option>
                    <option value="GC_PEDIA_ONCOLOGY">Pediatric Oncology</option>
                    <option value="GC_PEDIA_SURGERY">Pediatric Surgery</option>
                    <option value="GC_PEDIA">General Pediatrics</option>
                </select>
            </div> -->
        </div>
    </fieldset>
    @endif

</div><!-- /.tab-pane -->

<fieldset>
    <div class="form-group">
        <div class="col-md-12">
            <div class="row">
                @if (!$follow_healthcareserviceid)
                    @if(!$healthcareData)
                    <button type="submit" class="btn btn-primary pull-right">Add</button>
                    @else
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                    @endif
                @else
                    <button type="submit" class="btn btn-primary pull-right">Follow Up</button>
                @endif
            </div>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
