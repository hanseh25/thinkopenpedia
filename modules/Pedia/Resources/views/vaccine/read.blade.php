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
                    <h3 class="box-title"><i class="fa fa-tag"></i> IMMUNIZATION </h3>
                </div>
                <div class="box-body">
    
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Date :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->date }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Vaccine :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->vaccine }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <label>Site :</label>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            {{ $result->site }}
                        </div>
                    </div>

                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                <label>Notes :</label>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                {{ $result->notes }}
                            </div>
                        </div>

                </div>
            </div>
        </section>
    </div>
@endsection