  <div class="col-md-3">
    <!-- <a href="{{ url('/referrals/createreferral')}}" class="btn btn-success btn-block margin-bottom">Create Referral</a> -->
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Folders</h3>
        <div class="box-tools">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li @if(Request::path() == 'referrals/inbound' OR Request::path() == 'referrals')
              class="active"
              @endif>
              <a href="{{ url('/referrals/inbound')}}">
                  <i class="fa fa-download"></i> Inbound <!-- inbox -->
                  {{-- <span class="label label-primary pull-right">12</span> --}}
              </a>
          </li>
          <li @if(Request::path() == 'referrals/outbound')
              class="active"
              @endif >
              <a href="{{ url('referrals/outbound')}}">
                  <i class="fa fa-upload"></i> Outbound <!-- sent -->
              </a>
          </li>
          <li @if(Request::path() == 'referrals/drafts')
              class="active"
              @endif >
              <a href="{{ url('referrals/drafts')}}">
                  <i class="fa fa-file-text-o"></i> Drafts <!-- drafts -->
              </a>
          </li>
        </ul>
      </div><!-- /.box-body -->
    </div><!-- /. box -->
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Referral Messages</h3>
        <div class="box-tools">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <li @if(Request::path() == 'referrals/messages' OR Request::path() == 'referrals/messages/1')
              class="active"
              @endif >
              <a href="{{ url('/referrals/messages')}}">
                  <i class="fa fa-envelope-o"></i> Inbox {{--<span class="label label-primary pull-right">1</span>--}}
              </a>
          </li>
        </ul>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->