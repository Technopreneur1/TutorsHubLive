$('document').ready(function(){



  $('#showmenu').click(function(){
    $('.mobmenu').css('margin-left', '0px');
  });
  $('#hidemenu').click(function(){
    $('.mobmenu').css('margin-left', '-80%');
  });

  $('#services').on("mouseover", function(){
    $('.servicesmenu').toggleClass('menuhide');
  });
  $('.servicesmenu').on("mouseleave", function(){
    $('.servicesmenu').toggleClass('menuhide');
  });

  $('.logedinname').hover(function(){
    $('.ddown').toggleClass('displaynow');
  });

});
