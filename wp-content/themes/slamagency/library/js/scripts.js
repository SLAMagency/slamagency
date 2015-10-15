/*
Joints Scripts File

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/
// @codekit-prepend "jquery.transit.min.js"
// @codekit-prepend "jquery.fitvids.js" 

 
$(function() {
  $('a.scroll[href*=#]:not([href=#]), a.icon-button[href*=#]:not([href=#])').click(function() {
    console.log('click');
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 400);
        return false;
      }
    }
  });
});

// as the page loads, call these scripts
jQuery(document).ready(function($) {
	// load Foundation
	jQuery(document).foundation();
	
    // load gravatars
    $('.comment img[data-gravatar]').each(function(){
        $(this).attr('src',$(this).attr('data-gravatar'));
    });
    

// add all your scripts here
// 


    $('#nav-icon1').click(function(){
        $(this).toggleClass('open');
        $('#menu').toggleClass('open');
    });

     $('.message-section .linked-play-button').each(function(){
        button = $(this);
        destination = button.data('div');
        var id = button.data('videoid');
        var url = button.attr('href');
        button.attr('href','#'+destination);
        console.log(id);
        button.click(function(){

            button.addClass('loading').find('.fi-play').removeClass('fi-play');

            console.log(id);
            $('#'+id).each(function(){

                 var src = $(this).data('src');

                 //$('.message-section .section_background_image').fadeOut();

                $(this)
                    .attr('src', src)
                    .load(function(){
                        $(this)
                            .attr('width', 640)
                            .attr('height', 360)
                            .removeClass('hide')
                            .show()
                            
                            .closest('div')
                            //.addClass('flex-video')
                            .closest('.message-section')
                            .addClass('active');
                            //.addClass('flex-video');
                            //.fitVids();
                            //
                        
                       
                    });
                
                
                            
            });
        })
        
        


     });


    // -------------------------------------------
    // Message Player Controls
    // -------------------------------------------
    // Play Audio files on sermon pages with a more obvious button.
    // 
    // 
    $('.linked-play-audio-button').click(function(){
        var player = $(this).data('player');
        $(player + ' .mejs-playpause-button button').trigger('click');
    });

    // Play Video files on sermon pages with a more obvious button.
    $('.linked-play-video-button').click(function(){
        var player = $(this).data('player');
        $(player + ' a.loadvideo').trigger('click');
    });


    // -------------------------------------------
    // Load embeded videos when clicked
    // -------------------------------------------
    $('.loadvideo').click(function(){
        var id = $(this).data('id');
        var width = $(this).width();
        var height = $(this).height();



        $(this).hide();
        $('#'+id).each(function(){
            $(this)
                .attr('width', 640)
                .attr('height', 360)
                .show()


            var src = $(this).data('src');
            $(this).attr('src', src).closest('div').fitVids();
        });

    });


    // -------------------------------------------
    // Open jpgs in a modal
    // -------------------------------------------
    var modal = $('#ajax-modal');

    if( modal.length < 1) {

        $('body').append('<div id="ajax-modal" style="max-width: 600px;" class="reveal-modal columns medium-8"><a class="close-reveal-modal">&#215;</a></div>');
        modal = $('#ajax-modal');

    }
    $('a[href$=".jpg"]').click(function(e){

        e.preventDefault();
        url = $(this).attr('href');

        close = '<a class="close-reveal-modal">&#215;</a>';
        content = '<img src="' + url + '"/>' + close;


        $('#ajax-modal')
            .html(content)
            .foundation('reveal','open');

    });




    // -------------------------------------------
    // Parallax Effect
    // -------------------------------------------
    // 
    // 
    $('.parallax').each(function(){



            var section = $(this);
            var H = section.height();
            var I = section.offset().top;
            var image = section.find('.section_background_image');
            //alert(image);

            var W = $(window).height();
            var imageH;
        

            var par = image; 

               

                    imageH = par.height();

                    var I = section.offset().top;
                    var H = section.height();
                    var x = $(window).scrollTop();


                    if (H > imageH) {

                        var factor = (H/imageH)*1.5;
                        par.css({ scale: factor });
                        imageH = par.height();

                    }
                    //var distance = imageH - H;

                    var yPos = (1/(W+H))*(x-(I-W));

                    
                    var distance = imageH - H;

                    yPos = (yPos*distance);
                    par.css({y: yPos-100});
                    //par.css({top: yPos-200 + 'px'});
                    //console.log('I: ' +I + ' W: ' + W + ' H: ' + H + ' x: ' + x + ' imageH: ' + imageH + ' yPos: ' + yPos);

                

                // Throttled resize function
                //$(window).scroll(function(e){
                function animateStuff() {

                    window.requestAnimationFrame(function(){
                       
                        var x = $(window).scrollTop();
                        var yPos = (1/(W+H))*(x-(I-W)).toFixed(1);

                        yPos = (yPos*distance).toFixed(1);
                        
                        par.css({y: yPos-100});

                        //console.log('I: ' +I + ' W: ' + W + ' H: ' + H + ' x: ' + x + ' imageH: ' + imageH + ' yPos: ' + yPos);

                    });
                    
                };

                scrollIntervalID = setInterval(animateStuff, 1000/120);
            


    });

    // -------------------------------------------
    // AJAX POST SORTER
    // -------------------------------------------

    $('#sort-bar select').change(function() {
        // Grab all Values
        var cat     = $('select#cat').val();
        var tag     = $('select.tag-select').val();
        var date    = $('select.date-select').val();

        date = date.split("/");

        var month = date[date.length-2];
        var year = date[date.length-3];

        

        var url = '/?ajax=true';
        if (tag) {
            url += '&tag=' + tag;
        }
        if (cat) {
            url += '&cat=' + cat;
        }
        if (date) {
            url += '&year=' + year;
            url += '&monthnum=' + month;
        }

        //alert(cat + ', ' + tag + ', ' + month + '/' + year + ', url: ' + url );

        $('#main').addClass('loading').removeClass('clearfix').load(url, function(){
            $('#main').removeClass('loading').addClass('clearfix');


            // Ajaxify Pagination
            ajaxify_pagination();


        });

        $('.page-navigation').hide();


    });



    function ajaxify_pagination() {
        $('.page-navigation a[href*="ajax=true"]').each(function() {

            var link = $(this);

            var url = link.attr('href');
            link.attr('data-load', url);
            link.attr('href','#');

            link.click(function(){
                $('#main').addClass('loading').removeClass('clearfix').load(url, function(){
                    $('#main').removeClass('loading').addClass('clearfix');
                    ajaxify_pagination();
                });
            });


        });
    }
	
 
}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );