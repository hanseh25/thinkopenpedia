@extends('backend.layouts.master')

@section('page-header')
    <h1>
        <small>{{ "" }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li><a href="{!!route('backend.patient.browse')!!}"><i class="fa fa-list-alt"></i> {{ trans('Patients') }}</a></li>
    <li><a href="{!!route('backend.patients.read',$children_id)!!}"><i class="fa fa-odnoklassniki"></i> {{ $child->first_name . " " . $child->last_name }}</a></li>
    <li class="active">{{ trans('Add Growth Progress') }}</li>
@endsection
<?php
    $date = new DateTime($child->birth_date);
    $now = new DateTime();
    $interval = $now->diff($date);
    $weeks = round($interval->days/7);
?>
@section('content')
    {!! Form::open(array( 'method' => 'post', 'class' => 'form-horizontal' )) !!}
    <div class="row">
        <section class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> GROWTH PROGRESS </h3>
                    <div class="box-tools pull-right">
                        <a href="{!!route('backend.patients.read', $children_id) . '#growth_progress'!!}" class="btn bg-olive">Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            {!! Form::hidden('children_id', $children_id) !!}
                            {!! Form::hidden('age', $weeks) !!}

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>WEIGHT :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="child_weight" class="form-control" required="required" step="any" min="0" >
                                    <span class="input-group-addon">kg</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>HEIGHT :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="child_height" class="form-control" required="required" step="any" min="0" >
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>HEAD :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="head" class="form-control" required="required" step="any" min="0" >
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>CHEST :</label>
                                    <span style="color: red">*</span>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
                                    <input type="number" name="chest" class="form-control" required="required" step="any" min="0" >
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-xs-4">
                                    <label>YOUR NOTES (PRIVATE) :</label>
                                </div>
                                <div class="col-md-8 col-xs-8 input-group">
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
                </div>
            </div>
        </section>
    </div>
{!! Form::close() !!}
@endsection