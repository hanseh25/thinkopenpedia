    <!-- Logo -->
    <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    <a href="{{ url('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('public/dist/img/shine-logo.png') }}"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('public/dist/img/shine-logo.png') }}"></span>
      Developer Edition Beta 1.0
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php /*
          <li class="dropdown messages-menu">
            <a href="{{ url('/referrals') }}" class="dropdown-togglee" data-toggle="dropdownn">
              <i class="fa fa-paper-plane text-shine-green"></i>
              <!-- <span class="label label-shine-blue">4</span> -->
            </a>
          </li>

          <li class="dropdown referrals-menu">
            <a href="{{ url('/referrals/messages') }}" class="dropdown-togglee" data-toggle="dropdownn">
              <i class="fa fa-envelope text-shine-green"></i>
              <!-- <span class="label label-shine-blue">10</span> -->
            </a>
          </li>

          <li class="dropdown reminders-menu">
            <a href="{{ url('/reminders') }}" class="dropdown-togglee" data-toggle="dropdownn">
              <i class="fa fa fa-bell text-shine-green"></i>
              <!-- <span class="label label-shine-blue">9</span> -->
            </a>
          </li>
          */ ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">
                      @if( Auth::check() )
                          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                      @endif
                    </span>&nbsp;
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php
                    $user = Session::get('_global_user');
                    $userPhoto = $user->profile_picture;
                ?>
                @if ( $userPhoto != '' )
                    <img src="{{ url('public/uploads/profile_picture/'.$userPhoto) }}" class="profile-img img-circle" />
                @else
                    <img src="{{ asset('public/dist/img/noimage_male.png') }}" class="profile-img img-circle" />
                @endif
                <p>
                          @if( Auth::check() )
                              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                  <?php $id = Auth::user()->user_id; ?>
                          @endif
                  <!-- <small>Doctor</small> -->
                </p>
              </li>
              @if(isset($userFacilities))
              <li class="user-body">
                @foreach($userFacilities as $facilities)
                <a href="#" class="user-facilities">{{ $facilities->facility_name }}</a>
                @endforeach
              </li>
              @endif
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('/users',[Auth::user()->user_id])}}" class="btn btn-default btn-flat">Profile</a><!--Note:: Change ID Parameter. For testing purposes only.-->
                </div>
                <div class="pull-right">
                  <a href="{{ URL::to('logout/'.$id) }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
