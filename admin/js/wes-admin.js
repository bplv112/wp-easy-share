(function( $ ) {

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
