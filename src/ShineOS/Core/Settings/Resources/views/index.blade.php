@extends('layout.master')

@section('page-header')
  <section class="content-header">
    <h1>
      <i class="fa fa-gear"></i>
      Settings
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Settings</li>
    </ol>
  </section>
@stop
  
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#plugin_list" data-toggle="tab">Plugin Management</a></li>
            </ul>
            <div class="tab-content">
				<div class="tab-pane active" id="plugin_list">
				@if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
				<table>
					{!! Form::open(array('url' => 'settings/save', 'name'=>'settingsForm', 'class'=>'form-horizontal')) !!}
					@for($i=0; count($plugins) > $i; $i++)
            <input type="checkbox" name="plugin[]">{{ $plugins[$i] }}<br />
					@endfor

					<tr><td><input type="submit" value="Enable Plugin" class="btn btn-primary"></td></tr>
					{!! Form::close() !!}
				</table>
				</div><!-- /.tab-pane -->
            </div>
        </div>
    </div>
</div>
@stop
