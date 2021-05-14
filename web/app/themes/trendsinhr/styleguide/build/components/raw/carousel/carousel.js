$(window).on("load", function() {

  $('.carousel').carousel();
  $('.carousel-control-prev').click(function() {
    $('.carousel').carousel('prev');
  });
  $('.carousel-control-next').click(function() {
    $('.carousel').carousel('next');
  });

  $('.carousel-indicators li').click(function() {
    var number = parseInt( $(this).attr('data-slide-to') );
    $('.carousel').carousel(number);
  });

});
