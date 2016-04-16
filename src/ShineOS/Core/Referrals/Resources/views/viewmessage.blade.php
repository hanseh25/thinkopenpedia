@extends('referrals::layouts.master')

@section('referral-content')

@foreach($referrals as $key => $value)
<div class="col-md-9">
    <!-- DIRECT CHAT --> 
    <div class="box box-success direct-chat direct-chat-success">
      <div class="box-header with-border">
        
          <h5>Referrer: <strong> {{ $value->referrerFacility->facility_name }} </strong> </h5> 
          <h5>Referred To: <strong>  {{ $value->referredFacility->facility_name }}  </strong> </h5>
          <h5>Referred Patient: <strong> {{ $value->patientsdata->first_name }} {{ $value->patientsdata->middle_name }} {{ $value->patientsdata->last_name }} </strong> </h5> 
          <h5>Health Care Service: <strong> {{ $value->healthcare_servicetype_name }} </strong> </h5>
      </div>
      <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" style="height:10% !important;">  
              @foreach($value->referralMessages as $k => $v) 
                  @if($v->referrer == 1) 
                   <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                     <div class="direct-chat-text">
                       <h5> <strong> {{ $value->referrerFacility->facility_name }} </strong> 
                  @else 
                     <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-text">
                       <h5> <strong> {{ $value->referredFacility->facility_name }} </strong>
                      
                  @endif  
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $v->created_at }}</small>
                        </h5>
                        <h5> {{ $v->referral_message }} </h5>
                      </div>
                 </div>

                @endforeach
            </div> 
        @endforeach 
      </div>
      {!! Form::open(array( 'url'=>"referrals/reply/$value->referral_id", 'id'=>'referrals', 'name'=>'referrals', 'class'=>'form-horizontal' )) !!} 
        <div class="box-footer"> 
            <div class="input-group">
              <input type="text" name="replyMessage" placeholder="Type Message ..." class="form-control" required>
              <span class="input-group-btn"> 
                {!! Form::submit('Reply', ['class'=>'btn btn-primary', 'name'=>'reply']) !!}
              </span>
            </div>  
        </div>
      {!! Form::close() !!}
    </div> 
  </div>
</div>
@stop