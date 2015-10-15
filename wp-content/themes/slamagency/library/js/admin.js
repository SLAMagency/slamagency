jQuery(document).ready(function(){

	var url = jQuery('#new_page_button').attr('href');
	jQuery('#new_page_button').data('baseurl', url);

	jQuery('#new_page_title').on('change keyup paste mouseup', function(){
		var url = jQuery('#new_page_button').data('baseurl');
		var name = jQuery(this).val();
		var go = url + '&new_page_title=' + name;
		jQuery('#new_page_button').attr('href', encodeURI(go) );
	});


	// Remap 
    function KeyPress(e) {
          var evtobj = window.event? event : e
          if (evtobj.keyCode == 83 && evtobj.metaKey) {
              //alert("Command+z");
              evtobj.preventDefault();
              $('form#post').submit();
              //$('form#customize-controls').submit();
          }
    }

    document.onkeydown = KeyPress;

});