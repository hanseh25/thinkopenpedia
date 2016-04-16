{!! Form::open(array('route' => 'medorder.insert', 'class'=>'form-horizontal')) !!}
{!! Form::hidden('hservices_id', $healthcareserviceid) !!}
<?php
    $medorder = 0;
    $withprescription = 0;
    $withlaboratory = 0;
?>
<?php

if(empty($disposition_record)) { $read = NULL; }
else { $read = 'disabled'; }
?>

<fieldset>
<legend>
    <span  class="col-md-5">Medical Orders</span>
    @if(empty($disposition_record))
    <span class="col-md-3 pull-right">{!! Form::select(NULL,
                            array(
                                '' => '-- Add a new order --',
                                'MO_MED_PRESCRIPTION' => 'Give Medical Prescription',
                                'MO_LAB_TEST' => 'Laboratory Exam',
                                'MO_PROCEDURE' => 'Medical Procedure',
                                'MO_OTHERS' => 'Others'
                            ), NULL,
    ['class' => 'form-control medorders', 'id'=> 'medorders', $read]) !!}</span>
    <span class="col-md-2 pull-right">Choose here ></span>
    @endif
    <?php /* //'MO_IMMUNIZATION' => 'Immunization', */?>
</legend>
@if($patientalert_record->count() > 0)
<div class="form-group">
    <p class='lead col-md-2 text-right'>Patient Alerts</p>
    <div class="col-md-10">
        <select class="form-control select2" multiple="multiple" data-placeholder="Allergies" style="width:100%;">
          @foreach($patientalert_record as $alertKey => $alertValue)
                @foreach($alertValue->PatientAllergies as $allegyKey => $allergyValue)
                <option selected="selected">
                    {{ $allergyValue->allergy_id }}: {{ $allergyValue->allergyreaction_name }}, {{ $allergyValue->allergy_severity }}
                </option>
               @endforeach
          @endforeach
        </select>
    </div>
    <br clear="all" />
    <legend> </legend>
</div>
@endif

