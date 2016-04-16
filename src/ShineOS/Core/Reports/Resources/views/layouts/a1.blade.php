@extends('layout.master')

@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="with-border">
	  	<i class="fa fa-paste"></i>
	    A1 Report
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Reports</li> <!--NOTE:: Create dynamic breadcrumbs-->
	    <li class="active">A1</li> 
	  </ol>
	</section>

	<section class="content">
	  @include('reports::pages.a2')
    </section><!-- /.content -->
@stop