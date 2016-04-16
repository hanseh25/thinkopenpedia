@extends('users::layouts.masterlogin')
@section('title') ShineOS+ | Login @stop

@section('content')
    <div class="video_wrapper">
        <video loop="true" muted="" autoplay="true" class="video js-background_video" poster="{{ asset('public/dist/img/shine.jpg') }}">
            <source type="video/webm" src="{{ asset('public/dist/img/videos/shine.webm') }}"></source>
            <source type="video/mp4" src="{{ asset('public/dist/img/videos/shine.mp4') }}"></source>
        </video>
    </div>
    <div id="loginstyle">
        <div class="overlay"></div>
        <div class="intro-box">
            <h1>Welcome to <span class="smartblue">ShineOS</span><span class="smartolive">+</span></h1>
            <h2>The First Health Care Operating System</h2>
            <p>SHINE stands for Secured Health Information Network and Exchange. A web and mobile-based system that addresses the data management needs of doctors, nurses, midwives, and allied health professionals in the Philippines.</p>
            <h3><a href="{{ url('registration')}}" class="text-center">Register</a> | <a href="#" class="text-center">Learn more</a></h3>
        </div>
        <div class="form-box" id="login-box">

            <div class="header"><i>ShineOS+</i></div>

            {!! Form::open(array( 'url'=>'forgotpassword/changepassword_request', 'id'=>'ChangePassword', 'name'=>'ChangePassword' )) !!}
                <div class="body">
                    <h4>Forgot Password</h4>

                    @if (Session::has('success'))
                        <div class="alert alert-dismissible alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    @if (Session::has('warning'))
                        <div class="alert alert-dismissible alert-warning">
                            <p>{{ Session::get('warning') }}</p>
                        </div>
                    @endif

                    <p>You may update your password below.</p>

                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="verify_password" id="verify_password" class="form-control" placeholder="Re-enter Password" required />
                    </div>
                </div>
                <div class="footer">
					<input type="hidden" id="forgot_password_code" name="forgot_password_code" value="{{ $forgotPassword->forgot_password_code }}" />
                    <button type="submit" class="btn bg-shine-green btn-block">Submit</button>

                </div>
            {!! Form::close() !!}
        </div>

        <div class="loginfooter">
            <a href="">About</a>
            <a href="">Tour</a>
            <a href="">Support</a>
            <a href="">Developers</a>
            <a href="">Privacy</a>
            <a href="">Terms</a> &copy; 2014 - 2015
        </div>
    </div>

@stop

@section('scripts')
	<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('pages/login/changepassword.js') }}"></script>
@endsection