@if(!empty($medicalorder_record))
    @foreach ($medicalorder_record as $key => $value)
        <div id="medorder{{ $key }}" class="dynamic-content">
            <div>
                <?php $hidden = "hidden"; ?>

                {!! Form::hidden("update[type][]", $value->medicalorder_type) !!}
                {!! Form::hidden("update[medicalorder_id][]", $value->medicalorder_id) !!}

                <!--DYNAMIC FORM GROUP-->
                <div class="form-group dynamic-row">
                    <label class="col-md-2 control-label">Medical Management &amp; Orders</label>
                    <div class="col-md-8 medical_order_form">
                        <!--Prescription-->
                            @if($value->medical_order_prescription)
                                <?php $withprescription = 1; ?>
                                @foreach ($value->medical_order_prescription as $pres_key => $pres_value)
                                    {!! Form::hidden("update[MO_MED_PRESCRIPTION][medicalorderprescription_id][$key]", $pres_value->medicalorderprescription_id, ['class'=>'form-control']) !!}
                                    <div class="form-group dynamic-row form-add MO_MED_PRESCRIPTION">

                                        <legend style='font-size: 18px;'>Prescription</legend>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Generic Name</label>
                                            <div class="col-md-8">
                                                {!! Form::text("update[MO_MED_PRESCRIPTION][Drug_Code][$key]", $pres_value->generic_name, ['class' => 'form-control drug_input', 'placeholder'=> 'Generic name', 'id'=>'drug_input', $read]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <label class="col-md-3 control-label">Brand Name</label>
                                            <div class="col-md-8">
                                                {!! Form::text("update[MO_MED_PRESCRIPTION][Drug_Brand_Name][$key]", $pres_value->brand_name, ['class' => 'form-control', 'placeholder'=> 'Brand name', $read]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group dynamic-row">
                                            <?php $Dose_Qty = explode(" ", $pres_value->dose_quantity); ?>
                                            <label class="col-md-3 control-label">Dose Quantity</label>
                                            <div class="col-md-5">

                                                {!! Form::number("update[MO_MED_PRESCRIPTION][Dose_Qty][$key]", $Dose_Qty[0], ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Dosage', $read]) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::select("update[MO_MED_PRESCRIPTION][Dose_UOM][$key]",
                                                    array('' => 'Choose',
                                                        'mg' => 'mg',
                                                        'ml' => 'ml',
                                                        'drops' => 'drops'), $Dose_Qty[1],
                                                 ['class' => 'form-control forreq', $read]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <?php $Total_Quantity = explode(" ", $pres_value->total_quantity); ?>
                                            <label class="col-md-3 control-label">Total Quantity</label>
                                            <div class="col-md-5">
                                                {!! Form::number("update[MO_MED_PRESCRIPTION][Total_Quantity][$key]", $Total_Quantity[0], ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Quantity', $read]) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::select("update[MO_MED_PRESCRIPTION][Total_Quantity_UOM][$key]",
                                                    array('' => 'Choose',
                                                        'Tablets' => 'Tablets',
                                                        'Capsules' => 'Capsules',
                                                        'Bottles' => 'Bottles',
                                                        'Others' => 'Others'), $Total_Quantity[1],
                                                 ['class' => 'form-control forreq', $read]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <label class="col-md-3 control-label">Dosage Regimen </label>
                                            <div class="col-md-8">
                                                {!! Form::select("update[MO_MED_PRESCRIPTION][dosage][$key]",
                                                    array('' => 'Choose',
                                                        'OD' => 'Once a day',
                                                        'BID' => '2 x a day - Every 12 hours',
                                                        'TID' => '3 x a day - Every 8 hours',
                                                        'QID' => '4 x a day - Every 6 hours',
                                                        'QOD' => 'Every other day',
                                                        'QHS' => 'Every bedtime',
                                                        'OTH' => 'Others'), $pres_value->dosage_regimen,
                                                 ['class' => 'forother form-control forreq', 'id'=>'regimenothers0', $read]) !!}
                                                 <!-- 'onchange'=>'if(this.value == 'OTH') show(event.target.id);' -->
                                            </div>
                                        </div>

                                        <div id='forregimenothers0' class="form-group dynamic-row regimenothers hidden">
                                            <div >
                                                <label class="col-md-3 control-label">Specify</label>
                                                <div class="col-md-8">
                                                    {!! Form::textarea("update[MO_MED_PRESCRIPTION][Specify][$key]", $pres_value->dosage_regimen_others, ['class' => 'form-control noresize', 'placeholder' => 'Specify others', 'rows'=>'3', $read]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <?php $Duration_Intake = explode(" ", $pres_value->duration_of_intake); ?>
                                            <label class="col-md-3 control-label">Intake Frequency</label>
                                            <div class="col-md-5">
                                                {!! Form::number("update[MO_MED_PRESCRIPTION][Duration_Intake][$key]", $Duration_Intake[0], ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Frequency', $read]) !!}
                                            </div>

                                            <div class="col-md-3">
                                                {!! Form::select("update[MO_MED_PRESCRIPTION][Duration_Intake_Freq][$key]",
                                                    array('' => 'Choose',
                                                        'D' => 'Daily',
                                                        'M' => 'Monthly',
                                                        'Q' => 'Quarterly',
                                                        'W' => 'Weekly',
                                                        'Y' => 'Yearly',
                                                        'O' => 'Others'), $Duration_Intake[1],
                                                 ['class' => 'form-control forreq', $read]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <label class="col-md-3 control-label">Regimen Start &amp; End Date</label>
                                            <div class="col-md-8 has-feedback">
                                                <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>

                                                  {!! Form::text("update[MO_MED_PRESCRIPTION][regimen_startend_date][$key]", date('m/d/Y', strtotime($pres_value->regimen_startdate)) .' - '. date('m/d/Y', strtotime($pres_value->regimen_enddate)), ['class' => 'form-control pull-right', 'id'=>'daterangepicker', $read]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group dynamic-row">
                                            <label class="col-md-3 control-label">Prescription Remarks</label>
                                            <div class="col-md-8">
                                                {!! Form::textarea("update[MO_MED_PRESCRIPTION][Remarks][$key]", $pres_value->prescription_remarks, ['class' => 'form-control noresize', 'placeholder' => 'Remarks', 'rows'=>'3', $read]) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        <!--/Prescription-->
                        <!--Laboratory-->
                            @if($value->medical_order_lab_exam)
                                <?php $withlaboratory = 1; ?>
                                @foreach ($value->medical_order_lab_exam as $lab_key => $lab_value)
                                    <?php $selectedlabs = explode(",",$lab_value->laboratory_test_type); ?>
                                    <div class="form-group dynamic-row form-add MO_LAB_TEST">
                                        {!! Form::hidden("update[MO_LAB_TEST][medicalorderlaboratoryexam_id][$key]", $lab_value->medicalorderlaboratoryexam_id, ['class'=>'form-control']) !!}
                                        <legend style='font-size: 18px;'>Laboratory Test</legend>

                                        <div class="icheck row">
                                            <div class="col-md-12">
                                            <h4>Selected laboratory exams:</h4>
                                            </div>
                                            @foreach($lovlaboratories as $labs)
                                                <div class="col-md-4 checkbox">
                                                    <label>
                                                      <?php $selectd = ""; ?>
                                                      @foreach($selectedlabs as $sellabs)
                                                        @if($sellabs == $labs->laboratorycode)
                                                            <?php $selectd = "checked='checked'"; ?>
                                                        @endif
                                                      @endforeach
                                                      <input type="checkbox" name="update[MO_LAB_TEST][Examination_Code][]" value="{{ $labs->laboratorycode }}" {{ $selectd }} class="form-control" {{ $read }} /> {{ $labs->laboratorydescription }}

                                                    </label>
                                                  </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group dynamic-row hidden">
                                            <label class="col-md-3 control-label">Specify Others</label>
                                            <div class="col-md-8">

                                                {!! Form::textarea("update[MO_LAB_TEST][others][$key]", $lab_value->laboratory_test_type_others, ['class' => 'form-control noresize', 'placeholder' => 'Remarks', 'rows'=>'3', $read]) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        <!--/Laboratory-->
                        <!--Medical Procedure-->
                            @if($value->medical_order_procedure)
                                @foreach ($value->medical_order_procedure as $proc_key => $proc_value)
                                    <div class="form-group dynamic-row form-add MO_PROCEDURE">
                                        {!! Form::hidden("update[MO_PROCEDURE][medicalorderprocedure_id][$key]", $proc_value->medicalorderprocedure_id, ['class'=>'form-control']) !!}

                                        <legend>Medical Procedure</legend>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Procedure Order</label>
                                            <div class="col-md-8">
                                                {!! Form::textarea("update[MO_PROCEDURE][Procedure_Order][$key]", $proc_value->procedure_order, ['class' => 'form-control noresize', 'placeholder' => 'Procedure Instructions', 'rows'=>'3', $read]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Date of Procedure</label>
                                            <div class="col-md-8 has-feedback">
                                                <div class="input-group">
                                                  <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                  </div>
                                                  {!! Form::text("update[MO_PROCEDURE][Date_of_Procedure][$key]", date('m/d/Y', strtotime($proc_value->procedure_date)), ['class' => 'form-control', 'id'=>'datepicker', $read]); !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        <!--/Medical Procedure-->
                        <!--Others-->
                            @if($value->medicalorder_others)
                                @if($value->medicalorder_type == 'MO_OTHERS')
                                    <div class="form-group dynamic-row form-add MO_OTHERS">
                                        <legend style='font-size: 18px;'>Other</legend>
                                        {!! Form::textarea("update[MO_OTHERS][order_type_others][$key]", $value->medicalorder_others, ['class' => 'form-control noresize', 'placeholder' => 'Specify others', 'rows'=>'3', $read]) !!}
                                    </div>
                                @endif
                            @endif
                        <!--/Others-->

                    </div>
                    <div class="col-md-2">
                        <?php
                            $hid = "hidden";
                            if($key > 0) {
                                $hid = "";
                            }
                        ?>
                        <button id="rmvbtn{{ $key }}" type="button" class="btn btn-danger {{ $hid }} rmvbtn"><i class="fa fa-times"></i> Remove</button>
                    </div>
                </div><!--/END DYNAMIC FORM GROUP-->

                <div class="form-group dynamic-row">
                    <label class="col-md-2 control-label">Doctor's Instructions</label>
                    <div class="col-md-8">
                        @if($key >= 0)
                            {!! Form::textarea("update[instructions][]", $value->user_instructions, ['class' => 'form-control noresize instructions', 'placeholder' => "Doctor's instructions for this medical order", 'rows'=>'3', 'style' => 'margin: 0px; width: 100%; height: 112px;', $read]) !!}
                        @endif
                    </div>
                </div>
                <legend> </legend>
            </div>
        </div>
    @endforeach
    <?php $medorder = 1;
    $isnew = 'hidden'; ?>
@else
    <?php $isnew = ''; ?>
@endif
    <!-- basic medical order form for new inserts initially hidden -->
    <div class="dynamic-content hidden">
        <div>
            {!! Form::hidden("insert[type][]", null) !!}
            {!! Form::hidden("insert[medicalorder_id][]", null) !!}

            <!--DYNAMIC FORM GROUP-->
            <div class="form-group dynamic-row">
                <label class="col-md-2 control-label">Medical Management &amp; Orders</label>
                <div class="col-md-8 medical_order_form">
                    <!--Prescription-->
                        <div class="form-group dynamic-row form-add MO_MED_PRESCRIPTION hidden" >

                                <legend style='font-size: 18px;'>Prescription</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Generic Name</label>
                                    <div class="col-md-8">
                                        {!! Form::text('insert[MO_MED_PRESCRIPTION][Drug_Code][]', null, ['class' => 'form-control drug_input', 'placeholder'=> 'Generic name', 'id'=>'drug_input', $read]) !!}
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Brand Name</label>
                                    <div class="col-md-8">
                                        {!! Form::text('insert[MO_MED_PRESCRIPTION][Drug_Brand_Name][]', null, ['class' => 'form-control', 'placeholder'=> 'Brand name', $read]) !!}
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Dose Quantity</label>
                                    <div class="col-md-5">
                                        {!! Form::number('insert[MO_MED_PRESCRIPTION][Dose_Qty][]', null, ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Dosage', $read]) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::select('insert[MO_MED_PRESCRIPTION][Dose_UOM][]',
                                            array('' => 'Choose',
                                                'mg' => 'mg',
                                                'ml' => 'ml',
                                                'drops' => 'drops'), '',
                                         ['class' => 'form-control forreq', $read]) !!}
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Total Quantity</label>
                                    <div class="col-md-5">
                                        {!! Form::number('insert[MO_MED_PRESCRIPTION][Total_Quantity][]', null, ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Quantity', $read]) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::select('insert[MO_MED_PRESCRIPTION][Total_Quantity_UOM][]',
                                            array('' => 'Choose',
                                                'Tablets' => 'Tablets',
                                                'Capsules' => 'Capsules',
                                                'Bottles' => 'Bottles',
                                                'Others' => 'Others'), '',
                                         ['class' => 'form-control forreq', $read]) !!}
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Dosage Regimen </label>
                                    <div class="col-md-8">
                                        {!! Form::select('insert[MO_MED_PRESCRIPTION][dosage][]',
                                            array('' => 'Choose',
                                                'OD' => 'Once a day',
                                                'BID' => '2 x a day - Every 12 hours',
                                                'TID' => '3 x a day - Every 8 hours',
                                                'QID' => '4 x a day - Every 6 hours',
                                                'QOD' => 'Every other day',
                                                'QHS' => 'Every bedtime',
                                                'OTH' => 'Others'), '',
                                         ['class' => 'forother form-control forreq', 'id'=>'regimenothers0', $read]) !!}
                                    </div>
                                </div>

                                <div id='forregimenothers0' class="form-group dynamic-row regimenothers hidden">
                                    <div >
                                        <label class="col-md-3 control-label">Specify</label>
                                        <div class="col-md-8">
                                            {!! Form::textarea('insert[MO_MED_PRESCRIPTION][Specify][]', null, ['class' => 'form-control noresize', 'placeholder' => 'Specify others', 'rows'=>'3', $read]) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Intake Frequency</label>
                                    <div class="col-md-5">
                                        {!! Form::number('insert[MO_MED_PRESCRIPTION][Duration_Intake][]', null, ['class' => 'form-control nonzero forreq', 'placeholder'=> 'Frequency', $read]) !!}
                                    </div>

                                    <div class="col-md-3">
                                        {!! Form::select('insert[MO_MED_PRESCRIPTION][Duration_Intake_Freq][]',
                                            array('' => 'Choose',
                                                'D' => 'Daily',
                                                'M' => 'Monthly',
                                                'Q' => 'Quarterly',
                                                'W' => 'Weekly',
                                                'Y' => 'Yearly',
                                                'O' => 'Others'), '',
                                         ['class' => 'form-control forreq', $read]) !!}
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Regimen Start &amp; End Date</label>
                                    <div class="col-md-8 has-feedback">
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                                          {!! Form::text('insert[MO_MED_PRESCRIPTION][regimen_startend_date][]', null, ['class' => 'form-control pull-right', 'id'=>'daterangepicker', $read]); !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group dynamic-row">
                                    <label class="col-md-3 control-label">Prescription Remarks</label>
                                    <div class="col-md-8">
                                        {!! Form::textarea('insert[MO_MED_PRESCRIPTION][Remarks][]', null, ['class' => 'form-control noresize', 'placeholder' => 'Remarks', 'rows'=>'3', $read]) !!}
                                    </div>
                                </div>

                            </div>
                    <!--/Prescription-->
                    <!--Laboratory-->
                        <div class="form-group dynamic-row form-add MO_LAB_TEST hidden" >
                                {!! Form::hidden("insert[MO_LAB_TEST][medicalorderlaboratoryexam_id][]", null) !!}
                                <legend style='font-size: 18px;'>Laboratory Test</legend>
                                <div class="icheck row">
                                    <div class="col-md-12">
                                    <h4>Choose all the laboratory exams you require.</h4>
                                    </div>
                                    @foreach($lovlaboratories as $labs)
                                        <div class="col-md-4 checkbox">
                                            <label>
                                              <input type="checkbox" name="insert[MO_LAB_TEST][Examination_Code][]" value="{{ $labs->laboratorycode }}" class="form-control" {{ $read }} /> {{ $labs->laboratorydescription }}
                                            </label>
                                          </div>
                                    @endforeach
                                </div>
                                <div class="form-group dynamic-row hidden">
                                    <label class="col-md-3 control-label">Specify Others</label>
                                    <div class="col-md-8">
                                        {!! Form::textarea('insert[MO_LAB_TEST][others][]', null, ['class' => 'form-control noresize', 'placeholder' => 'Remarks', 'rows'=>'5', $read]) !!}
                                    </div>
                                </div>
                            </div>
                    <!--/Laboratory-->
                    <!--Medical Procedure-->
                        <div class="form-group dynamic-row form-add MO_PROCEDURE hidden" >
                            <legend>Medical Procedure</legend>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Procedure Order</label>
                                <div class="col-md-8">
                                    {!! Form::textarea('insert[MO_PROCEDURE][Procedure_Order][]', '', ['class' => 'form-control noresize', 'placeholder' => 'Procedure Instructions', 'rows'=>'3', $read]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Procedure</label>
                                <div class="col-md-8 has-feedback">
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      {!! Form::text('insert[MO_PROCEDURE][Date_of_Procedure][]', '', ['class' => 'form-control', 'id'=>'datepicker', $read]); !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--/Medical Procedure-->
                    <!--Others-->
                        <div class="form-group dynamic-row form-add MO_OTHERS hidden" >
                                <legend style='font-size: 18px;'>Other</legend>
                                {!! Form::textarea('insert[MO_OTHERS][order_type_others][]', null, ['class' => 'form-control noresize', 'placeholder' => 'Specify others', 'rows'=>'3', $read]) !!}
                            </div>
                    <!--/Others-->

                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger hidden rmvbtn"><i class="fa fa-times"></i> Remove</button>
                </div>
            </div><!--/END DYNAMIC FORM GROUP-->

            <div class="form-group dynamic-row">
                <label class="col-md-2 control-label">Doctor's Instructions</label>
                <div class="col-md-8">
                    {!! Form::textarea("insert[instructions][]", null, ['class' => 'form-control noresize instructions', 'placeholder' => "Doctor's instructions for this medical order", 'rows'=>'3', 'style' => 'margin: 0px; width: 100%; height: 112px;', $read]) !!}
                </div>
            </div>
            <legend> </legend>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if($withprescription == 1)
                <a class="btn btn-success" href="{{ url('healthcareservices/medorder/print/prescription/'.$healthcareserviceid) }}" target="_blank">Print Prescription</a>
            @endif
            @if($withlaboratory == 1)
                <a class="btn btn-success" href="{{ url('healthcareservices/medorder/print/laboratory/'.$healthcareserviceid) }}" target="_blank">Print Lab Order</a>
            @endif
        </div>
        <div class="col-md-6">
            @if(empty($disposition_record))
            <button type="submit" class="btn btn-primary pull-right">Save Medical Orders</button>
            @endif
        </div>
    </div>


</fieldset>
{!! Form::close() !!}


@section('linked_scripts')

<!--Put page related scripts here-->
<script type="text/javascript">
$(".select2").select2({
    'disabled': 'disabled'
});
</script>

@stop
