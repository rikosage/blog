$(document).ready(function(){
  $("#change-category").find("select").change(function(){
    $("#change-category").submit();
  });

  $("#sub_category").change(function(){
    $("#sub_id").val($("#sub_category").val());
  });

  $("#sub_id").val($("#sub_category").val());
});