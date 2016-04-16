@extends('layout.master')
@section('title') ShineOS+ | Pedia @stop

@section('page-header')
	<section class="content-header">
		<h1>
			<i class="fa fa-odnoklassniki"></i>
		 	Pedia PO
		</h1>

		<!--Breadcrumbs-->

	</section>
@stop

@section('content')
	<div class="row">
		<!-- Main content -->
		@yield('pedia-content')
	</div><!-- /.row -->
@stop

