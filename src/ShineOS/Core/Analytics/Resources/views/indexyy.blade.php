@extends('layout.master')

@section('page-header')
  <section class="content-header">
    <h1>
      <i class="fa fa-pie-chart"></i>
      Analytics
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Analytics</li>
    </ol>
  </section>
@stop

@section('content')
    <!-- Info boxes -->
    <div class="row mb20">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Patient Count</span>
            <span class="info-box-number">{{ $patient_count }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-stethoscope"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total No. of visits</span>
            <span class="info-box-number">{{ $visit_count }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-cloud-download"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Referral Count</span>
            <span class="info-box-number">{{ $referral_count }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
	{!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Facility Recap Report</h3>
            <div class="box-tools pull-right">
              <span>Filter by:</span>
              <select class="btn" id="filterBy">
				<option value="age">Age</option>
                <option value="visits">Visits</option>
              </select>
              <button class="btn btn-primary btn-sm analytics-daterange" data-toggle="tooltip" title="" data-original-title="Date range"><i class="fa fa-calendar"></i></button>
              <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Statistics: 1 Jan, 2015 - 30 Jul, 2015</strong>
                </p>
                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180"></canvas>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Top Patients</strong>
                </p>
                @foreach ($top_patients as $patients)
                <div class="progress-group">
                  <span class="progress-text">{{ $patients->last_name }}, {{ $patients->first_name }}</span>
                </div><!-- /.progress-group -->
                @endforeach
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- ./box-body -->
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">{{ $count_by_gender_sex }}</h5>
                  <span class="description-text">Count by sex, age, barangay</span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">{{ $count_by_services_rendered }}</h5>
                  <span class="description-text">Count by services rendered</span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
              <div class="col-sm-4 col-xs-6">
                <div class="description-block border-right">
                  <h5 class="description-header">{{ $count_by_disease }}</h5>
                  <span class="description-text">Count by disease </span>
                </div><!-- /.description-block -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('scripts')
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="{{ asset('public/dist/plugins/chain/jquery.chained.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/dist/plugins/chain/jquery.chained.remote.min.js') }}" type="text/javascript"></script>

     <!-- Morris.js charts -->
    <script src="{{ asset('public/dist/plugins/morris/raphael-min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/morris/morris.min.js') }}" type="text/javascript"></script>

    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('public/dist/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/dist/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset('public/dist/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset('public/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/dist/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('public/dist/plugins/daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/dist/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{{ asset('public/dist/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('public/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>

    <!-- Chart /dashboard-page-->
    <script src="{{ asset('public/dist/plugins/chartjs/Chart.min.js') }}" type="text/javascript"></script>
     <!-- /dashboard-page  -->
    <script src="{{ asset('public/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
    <!-- Bootstrap Switch JS -->
    <script src="{{ asset('public/dist/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5-->
    <script src="{{ asset('public/dist/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
@stop