


	var vennContainer = document.getElementById('venn-container');
	var ctx = Sketch.create({
		container: vennContainer,
		autopause: false
	});


	var venn_duration = jQuery('#venn').innerHeight();
	console.log('venn_duration', venn_duration);
	// Get the height to set the duration
	var vennDurationValueCache;
	function getVennDuration () {
		console.log('duration: ' + vennDurationValueCache);
	  return vennDurationValueCache;

	}
	function updateVennDuration (e) {
	  vennDurationValueCache = jQuery(window).innerHeight()*2;
	  //vennDurationValueCache = $('#mountains').innerHeight();
	}
	jQuery(window).on("resize", updateVennDuration); // update the duration when the window size changes
	jQuery(window).triggerHandler("resize"); // set to initial value

	var vennController = new ScrollMagic.Controller({
		globalSceneOptions: {
	        //triggerHook: 'onLeave'
	    }
	});


	var frame = 0;
	var vennTimeline = new TimelineMax();
	vennTimeline.to(window, getVennDuration()*3, {frame:1000}, 0);

	var resultsTimeline = new TimelineMax();
	//resultsTimeline.to('#results', getVennDuration()/2, {color: FFFFFF}, 0);

	var vennScene = new ScrollMagic.Scene({
			triggerElement: '#venn-container',
			triggerHook: 0,
			reverse: true
		})
		.duration( (getVennDuration()/2)*5 ) //venn_duration/2 )
		.setTween(vennTimeline)
		.setPin('#venn-container', {
			pushFollowers: false
		})
		.addTo(vennController);

	var resultsScene = new ScrollMagic.Scene({
			triggerElement: '#results',
			triggerHook: .4,
			reverse: true
		})
		//.duration( venn_duration/7*2 - 30 )
		.duration( (getVennDuration()/2)*1.5 - 250 )
		//.setTween(resultsTimeline)
		.setPin( '#results' )
		.addTo(vennController);

	// var videoScene = new ScrollMagic.Scene({
	// 	triggerElement: '#go',
	// 	triggerHook: 0,
	// 	reverse: true
	// })
	// .duration( getVennDuration() )
	// .setPin('#go')
	// .addTo(vennController);


	dist = 120;

	start_size = 600;

	var circle_1 = {};
	var circle_2 = {};
	var circle_3 = {};

	function setup() {

		circle_1.start = {};
		circle_1.end = {}
		circle_1.start.x = -start_size;
		circle_1.start.y = 0;
		circle_1.start.size = start_size;
		circle_1.end.x = ctx.width/2 - dist;
		circle_1.end.y = ctx.height/2 -dist*sqrt(3)/2;
		circle_1.end.size = 200;
		circle_1.delay = 0;
		circle_1.length = 200;



		circle_2.start = {};
		circle_2.end = {}
		circle_2.start.x = ctx.width+start_size;
		circle_2.start.y = 0;
		circle_2.start.size = start_size;
		circle_2.end.x = ctx.width/2 + dist;
		circle_2.end.y = ctx.height/2 -dist*sqrt(3)/2;
		circle_2.end.size = 200;
		circle_2.delay = 150;
		circle_2.length = 200;


		
		circle_3.start = {};
		circle_3.end = {}
		circle_3.start.x = ctx.width/2;
		circle_3.start.y = ctx.height +start_size;
		circle_3.start.size = start_size;
		circle_3.end.x = ctx.width/2;
		circle_3.end.y = ctx.height/2 + dist*sqrt(3)/2;
		circle_3.end.size = 200;
		circle_3.delay = 300;
		circle_3.length = 200;

	}

	setup();
	jQuery(window).on("resize", setup);

	var pos = {};
	pos.x = ctx.width/2;
	pos.y = ctx.height/2;

	var go = {};
	go.x = pos.x;
	go.y = pos.y;

	var size = 10;

	var convergence = 600;
	var convergence_length = 200;
	

	function get_pos(obj, c) {
		pos = {};

		time = 0;
		if (c > obj.delay) {
			time = sin_ease( (c-obj.delay)/obj.length, 2 );
		}
		if (c > obj.length + obj.delay) {
			time = 1;
		}

		pos.x = obj.start.x + (obj.end.x - obj.start.x)*time;
		pos.y = obj.start.y + (obj.end.y - obj.start.y)*time;

		if (c > convergence) {
			time = sin_ease( (c-convergence)/convergence_length, 2 );
			pos.x = obj.end.x + (ctx.width/2  - obj.end.x)*time;
			pos.y = obj.end.y + (ctx.height/2 - obj.end.y)*time;
		}


		return pos;
	}

	function get_size(obj, c) {

		time = 0;
		if (c > obj.delay) {
			time = sin_ease( (c-obj.delay)/obj.length, 2 );
		}
		if (c > obj.length + obj.delay) {
			time = 1;
		}

		size = obj.start.size + (obj.end.size - obj.start.size)*time;

		if (c > (convergence+convergence_length)  ) {
			time = sin_ease( (c-(convergence+convergence_length))/convergence_length, 2 );
			size = obj.end.size + (ctx.width - obj.end.size)*time;
		}

		return size;
	}

	function sin_ease(c, power) {
		return pow(.5+Math.sin((c-.5)*PI)*.5, power);
	}

	// Create a canvas that we will use as a mask
	var maskCanvas = document.createElement('canvas');
	// Ensure same dimensions
	maskCanvas.width = ctx.width;
	maskCanvas.height = ctx.height;
	var maskCtx = maskCanvas.getContext('2d');

	var magenta = 	'rgba(177,	61,		150,	.85)';
	var blue = 		'rgba(26, 	60, 	107,	.85)';
	var mint = 		'rgba(166,	220,	209,	.85)';
	var green = 	'rgba(62,	185,	128, 	.85)';

	ctx.draw = function() {
		//frame++;

		// Circle 3
	   	//console.log(frame);
	   	//
	   	if (frame > (convergence+convergence_length)  ) {
	   		fade = sin_ease( (frame-(convergence+convergence_length))/convergence_length, 2 );
	   		ctx.globalAlpha = 1-fade;
	    }
		pos3 = get_pos(circle_3,   frame );
		size3 = get_size(circle_3, frame );
		
		ctx.fillStyle = mint;
	    ctx.beginPath();
	    ctx.arc( pos3.x, pos3.y, size3, 0, TWO_PI );
	    ctx.rect(ctx.width,0,-ctx.width, ctx.height);
	    ctx.font = size3/5 + "px Oswald";
	    ctx.textAlign = "center";
	    //ctx.fillStyle = '#FFF';
	    ctx.fillText("INTUITION", pos3.x, pos3.y+(size3/2));
	  
	    ctx.fill();
	    //ctx.globalCompositeOperation = 'source';


	    // Circle 2
	    
		pos2 = get_pos(circle_2,   frame );
		size2 = get_size(circle_2, frame );
		

	    ctx.fillStyle = magenta;
	    ctx.beginPath();
	    ctx.arc( pos2.x, pos2.y, size2, 0, TWO_PI );
	    ctx.rect(ctx.width,0,-ctx.width, ctx.height);

		ctx.font = size2/5 + "px Oswald";
	    ctx.fillText("SCIENCE", pos2.x+(size2/2), pos2.y);

	    ctx.fill();
	    //ctx.globalCompositeOperation = 'xor';
	    ctx.globalCompositeOperation = 'xor';
	    //ctx.globalCompositeOperation = 'source';

	    

    	// Circle 1

    	pos1 = get_pos(circle_1, frame );
    	size1 = get_size(circle_1, frame );
        ctx.fillStyle = blue;
        ctx.beginPath();
        ctx.arc( pos1.x, pos1.y, size1, 0, TWO_PI );
        ctx.rect(ctx.width,0,-ctx.width, ctx.height);
        ctx.font = size1/5 + "px Oswald";
        ctx.fillText("ART", pos1.x-(size1/2), pos1.y);

        ctx.fill();



        


        ctx.fillStyle = 'transparent';
        ctx.lineWidth=4;
        ctx.strokeStyle = "#FFFFFF";
        ctx.beginPath();
        	ctx.arc( pos3.x, pos3.y, size3+2, 0, TWO_PI );
        ctx.stroke();

        //ctx.fillStyle = 'rgba(0, 147, 177,.5)';
        ctx.beginPath();
        	ctx.arc( pos2.x, pos2.y, size2+2, 0, TWO_PI );
        ctx.stroke();
        //ctx.fill();

        ctx.beginPath();
        	ctx.arc( pos1.x, pos1.y, size1+2, 0, TWO_PI );
        ctx.stroke();




        




        // // This color is the one of the filled shape
        // maskCtx.fillStyle = "black";
        // // Fill the mask
        // maskCtx.fillRect(0, 0, maskCanvas.width, maskCanvas.height);
        // // Set xor operation
        // maskCtx.globalCompositeOperation = 'xor';
        // // Draw the shape you want to take out
        // maskCtx.arc( pos3.x, pos3.y, size3, 0, TWO_PI );
        // maskCtx.arc( pos2.x, pos2.y, size2, 0, TWO_PI );
        // maskCtx.arc( pos1.x, pos1.y, size1, 0, TWO_PI );
        // maskCtx.fill();

        // // Draw mask on the image, and done !
        // ctx.drawImage(maskCanvas, 0, 0);
	   
	    

	}


//});

