<?php
	
	$scripts = array(
		"https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js",
		// "https://cdnjs.cloudflare.com/ajax/libs/three.js/r70/three.js",
		// "https://dl.dropboxusercontent.com/u/3587259/Code/Threejs/CSS3DRenderer.js",
		// "library/js/jquery-mousewheel-master/jquery.mousewheel.min.js",
		"library/js/jquery.easing.1.3.js",
		"library/js/bigtext.js",
		// //"js/jquery.appear.js",
		// "library/js/achieve.js",

	);

	$required_scripts = array_merge($required_scripts, $scripts);

?>

<section class="section next gray-bg" id="go">
	<div class="background-video">
		<div class="hatch-overlay"></div>
		<video id="bgVideo" class="show-for-medium-up" preload="auto" autoplay loop muted > 
		    
		    
		    
		   <!--  <source src="http://d199e1cq7z8hrp.cloudfront.net/lansing-background.webm" type="video/webm" > -->
		    <!-- <source src="http://d199e1cq7z8hrp.cloudfront.net/lansing-background-720.mp4" type="video/mp4" > -->
		    <source src="../library/video/slam-website-background_final.mp4" type="video/mp4" >
		    <source src="https://s3.amazonaws.com/citylifelansing/lansing_background_720.ogv" type="video/ogg" >

		    <!-- <source src="http://d199e1cq7z8hrp.cloudfront.net/lansing-background-720.mp4" type="video/mp4" > 
		    <source src="http://d199e1cq7z8hrp.cloudfront.net/lansing-background.webm" type ="video/webm" >
		    <source src="http://d199e1cq7z8hrp.cloudfront.net/lansing_background_720.ogv" type="video/ogg" >  -->  
		    
		</video>  
	</div>
	<h1><div class='bigtext'><span>NOW</span><span class="light">IS YOUR TIME FOR</span><span>GREATNESS</span></div>
		
		<a href="#" data-reveal-id="video-modal"><i class="fi-play-circle"></i></a>

		<!-- <a href="#video">
			
			<svg version="1.1"
				 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
				 x="0px" y="0px" width="69.79px" height="52.47px" viewBox="0 0 69.79 52.47" enable-background="new 0 0 69.79 52.47"
				 xml:space="preserve">
			<defs>
			</defs>
			<polygon fill="#A6DCD1" points="69.79,0 34.5,17.55 34.89,17.75 "/>
			<linearGradient id="SVGID_2222_" gradientUnits="userSpaceOnUse" x1="0" y1="17.3597" x2="34.502" y2="17.3597">
				<stop  offset="0" style="stop-color:#A6DCD1"/>
				<stop  offset="1" style="stop-color:#48D3A0"/>
			</linearGradient>
			<polygon fill="#48D3A0" points="0,0 0,34.72 34.5,17.55 "/>
			<polygon fill="#A6DCD1" points="0,34.72 34.89,52.47 69.79,34.72 69.79,0 "/>
			</svg>
		</a> -->
	</h1>
	<div class="clock hide-for-small">
	  <div class="hour hand"></div>
	  <div class="minute hand"></div>
	  <div class="second hand"></div>
	</div>

</section>