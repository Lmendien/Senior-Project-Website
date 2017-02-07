$(document).on('click', '.menu-toggle', function() {
    $(this).find(".menu-bar").toggleClass('menu-active');
});

$('.carousel').carousel({
  interval: false
});
