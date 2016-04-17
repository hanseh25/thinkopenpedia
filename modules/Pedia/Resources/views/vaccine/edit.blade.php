@extends('backend.layouts.master')

@section('page-header')
    <h1>
        <small>{{ "" }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li><a href="{!!route('backend.patient.browse')!!}"><i class="fa fa-list-alt"></i> {{ trans('Patients') }}</a></li>
    <li><a href="{!!route('backend.patients.read',$result->children->id)!!}"><i class="fa fa-odnoklassniki"></i> {{ $child->first_name . " " . $child->last_name }}</a></li>
    <li class="active">{{ trans('Edit Immunization') }}</li>
@endsection

@section('content')
    {!! Form::open(array( 'method' => 'post', 'class' => 'form-horizontal' )) !!}
    <div class="row">
        <section class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> IMMUNIZATION </h3>
                    <div class="box-tools pull-right">
                        <a href="{!!route('backend.patients.read', $result->children->id) . '#immunization'!!}" class="btn bg-olive">Back</a>
                    </div>
                </div>
                <div class="box-body">
                    @if(count($result))
                    {!! Form::hidden('children_id', $result->children->id) !!}
                    {!! Form::hidden('immune_id', $result->id) !!}
    
                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>DATE :</label>
                            <span style="color: red">*</span>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::text('date', $result->date, array('class' => 'datepicker form-control', 'required' => 'required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>VACCINE :</label>
                            <span style="color: red">*</span>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::select('vaccine', $vaccines, $result->vaccine, array('class' => 'form-control', 'required' => 'required') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>SITE :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::select('site', array( '' => 'SELECT SITE', 'LEFT ARM' => 'LEFT ARM', 'RIGHT ARM' => 'RIGHT ARM','LEFT BUTTOCKS' => 'LEFT BUTTOCKS', 'RIGHT BUTTOCKS' => 'RIGHT BUTTOCKS'), $result->site, array('class' => 'form-control') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-xs-4">
                            <label>YOUR NOTES (PRIVATE)  :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {!! Form::textarea('notes', $result->notes, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            {!! Form::submit('Submit', array('class'=> 'btn btn-block btn-success btn-lg')) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
{!! Form::close() !!}
@endsection