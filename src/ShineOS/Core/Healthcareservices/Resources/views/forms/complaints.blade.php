@if (isset($complaints_record))
    {!! Form::model($complaints_record, array('route' => 'complaints.edit')) !!}
@else
    {!! Form::open(array('route' => 'complaints.insert')) !!}
@endif

{!! Form::hidden('healthcareservice_id', $healthcareserviceid) !!}
{!! Form::hidden('generalconsultation_id', $complaints_record->generalconsultation_id) !!}

<?php
if(empty($disposition_record)) { $read = NULL; }
else { $read = 'disabled'; }
?>

<legend>Patient Complaints</legend>
<fieldset {{$disabled}}>
    <div class="form-group">
        <label class="col-md-2 control-label">Complaint*</label>
        <div class="col-md-10">
            {!! Form::textarea('complaint', null, ['class' => 'form-control required noresize', 'placeholder' => 'Complaint', 'cols'=>'10', 'rows'=>'5', $read, 'required'=>'required']) !!}
        </div>
    </div>
</fieldset>
<fieldset {{$disabled}}>
    <div class="form-group">
        <label class="col-md-2 control-label">Complaint History</label>
        <div class="col-md-10">
            {!! Form::textarea('complaint_history', null, ['class' => 'form-control noresize', 'placeholder' => 'Illness history', 'cols'=>'10', 'rows'=>'5', $read]) !!}
        </div>
    </div>
</fieldset>
<fieldset {{$disabled}}>
    <div class="form-group">
        <label class="col-md-2 control-label">Physical Examination</label>
        <div class="col-md-10">
            {!! Form::textarea('physical_examination', null, ['class' => 'form-control noresize', 'placeholder' => 'Physical Examination', 'cols'=>'10', 'rows'=>'5', $read]) !!}
        </div>
    </div>
</fieldset>
<fieldset {{$disabled}}>
    <div class="form-group">
        <label class="col-md-2 control-label">Remarks</label>
        <div class="col-md-10">
            {!! Form::textarea('remarks', null, ['class' => 'form-control noresize', 'placeholder' => 'Remarks', 'cols'=>'10', 'rows'=>'5', $read]) !!}
        </div>
    </div>
</fieldset>

@if(empty($disposition_record))
<fieldset {{$disabled}}>
    <div class="form-group">
        <div class="col-md-12">
            <div class="row">
                <button type="submit" class="btn btn-primary pull-right">Save Complaints</button>
            </div>
        </div>
    </div>
</fieldset>
@endif
{!! Form::close() !!}
