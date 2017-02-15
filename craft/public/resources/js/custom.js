$(document).on('click', '.menu-toggle', function() {
    $(this).find(".menu-bar").toggleClass('menu-active');
});

// $('.carousel').carousel({
//   interval: false;
// });

// $(document).ready(function() {  
// 	$("#annoucementsCarousel").swiperight(function() {  
// 	    $("#annoucementsCarousel").carousel('prev');  
// 	});  
// 	$("#annoucementsCarousel").swipeleft(function() {  
// 	    $("#annoucementsCarousel").carousel('next');  
// 	});  
// });  

// Used on the Historical Data Page to change the title of the dropdown according to the content
$('.option').on("click", function(event) {
  $('a.dropdown-toggle').text($(event.target).text()).append('&nbsp;<span class="caret"></span>');
});