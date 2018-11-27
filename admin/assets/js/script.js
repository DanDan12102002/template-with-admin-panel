
/* *********************** Custom Scripts *********************** */
$(document).ready(function(){
	// SEND FORMS
	$('.send-ajax').click( function() {
		var form = $(this).closest('form');
		
		if ( form.valid() ) {
			form.css('opacity','.5');
			var actUrl = form.attr('action');

			$.ajax({
				url: actUrl,
				type: 'post',
				dataType: 'html',
				data: form.serialize(),
				success: function(data) {
					form.html(data);
					form.css('opacity','1');
				},
				error:	 function() {}
			});
		}
	});
	
	$('.send').click( function() {
		var form = $(this).closest('form');
		
		if ( form.valid() ) {
			form.submit();
		}
	});
	
	
	
	$(".go-to-block").click(function() {
		var target = $(this).data('target');
		
	    $('html, body').animate({
	        scrollTop: $(target).offset().top - 30
	    }, 400);
	});
});/* ******************* End Custom Scripts *********************** */
