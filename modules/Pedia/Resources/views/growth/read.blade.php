@extends('pedia::layouts.master')

@section('page-header')
    <h1>
        <small>{{ "" }}</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <section class="col-md-6 col-md-offset-3 col-xs-12 col-xs-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-tag"></i> Child Growth Progress</h3>
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
                    

                </div>
            </div>
        </section>
    </div>
@endsection