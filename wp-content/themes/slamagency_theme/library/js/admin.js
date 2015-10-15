

jQuery(document).ready(function(){

	/** Handle the Add Section button.
		
		This adds the name of the new page to the url parameters of the 
		Add Section Button
	 */

	var url = jQuery('#new_page_button').attr('href');
	jQuery('#new_page_button').data('baseurl', url);

	jQuery('#new_page_title').on('change keyup paste mouseup', function(){
		var url = jQuery('#new_page_button').data('baseurl');
		var name = jQuery(this).val();
		var go = url + '&new_page_title=' + name;
		jQuery('#new_page_button').attr('href', encodeURI(go) );
	});



	// jQuery(document).bind('keydown', 'meta+s', function(e){
	// 	e.preventDefault();

	// 	console.log('Save!');
	// 	jQuery('#publish').click(); 
	// });

	jQuery(window).keydown(function (e){
	    if ((e.metaKey || e.ctrlKey) && e.keyCode == 83) { //ctrl+s or command+s
	        jQuery('#publish').click(); 

	        e.preventDefault();
	        return false;
	    }
	});

});