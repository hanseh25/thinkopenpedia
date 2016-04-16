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
                    <h3 class="box-title"><i class="fa fa-tag"></i> GROWTH PROGRESS </h3>
                    
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            {!! Form::hidden('patient_id', $result->patient_id) !!}
                            {!! Form::hidden('id', $result->id) !!}

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>Age :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="age" class="form-control" required="required" step="any" min="0" value="{!! $result->age !!}" >
                                    <span class="input-group-addon">weeks</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>WEIGHT :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="child_weight" value="{!! $result->child_weight !!}" class="form-control" required="required" step="any" min="0">
                                    <span class="input-group-addon">kg</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>HEIGHT :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="child_height" value="{!! $result->child_height !!}" class="form-control" required="required" step="any" min="0">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>HEAD :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="head" value="{!! $result->head !!}" class="form-control" required="required" step="any" min="0">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>CHEST :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="chest" value="{!! $result->chest !!}" class="form-control" required="required" step="any" min="0">
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>NOTES :</label>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    {!! Form::textarea('notes', $result->notes, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    {!! Form::submit('Submit', array('class'=> 'btn btn-block btn-success btn-lg')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
{!! Form::close() !!}
@endsection