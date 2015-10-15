<?php if(!$_GET['ajax']){ ?><!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- Icons & Favicons -->
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<link href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png" rel="apple-touch-icon" />
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		 <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<link href='http://fonts.googleapis.com/css?family=Lato:400,300,900' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css">

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

		

	</head>

	<body <?php body_class(); ?>>
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap">
				<div id="container">
					
					<header id="header">
						<div id="menu" class="bg-black">
							<div class="row fullwidth">
								<div class="columns large-12">
									<?php 
									 wp_nav_menu( array( 'container_class' => 'image-menu', 'theme_location' =>'main-nav' , 'walker' => new Thumbnail_Walker) ); 
									?>
								</div>
							</div>
							<div class="row fullwidth hide">
								<div class="columns large-8 show-for-large-up map-box">
									<h4>Find Us</h4>
									<img src="http://maps.googleapis.com/maps/api/staticmap?center=39.175634,-76.8154069&zoom=14&scale=2&size=640x150&sensor=false&markers=color:0xbdd630|39.175634,-76.8154069&style=&style=feature:landscape|element:geometry|lightness:100|saturation:100&style=feature:all|element:labels|visibility:off&style=feature:all|saturation:-100" alt="">

								</div>
								<div class="columns large-4 show-for-large-up form-box">
									<h4>Contact Us</h4>
									<?php echo do_shortcode( get_theme_mod('contact_form') ); ?>
								</div>
							</div>
							
						</div>
						<a href="/" id="logo" >
							
							<!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In  -->
							<svg version="1.1"
								 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
								 x="0px" y="0px" width="114.1px" height="198.2px" viewBox="0 0 114.1 198.2" enable-background="new 0 0 114.1 198.2"
								 xml:space="preserve">
							<defs>
							</defs>
							<path id="XMLID_21_" fill="#FFFFFF" d="M114.1,0v158c0,6.1-3.3,11.7-8.5,14.8l-40,23.1c-5.3,3.1-11.8,3.1-17.1,0l-40-23.1
								C3.3,169.8,0,164.2,0,158V0H114.1z"/>
							<g>
								<g>
									<path id="XMLID_18_" fill="#C0BFBF" d="M81.8,67.3L61.4,55.5c-2.7-1.6-6-1.6-8.7,0L32.3,67.3c-2.7,1.6-4.4,4.4-4.4,7.6v23.5
										c0,3.1,1.7,6,4.4,7.6l20.4,11.8c2.7,1.6,6,1.6,8.7,0l20.4-11.8c2.7-1.6,4.4-4.4,4.4-7.6V74.8C86.2,71.7,84.5,68.8,81.8,67.3z
										 M81.3,96.4c0,2.6-1.4,5-3.6,6.3l-17,9.8c-2.3,1.3-5,1.3-7.3,0l-17-9.8c-2.3-1.3-3.6-3.7-3.6-6.3V76.8c0-2.6,1.4-5,3.6-6.3l17-9.8
										c2.3-1.3,5-1.3,7.3,0l17,9.8c2.3,1.3,3.6,3.7,3.6,6.3V96.4z"/>
									<path id="XMLID_17_" fill="#00A8CA" d="M58.3,73.3l9.1,5.2c1.7,1,3.8-0.2,3.8-2.2v-0.9c0-0.9-0.5-1.7-1.3-2.2l-11.6-6.7
										c-0.8-0.5-1.8-0.5-2.5,0l-11.6,6.7c-0.8,0.5-1.3,1.3-1.3,2.2v0.9c0,2,2.1,3.2,3.8,2.2l9.1-5.2C56.6,72.9,57.5,72.9,58.3,73.3z"/>
									<path id="XMLID_16_" fill="#C0BFBF" d="M58.3,86.6l9.1,5.2c1.7,1,3.8-0.2,3.8-2.2v-0.9c0-0.9-0.5-1.7-1.3-2.2l-11.6-6.7
										c-0.8-0.5-1.8-0.5-2.5,0l-11.6,6.7c-0.8,0.5-1.3,1.3-1.3,2.2v0.9c0,2,2.1,3.2,3.8,2.2l9.1-5.2C56.6,86.1,57.5,86.1,58.3,86.6z"/>
									<path id="XMLID_15_" fill="#C0BFBF" d="M57,106.2L57,106.2c-1.6,0-2.9-1.3-2.9-2.9V84.6c0-1.6,1.3-2.9,2.9-2.9h0
										c1.6,0,2.9,1.3,2.9,2.9v18.7C60,104.9,58.7,106.2,57,106.2z"/>
								</g>
								<g id="XMLID_1_">
									<path id="XMLID_13_" fill="#C0BFBF" d="M13.9,150.8v-21.3c0-0.1,0.1-0.3,0.3-0.3h16.2c0.2,0,0.3,0.2,0.3,0.4l-1.3,3.5
										c0,0.1-0.1,0.2-0.3,0.2H18.2v4.7h9.2c0.2,0,0.3,0.2,0.3,0.4l-1.3,3.5c0,0.1-0.1,0.2-0.3,0.2h-7.9v8.8c0,0.1-0.1,0.3-0.3,0.3h-3.8
										C14,151,13.9,150.9,13.9,150.8z"/>
									<path id="XMLID_10_" fill="#C0BFBF" d="M27.2,150.7l8.5-21.3c0-0.1,0.1-0.2,0.2-0.2h4c0.1,0,0.2,0.1,0.2,0.2l8.5,21.3
										c0.1,0.2-0.1,0.4-0.2,0.4l-4.1,0c-0.1,0-0.2-0.1-0.2-0.2l-1.2-3.2h-9.9l-1.2,3.2c0,0.1-0.1,0.2-0.2,0.2h-4.1
										C27.3,151,27.2,150.8,27.2,150.7z M38.2,135l-3.3,8.3h6.6L38.2,135z"/>
									<path id="XMLID_7_" fill="#C0BFBF" d="M52.5,129.1h3.8c0.1,0,0.3,0.1,0.3,0.3v21.4c0,0.1-0.1,0.3-0.3,0.3h-3.8
										c-0.1,0-0.3-0.1-0.3-0.3v-21.4C52.2,129.2,52.3,129.1,52.5,129.1z"/>
									<path id="XMLID_5_" fill="#C0BFBF" d="M78.8,129.4v3.6c0,0.1-0.1,0.3-0.3,0.3h-7v17.5c0,0.1-0.1,0.3-0.3,0.3h-3.8
										c-0.1,0-0.3-0.1-0.3-0.3v-17.5h-7c-0.1,0-0.3-0.1-0.3-0.3v-3.6c0-0.1,0.1-0.3,0.3-0.3h18.4C78.7,129.1,78.8,129.3,78.8,129.4z"/>
									<path id="XMLID_2_" fill="#C0BFBF" d="M82.1,150.8v-21.3c0-0.1,0.1-0.3,0.3-0.3h3.8c0.1,0,0.3,0.1,0.3,0.3v8.5h10.2v-8.5
										c0-0.1,0.1-0.3,0.3-0.3h3.8c0.1,0,0.3,0.1,0.3,0.3v21.3c0,0.1-0.1,0.3-0.3,0.3l-3.8,0c-0.1,0-0.3-0.1-0.3-0.3V142H86.5v8.8
										c0,0.1-0.1,0.3-0.3,0.3h-3.8C82.2,151,82.1,150.9,82.1,150.8z"/>
								</g>
								<g>
									<polygon fill="#C0BFBF" points="13.4,161.3 14.7,161.3 14.7,158.3 17.5,158.3 17.5,157 14.7,157 14.7,155.5 18.2,155.5 
										18.2,154.1 13.4,154.1 		"/>
									<polygon fill="#C0BFBF" points="23.6,158.1 26.5,158.1 26.5,156.8 23.6,156.8 23.6,155.5 27.2,155.5 27.2,154.1 22.3,154.1 
										22.3,161.3 27.2,161.3 27.2,160 23.6,160 		"/>
									<polygon fill="#C0BFBF" points="32.9,154.1 31.5,154.1 31.5,161.3 36.4,161.3 36.4,160 32.9,160 		"/>
									<polygon fill="#C0BFBF" points="41.6,154.1 40.3,154.1 40.3,161.3 45.1,161.3 45.1,160 41.6,160 		"/>
									<path fill="#C0BFBF" d="M51.9,154c-2.1,0-3.7,1.6-3.7,3.7c0,2.1,1.6,3.7,3.7,3.7c2.1,0,3.7-1.6,3.7-3.7
										C55.6,155.6,54,154,51.9,154z M51.9,160.1c-1.4,0-2.4-1-2.4-2.4c0-1.4,1-2.4,2.4-2.4c1.4,0,2.4,1,2.4,2.4S53.3,160.1,51.9,160.1z"
										/>
									<polygon fill="#C0BFBF" points="64.8,158.6 63.7,155.1 62.7,155.1 61.6,158.6 60,154.1 58.6,154.1 61.2,161.3 62.1,161.3 
										63.2,157.8 64.3,161.3 65.3,161.3 67.8,154.1 66.4,154.1 		"/>
									<path fill="#C0BFBF" d="M74,156.9c-0.8-0.2-1.4-0.4-1.4-0.8c0-0.7,1-0.8,1.2-0.8c0.7,0,1.2,0.4,1.3,1l0.1,0.6l1.3-0.4l-0.1-0.4
										c-0.2-1.2-1.2-2-2.6-2c-1.5,0-2.6,0.9-2.6,2.1c0,1.4,1.4,1.8,2.2,2l0.3,0.1c1,0.3,1.5,0.5,1.5,1c0,0.6-0.5,0.9-1.3,0.9
										c-0.8,0-1.4-0.4-1.4-1.1l0-0.6l-1.3,0.4l0,0.4c0.1,1.3,1.2,2.3,2.7,2.3c1.5,0,2.7-0.9,2.7-2.2C76.5,157.6,74.9,157.1,74,156.9z"/>
									<polygon fill="#C0BFBF" points="84.9,156.9 82,156.9 82,154.1 80.7,154.1 80.7,161.3 82,161.3 82,158.2 84.9,158.2 84.9,161.3 
										86.2,161.3 86.2,154.1 84.9,154.1 		"/>
									<rect x="90.9" y="154.1" fill="#C0BFBF" width="1.3" height="7.2"/>
									<path fill="#C0BFBF" d="M99,154.1h-2.2v7.2h1.3v-2.4H99c1.7,0,2.7-0.9,2.7-2.4C101.7,155.1,100.7,154.1,99,154.1z M99,157.6h-0.8
										v-2.1H99c0.9,0,1.4,0.4,1.4,1.1C100.4,157.2,99.9,157.6,99,157.6z"/>
								</g>
							</g>
							</svg>



						</a>
						
						<div id="nav-icon1">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>	
						
						

					</header> <!-- end header -->
<?php } // if ! ajax ?>