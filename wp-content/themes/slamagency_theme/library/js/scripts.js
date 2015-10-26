/*
Joints Scripts File

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// @codekit-prepend "/jquery.bxslider/jquery.bxslider.js"
// @codekit-prepend "jquery.transit.min.js"
// @codekit-prepend "jquery.fitvids.js"  

var wistia_video = [];

window._wq = window._wq || [];
var i = 0;
_wq.push({ "_all": function(video) {
  console.log("I got a handle to the video!", video);
  wistia_video[i] = video;
  i++;
}});
    

// as the page loads, call these scripts
jQuery(document).ready(function($) {
	// load Foundation
	jQuery(document).foundation();
	
    // load gravatars
    $('.comment img[data-gravatar]').each(function(){
        $(this).attr('src',$(this).attr('data-gravatar'));
    });

    // $('a.js-opener').click(function(){
    //     $('a.js-opener').removeClass('active');
    //     $(this).addClass('active');
    //     var open = $(this).data('open');
    //     var close = $(this).data('close');
    //     $(open).slideDown(200);
    //     $(close).slideUp(200);
    // });

    // url = window.location.pathname;
    // pathArray = window.location.pathname.split( '/' );

    // pathArray.forEach(function(element, index, array){
    //     console.log('a[' + index + '] = ' + element);

    //     $('#content').addClass('page-' + element);
    // });
    // 
    // 
    
    $('#content h3').wrap('<div>');

    
    var lastScrollTop = 0;
    header = $('.header');

    function show_hide_header(){
       var st = $(this).scrollTop();
       if (st > 200) {
           if (st > lastScrollTop){
               // downscroll code
               header.removeClass('show');
           } else if(st < lastScrollTop) {
              // upscroll code
              header.addClass('show');
           }
        } else {
            header.removeClass('show');
        }
       lastScrollTop = st;
    }

    checkHeader = setInterval(show_hide_header, 100);




    $('#nav-icon1').click(function(){
        $(this).toggleClass('open');
        $('#menu').toggleClass('open');
        header.removeClass('show');
    });




    // Background Video
    var myVideo = document.getElementById("bgVideo");

    //jQuery(document).ready( function () {

    jQuery("#video-play").click( function() {

        myVideo.pause();

        jQuery(".background-video").fadeOut();

        jQuery("#go")
            .removeClass("full-height")
            .addClass('ztop');

        header.removeClass('show');

        wistia_video[0].play();

    });

        

    //}); 


    

// add all your scripts here
	
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
                    par.css({y: yPos-150});
                    //par.css({top: yPos-200 + 'px'});
                    //console.log('I: ' +I + ' W: ' + W + ' H: ' + H + ' x: ' + x + ' imageH: ' + imageH + ' yPos: ' + yPos);

                

                // Throttled resize function
                //$(window).scroll(function(e){
                function animateStuff() {

                    window.requestAnimationFrame(function(){
                       
                        var x = $(window).scrollTop();
                        var yPos = (1/(W+H))*(x-(I-W)).toFixed(1);

                        yPos = (yPos*distance).toFixed(1);
                        
                        par.css({y: yPos-150});

                        //console.log('I: ' +I + ' W: ' + W + ' H: ' + H + ' x: ' + x + ' imageH: ' + imageH + ' yPos: ' + yPos);

                    });
                    
                };

                scrollIntervalID = setInterval(animateStuff, 1000/120);
            


    });
    
 



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