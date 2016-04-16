<div class="box no-border">
    <div class="box-body table-responsive no-padding overflowx-hidden">
        <table class="table table-hover datatable">
            <thead>
            <tr>
                <th>Patient Name</th>
                <th>Service</th>
                <th>Seen by</th>
                <th>Encounter Date</th>
                <th class="nosort" style="width: 118px;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
               @if($visits)
                @foreach($visits as $key => $value)
                <tr>
                    <td>
                        <a href="{{ url('patients', [$value->patient_id]) }}" class="" title="View Patient Dashboard">
                        {{ $value->last_name }}, {{ $value->first_name }} {{ $value->middle_name }}
                        </a>
                    </td>
                    <td>{{ $value->healthcareservicetype_id }}</td>
                    <td><a href="{{ url('/users', [$value->seen_by->user_id])}}" title="View User Info">Dr. {{ $value->seen_by->last_name }}, {{ $value->seen_by->first_name }}</a></td>
                    <td> {{ date('M. d, Y', strtotime($value->encounter_datetime)) }} </td>
                    <td class="nosort">
                      <div class="btn-group">
                        <div class="btn-group">
                            <a href="#" type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown"> Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                              @if ($value->parent_service_id == NULL)
                              <li><a href="{{ url('healthcareservices/add/'.$value->patient_id.'/'.$value->healthcareservice_id) }}" title="Add Follow-up">Add Follow-up </a></li>
                              @endif
                              @if(getModuleStatus('referrals') == 1)
                              <li><a href="{{ url('referrals/add', [$value->healthcareservice_id]) }}" title="Refer Patient">Refer Patient </a></li>
                              @endif
                              @if(getModuleStatus('reminders') == 1)
                              <li><a href="{{ url('reminders/add', [$value->patient_id]) }}" title="Refer Patient">Create Appointment </a></li>
                              @endif
                            </ul>
                        </div>
                        @if(!empty($value->healthcare_disposition))
                        <a href="{{ url('healthcareservices/edit/'.$value->patient_id.'/'.$value->healthcareservice_id) }}" type="button" class="btn btn-success btn-flat" title="View Visits"><i class="fa fa-eye"></i> View </a>
                        @else
                        <a href="{{ url('healthcareservices/edit/'.$value->patient_id.'/'.$value->healthcareservice_id) }}" type="button" class="btn btn-success btn-flat" title="Edit Visits"><i class="fa fa-pencil"></i> Edit </a>
                        @endif
                        <a href="{{ url('healthcareservices/delete', [$value->healthcareservice_id]) }}" type="button" class="btn btn-danger btn-flat" title="Delete Visits"><i class="fa fa-trash-o"></i> Delete</a>
                      </div>
                    </td>
                </tr>
                @endforeach
              @endif
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
