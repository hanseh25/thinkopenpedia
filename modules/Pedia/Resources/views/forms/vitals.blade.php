@if (isset($vitals_record))
    {!! Form::model($vitals_record, array('route' => 'vitals.edit')) !!}
    <?php $vitals = $vitals_record; ?>
@else
    {!! Form::open(array('route' => 'vitals.insert')) !!}
@endif

    {!! Form::hidden('vitalphysical_id', null) !!}
    {!! Form::hidden('healthcareservice_id', $healthcareserviceid) !!}
    {!! Form::hidden('bmi', '') !!}

<?php
//dd($vitals_record);
if(empty($disposition_record)) { $read = ''; }
else { $read = 'disabled'; }
?>

    <fieldset {{ $disabled }}>
        <legend>Vital Signs</legend>
        <div class="row">
            <label class="col-sm-3 control-label">Temperature &deg;C</label>
            <label class="col-sm-3 control-label"> Blood Pressure <small> (Systolic / Diastolic) </small></label>
        </div>
        <div class="row">
          <div class="col-md-3">
            {!! Form::number('temperature', (($vitals_record) ? (($vitals->temperature) ? $vitals->temperature : '') : ''), ['class' => 'form-control required', 'step' => 'any', 'placeholder'=>'Temperature', $read, 'required'=>'required']) !!}
          </div>
          <div class="col-md-3">
            {!! Form::number('bloodpressure_systolic', (($vitals_record) ? (($vitals->bloodpressure_systolic) ? $vitals->bloodpressure_systolic : '') : ''), ['class' => 'form-control required', 'placeholder'=> 'Systolic', $read, 'required'=>'required']) !!}
          </div>
          <div class="col-md-3">
            {!! Form::number('bloodpressure_diastolic', (($vitals_record) ? (($vitals->bloodpressure_diastolic) ? $vitals->bloodpressure_diastolic : '') : ''), ['class' => 'form-control required', 'placeholder'=> 'Diastolic', $read, 'required'=>'required']) !!}
          </div>
        </div>
        <div class="row">
            <label class="col-sm-3 control-label">Heart Rate <small>(bpm)</small> </label>
            <label class="col-sm-3 control-label">Pulse Rate <small>(bpm)</small> </label>
            <label class="col-sm-3 control-label">Respiratory Rate <small>(bpm)</small> </label>
        </div>
        <div class="row">

          <div class="col-md-3">
            {!! Form::number('heart_rate', (($vitals_record) ? (($vitals->heart_rate) ? $vitals->heart_rate : '') : ''), ['class' => 'form-control', 'placeholder'=>'Heart rate', $read]) !!}
          </div>
          <div class="col-md-3">
            {!! Form::number('pulse_rate', (($vitals_record) ? (($vitals->pulse_rate) ? $vitals->pulse_rate : '') : ''), ['class' => 'form-control', 'placeholder'=>'Pulse rate', $read]) !!}
          </div>
          <div class="col-md-3">
            {!! Form::number('respiratory_rate', (($vitals_record) ? (($vitals->respiratory_rate) ? $vitals->respiratory_rate : '') : ''), ['class' => 'form-control', 'placeholder'=>'Respiratory rate', $read]) !!}
          </div>

        </div>


    </fieldset>
    <fieldset {{ $disabled }}>
        <legend>Physical</legend>
        <div class="form-group bmigroup">
            <div class="row">
                <label class="col-sm-3 control-label">Height <small>(cm)</small></label>
                <label class="col-sm-3 control-label">Weight <small>(kgs)</small></label>
                <label class="col-sm-3 control-label">Body Mass Index <small>(BMI)</small> </label>
                <label class="col-sm-3 control-label">Waist <small>(cm)</small></label>
            </div>
            <div class="row">
              <div class="col-md-3">
                {!! Form::number('height', (($vitals_record) ? (($vitals->height) ? $vitals->height : '') : ''), ['class' => 'form-control', 'placeholder'=> 'Height', 'name'=>'height', 'id'=>'height', $read]) !!}
              </div>
              <div class="col-md-3">
                {!! Form::number('weight', (($vitals_record) ? (($vitals->weight) ? $vitals->weight : '') : ''), ['class' => 'form-control', 'placeholder'=> 'Weight', 'name'=>'weight', 'id'=>'weight', $read]) !!}
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control bmiResult" name="bmiResult" placeholder="BMI" value="" readonly="">
              </div>
              <div class="col-md-3">
                {!! Form::number('waist', (($vitals_record) ? (($vitals->waist) ? $vitals->waist : '') : ''), ['class' => 'form-control', 'placeholder'=> 'Waist', $read]) !!}
              </div>
            </div>
        </div>

        @if ($gender == 'female' || $gender == 'f' || $gender == 'F')
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label">Pregnant</label>
                <label class="col-sm-3 control-label">Weight Loss</label>
                <label class="col-sm-3 control-label">With Intact Uterus</label>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="radio inline">
                    <label>
                        {!! Form::radio('Pregnant', 1, (($vitals_record) ? (($vitals->pregnant==1) ? true : '') : ''), [$read]); !!} Yes
                    </label>
                </div>
                <div class="radio inline">
                    <label>
                        {!! Form::radio('Pregnant', 0, (($vitals_record) ? (($vitals->pregnant==0) ? true : '') : true), [$read]); !!} No
                    </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="radio inline">
                    <label>
                        {!! Form::radio('WeightLoss', 1, (($vitals_record) ? (($vitals->weight_loss==1) ? true : '') : ''), [$read]); !!} Yes
                    </label>
                </div>
                <div class="radio inline">
                    <label>
                        {!! Form::radio('WeightLoss', 0, (($vitals_record) ? (($vitals->weight_loss==0) ? true : '') : true), [$read]); !!} No
                    </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="radio inline">
                    <label>
                        {!! Form::radio('WithIntactUterus', 1, (($vitals_record) ? (($vitals->with_intact_uterus==1) ? true : '') : ''), [$read]); !!} Yes
                    </label>
                </div>
                <div class="radio inline">
                    <label>
                        {!! Form::radio('WithIntactUterus', 0, (($vitals_record) ? (($vitals->with_intact_uterus==0) ? true : '') : true), [$read]); !!} No
                        {!! Form::radio('WithIntactUterus', 0, (($vitals_record) ? (($vitals->with_intact_uterus==0) ? true : '') : true), [$read]); !!} No
                    </label>
                </div>
              </div>
            </div>
        </div>
        @endif
    </fieldset>
    @if(empty($disposition_record))
    <fieldset {{ $disabled }}>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <button type="submit" class="btn btn-primary pull-right">Save Vitals</button>
                </div>
            </div>
        </div>
    </fieldset>
    @endif
{!! Form::close() !!}
