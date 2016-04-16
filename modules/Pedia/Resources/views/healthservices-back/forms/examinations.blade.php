@if (isset($examination_record))
    {!! Form::model($examination_record, array('route' => 'exam.edit')) !!}
@else
    {!! Form::open(array('route' => 'exam.insert')) !!}
@endif
{!! Form::hidden('examination_id', null) !!}
{!! Form::hidden('healthcareservice_id', $healthcareserviceid) !!}

<?php
if(empty($disposition_record)) { $read = ''; }
else { $read = 'disabled'; }
?>
<div class="icheck">
    <fieldset {{$disabled}}>
        <legend>Skin</legend>
        <div class="col-sm-12">
            <dl class="col-sm-3">
                <dt> Pallor </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Pallor]", 1, (isset($examination_record) ? (($examination_record->Pallor==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Pallor]", 0, (isset($examination_record) ? (($examination_record->Pallor==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Rashes </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Rashes]", 1, (isset($examination_record) ? (($examination_record->Rashes==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Rashes]", 0, (isset($examination_record) ? (($examination_record->Rashes==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Jaundice </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Jaundice]", 1, (isset($examination_record) ? (($examination_record->Jaundice==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Jaundice]", 0, (isset($examination_record) ? (($examination_record->Jaundice==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Good Skin Turgor </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Good_Skin_Turgor]", 1, (isset($examination_record) ? (($examination_record->Good_Skin_Turgor==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Good_Skin_Turgor]", 0, (isset($examination_record) ? (($examination_record->Good_Skin_Turgor==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>


            <dl class="col-sm-3">
                <dt> Others </dt>
                <dd>
                    {!! Form::text("anatomy[skin_others]", (isset($examination_record) ? (($examination_record->skin_others) ? $examination_record->skin_others : null) : null), ['class' => 'form-control alpha cotrol-box input-sm', $read]) !!}
                </dd>
            </dl>
        </div>
    </fieldset>
    <fieldset {{$disabled}}>
        <legend>HEENT</legend>
        <div class="col-sm-12">
            <dl class="col-sm-3">
                <dt> Anicteric Sclerae </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Anicteric_Sclerae]", 1, (isset($examination_record) ? (($examination_record->Anicteric_Sclerae==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Anicteric_Sclerae]", 0, (isset($examination_record) ? (($examination_record->Anicteric_Sclerae==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Pupils </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Pupils]", 1, (isset($examination_record) ? (($examination_record->Pupils==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Pupils]", 0, (isset($examination_record) ? (($examination_record->Pupils==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Aural Discharge </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Aural_Discharge]", 1, (isset($examination_record) ? (($examination_record->Aural_Discharge==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Aural_Discharge]", 0, (isset($examination_record) ? (($examination_record->Aural_Discharge==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Intact Tympanic Membrane </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Intact_Tympanic_Membrane]", 1, (isset($examination_record) ? (($examination_record->Intact_Tympanic_Membrane==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Intact_Tympanic_Membrane]", 0, (isset($examination_record) ? (($examination_record->Intact_Tympanic_Membrane==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <!--<dl class="col-sm-3">
                <dt> Alar Flaring </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                          <input type="radio" name="anatomy[AlarFlaring]" id="" value="1" checked=""> Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                          <input type="radio" name="anatomy[AlarFlaring]" id="" value="0" checked=""> No
                        </label>
                    </div>
                </dd>
            </dl>-->
            <dl class="col-sm-3">
                <dt> Nasal Discharge </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Nasal_Discharge]", 1, (isset($examination_record) ? (($examination_record->Nasal_Discharge==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Nasal_Discharge]", 0, (isset($examination_record) ? (($examination_record->Nasal_Discharge==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Tonsillopharyngeal Congestion </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Tonsillopharyngeal_Congestion]", 1, (isset($examination_record) ? (($examination_record->Tonsillopharyngeal_Congestion==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Tonsillopharyngeal_Congestion]", 0, (isset($examination_record) ? (($examination_record->Tonsillopharyngeal_Congestion==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Hypertrophic Tonsils </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Hypertrophic_Tonsils]", 1, (isset($examination_record) ? (($examination_record->Hypertrophic_Tonsils==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Hypertrophic_Tonsils]", 0, (isset($examination_record) ? (($examination_record->Hypertrophic_Tonsils==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Palpable Mass </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Palpable_Mass_B]", 1, (isset($examination_record) ? (($examination_record->Palpable_Mass_B==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Palpable_Mass_B]", 0, (isset($examination_record) ? (($examination_record->Palpable_Mass_B==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Exudates </dt>
                <dd>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Exudates]", 1, (isset($examination_record) ? (($examination_record->Exudates==1) ? true : '') : true), [$read]); !!} Yes
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio("anatomy[Exudates]", 0, (isset($examination_record) ? (($examination_record->Exudates==0) ? true : '') : true), [$read]); !!} No
                        </label>
                    </div>
                </dd>
            </dl>
            <dl class="col-sm-3">
                <dt> Others </dt>
                <dd>
                    {!! Form::text("anatomy[heent_others]", (isset($examination_record) ? (($examination_record->heent_others) ? $examination_record->heent_others : null) : null), ['class' => 'form-control alpha cotrol-box input-sm', $read]) !!}
                </dd>
            </dl>
        </div>
    </fieldset>
    <fieldset {{$disabled}}>
        <legend>Chest/Lungs</legend>
            <div class="col-sm-12">
                <dl class="col-sm-3">
                    <dt> Symmetrical Chest Expansion </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Symmetrical_Chest_Expansion]", 1, (isset($examination_record) ? (($examination_record->Symmetrical_Chest_Expansion==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Symmetrical_Chest_Expansion]", 0, (isset($examination_record) ? (($examination_record->Symmetrical_Chest_Expansion==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Clear Breathsounds </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Clear_Breathsounds]", 1, (isset($examination_record) ? (($examination_record->Clear_Breathsounds==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Clear_Breathsounds]", 0, (isset($examination_record) ? (($examination_record->Clear_Breathsounds==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <!--<dl class="col-sm-3">
                    <dt> Retractions </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                              <input type="radio" name="anatomy[Retractions]" id="" value="1" checked=""> Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                              <input type="radio" name="anatomy[Retractions]" id="" value="0" checked=""> No
                            </label>
                        </div>
                    </dd>
                </dl>-->
                <dl class="col-sm-3">
                    <dt> Crackles Rales </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Crackles_Rales]", 1, (isset($examination_record) ? (($examination_record->Crackles_Rales==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Crackles_Rales]", 0, (isset($examination_record) ? (($examination_record->Crackles_Rales==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Wheezes </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Wheezes]", 1, (isset($examination_record) ? (($examination_record->Wheezes==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Wheezes]", 0, (isset($examination_record) ? (($examination_record->Wheezes==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Others </dt>
                    <dd>
                        {!! Form::text('anatomy_chest_others', (isset($examination_record) ? (($examination_record->chest_others) ? $examination_record->chest_others : null) : null), array('class' => 'control-box input-sm form-control ', 'name'=>'anatomy[chest_others]', $read) ) !!}
                  <!--       <input class="form-control cotrol-box input-sm" type="text" placeholder="" name="anatomy[chest_Others"> -->
                    </dd>
                </dl>
            </div>
    </fieldset>
    <fieldset {{$disabled}}>
        <legend>Heart</legend>
            <div class="col-sm-12">
                <dl class="col-sm-3">
                    <dt> Adynamic Precordium </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Adynamic_Precordium]", 1, (isset($examination_record) ? (($examination_record->Adynamic_Precordium==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Adynamic_Precordium]", 0, (isset($examination_record) ? (($examination_record->Adynamic_Precordium==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Rhythm </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Rhythm]", 1, (isset($examination_record) ? (($examination_record->Rhythm==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Rhythm]", 0, (isset($examination_record) ? (($examination_record->Rhythm==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Heaves </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Heaves]", 1, (isset($examination_record) ? (($examination_record->Heaves==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Heaves]", 0, (isset($examination_record) ? (($examination_record->Heaves==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Murmurs </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Murmurs]", 1, (isset($examination_record) ? (($examination_record->Murmurs==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Murmurs]", 0, (isset($examination_record) ? (($examination_record->Murmurs==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Others </dt>
                    <dd>
                        {!! Form::text('anatomy_chest_others', (isset($examination_record) ? (($examination_record->heart_others) ? $examination_record->heart_others : null) : null), array('class' => 'control-box input-sm form-control ', 'name'=>'anatomy[heart_others]', $read) ) !!}
                    </dd>
                </dl>
            </div>
    </fieldset>
    <fieldset {{$disabled}}>
        <legend>Abdomen</legend>
            <div class="col-sm-12">
                <dl class="col-sm-3">
                    <dt> Flat </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Flat]", 1, (isset($examination_record) ? (($examination_record->Flat==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Flat]", 0, (isset($examination_record) ? (($examination_record->Flat==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Globular </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Globular]", 1, (isset($examination_record) ? (($examination_record->Globular==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Globular]", 0, (isset($examination_record) ? (($examination_record->Globular==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Flabby </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Flabby]", 1, (isset($examination_record) ? (($examination_record->Flabby==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Flabby]", 0, (isset($examination_record) ? (($examination_record->Flabby==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Muscle Guarding </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Muscle_Guarding]", 1, (isset($examination_record) ? (($examination_record->Muscle_Guarding==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Muscle_Guarding]", 0, (isset($examination_record) ? (($examination_record->Muscle_Guarding==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Tenderness </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Tenderness]", 1, (isset($examination_record) ? (($examination_record->Tenderness==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Tenderness]", 0, (isset($examination_record) ? (($examination_record->Tenderness==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Palpable Mass </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Palpable_Mass_B]", 1, (isset($examination_record) ? (($examination_record->Palpable_Mass_B==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Palpable_Mass_B]", 0, (isset($examination_record) ? (($examination_record->Palpable_Mass_B==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Others </dt>
                    <dd>
                        {!! Form::text('anatomy_abdomen_others', (isset($examination_record) ? (($examination_record->abdomen_others) ? $examination_record->abdomen_others : null) : null), array('class' => 'control-box input-sm form-control ', 'name'=>'anatomy[abdomen_others]', $read) ) !!}
                    </dd>
                </dl>
            </div>
    </fieldset>
    <fieldset {{$disabled}}>
        <legend>Extremities</legend>
            <div class="col-sm-12">
                <!---<dl class="col-sm-3">
                    <dt> Gross Deformity </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                              <input type="radio" name="anatomy[Gross_Deformity]" id="" value="1" checked=""> Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                              <input type="radio" name="anatomy[Gross_Deformity]" id="" value="0" checked=""> No
                            </label>
                        </div>
                    </dd>
                </dl>-->
                <dl class="col-sm-3">
                    <dt> Normal Gait </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Normal_Gait]", 1, (isset($examination_record) ? (($examination_record->Normal_Gait==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Normal_Gait]", 0, (isset($examination_record) ? (($examination_record->Normal_Gait==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Full Equal Pulses </dt>
                    <dd>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Full_Equal_Pulses]", 1, (isset($examination_record) ? (($examination_record->Full_Equal_Pulses==1) ? true : '') : true), [$read]); !!} Yes
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                {!! Form::radio("anatomy[Full_Equal_Pulses]", 0, (isset($examination_record) ? (($examination_record->Full_Equal_Pulses==0) ? true : '') : true), [$read]); !!} No
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-3">
                    <dt> Others </dt>
                    <dd>
                        {!! Form::text('anatomy_extreme_others', (isset($examination_record) ? (($examination_record->extreme_others) ? $examination_record->extreme_others : null) : null), array('class' => 'control-box input-sm form-control ', 'name'=>'anatomy[extreme_others]', $read) ) !!}
                        <!-- <input class="form-control cotrol-box input-sm" type="text" name="anatomy[extreme_Others"> -->
                    </dd>
                </dl>
            </div>
    </fieldset>
    @if(empty($disposition_record))
    <fieldset {{$disabled}}>
        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <button type="submit" class="btn btn-primary pull-right">Save Examinations</button>
                </div>
            </div>
        </div>
    </fieldset>
    @endif
</div>
{!! Form::close() !!}
