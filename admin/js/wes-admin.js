(function( $ ) {

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
$( function() {
    $( "#wes-sortable" ).sortable({
    	axis: 'y',
        containment: "parent",
    	update: function( event, ui ) {
    		var profile_array = [];
	        $('.wes-option-wrapper input[type="checkbox"]').each(function(){
	        profile_array.push($(this).attr('data-key')) ;
	        });
	        var social_networks_orders = profile_array.join(',');
	        $('#wes_social_order').val(social_networks_orders);
    	}
    });
  });
	 $('.wes-tab-trigger').click(function(){
           $('.wes-tab-trigger').removeClass('nav-tab-active');
           $(this).addClass('nav-tab-active');
           var configuration = $(this).data('configuration');
           $('.wes-configurations').hide();
           $('.wes-'+configuration+'-configurations').show();
    	});



})( jQuery );
