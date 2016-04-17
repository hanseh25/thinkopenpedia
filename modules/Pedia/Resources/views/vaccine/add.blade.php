@extends('pedia::layouts.master')

@section('page-header')
    <h1>
        <small>{{ "" }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::open(array( 'method' => 'post', 'class' => 'form-horizontal' )) !!}
    <div class="row">
        <section class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> Vaccine </h3>
                </div>
                <div class="box-body">
                    {!! Form::hidden('patient_id', $patient_id) !!}

                    
                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>DATE :</label>
                            <span style="color: red">*</span>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::text('date', '', array('class' => 'datepicker form-control', 'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>VACCINE :</label>
                            <span style="color: red">*</span>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::select('vaccine', $vaccines, 0, array('class' => 'form-control', 'required' => 'required') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>SITE :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::select('site', array( '' => 'SELECT SITE', 'LEFT ARM' => 'LEFT ARM', 'RIGHT ARM' => 'RIGHT ARM','LEFT BUTTOCKS' => 'LEFT BUTTOCKS', 'RIGHT BUTTOCKS' => 'RIGHT BUTTOCKS'), 0, array('class' => 'form-control') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>NOTES:</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::textarea('notes', '', array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            {!! Form::submit('Submit', array('class'=> 'btn btn-block btn-success btn-lg')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
{!! Form::close() !!}
@endsection