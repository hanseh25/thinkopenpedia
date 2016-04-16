<div class="tab-pane step icheck" id="notifications">
    <fieldset class="col-md-12">
        <legend>Notification Settings</legend>
        <div class="form-group">
            <p>Patients can receive notifications for referrals, appointments, medical orders and health announcements via SMS or email. Your patient can opt-in or opt-out to this features. Check the preferred settings.</p>

            <div class="col-sm-12">
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" value="1" name="inputBroadcastNotif" id="inputBroadcastNotif" @if(isset($patient) AND $patient->broadcast_notif == '1') checked='checked' @endif>
                        Receive Broadcast Nofitication
                    </label>
                </div>
                <div class="checkbox-inline" >
                    <label>
                        <input type="checkbox" value="1" name="inputReferralNotif" id="inputReferralNotif" @if(isset($patient) AND $patient->referral_notif == '1') checked='checked' @endif>
                        Receive Referral Notification
                    </label>
                </div>
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" value="1" name="inputNonReferralNotif" id="inputNonReferralNotif" @if(isset($patient) AND $patient->nonreferral_notif == '1') checked='checked' @endif>
                        Receive Non-referral Notification
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="col-md-6">
        <legend>MyShine Account</legend>
        <div class="form-group">
            <p>MyShine is a client base access to personal health record. If client wants to sign up for MyShine, please check the box.</p>

            <div class="col-sm-12">
                <div class="checkbox-inline">
                    <label>
                        <input type="checkbox" value="1" name="inputMyShineAcct" id="inputMyShineAcct" @if(isset($patient) AND $patient->myshine_acct == '1') checked='checked' @endif>
                         MyShine Access
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="col-md-6">
        <legend>Patient Consent</legend>
        <div class="form-group">
            <p>Patient is required to sign a consent form for PHIE Submission. Once it is signed, tick on the box below and 'Submit' to save this record. If patient do not want to be included in the PHIE, do not check this box, just click on 'Save'.</p>

            <div class="col-sm-12">
                <div class="checkbox-inline">
                    <label>
                      <input type="checkbox" value="1" name="inputPatientConsent" id="inputPatientConsent" @if(isset($patient) AND $patient->patient_consent == '1') checked='checked' @endif>
                       Patient Consent
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <input type="hidden" name="record_status" value='1' />

    <br clear="all" />

</div><!-- /.tab-pane -->
