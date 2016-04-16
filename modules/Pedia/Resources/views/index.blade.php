@extends('pedia::layouts.master')

@section('heads')

@stop

@section('pedia-content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('flash_message'))
            <div class="alert {{Session::get('flash_type') }}">{{ Session::get('flash_message') }}</div>
        @endif
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#patient_list" data-toggle="tab">Patients</a></li>
                <li><a href="#visit_list" data-toggle="tab">Health Care Visits</a></li>
                <li class="pull-right"> <a href="patients/add" class="btn btn-primary"> <i class="fa fa-user-plus"></i> Add New Patient</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="patient_list">
                  @include('records::pages.patient_list')
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="visit_list">
                  @include('records::pages.healthcare_list')
                </div><!-- /.tab-pane -->

            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    {!! HTML::script('public/dist/plugins/chain/jquery.chained.min.js') !!}
    {!! HTML::script('public/dist/plugins/chain/jquery.chained.remote.min.js') !!}
@stop
