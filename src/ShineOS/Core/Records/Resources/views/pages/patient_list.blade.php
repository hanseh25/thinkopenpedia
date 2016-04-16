<div class="box no-border">
    @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info alert-dismissible') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="box-body table-responsive no-padding overflowx-hidden">
        <table class="table table-hover datatable" id="dataTable_patients">
            <thead>
            <tr>
                <th>Patient Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Birthdate</th>
                <th>Family Folder</th>
                <th>Barangay</th>
                <th class="nosort" width="247">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    @if ($patient->patientDeathInfo != null)
                    <?php
                        $status = 'disabled';
                    ?>
                    @else
                    <?php
                        $status = 'active';
                    ?>
                    @endif
                    <?php
                        $dateNow = new DateTime();
                        $patientBday = new DateTime(($patient->birthdate));
                        $interval = $dateNow->diff($patientBday);
                    ?>
                    <tr>
                        <td><a href="{{ url('patients', [$patient->patient_id]) }}" class="" title="View Patient Dashboard">{{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}</a></td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $interval->format('%Y years') }}</td>
                        <td>{{ dateFormat($patient->birthdate, "M. d, Y") }}</d>
                        <td>{{ $patient->last_name }}
                            <!--@if ($patient->patientFamilyGroup != NULL)
                                            @foreach ($patient->patientFamilyGroup as $key=>$val)
                                                {{ $val->familygroup_name }}
                                            @endforeach
                                        @endif-->
                        </td>
                        <td>{{ getBrgyName($patient->patientContact->barangay) }}</td>
                        <td class="nosort">
                             <div class="btn-group">
                                <div class="btn-group">
                                    <a href="#" type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" {{ $status }}> Actions <span class="caret"></span></a>
                                    <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                      <li><a href="{{ url('healthcareservices/add', [$patient->patient_id]) }}">Add Healthcare Visit</a></li>
                                      <li role="separator" class="divider"></li>
                                      <li><a href="#" data-toggle="modal" data-target="#deathModal" class="red">Declare Dead</a></li>
                                    </ul>
                                </div>
                                <a href="{{ url('patients/view', [$patient->patient_id]) }}" type="button" class="btn btn-success btn-flat" title="Edit Patient" {{ $status }}><i class="fa fa-pencil"></i> Edit</a>
                                <a href="{{ route('patients.delete', [$patient->patient_id]) }}" type="button" class="btn btn-danger btn-flat" title="Delete Role"><i class="fa fa-trash-o"></i> Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->

@section('scripts')
    <!-- Modal form-->
    <div class="modal fade" id="deathModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Declare Patient Dead</h4>
          </div>
            @if (isset($patient))
            {!! Form::model($patient, array('url' => 'patients/'.$patient->patient_id.'/saveDeathInfo','class'=>'form-horizontal', 'method'=>'PATCH' )) !!}
            @else
            {!! Form::open(array('url' => 'patients/viewDeathInfo','class'=>'form-horizontal')) !!}
            @endif
          <div class="modal-body" id="modal-body">
            <div class="form-group">
              <label for="inputCauseofDeath">Cause of Death</label>
              <input type="text" class="form-control" name="inputCauseofDeath" id="inputCauseofDeath" placeholder="Cause of Death" required>
            </div>

            <div class="form-group">
              <label for="inputPlaceofDeath">Place of Death</label>
              <input type="text" class="form-control" name="inputPlaceofDeath" id="inputPlaceofDeath" placeholder="Place of Death" required>
            </div>

            <div class="form-group">
              <label for="exampleInputFile">Date and Time of Death</label>
              <input type="date" class="form-control" name="inputDateTimeDeath" id="datetimepicker" placeholder="Death Time and Day" required>
            </div>

            <div class="form-group">
              <label for="inputCauseofDeathNotes">Notes</label>
              <textarea class="form-control" name="inputCauseofDeathNotes" id="inputCauseofDeathNotes"></textarea>
            </div>

            <div class="form-group">
              <label for="inputDeathCertificate">Death Certificate</label>
              <input type="file" id="inputDeathCertificate" name="inputDeathCertificate" required>
            </div>
          </div>
          <div class="modal-footer" id="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end of modal ------------------------------>

@stop
