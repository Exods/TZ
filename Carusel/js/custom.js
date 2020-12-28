$(function(){
     $(".menu-button").click(function(){
         $(".header-menu-block").toggleClass("open");
   });
      var owl = $('.owl-carousel');
              owl.owlCarousel({
                margin: 30,
                loop: true,
                dots:true,
                nav:true,
                responsive: {
                  0: {
                    items: 3
                  },
                  600: {
                    items: 3
                  },
                  1300: {
                    items: 4
                  },
                  1500: {
                    items: 4
                  },

                }
              })
});
