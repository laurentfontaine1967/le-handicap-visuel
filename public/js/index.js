
 $("#contrast").click(function(){   
  $("body").addClass('ajout')
  $("body").removeClass('image')
  $("#contrast").hide();
  $("#return_view").show();

})


$("#return_view").click(function(){   
 
  $("body").removeClass('ajout')
  $("body").addClass('image')
  $("#return_view").hide();
  $("#contrast").show();
})


