$(document).ready(function(){


 	$('#scrollmouse').click(function(){ //, .scrollmagic-pin-spacer
 		var top = $('html').scrollTop() > $('body').scrollTop() ? $('html').scrollTop() : $('body').scrollTop();
 		height = $(window).height();
 		duration = 1500;
 		if(top < height*2.4 ) {
 			newtop = height*2.5;
 			duration = 1500;
 		} else if(top < height*5.4) {
 			newtop = height*5.5;
 			duration = 3500;
 		}  else if(top < height*6.4) {
 			newtop = height*6.5;
 			duration = 1500;
 		} else {
 			newtop = top+height;
 			duration = 1000;
 		}


 		$('html,body').animate({
		    scrollTop: newtop
		}, duration, 'easeInOutQuart');

 	});

	/**
	Big Text
	*/
	$(function() {
		// Big Text
		$('.bigtext').bigtext().addClass('visible');	

		// Smooth Scroll
		$('a[href*=#]:not([href=#])').click(function() {
		  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		    var target = $(this.hash);
		    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		    if (target.length) {
		      $('html,body').animate({
		        scrollTop: target.offset().top
		      }, 400, 'easeInOutQuart');
		      return false;
		    }
		  }
		});
	});

	$('html,body').scrollTop(0);


	$('#mountain_text_1 .big').delay(600).animate({
		letterSpacing: 2,
		opacity: 1
	}, 900);

	var text1anim = new TimelineMax();

	var small = $('#mountain_text_1 .small');

	text1anim.to( small, 1, {
		letterSpacing: 2,
		opacity: 1,
		ease: Power3.easeInOut,
	});


	// Smooth Scroll
	$(function() {
	  $('a.smooth-scroll[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 3000);
	        return false;
	      }
	    }
	  });
	});

	$(function() {
	  $('a.go-to-next').click(function() {
	   
	    var wh = $(window).innerHeight();


	    var here = $(window).scrollTop();
	    var there = here + wh*1.0;
	    if (here >= 2*wh) {
	    	there = here + wh*1.5;
	    	$(this).addClass('gone');
	    }

	    console.log(wh, here, there); 

	    
        $('html,body').animate({
          scrollTop: there
        }, 1000);
        return false;
	     
	  
	  });
	});




});
