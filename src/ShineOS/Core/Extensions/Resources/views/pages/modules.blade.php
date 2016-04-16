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
                <li class="active"><a href="#plugin_list" data-toggle="tab">Plugin Management</a></li>
                <li>Add New</li>
            </ul>
            <div class="tab-content">
                      <div class="tab-pane active" id="plugin_list">
                      @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
              @endif

              {!! Form::open(array('url' => 'settings/saveModules', 'name'=>'settingsForm', 'class'=>'form-horizontal')) !!}
                @if($extModules)
                    <?php dd(); ?>
                    @foreach($extModules as $val)
                    <?php
                      $checked = '';
                    ?>
                    @foreach($enabled_modules as $v)
                      @if ($val == strtolower($v))
                        <?php
                          $checked = 'checked';
                        ?>
                      @endif
                    @endforeach
                    <input type="checkbox" name="modules[]" value="{{ ucfirst($val) }}" {{ $checked }}> {{ ucfirst($val) }} <br />
                  @endforeach
                @endif
                <input type="submit" value="Enable Modules" class="btn btn-primary">
              {!! Form::close() !!}
                      </div><!-- /.tab-pane -->
            </div>
        </div>
    </div>
</div>
@stop
