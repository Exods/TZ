$(function(){
  $('.bxslider').bxSlider({
    mode: 'fade',
    captions: false,
    slideWidth: 1270,
    adaptiveHeight:true,
    responsive:true,
    pager:true,
    controls: true,
    nextText: '<img src="img/NEXT.png">',
    prevText: '<img src="img/PREV.png">'
  });
  $('.slider').slick({
     infinite: true,
     slidesToShow: 2,
     slidesToScroll: 2,
     adaptiveHeight:true,
     responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          infinite: true,
          slidesToScroll: 1,
          adaptiveHeight:true
        }
      }
    ]
  });
});
