 // Used on the Historical Data Page to change the title of the dropdown according to the content
$('.option').on("click", function(event) {
  $('.historical-data a.dropdown-toggle').text($(event.target).text()).append('&nbsp;<span class="caret"></span>');
});

// Scroll to a certain element
$("#scroll-down").click(function () {
	event.preventDefault();

	$('html, body').animate({
        scrollTop: $("#scroll-down").offset().top
    }, 500);
});