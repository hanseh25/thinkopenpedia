@extends('layout.master')

@section('page-header')
  <section class="content-header">
    <h1>
      <i class="fa fa-gear"></i>
      Extensions
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Extensions</li>
    </ol>
  </section>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#module_list" data-toggle="tab">Modules</a></li>
                <li class="active"><a href="#plugin_list" data-toggle="tab">Plugins</a></li>
                <li><a href="#widget_list" data-toggle="tab">Widgets</a></li>
                <li class="btn btn-primary">Add New</li>
            </ul>
            <div class="tab-content">
                @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-info alert-dismissible') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="tab-pane" id="module_list">
                    <h4>Installed Modules</h4>
                </div>

                <div class="tab-pane active" id="plugin_list">
                    <h4>Installed Plugins</h4>
                    <table class="table tdtop">
                        <thead>
                        <tr>
                            <td width="15">&nbsp;</td>
                            <td width="300">Extension Name</td>
                            <td width="60">Module</td>
                            <td>Description</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plugins as $p)
                        {!! Form::open(array('url' => 'settings/save', 'name'=>'settingsForm', 'class'=>'form-horizontal')) !!}
                        <tr>
                            <td width="15" valign="top"><input type="checkbox" checked="checked" name="{{ $p['plugin'] }}"></td>
                            <td width="300" valign="top">
                                <strong>{{ $p['plugin_name'] }}</strong> @if(isset($p['plugin_version'])) {{ " | ".$p['plugin_version'] }}@endif
                                <br clear="all" />
                                <div class="btn-group" style="margin-top:5px;">
                                    <a href="#" class="btn btn-success btn-xs">Activate</a><a href="#" class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </td>
                            <td width="60" valign="top">{{ $p['plugin_module'] }}</td>
                            <td valign="top">
                                {{ $p['plugin_description'] }}
                                <p>
                                    @if(isset($p['plugin_developer'])) {{ $p['plugin_developer'] }}@endif
                                     | <a href="#">View Info</a>
                                </p>
                            </td>
                        </tr>
                        {!! Form::close() !!}
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="widget_list">
                    <h4>Installed Widgets</h4>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
