<?php if($action == "view") { ?>
    <ul class="nav nav-tabs">
         <li class="active"><a href="#basic" data-toggle="tab" aria-expanded="true">Basic</a></li>
         <li><a href="#location" data-toggle="tab">Location</a></li>
         <li id="plugin-insert"><a href="#health" data-toggle="tab">Health Info</a></li>
         <li><a href="#notifications" data-toggle="tab">Record Settings</a></li>
         <li><a href="#photos" class="text-lg" data-toggle="tab">Photo</a></li>

         <li role="presentation" class="dropdown special">
            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents"> + Additional Patient Data  </a>
            <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                @if($plugs)
                  @foreach($plugs as $plug)
                    @if($plug['plugin_location'] == 'newdata')
                        <li><a href="{{ url('plugin/call/'.$plug['folder'].'/'.$plug['plugin'].'/view/'.$patient->patient_id) }}" role="tab">@if(!$plug['pdata']) <i class="fa fa-plus"></i> Add {{ $plug['title'] }} @else <i class="fa fa-eye"></i> View {{ $plug['title'] }} @endif</a></li>
                    @endif
                  @endforeach
                @endif
            </ul>
          </li>

          <li class="floatright"><button class="btn btn-danger deadPatient-button" data-toggle="modal" data-target="#deathModal">Declare Dead</button></li>
    </ul>
<?php } ?>
<?php if($action == "add") { ?>
    <ul id="step_visualization" class="nav nav-tabs">
         <li id="basictab" class="active"><a href="#" class="disabled" data-toggle="tab" aria-expanded="true">Basic</a></li>
         <li id="personaltab"><a href="#" class="disabled" data-toggle="tab">Personal</a></li>
         <li id="locationtab"><a href="#" class="disabled" data-toggle="tab">Location</a></li>
         <li id="healthtab"><a href="#" class="disabled" data-toggle="tab">Health Info</a></li>
         <li id="notificationstab"><a href="#" class="disabled" data-toggle="tab">Record Settings</a></li>
         <li id="phototab"><a href="#" class="disabled" data-toggle="tab">Photo</a></li>
    </ul>
<?php } ?>
