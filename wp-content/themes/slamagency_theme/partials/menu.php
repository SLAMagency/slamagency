<div id="menu" class="row fullwidth collapse">
   
	
	<?php if ( is_active_sidebar( 'menu' ) ) : ?>
		<ul class="medium-block-grid-3">
			<?php dynamic_sidebar( 'menu' ); ?>
		</ul>
	<?php else : ?>
		<div class="columns medium-4 menu-item"><h3><a href="/">Homex</a></h3></div>
		<div class="columns medium-4 menu-item"><h3><a href="/about/">About</a></h3></div>
		<div class="columns medium-4 menu-item"><h3><a href="/start-now/">Start Now</a></h3></div>
	<?php endif; ?>
	

    <div class="columns small-12">

    </div>
</div>
<div class="header clearfix">
	<h1 class='columns small-3 logo'><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/library/images/slam-logo.svg" ?></a></h1>
	<div class="columns small-6">
		<div id="nav-icon1">
		  <span></span>
		  <span></span>
		  <span></span>
		</div>
	</div>
</div>