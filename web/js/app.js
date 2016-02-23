$(document).ready(function(){
  $("#change-category").find("select").change(function(){
    $("#change-category").submit();
  });

  $("#sub_category").change(function(){
    $("#sub_id").val($("#sub_category").val());
  });

  $("#cat_id").val($("#category_id").val());
  $("#sub_id").val($("#sub_category").val());

  $(".change-article-button").click(function(){
    $(".article-content").hide("fast");
    $(".article-change-content").show("fast");
  });

});