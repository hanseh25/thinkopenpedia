<?php
    //get the prefix of the page to set the nav to active
    $route = Route::current();
    $name = $route->getPrefix();
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <div class="user-panel">
    <div class="pull-left image">
        <?php
            $user = Session::get('_global_user');
            $userPhoto = $user->profile_picture;
        ?>
        @if ( $userPhoto != '' )
            <img src="{{ url('public/uploads/profile_picture/'.$userPhoto) }}" class="profile-img img-circle" />
        @else
            <img src="{{ asset('public/dist/img/noimage_male.png') }}" class="profile-img img-circle" />
        @endif
    </div>
    <div class="pull-left info">
      <p>Welcome
        <?php $id = Auth::user()->user_id; ?>
        <a href="{{ url('/users',[$id])}}">
          @if( Auth::check() )
            {{ Auth::user()->first_name }} !
          @endif
        </a>
      </p>
      <a href="{{ url('/users',[$id])}}" class="btn btn-primary">Profile</a>
    </div>
  </div>

  <ul class="sidebar-menu">
    <li class="divider-bottom @if($name == 'dashboard') active @endif">
      <a href="{{ url('/')}}" class="{{ Request::is('/') ? 'active' : '' }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <!-- Edited by RJBS -->
    @if (Cache::get('roles'))
      <?php
          $modules = Cache::get('roles');
      ?>

      <!-- start Core modules -->
      @foreach($modules['modules'] as $k => $v)
        @if( $v['name'] != 'dashboard' AND $v['icon'] != NULL AND $v['status'] == '1' AND $v['order'] < 10 )
          <li class="@if($name == $v['name']) active @endif">
            <a href="{{ url( '/', $v['name'] )}}" class="{{ Request::is('*'.$v['name']) ? 'active' : '' }}">
              <i class="fa {{ $v['icon'] }}"></i> <span>{{ ucfirst($v['name']) }}</span>
            </a>
          </li>
        @endif
      @endforeach

      <!-- start extension modules -->
      <?php $cnt = 0; $totalc = 0; ?>
      @if(isset($modules['external_modules']))
        <?php $totalc = count($modules['external_modules']); ?>
        @foreach($modules['external_modules'] as $key => $val)
          <?php $cnt++; ?>
          <?php $c = Config::get($key.'.icon'); ?>
          <li class="@if($name == $key) active @endif @if($cnt == 1) divider-top @endif @if($cnt == $totalc) divider-bottom @endif">
            <a href="{{ url('/', $key)}}" class="{{ Request::is('*$key') ? 'active' : '' }}">
              <i class="fa {{ $c }}"></i> <span>{{ ucfirst($key) }}</span>
            </a>
          </li>
        @endforeach
      @endif

      <!-- start Utility modules -->
      @foreach($modules['modules'] as $k => $v)
        @if( $v['name'] != 'dashboard' AND $v['icon'] != NULL AND $v['status'] == '1' AND $v['order'] >= '10000' )
          <li class="@if($name == $v['name']) active @endif">
            <a href="{{ url( '/', $v['name'] )}}" class="{{ Request::is('*'.$v['name']) ? 'active' : '' }}">
              <i class="fa {{ $v['icon'] }}"></i> <span>{{ ucfirst($v['name']) }}</span>
            </a>
          </li>
        @endif
      @endforeach

    @endif
    <!-- end RJBS edit -->
  </ul>
</section>
<!-- /.sidebar -->
