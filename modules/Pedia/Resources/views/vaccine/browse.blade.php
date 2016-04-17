@extends('pedia::layouts.master')

@section('page-header')
    
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
                    @if(count($result))
                        <table class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                                <tr class="row">
                                    <th>Vaccine</th>
                                    <th>Date</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $item)
                                    <tr class="row">
                                        <td>{!! $item->vaccine !!}</td>
                                        <td>{!! $item->date !!}</td>
                                        <td>{!! $item->notes !!}</td>
                                        <td>
                                            <a href="read/{!! $item->id !!}" class="btn btn-info"> 
                                                <i class="fa fa-fw fa-edit"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5>There was no Immune on Patient</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection