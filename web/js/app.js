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
    $(this).hide("fast");
    $(".article-content").hide("fast");
    $(".comments").hide("fast");
    $(".delete-article-button").hide("fast");
    $(".article-change-content").show("fast");
    $(".cancel-button").show("fast");
  });

  $(".cancel-button").click(function(){
    document.location.reload();
  });

  $('.delete-article-button').click(function(){
    if(confirm("Вы уверены? Операция необратима. Все комментарии и данные будут утрачены!"))
      return true;
    else
      return false;
  });

  $('.screen-lock').click(function(){
    $(this).hide("fast");
    $('.subscribe-container').hide("fast");
  });

  $('#subscribe-link').click(function(){
    $(".screen-lock").show("fast");
    $(".subscribe-container").show("fast");
    $(".subscribe-container").find("#subscribe-form").show();
    $(".subscribe-container").find("#unsubscribe-form").hide();
    return false;
  });

  $('#unsubscribe-link').click(function(){
    $(".screen-lock").show("fast");
    $(".subscribe-container").show("fast");
    $(".subscribe-container").find("#subscribe-form").hide();
    $(".subscribe-container").find("#unsubscribe-form").show();
    return false;
  });


});