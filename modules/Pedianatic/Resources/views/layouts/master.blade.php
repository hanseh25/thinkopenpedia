@extends('layout.master')
@section('title')Analytics @stop

@section('page-header')
	<section class="content-header">
		<h1>
			<i class="fa fa-area-chart"></i>
		 	Analytics
		</h1>

		<!--Breadcrumbs-->

	</section>
@stop

@section('content')
	<div class="row">
		<!-- Main content -->
		@yield('pedianatic-content')
	</div><!-- /.row -->
@stop

