@extends('backend.layouts.master')

@section('page-header')
    <h1>
        <small>{{ "" }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li><a href="{!!route('backend.patient.browse')!!}"><i class="fa fa-list-alt"></i> {{ trans('Patients') }}</a></li>
    <li><a href="{!!route('backend.patients.read',$result->child_id)!!}"><i class="fa fa-odnoklassniki"></i> {{ $child->first_name . " " . $child->last_name }}</a></li>
    <li class="active">{{ trans('Growth Progress') }}</li>
@endsection

@section('content')
    <div class="row">
        <section class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> Child Growth Progress</h3>
                    <div class="box-tools pull-right">
                        @if($doctor->user_id == $result->creator_user_id)
                            <a href="{!!route('backend.patients.growth.progress.edit',$result->id) !!}" class="btn bg-olive"><i class="fa fa-fw fa-edit"></i>Edit</a>
                        @endif
                        <a href="{!!route('backend.patients.read',$result->child_id) . '#growth_progress'!!}" class="btn bg-olive">Back</a>
                    </div>
                </div>
                <div class="box-body">
    
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Age :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->age }} weeks
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Weight :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->child_weight }} kg
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Height :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->child_height }} cm
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Head :</label> cm
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->head }} cm
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Chest :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->chest }} cm
                        </div>
                    </div>
                    
                    @if($doctor->user_id == $result->creator_user_id)
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                <label>Notes :</label>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                {{ $result->notes }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </div>
@endsection