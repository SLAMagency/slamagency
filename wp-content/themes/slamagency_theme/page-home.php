<?php
/*
Template Name: SLAM! Home
*/
?>
<?php

    /**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function home_scripts() {
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), false, true);
		wp_enqueue_script( 'GSAP', 'http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/jquery.gsap.min.js', array( 'jquery' ), false, true);
		wp_enqueue_script( 'TweenMax', 'http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', array( 'jquery', 'GSAP' ), false, true);
		wp_enqueue_script( 'ScrollMagic', get_template_directory_uri() . '/bower_components/ScrollMagic/scrollmagic/uncompressed/ScrollMagic.js', array( 'jquery', 'GSAP', 'TweenMax' ), false, true);
		wp_enqueue_script( 'animation-gsap', get_template_directory_uri() . '/library/js/animation.gsap.js', array( 'jquery', 'GSAP', 'TweenMax' ), false, true);
		wp_enqueue_script( 'mountains', get_template_directory_uri() . '/library/js/mountains.js', array( 'jquery', 'GSAP', 'TweenMax' ), false, true);
		wp_enqueue_script( 'home_scripts', get_template_directory_uri() . '/library/js/home_scripts.js', array( 'jquery'), false, true);
		wp_enqueue_script( 'bigtext', get_template_directory_uri() . '/library/js/bigtext.js', array( 'jquery'), false, true);

		wp_enqueue_script( 'sketch-js', get_template_directory_uri() . '/library/js/sketch.min.js', array( 'jquery' ), false, true);
		wp_enqueue_script( 'venn', get_template_directory_uri() . '/library/js/venn.js', array( 'jquery', 'GSAP', 'TweenMax' ), false, true);
	}

	add_action( 'wp_enqueue_scripts', 'home_scripts' );
	

?>
<?php get_header(); ?>

<div id="home-content">
	

	<!-- ––––––––––––––– -->
	<!-- Desktop Version -->
	<!-- ––––––––––––––– -->
	<div id="desktop" class="show-for-medium-up">
		
		<?php include('home-partials/mountains.php'); ?>

		<?php include('home-partials/possible.php'); ?>

		<?php include('home-partials/venn.php'); ?>

		<?php //include('home-partials/time.php'); ?>

		<?php include('home-partials/video.php'); ?>

		<section id="cta" class="section bg-white thin-padding">
			<div class="content">
				<div class="row">
					<div class="columns medium-6"><a href="#" class="button expand large">LEARN MORE</a></div>
					<div class="columns medium-6"><a href="#" class="button expand large">GET STARTED</a></div>
	        	</div>
			</div>
		</section>

	</div>

	<!-- ––––––––––––––– -->
	<!-- Mobile Version  -->
	<!-- ––––––––––––––– -->
	<div id="mobile" class="hide-for-medium-up">

	    <section id="mobile-mindset" class='bg-blue'>
	        <div class="content">
	            <h2>What if you operated from a Different Mindset?</h2>
	            <a class="next" href="#mobile-no-competition"><i class="fi-play-circle"></i></a>
	        </div>
	        
	        <img src="<?php echo get_template_directory_uri(); ?>/library/images/mobile-mountain.png" class='mobile-mountain'>
	    </section>
	    <section id="mobile-no-competition" class='bg-mint'>
	        <div class="content text-right">
	            <h2>A mindset where there is no competition?</h2>
	            <a class="next" href="#mobile-destiny"><i class="fi-play-circle"></i></a>
	        </div>
	        
	        <img src="<?php echo get_template_directory_uri(); ?>/library/images/mobile-mountain-blue.png" class='mobile-mountain'>
	    </section>
	    <section id="mobile-destiny" class='bg-blue'>
	        <h2>A mindset where you create your own Destiny?</h2>
	        <a class="next" href="#mobile-create"><i class="fi-play-circle"></i></a>
	    </section>
	    <section id="mobile-create" class="bg-white top-angle">
	        <div class="content">
	            <h2 class='bigtext'>I'ts more than possible.</h2>
	            
	            <h4>Here's how we do it.</h4>
	            <div class="video-wrapper ratio24">
	        	    <iframe 
	        	        id="video--home"
	        	        class="video--wistia"
	        	        src="//fast.wistia.net/embed/iframe/5ajp75g6fr?videoFoam=true"
	        	        allowtransparency="true"
	        	        frameborder="0"
	        	        scrolling="no"
	        	        class="wistia_embed"
	        	        name="wistia_embed"
	        	        allowfullscreen="allowfullscreen"
	        	        mozallowfullscreen="mozallowfullscreen"
	        	        webkitallowfullscreen="webkitallowfullscreen"
	        	        oallowfullscreen="oallowfullscreen"
	        	        msallowfullscreen="msallowfullscreen"
	        	        style="width: 100%; height: 40vw"  
	        	        >
	        	    </iframe>
	        	</div>
	        	<a href="" class="get-started button">LEARN MORE</a>
	        	<a href="" class="get-started button">GET STARTED</a>
	        </div>
	    </section>
	</div>

	
	<!-- ––––––––––––––– -->
	<!-- Video Modal 1	  -->
	<!-- ––––––––––––––– -->
	<div id="video-modal" class="reveal-modal" data-reveal>
	    <div class="video-wrapper ratio24">
	        <iframe 
	            id="video--home"
	            class="video--wistia"
	            src="//fast.wistia.net/embed/iframe/5ajp75g6fr?videoFoam=true"
	            allowtransparency="true"
	            frameborder="0"
	            scrolling="no"
	            class="wistia_embed"
	            name="wistia_embed"
	            allowfullscreen="allowfullscreen"
	            mozallowfullscreen="mozallowfullscreen"
	            webkitallowfullscreen="webkitallowfullscreen"
	            oallowfullscreen="oallowfullscreen"
	            msallowfullscreen="msallowfullscreen"
	            style="width: 100%; height: 40vw"  
	            >
	        </iframe>
	    </div>

	  <a class="close-reveal-modal" href="javascript:;">&#215;</a>
	</div>


	<!-- ––––––––––––––– -->
	<!-- Video Modal 2	  -->
	<!-- ––––––––––––––– -->
	<div id="reel-modal" class="reveal-modal" data-reveal>
	    <div class="video-wrapper ratio24">
	        <iframe 
	            id="video--home"
	            class="video--wistia"
	            src="//fast.wistia.net/embed/iframe/5ajp75g6fr?videoFoam=true"
	            allowtransparency="true"
	            frameborder="0"
	            scrolling="no"
	            class="wistia_embed"
	            name="wistia_embed"
	            allowfullscreen="allowfullscreen"
	            mozallowfullscreen="mozallowfullscreen"
	            webkitallowfullscreen="webkitallowfullscreen"
	            oallowfullscreen="oallowfullscreen"
	            msallowfullscreen="msallowfullscreen"
	            style="width: 100%; height: 40vw"  
	            >
	        </iframe>
	    </div>

	  <a class="close-reveal-modal" href="javascript:;">&#215;</a>
	</div>


</div>

<?php get_footer(); ?>
