@extends('users::layouts.masterprofile')

@section('profile-content')
        @include('users::partials.user_nav')
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has('message'))
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session::get('warning') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Upload Profile Picture</a></li>
                </ul>
                <div class="tab-content">

                    <!-- TAB 1 -->
                    <div class="tab-pane active" id="tab_1">
                        {!! Form::open(array( 'url'=>$modulePath.'/changeprofilepic_update/'.$userInfo->user_id, 'id'=>'UserInformationForm', 'name'=>'UserInformationForm', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data' )) !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="profile_picture" class="col-sm-2 control-label">Upload Photo</label>
                                <div class="col-sm-10">
                                    <input type="file" class="" id="profile_picture" name="profile_picture" value="" />
                                </div>
                            </div>
                            @if ( $userInfo->profile_picture != '' )
                            <div class="form-group">
                                <label for="profile_picture" class="col-sm-2 control-label">Current Photo</label>
                                <div class="col-sm-10">
                                    <img src="{{ url('public/uploads/profile_picture/'.$userInfo->profile_picture) }}" class="img-responsive" />
                                </div>
                            </div>
                            @endif
                        </div> <!-- box-body end -->
                        <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update Info</button>
                        </div><!-- /.box-footer -->
                        {!! Form::close() !!}
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div>

@stop

@section('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/pages/users/profile_picture.js') }}"></script>
@endsection
