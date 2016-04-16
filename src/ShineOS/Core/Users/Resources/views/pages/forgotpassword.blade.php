@extends('users::layouts.masterlogin')
@section('title') ShineOS+ | Forgot Password @stop

@section('content')

    <div id="loginstyle" class="row">
        <div class="col-md-2 leftrightfill"></div>
        <div class="intro-box col-md-5">

            <h1>Welcome to <span class="smartblue">ShineOS</span><span class="smartolive">+</span></h1>
            <h2 class="smartlitblue">Developer Edition Beta1.0</h2>
            <p class="lead">SHINE stands for <strong>Secured Health Information Network and Exchange</strong>. A web and mobile-based system that addresses the data management needs of doctors, nurses, midwives, and other allied health professionals in the Philippines.</p>
            <p class="lead">The Developer Edition is the software development kit (SDK) for ShineOS+.</p>

            <h3>
            <a href="http://www.shine.ph/developer" class="btn btn-danger text-center" target="_blank">Learn more</a>
            <a href="http://www.shine.ph/developer/codex" class="btn btn-primary text-center" target="_blank">Documentation</a>
            <a href="http://www.shine.ph/developer/forum" class="btn bg-shine-green text-center" target="_blank">Developer Forum</a>
            </h3>

        </div>
        <div class="form-box col-md-3" id="login-box">

            <div class="header"><i>ShineOS+</i></div>

            {!! Form::open(array( 'url'=>'forgotpassword/send', 'id'=>'forgotPasswordForm', 'name'=>'forgotPasswordForm' )) !!}
                <div class="body">
                    <h4>Forgot Password</h4>

                    @if (Session::has('message'))
                        <div class="alert alert-dismissible alert-success">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif

                    @if (Session::has('warning'))
                        <div class="alert alert-dismissible alert-warning">
                            <p>{{ Session::get('warning') }}</p>
                        </div>
                    @endif

                    <p>Please enter your email address below. We will send you steps to change your password.</p>

                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required />
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-shine-green btn-block">Submit</button>
                    <p><a href="{{ url('login') }}">Back to Login</a></p>
                </div>
            {!! Form::close() !!}

          <!--   <div class="social margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div> -->
        </div>

        <div class="col-md-2 leftrightfill"></div>
        <br clear="all" />
        <div class="loginfooter">
            <a href="http://www.shine.ph/" target="_blank">About</a>
            <a href="http://www.shine.ph/support" target="_blank">Support</a>
            <a href="http://www.shine.ph/developers" target="_blank">Developers</a>
            <a href="http://www.shine.ph/about/privacy-policy/" target="_blank">Privacy</a>
            <a href="http://www.shine.ph/about" target="_blank">Ateneo ShineLabs</a>
            <a href="http://www.shine.ph/" target="_blank">Terms</a> &copy; 2014 - <?php echo date("Y"); ?>
        </div>
        <br clear="all" />
    </div>

@stop

@section('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('pages/login/forgotpassword.js') }}"></script>
@endsection
