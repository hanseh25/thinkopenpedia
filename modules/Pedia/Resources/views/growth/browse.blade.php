@extends('backend.layouts.master')

@section('page-header')
    <h1>
        <small>{{ "Patients Immunization List" }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li><a href="{!!route('backend.patient.browse')!!}"><i class="fa fa-list-alt"></i> {{ trans('Patients') }}</a></li>
    <li><a href="{!!route('backend.patients.read',$children_id)!!}"><i class="fa fa-odnoklassniki"></i> {{ $child->first_name . " " . $child->last_name }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <?php 
        // dd($result->data);
    ?>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    @if(count($result->data))
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr class="row">
                                    <th>Vaccine</th>
                                    <th>Date</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result->data as $item)
                                    <tr class="row">
                                        <td>{!! $item->vaccine !!}</td>
                                        <td>{!! $item->date !!}</td>
                                        <td>{!! $item->notes !!}</td>
                                        <td>{!! $item->status !!}</td>
                                        <td>
                                            <a href="{!! route('backend.patients.immunization.read', $item->id) !!}" class="btn btn-info"> 
                                                <i class="fa fa-fw fa-edit"></i>
                                                View
                                            </a>
                                            <a href="{!! route('backend.patients.immunization.edit', $item->id) !!}" class="btn bg-olive"> 
                                                <i class="fa fa-fw fa-edit"></i>
                                                edit
                                            </a>
                                            <a href="" class="btn btn-danger"> 
                                                <i class="fa fa-fw fa-trash-o"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5>There was no Immunizations found or the Children is not yet your Patient</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection