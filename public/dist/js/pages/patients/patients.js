var Patients = {};

Patients.init = function ()
{
   Patients.cloneDiv();
   Patients.checkMorbidity(patientId);
   Patients.showChildDiv();

   if($('#wizardForm').length > 0) {
      Patients.wizard();
   }
}

Patients.cloneDiv = function ()
{
  $('.addAllergy-button').on('click', function (){
    Helper.cloneElement('.clone', $('.parentDiv'));
    $('.allergyname').addClass('required').attr('required','required');
          $('.allergyreaction').addClass('required').attr('required','required');
          $('.allergyseverity').addClass('required').attr('required','required');
  });
}

Patients.checkMorbidity = function (patientId)
{
  if(patientId) {
      var url = baseurl + "patients/" + patientId + '/checkPatientMorbidity';

      Helper.ajaxGet(url, [], function(result) {
        if (result == 1)
        {
          $(".patient-form :input, button").attr("disabled", "disabled");
          $('.deadPatient-button').html('DEAD');
        }
      });
  }
}

Patients.showChildDiv = function ()
{
    $('#chk_aller').on('ifChecked', function(event){
      $('#allergies').removeClass('hide');
      $('.allergyname').addClass('required').attr('required','required');
      $('.allergyreaction').addClass('required').attr('required','required');
      $('.allergyseverity').addClass('required').attr('required','required');
    });
    $('#chk_aller').on('ifUnchecked', function(event){
      $('#allergies').addClass('hide');
      $('#allergies .form-control').val("");
      $('.allergyname').removeClass('required').removeAttr('required','required');
      $('.allergyreaction').removeClass('required').removeAttr('required','required');
      $('.allergyseverity').removeClass('required').removeAttr('required','required');

    });

  $('#chk_disab').on('ifChecked', function(event){
        $('#disabilities').removeClass('hide');
  });
  $('#chk_disab').on('ifUnchecked', function(event){
        $('#disabilities').addClass('hide');
        $('#disabilities input').iCheck('uncheck');
  });

  $('#chk_other').on('ifChecked', function(event){
      $('.alert-other').removeClass('hide');
      $('.alert_other_field').addClass('required').attr('required','required');
  });
  $('#chk_other').on('ifUnchecked', function(event){
      $('.alert-other').addClass('hide');
      $('.alert_other_field').removeClass('required').removeAttr('required','required');
  });
}

Patients.wizard = function() {
    $("#step_visualization").on('click','a.disabled', function(e){
        return false;
    })

    //trigger form wizard
    //bind callback to the before_remote_ajax event
    $("#wizardForm").formwizard({
        validationEnabled: true,
        focusFirstInput : true,
        disableUIStyles: true,
        remoteAjax : {"basic" : { // add a remote ajax call when moving next from the first step
            url : baseurl + "patients/check", //checks whether new record already exists
            dataType : 'json',
            beforeSend : function(){},
            complete : function(){},
            success : function(data)
            {
              console.log(data);
                if(data.firstname != "none")
                {
                    $("#results").removeClass("hidden");

                    htmltext = "<h4>Found records with same name and birthdate:</h4>";

                    for(var i=0;i<data.length;i++){
                        var obj = data[i];

                        htmltext = htmltext + "<p><a href='"+baseurl+"patients/"+obj['patient_id']+"' class='ajax-link'>&rsaquo; "+obj['first_name']+" "+obj['last_name']+"</a> - Profiled by: "+obj['facility_name']+"</p>";

                    }

                    $("#results").html(htmltext); //.fadeTo(5000, 0);
                    return false; //return false to stop the wizard from going forward to the next step
                } else {
                    return true; //return true to make the wizard move to the next step
                }
            }
        }}
    });

    // function for appending step visualization
    function addVisualization(id){
        $('#step_visualization li').removeClass("active");
        $("#"+id+"tab").addClass("active");
    }
    // initial call to addVisualization (for visualizing the first step)
    addVisualization($("#wizardForm").formwizard("state").firstStep);

    $("#wizardForm").bind("step_shown", function(event, data){
        if(data.isBackNavigation || !data.isFirstStep){
            var direction = (data.isBackNavigation)?"back":"forward";
        }
        $.each(data.activatedSteps, function(){
            addVisualization(this)
        });

        console.log(event);
    });


}

$(function ()
{
   Patients.init();
});
