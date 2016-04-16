
var url = '/healthcareservices/add';
var Healthcare = {};

Healthcare.init = function () {
   $('#healthcare_services').on('change', function () {
        if($(this).val() == 'general_consultation') {
            $('#medicalcategory').removeClass("hidden");
        } else {
            $('#medicalcategory').addClass("hidden");
        }
   });
  $('#consuTypeNewAdmit').on('click', function () {
        $('#inPatient').addClass("active");
        $('#inPatient input').attr("checked","checked");
        $('#outPatient').removeClass("active");
        $('#outPatient input').removeAttr("checked");
   });
  $('#consuTypeNewConsu').on('click', function () {
        $('#inPatient').removeClass("active");
        $('#inPatient input').removeAttr("checked");
        $('#outPatient').addClass("active");
        $('#outPatient input').attr("checked","checked");
   });
  $('#consuTypeFollow').on('click', function () {
        $('#inPatient').removeClass("active");
        $('#inPatient input').removeAttr("checked");
        $('#outPatient').addClass("active");
        $('#outPatient input').attr("checked","checked");
   });
  $("#diag_cat").remoteChained({
     parents : "#diag_parent",
     url : baseurl+"/lov/api/diagnosis/category",
     loading : "Loading . . ."
  });

  $("#diag_subcat").remoteChained({
      parents : "#diag_cat",
      url : baseurl+"/lov/api/diagnosis/subCat",
      loading : "Loading . . ."
  });

  $("#diag_subsubcat").remoteChained({
    parents : "#diag_subcat",
    url : baseurl+"/lov/api/diagnosis/subsubCat",
    loading : "Loading . . ."
  });

   Healthcare.computeBMI();
   Healthcare.impAndDIag();
   Healthcare.medOrder();

   if($(".diagnosis_input").length > 0) {
       Healthcare.diagAutoComplete();
   }

   if($(".procedure_input").length > 0) {
       Healthcare.proceedureAutoComplete();
   }
}

Healthcare.diagAutoComplete = function () {
    var c = 0;
    var diagnosisforms = $('.diagnosis_input');
    diagnosisforms.each(function() {
        $( "#diagnosis_input"+c ).autocomplete({
            source: availableTags
        });
        c++;
    })
}

Healthcare.proceedureAutoComplete = function () {
    var c = 0;
    var procforms = $('.procedure_input');
    procforms.each(function() {
        $( ".procedure_input" ).autocomplete({
            source: availableProcedures
        });
        c++;
    })
}

Healthcare.fireDiagAutoComplete = function()
{
    var diagnosisforms = $('.diagnosis_input');
    $( ".diagnosis_input" ).autocomplete({
        source: availableTags
    });
}
Healthcare.fireProcedureAutoComplete = function(id)
{
    var procforms = $('.procedure_input');
    procforms.each(function() {
        $( "#procedure_input"+id ).autocomplete({
            source: availableProcedures
        });
    })
}
Healthcare.computeBMI = function () {
    if($('input[name="height"]').val() != '' && $('input[name="weight"]').val() != '') {
        var weight = $('input[name="weight"]').val();
        var height = $('input[name="height"]').val();
        var bmi = weight / (height / 100 * height / 100);
        bmi = Math.round(bmi * 100) / 100;
        $('input[name=bmiResult]').val(isNaN(bmi) ? '' : bmi);
        $('input[name=bmi]').val(isNaN(bmi) ? '' : bmi);
    }

    $('input[name="height"], input[name="weight"]').on('keyup keydown keypress click change', function () {
        var weight = $('input[name="weight"]').val();
        var height = $('input[name="height"]').val();
        var bmi = weight / (height / 100 * height / 100);
        bmi = Math.round(bmi * 100) / 100;
        $('input[name=bmiResult]').val(isNaN(bmi) ? '' : bmi);
        $('input[name=bmi]').val(isNaN(bmi) ? '' : bmi);
    });
}

Healthcare.impAndDIag = function () {
  var count = 0;
  //let us count all forms
  count = $('.diagnosis_input').length - 1;
  if (count>0)  $('.deleteRow').removeAttr('disabled');
  else $('.deleteRow').attr('disabled', 'disabled');

  $("select[id=diagnosisType]").on('change', function() {
    var value = $.trim( this.value );
    // console.log('value '+value);

    if(this.value == 'FINDX') {
      $("#FinalDiagnosis").removeClass("hidden");
      $("option[value='FINDX']").addClass("hidden");
      $(".addRow").addClass("hidden");
    } else {
      $("#FinalDiagnosis").addClass("hidden");
      $("option[value='FINDX']").removeClass("hidden");
      $(".addRow").removeClass("hidden");
    }
  });

  $('.addRow').click(function() {
        //remove autocomplete first
        $('.diagnosis_input').autocomplete('destroy');
        var $clone = $('.impanddiag:eq(0)').clone(true);
        $clone.find('.form-control').val("");
        $clone.find('input[type=hidden]').val("");
        $clone.find('div.active').hide().removeClass('active');
        console.log('count '+count);
        var idcounter = ++count;
        $clone.attr('id', "added"+idcounter);
        $('.impanddiag').last().after($clone);
        $clone.find('.deleteRow').removeClass('hidden');
        $('.deleteRow').removeAttr('disabled');
        $clone.find('.diagnosis_input').attr('id','diagnosis_input'+idcounter);
        //reinit autocomplete
        Healthcare.fireDiagAutoComplete();
  });

  $('.deleteRow').click(function(){
    $('#added'+(count--)).remove();
    if (count>0)  $('.deleteRow').removeAttr('disabled');
    else $('.deleteRow').attr('disabled', 'disabled');
    $("#FinalDiagnosis").addClass("hidden");
    $(".addRow").removeClass("hidden");
  });

}

Healthcare.medOrder = function () {
  var count = 1;
  $('select[id=medorders]').on('change', function() {
      var $selected = $(this).val();

      //check of this is a new form
      var formCount = $('.dynamic-content.hidden').length;
      if(formCount == 1) {
          $('.dynamic-content').removeClass('hidden');
          $('.dynamic-content').find('div.form-add').addClass('hidden');
          $('.dynamic-content').find('div.'+$selected).removeClass('hidden');
          $('.dynamic-content').find('input[name="insert[type][]"]').attr('value', $selected);
          $('.dynamic-content').find('.procedure_input').attr('id','procedure_input1');
          Healthcare.fireProcedureAutoComplete(1);
      } else {
          var $clone = $('.dynamic-content:eq(-1)').clone(true);
          $clone.removeClass('hidden');
          console.log('count '+count);
          var idcounter = ++count;
          $clone.attr('id', "added"+idcounter);
          $clone.find('.form-control').val("");
          $clone.find('div.form-add').addClass('hidden');
          $clone.find('div.'+$selected).removeClass('hidden');
          $clone.find('input[name="insert[type][]"]').attr('value', $selected);

          $clone.find('.rmvbtn').attr('id','rmvbtn'+idcounter);
          $clone.find('#rmvbtn'+idcounter).removeClass('hidden');
          $('.dynamic-content').last().after($clone);

          $clone.find('#rmvbtn'+idcounter).click(function(){
              //$('#added'+idcounter).remove();
              $(this).parents('.dynamic-content').remove();
              if (count>1)  $('#rmvbtn').removeAttr('disabled');
              else $('#rmvbtn').attr('disabled', 'disabled');
          });

          if($selected == 'MO_PROCEDURE') {
            $clone.find('.procedure_input').attr('id','procedure_input'+idcounter);
            Healthcare.fireProcedureAutoComplete(idcounter);
          }
      }
      if($selected == 'MO_LAB_TEST') {
          $('#medorders').find('[value="MO_LAB_TEST"]').remove();
      }

      $('#medorders').prop('selectedIndex', 0);
  });

  $('#regimenothers0').change(function(e) {
      var value = $.trim( this.value );
      //console.log('value '+value);
      if(value=='OTH') {
        $("#forregimenothers0").removeClass("hidden");
      } else {
        $("#forregimenothers0").addClass("hidden");
      }
  });

  $('.rmvbtn').click(function(){
        $(this).parent().parent().parent().parent().remove();
        if (count>1)  $('#rmvbtn').removeAttr('disabled');
        else $('#rmvbtn').attr('disabled', 'disabled');
    });

}



$(function () {
   Healthcare.init();
});
