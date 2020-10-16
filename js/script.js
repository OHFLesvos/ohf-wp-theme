(function($) {
	
	$('.burger').click(function() {
		$( "#menu" ).toggleClass( 'display' );
	});
	
	$('.burger_close').click(function() {
		$( "#menu" ).toggleClass( 'display' );
	});
	
	
})( jQuery );


// Show more button
(function($) {
	$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
	});
	
	
	$('.load_more').click(function() {
		$( ".additional_item" ).toggleClass( 'hidden' );
		$(this).toggleText('Show all', 'Show less');

	});
	
	
	
	
	
})( jQuery );




// Action block
(function($) {
  
  $('.bg_image_with_action_btn button').click(function() {
		$( ".action_buttons a" ).toggleClass( 'display' );
	});
})( jQuery );