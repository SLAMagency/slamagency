window.scrollTo(0, 0);

$(document).ready(function(){

	//console.log('Begin');




	// Get the height to set the duration
	var durationValueCache;
	function getDuration () {
		//console.log('duration: ' + durationValueCache);
	  return durationValueCache;

	}
	function updateDuration (e) {
	  durationValueCache = $(window).innerHeight()*2;
	  //durationValueCache = $('#mountains').innerHeight();
	}
	$(window).on("resize", updateDuration); // update the duration when the window size changes
	$(window).triggerHandler("resize"); // set to initial value

	// Prepares SVG paths for path animation
	function pathPrepare ($el) {
		var lineLength = $el[0].getTotalLength();
		$el.css("stroke-dasharray", lineLength);
		$el.css("stroke-dashoffset", lineLength);
	}


	// init ScrollMagic Controller
	var controller = new ScrollMagic.Controller({
		//container: "#wrapper"
	});

	// Mountains Tween
	// This controlls the animation for mountainScene
	var mountainsTimeline = new TimelineMax();

	var mountains = $('.mountain');
	var total = mountains.length;
	var i = 0;
	mountains.each(function(){

		// Move distant mountains into view
		mountainsTimeline.from( $(this), getDuration()/2, {
			y: 600*Math.sqrt(i/6),
		}, 0);

		// Fly over mountains
		mountainsTimeline.to( $(this), getDuration()/2, {
			scale: 2*(total/(i+1))*(total/(i+1)),
			transformOrigin: "50% -20%",
			ease: Power2.easeIn,
		}, getDuration()/2);

		// Fade mountains to blue as we approach
		mountainsTimeline.to( $(this).find('.mountain-blue'), (getDuration()/2)-( (getDuration()/2)/total )*(total-i) , {
			fill: '#A6DCD1',
		}, (getDuration()/2) );


		i++;

	});

	// Yellow Line 1
	mountainsTimeline.to( '.yellow-line_1', getDuration()/4, {
		height: getDuration()*1.25 - $('.mountain_text_2').height()-40,
	}, getDuration()/12 );


	var paths = $('.orange-path');
	paths.each(function(){
		pathPrepare($(this));
	});

	// Orange Path 1
	var path_start = getDuration()/2 + 1;
	var path_speed = getDuration()/12;
	mountainsTimeline.to( '.orange-path_1.orange-path_a', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start );
	mountainsTimeline.to( '.orange-path_1.orange-path_b', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start + path_speed);

	// Orange Path 2
	path_start = path_start + path_speed;
	mountainsTimeline.to( '.orange-path_2.orange-path_a', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start );
	mountainsTimeline.to( '.orange-path_2.orange-path_b', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start + path_speed);

	// Orange Path 3
	//path_speed = getDuration()/48;
	path_start = path_start + path_speed*1.1;
	mountainsTimeline.to( '.orange-path_3.orange-path_a', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start );
	mountainsTimeline.to( '.orange-path_3.orange-path_b', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start + path_speed);

	// Orange Path 4
	//path_speed = getDuration()/24;
	path_start = path_start + path_speed;
	mountainsTimeline.to( '.orange-path_4.orange-path_a', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start );
	mountainsTimeline.to( '.orange-path_4.orange-path_b', path_speed, {
		strokeDashoffset: 0,
		strokeWidth: 8,
		ease: Linear.easeNone
	}, path_start + path_speed);



	// Create a Scene
	var mountainScene = new ScrollMagic.Scene({
			triggerElement: '#mountain_container',
			//duration: getDuration(),
			reverse: true
		})
		.duration(getDuration()*3)
		.setTween(mountainsTimeline)
		.setPin('#mountain_container') //.setPin('#mountain_container')
		//.on('start', function(){ $('#mountain_container').addClass('fixed'); })
		
		.addTo(controller);



	// - - - - - - -
	// Text 2
	// - - - - - - -
	var text2timeline = new TimelineMax();

	text2timeline.to( '.mountain_text_2', getDuration()*2, {
			scale: 2,
			opacity: 0,
			ease: Power2.easeIn,
		}, 0
	).to( '#rays', getDuration()*2, {
			opacity: 1,
			ease:Power2.easeIn
		}, getDuration() 
	).from( '#rays path', getDuration()*2, {
			rotation: -80+'deg',
			y: 100 + '%',

		}, getDuration() );

	var rays = $('#rays path');
	rays.each(function(){
		text2timeline.to($(this), getDuration()*2, {
			rotation: (Math.random()-.5)*10+'deg',
			opacity: .5
		}, getDuration() );
	});

	var text2pin = new ScrollMagic.Scene({
		triggerElement: '.mountain_text_2',
	})
	.setPin('.mountain_text_2')
	.setTween(text2timeline)
	.duration(getDuration())
	//.on('start', function(){ $('.go-to-next').removeClass('animated')})
	.addTo(controller);

	// - - - - - - -
	// Text 3
	// - - - - - - -
	var text3timeline = new TimelineMax();

	text3timeline
		.to( '.mountain_text_3', getDuration(), {
				//zIndex: -10,
			}, 0);
	var text3pin = new ScrollMagic.Scene({
		triggerElement: '.mountain_text_3',
	})
	.setPin('.mountain_text_3')
	//.setTween(text3timeline)
	.duration(getDuration())
	.addTo(controller);




	$('#mountain_container').addClass('visible');

});