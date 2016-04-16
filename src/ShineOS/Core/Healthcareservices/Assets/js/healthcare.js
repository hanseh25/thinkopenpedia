
var url = '/healthcareservices/add';
var Healthcare = {};




Healthcare.init = function () {
   /*$('select[name=healthcare_services]').on('change', function () {
        window.location = url + '/' + patient_id + '?consultID=' + $(this).val(); 
   });*/


  $("#diag_cat").remoteChained({
     parents : "#diag_parent",
     url : "/healthcareservices/api/diagnosis/lov/category",
  });

  $("#diag_subcat").remoteChained({
      parents : "#diag_cat",
      url : "/healthcareservices/api/diagnosis/lov/subCat",
  });

  $("#diag_subsubcat").remoteChained({
      parents : "#diag_subcat",
      url : "/healthcareservices/api/diagnosis/lov/subsubCat"
  });

  $("#province").remoteChained({
     parents : "#region",
      url : "healthcareservices/province"
   });

  $("#city").remoteChained({
     parents : "#province",
      url : "healthcareservices/city"
   });

  $("#brgy").remoteChained({
     parents : "#city",
      url : "healthcareservices/brgy"
   });

   Healthcare.computeBMI();
   Healthcare.impAndDIag();
   Healthcare.medOrder();


}


Healthcare.computeBMI = function () {
  $('#a').on('keyup', function () {
    console.log('asdsa');
	//$('input[name=height], input[name=weight]').on('keyup', function () {

     //    var row = $(this).closest('.box-border-1p');
     //    var weight = parseInt(row.find('input[name=weight]').val(), 10);
    	// var height = parseInt(row.find('input[name=height]').val(), 10);

    	
    	// var bmi = weight / (height / 100 * height / 100);

    	// $('input[name=bmiResult]').val(isNaN(bmi) ? '' : bmi);
    	// $('input[name=bmi]').val(isNaN(bmi) ? '' : bmi);

   	});
}


Healthcare.impAndDIag = function () {
  $('.impdiag-button').on('click', function (){
    Helper.cloneElement('.clone', $('.parentDiv'));
    $('.parentDiv').find('.clone').show();
  });
}


Healthcare.medOrder = function () {
  $('select[name=order]').on('change', function () {
     $('#medicalorders div.active').removeClass('active').hide();

     var $selected = $(this).val();

     $('#' + $selected).show();
     $('.action').val($selected);
     $('#' + $selected).addClass('active');
  });
}



$(function () {
   Healthcare.init();


});