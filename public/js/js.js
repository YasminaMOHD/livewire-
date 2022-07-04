/*scroll top button*/
var start_scroll_button=$('header').outerHeight();
$(window).scroll(function () {
   if($(this).scrollTop()>start_scroll_button){
      $('.top-button').fadeIn();
   }else {
       $('.top-button').fadeOut();
   }
})
$('.top-button').click(function () {
   $('html , body').animate({
       scrollTop:0
   },1000);
})
