// $(function() {
//     $(document).scroll(function () {
//         let $nav = $(".navbar-fixed-top");
//         $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
//     })
// })

$(window).scroll(function() {
    var navbar = $('.navbar');
    navbar.toggleClass('sticky', $(window).scrollTop() > 0);
  });