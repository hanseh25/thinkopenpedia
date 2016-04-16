<h4>Background</h4>
<!-- form start -->
{!! Form::open(array( 'url'=>$modulePath.'/updatebackground/'.$userInfo->user_id, 'id'=>'UserBackgroundForm', 'name'=>'UserBackgroundForm', 'class'=>'form-horizontal' )) !!}
	<div class="box-body">
		<div class="form-group">
			<label for="inputLastName" class="col-sm-2 control-label">Profession</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="profession" name="profession" placeholder="Profession" value="{{ $userMd->profession }}" />
			</div>
		</div>
		<div class="form-group">
			<label for="professional_license_number" class="col-sm-2 control-label">License Number</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="professional_license_number" name="professional_license_number" placeholder="License Number" value="{{ $userMd->professional_license_number }}" />
			</div>
		</div>
		<div class="form-group">
			<label for="med_school" class="col-sm-2 control-label">Medical School</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="med_school" name="med_school" placeholder="Med School" value="{{ $userMd->med_school }}" />
			</div>
		</div>
		<div class="form-group">
			<label for="residency_trn_inst" class="col-sm-2 control-label">Residency</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="datepicker" name="residency_trn_inst" placeholder="Residency" value="{{ $userMd->residency_trn_inst }}" />
				<!--<input type="text" class="form-control" id="datepicker" id="residency_trn_inst" name="residency_trn_inst" placeholder="Residency" value="{{ $userMd->residency_trn_inst }}" />-->
			</div>
		</div>
		<div class="form-group">
			<label for="residency_grad_yr" class="col-sm-2 control-label">Year Graduated</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="datepicker" name="residency_grad_yr" placeholder="Year Graduated" value="{{ $userMd->residency_grad_yr }}" />
				<!--<input type="text" class="form-control" id="datepicker"id="residency_grad_yr" name="residency_grad_yr" placeholder="Year Graduated" value="{{ $userMd->residency_grad_yr }}" />-->
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button type="submit" class="btn btn-success pull-right">Update Background</button>
	</div><!-- /.box-footer -->
{!! Form::close() !!}