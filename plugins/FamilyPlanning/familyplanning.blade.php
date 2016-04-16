<?php
    $hservice_id = $data['healthcareservice_id'];
    $fpservice_id = $data['familyplanning_id'];

    //$data['history_of_following']
?>

<!-- if there's family planning background - make this uneditable proceed to Family Planning -->

{!! Form::model($data, array('url' => 'plugin/call/FamilyPlanning/FamilyPlanning/save/'.$hservice_id,'class'=>'form-horizontal')) !!}
{!! Form::hidden('fpservice_id',$fpservice_id) !!}
{!! Form::hidden('hservice_id',$hservice_id) !!}

    <fieldset>
        <legend> Physical Examination </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <dl class="col-sm-3">   
                        <dt> Conjunctiva </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Conjunctiva" id="" value="Pale" <?php if($data['conjunctiva']=='Pale'){echo "checked";}?> > Pale
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Conjunctiva" id="" value="Yellowish" <?php if($data['conjunctiva']=='Yellowish'){echo "checked";}?> > Yellowish
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Neck </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Neck" id="" value="Enlarged thyroid" <?php if($data['neck']=='Enlarged thyroid'){echo "checked";}?> > Enlarged thyroid
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Neck" id="" value="Enlarged lymph nodes" <?php if($data['neck']=='Enlarged lymph nodes'){echo "checked";}?> > Enlarged lymph nodes
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Breast </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Breast" id="" value="Mass" <?php if($data['breast']=='Mass'){echo "checked";}?> > Mass
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Breast" id="" value="Nipple discharge" <?php if($data['breast']=='Nipple discharge'){echo "checked";}?> > Nipple discharge
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Breast" id="" value="Skin - orange peel or dimpling" <?php if($data['breast']=='Skin - orange peel or dimpling'){echo "checked";}?> > Skin - orange peel or dimpling
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Breast" id="" value="Enlarged axillary lymph nodes" <?php if($data['breast']=='Enlarged axillary lymph nodes'){echo "checked";}?> > Enlarged axillary lymph nodes
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Thorax </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Thorax" id="" value=" Abnormal heart sounds/cardiac rate" <?php if($data['thorax']=='Abnormal heart sounds/cardiac rate'){echo "checked";}?> > Abnormal heart sounds/cardiac rate
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Thorax" id="" value="Abnormal breath sounds/respiratory rate" <?php if($data['thorax']=='Abnormal breath sounds/respiratory rate'){echo "checked";}?> > Abnormal breath sounds/respiratory rate
                                </label>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-sm-12">
                    <dl class="col-sm-3">
                        <dt> Abdomen </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Abdomen" id="" value="Enlarged lever" <?php if($data['abdomen']=='Enlarged lever'){echo "checked";}?> > Enlarged liver
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Abdomen" id="" value="Mass" <?php if($data['abdomen']=='Mass'){echo "checked";}?> > Mass
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Abdomen" id="" value="Tenderness" <?php if($data['abdomen']=='Tenderness'){echo "checked";}?> > Tenderness
                                </label>
                            </div>
                        </dd>
                    </dl>
                   <dl class="col-sm-3">
                        <dt> Extremities </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Extremities" id="" value="Edema" <?php if($data['extremities']=='Edema'){echo "checked";}?> > Edema
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Extremities" id="" value="Varicosities" <?php if($data['extremities']=='Varicosities'){echo "checked";}?> > Varicosities
                                </label>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend> Pelvic Examination </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <dl class="col-sm-3">
                        <dt> Perineum </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Perineum" id="" value="Scars" <?php if($data['perineum']=='Scars'){echo "checked";}?> > Scars
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Perineum" id="" value="Warts" <?php if($data['perineum']=='Warts'){echo "checked";}?> > Warts
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Perineum" id="" value="Reddish" <?php if($data['perineum']=='Reddish'){echo "checked";}?> > Reddish
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Perineum" id="" value="Laceration" <?php if($data['perineum']=='Laceration'){echo "checked";}?> > Laceration
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Vagina </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Congested" <?php if($data['vagina']=='Congested'){echo "checked";}?> > Congested
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Bartholin's Cyst" <?php if($data['vagina']=='Bartholin\'s Cyst'){echo "checked";}?> > Bartholin's Cyst
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Warts" <?php if($data['vagina']=='Warts'){echo "checked";}?> > Warts
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Skene's Cland Discharge" <?php if($data['vagina']=='Skene\'s Cland Discharge'){echo "checked";}?> > Skene's Cland Discharge
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Rectocele" <?php if($data['vagina']=='Rectocele'){echo "checked";}?> > Rectocele
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Vagina" id="" value="Cystocele" <?php if($data['vagina']=='Cystocele'){echo "checked";}?> > Cystocele
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Cervix </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Cervix" id="" value="Congested" <?php if($data['cervix']=='Congested'){echo "checked";}?> > Congested
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Cervix" id="" value="Erosion" <?php if($data['cervix']=='Erosion'){echo "checked";}?> > Erosion
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Cervix" id="" value="Discharge" <?php if($data['cervix']=='Discharge'){echo "checked";}?> > Discharge
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Cervix" id="" value="Polyps/Cysts" <?php if($data['cervix']=='Polyps/Cysts'){echo "checked";}?> > Polyps/Cysts
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Cervix" id="" value="Laceration" <?php if($data['cervix']=='Laceration'){echo "checked";}?> > Laceration
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Consistency </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Consistency" id="" value="Firm" <?php if($data['consistency']=='Firm'){echo "checked";}?> > Firm
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Consistency" id="" value="Solt" <?php if($data['consistency']=='Solt'){echo "checked";}?> > Solt
                                </label>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-sm-12">
                    <dl class="col-sm-3">
                        <dt> Uterus Position </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusPosition" id=""  value="Mid" <?php if($data['uterus_position']=='Mid'){echo "checked";}?> > Mid
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusPosition" id="" value="Antiflexed" <?php if($data['uterus_position']=='Antiflexed'){echo "checked";}?> > Antiflexed
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusPosition" id="" value="Retroflexed" <?php if($data['uterus_position']=='Retroflexed'){echo "checked";}?> > Retroflexed
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Uterus Size </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusSize" id="" value="Normal" <?php if($data['uterus_size']=='Normal'){echo "checked";}?> > Normal
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusSize" id="" value="Small" <?php if($data['uterus_size']=='Small'){echo "checked";}?> > Small
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusSize" id="" value="Large" <?php if($data['uterus_size']=='Large'){echo "checked";}?> > Large
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="UterusSize" id="" value="Mass" <?php if($data['uterus_size']=='Mass'){echo "checked";}?> > Mass
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Uterine Depth (cm) <small> - for intended IUD users </small></dt>
                        <dd>
                            <input type="text" name="UterusDepth" id="" class="form-control" value={{ $data['uterus_depth'] }} >
                        </dd>
                    </dl>
                    <dl class="col-sm-3">
                        <dt> Adnexa </dt>
                        <dd>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Adnexa" id="" value="Mass" <?php if($data['adnexa']=='Mass'){echo "checked";}?> > Mass
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                  <input type="radio" name="Adnexa" id="" value="Tenderness" <?php if($data['adnexa']=='Tenderness'){echo "checked";}?> > Tenderness
                                </label>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend> Obsterical History </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-12 box no-border noboxshadow">
                    <label class="col-sm-12 control-label"> No. of Pregnancies: </label>
                    <dd class="col-sm-3">
                        <small> Full Term </small>
                        <input type="text" class="form-control" name="FullTerm"  placeholder="" value={{ $data['full_term'] }}>
                    </dd>
                    <dd class="col-sm-3">
                        <small> Abortions </small>
                        <input type="text" class="form-control" name="Abortions"  placeholder="" value={{ $data['abortions'] }}>
                    </dd>
                    <dd class="col-sm-3">
                        <small> Premature </small>
                        <input type="text" class="form-control" name="Premature"  placeholder="" value={{ $data['premature'] }}>
                    </dd>
                    <dd class="col-sm-3">
                        <small> Living Children </small>
                        <input type="text" class="form-control" name="LivingChildren"  placeholder="" value={{ $data['living_children'] }}>
                    </dd>
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label"> Date of last delivery </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="DateOFLastDelivery"  placeholder="" value={{ $data['date_of_last_delivery'] }}>
                    </div>
                    <label class="col-sm-2 control-label"> Type of last delivery </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="TypeOfLastDelivery"  placeholder="" value={{ $data['type_of_last_delivery'] }}>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label"> Past menstrual period </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="PastMenstrualPeriod"  placeholder="" value={{ $data['past_menstrual_period'] }}>
                    </div>
                    <label class="col-sm-2 control-label"> Last menstrual period </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="LastMenstrualPeriod"  placeholder="" value={{ $data['last_menstrual_period'] }}>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label"> Number of days menses </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="NumberOfDaysMenses"  placeholder="" value={{ $data['number_of_days_menses'] }}>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-2 control-label"> Character of menses</label>
                    <div class="col-sm-10">
                        <div class="radio inline">
                                <label>
                                  <input type="radio" name="CharacterofMenses" id="" value="Scanty" <?php if($data['character_of_menses']=="Scanty"){echo "checked";}?> > Scanty
                                </label>
                            </div>
                            <div class="radio inline">
                                <label>
                                  <input type="radio" name="CharacterofMenses" id="" value="Painful" <?php if($data['character_of_menses']=="Painful"){echo "checked";}?> > Painful
                                </label>
                            </div>
                            <div class="radio inline">
                                <label>
                                  <input type="radio" name="CharacterofMenses" id="" value="Moderate" <?php if($data['character_of_menses']=="Moderate"){echo "checked";}?> > Moderate
                                </label>
                            </div>
                            <div class="radio inline">
                                <label>
                                  <input type="radio" name="CharacterofMenses" id="" value="Regular" <?php if($data['character_of_menses']=="Regular"){echo "checked";}?> > Regular
                                </label>
                            </div>
                            <div class="radio inline">
                                <label>
                                  <input type="radio" name="CharacterofMenses" id="" value="Heavy" <?php if($data['character_of_menses']=="Heavy"){echo "checked";}?> > Heavy
                                </label>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend> History of any of the following  </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <dl class="col-sm-12">
                    <dd>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="HistoryOfAnyOfTheFollowing[]" id="" value="Hydatidiform mole (within the last 12 months)"
                                    <?php
                                        foreach(explode(",", $data['history_of_following']) as $value)
                                        {
                                            if($value=="Hydatidiform mole (within the last 12 months)")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                                > Hydatidiform mole (within the last 12 months)
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="HistoryOfAnyOfTheFollowing[]" id="" value="Ectopic Pregnancy"
                                    <?php
                                        foreach(explode(",", $data['history_of_following']) as $value)
                                        {
                                            if($value=="Ectopic Pregnancy")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                              > Ectopic Pregnancy
                            </label>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend> STI Risks  </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <dl class="col-sm-12">
                    <dd>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="WithHistoryOfMultiplePartners" id="" value="Yes" <?php if($data['with_history_of_multiple_partners']=="Yes"){echo "checked";} ?> > With History of multiple partners
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-6">
                    <dt> For Women </dt>
                    <dd>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksWomen[]" id="" value="Unusual discharge from vagina"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_women']) as $value)
                                        {
                                            if($value=="Unusual discharge from vagina")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Unusual discharge from vagina
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksWomen[]" id="" value="Itching or sores in or around vagina"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_women']) as $value)
                                        {
                                            if($value=="Itching or sores in or around vagina")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Itching or sores in or around vagina
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksWomen[]" id="" value="Pain or burning sensation"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_women']) as $value)
                                        {
                                            if($value=="Pain or burning sensation")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Pain or burning sensation
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksWomen[]" id="" value="Treated for STIs in the past"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_women']) as $value)
                                        {
                                            if($value=="Treated for STIs in the past")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                              > Treated for STIs in the past
                            </label>
                        </div>
                    </dd>
                </dl>
                <dl class="col-sm-6">
                    <dt> For Men </dt>
                    <dd>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksMen[]" id="" value="Pain or burning sensation"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_men']) as $value)
                                        {
                                            if($value=="Pain or burning sensation")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Pain or burning sensation
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksMen[]" id="" value="Open sores anywhere in genital area"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_men']) as $value)
                                        {
                                            if($value=="Open sores anywhere in genital area")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Open sores anywhere in genital area
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksMen[]" id="" value="Pus coming from penis"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_men']) as $value)
                                        {
                                            if($value=="Pus coming from penis")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Pus coming from penis
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksMen[]" id="" value="Swollen testicles or penis"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_men']) as $value)
                                        {
                                            if($value=="Swollen testicles or penis")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Swollen testicles or penis
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="STIRisksMen[]" id="" value="Treated for STIs in the past"
                                    <?php
                                        foreach(explode(",", $data['sti_risks_men']) as $value)
                                        {
                                            if($value=="Treated for STIs in the past")
                                            {
                                                echo "checked";
                                            }
                                        }   
                                    ?>
                               > Treated for STIs in the past
                            </label>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend> Risks for violence against women (VAW)  </legend>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ViolenceAgainstWomen[]" id="" value="History of domestic violence or VAW"
                            <?php
                                foreach(explode(",", $data['violence_against_women']) as $value)
                                {
                                    if($value=="History of domestic violence or VAW")
                                    {
                                        echo "checked";
                                    }
                                }   
                            ?>
                       > History of domestic violence or VAW
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ViolenceAgainstWomen[]" id="" value="Unpleasant relationship with partner"
                            <?php
                                foreach(explode(",", $data['violence_against_women']) as $value)
                                {
                                    if($value=="Unpleasant relationship with partner")
                                    {
                                        echo "checked";
                                    }
                                }   
                            ?>
                       > Unpleasant relationship with partner
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ViolenceAgainstWomen[]" id="" value="Partner does not approve of the visit to Family Planning"
                            <?php
                                foreach(explode(",", $data['violence_against_women']) as $value)
                                {
                                    if($value=="Partner does not approve of the visit to Family Planning")
                                    {
                                        echo "checked";
                                    }
                                }   
                            ?>
                       > Partner does not approve of the visit to Family Planning 
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ViolenceAgainstWomen[]" id="" value="Partner disagrees to use Family Planning"
                            <?php
                                foreach(explode(",", $data['violence_against_women']) as $value)
                                {
                                    if($value=="Partner disagrees to use Family Planning")
                                    {
                                        echo "checked";
                                    }
                                }   
                            ?>
                       > Partner disagrees to use Family Planning
                    </label>
                </div>
            </div>
            <div class="col-sm-12">
                <dl class="col-sm-12">
                    <dt> Referred to </dt>
                    <dd>
                        <div class="checkbox inline">
                            <label>
                              <input type="checkbox" name="Referredto[]" id="" value="DSWD"
                                <?php
                                    foreach(explode(",", $data['referred_to']) as $value)
                                    {
                                        if($value=="DSWD")
                                        {
                                            echo "checked";
                                        }
                                    }   
                                ?>
                              > DSWD
                            </label>
                        </div>
                        <div class="checkbox inline">
                            <label>
                              <input type="checkbox" name="Referredto[]" id="" value="WCPU"
                                <?php
                                    foreach(explode(",", $data['referred_to']) as $value)
                                    {
                                        if($value=="WCPU")
                                        {
                                            echo "checked";
                                        }
                                    }   
                                ?>
                              > WCPU
                            </label>
                        </div>
                        <div class="checkbox inline">
                            <label>
                              <input type="checkbox" name="Referredto[]" id="" value="NGOs"
                                <?php
                                    foreach(explode(",", $data['referred_to']) as $value)
                                    {
                                        if($value=="NGOs")
                                        {
                                            echo "checked";
                                        }
                                    }   
                                ?>
                              > NGOs
                            </label>
                        </div>
                        <div class="checkbox inline">
                            <label>
                              <input type="checkbox" name="Referredto[]" id="" value="Others"
                                <?php
                                    foreach(explode(",", $data['referred_to']) as $value)
                                    {
                                        if($value=="Others")
                                        {
                                            echo "checked";
                                        }
                                    }   
                                ?>
                              > Others
                            </label>
                        </div>
                        <div class="checkbox inline">
                            <label>
                              <input type="text" class="form-control" name="ReferredtoOthers"  placeholder="" value={{ $data['referred_to_others'] }}>
                            </label>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </fieldset>
    <!-- // -->


    <!-- Family Planning -->
    <fieldset>
        <legend>Family Planning</legend>   
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> Planning Start </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="PlanningStart" class="form-control" value={{ $data['planning_start'] }}>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> No. of Living Children </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="NoOfLivingChildren"  placeholder="" value={{ $data['no_of_living_children'] }}>
                </div>
                <label class="col-sm-2 control-label"> Plan more children? </label>
                <div class="col-sm-4">
                    <div class="radio inline">
                        <label>
                          <input type="radio" name="PlanMoreChildren" id="" value="yes" <?php if($data['plan_more_children']=="yes"){echo "checked";} ?> > yes
                        </label>
                    </div>
                    <div class="radio inline">
                        <label>
                          <input type="radio" name="PlanMoreChildren" id="" value="no" <?php if($data['plan_more_children']=="no"){echo "checked";} ?> > no
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> Reason for practicing FP </label>
                <div class="col-sm-10">
                    <textarea class="form-control noresize" placeholder="" name="ReasonForPracticingFP">{{ $data['reason_for_practicing_fp'] }}</textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> Client Type </label>
                <div class="col-sm-4">
                    <select class="form-control" name="ClientType">
                        <option value="">-- Select --</option>
                        <option value="CU" <?php if($data['client_type']=="CU"){echo "selected";} ?> >Current User</option>
                        <option value="NA" <?php if($data['client_type']=="NA"){echo "selected";} ?> >New Acceptor</option>
                    </select>
                </div>
                <!-- if client type = CU -->
                <label class="col-sm-2 control-label"> Client Sub Type </label>
                <div class="col-sm-4">
                    <select class="form-control" name="ClientSubType">
                        <option value="">-- Select --</option>
                        <option value="CC" <?php if($data['client_sub_type']=="CC"){echo "selected";} ?> >Changing Clinic</option>
                        <option value="CM" <?php if($data['client_sub_type']=="CM"){echo "selected";} ?> >Changing Method</option>
                        <option value="RS" <?php if($data['client_sub_type']=="RS"){echo "selected";} ?> >Restart</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> Previous Method </label>
                <div class="col-sm-4">
                    <select name="PreviousMethod" class="form-control">
                        <option selected="selected" value="">-- Select --</option>
                        <option value="CON" <?php if($data['previous_method']=="CON"){echo "selected";} ?> >Condom</option>
                        <option value="FSTR/BTL" <?php if($data['previous_method']=="FSTR/BTL"){echo "selected";} ?> >Female Sterilization/Bilateral Tubal Ligation</option>
                        <option value="INJ" <?php if($data['previous_method']=="INJ"){echo "selected";} ?> >Depo-medroxy Progestone Acetate</option>
                        <option value="UD" <?php if($data['previous_method']=="UD"){echo "selected";} ?> >Intra-Uterine Device</option>
                        <option value="MSTR/VASECTOMY" <?php if($data['previous_method']=="MSTR/VASECTOMY"){echo "selected";} ?> >Male Sterilization/Vasectomy</option>
                        <option value="NFP-BBT" <?php if($data['previous_method']=="NFP-BBT"){echo "selected";} ?> >NFP-Basal Body Temperature</option>
                        <option value="NFP-CM" <?php if($data['previous_method']=="NFP-CM"){echo "selected";} ?> >NFP-Cervical Mucus Method</option>
                        <option value="NFP-LAM" <?php if($data['previous_method']=="NFP-LAM"){echo "selected";} ?> >Lactational Amenorrhea Method</option>
                        <option value="NFP-SDM" <?php if($data['previous_method']=="NFP-SDM"){echo "selected";} ?> >NFP-Standard Days Method</option>
                        <option value="NFP-STM" <?php if($data['previous_method']=="NFP-STM"){echo "selected";} ?> >NFP-Sympothermal Method</option>
                        <option value="PILLS" <?php if($data['previous_method']=="PILLS"){echo "selected";} ?> >Pills</option>
                        <option value="IMPLANT" <?php if($data['previous_method']=="IMPLANT"){echo "selected";} ?> >Implant</option>
                    </select>
                </div>
                <label class="col-sm-2 control-label"> Current Method </label>
                <div class="col-sm-4">
                    <select name="CurrentMethod" class="form-control">
                        <option selected="selected" value="">-- Select --</option>
                        <option value="CON" <?php if($data['current_method']=="CON"){echo "selected";} ?> >Condom</option>
                        <option value="FSTR/BTL" <?php if($data['current_method']=="FSTR/BTL"){echo "selected";} ?> >Female Sterilization/Bilateral Tubal Ligation</option>
                        <option value="INJ" <?php if($data['current_method']=="INJ"){echo "selected";} ?> >Depo-medroxy Progestone Acetate</option>
                        <option value="UD" <?php if($data['current_method']=="UD"){echo "selected";} ?> >Intra-Uterine Device</option>
                        <option value="MSTR/VASECTOMY" <?php if($data['current_method']=="MSTR/VASECTOMY"){echo "selected";} ?> >Male Sterilization/Vasectomy</option>
                        <option value="NFP-BBT" <?php if($data['current_method']=="NFP-BBT"){echo "selected";} ?> >NFP-Basal Body Temperature</option>
                        <option value="NFP-CM" <?php if($data['current_method']=="NFP-CM"){echo "selected";} ?> >NFP-Cervical Mucus Method</option>
                        <option value="NFP-LAM" <?php if($data['current_method']=="NFP-LAM"){echo "selected";} ?> >Lactational Amenorrhea Method</option>
                        <option value="NFP-SDM" <?php if($data['current_method']=="NFP-SDM"){echo "selected";} ?> >NFP-Standard Days Method</option>
                        <option value="NFP-STM" <?php if($data['current_method']=="NFP-STM"){echo "selected";} ?> >NFP-Sympothermal Method</option>
                        <option value="PILLS" <?php if($data['current_method']=="PILLS"){echo "selected";} ?> >Pills</option>
                        <option value="IMPLANT" <?php if($data['current_method']=="IMPLANT"){echo "selected";} ?> >Implant</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <label class="col-sm-2 control-label"> Remarks </label>
                <div class="col-sm-10">
                    <textarea class="form-control noresize" placeholder="" name="Remarks" >{{ $data['remarks'] }}</textarea>
                </div>
            </div>
        </div>
    </fieldset>

     <div class="form-group pull-right ">   
        <button type="submit" value="submit" class="btn btn-success">Save Family Planning</button>
    </div>

{!! Form::close() !!}