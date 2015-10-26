<div id="menu" class="row">
   
   <div class="columns small-12">
	
	<?php if ( is_active_sidebar( 'top-menu' ) ) : ?>
		
			<ul id="top-menu" class="small-block-grid-2 medium-block-grid-<?php echo count_sidebar_widgets('top-menu');?>">
				<?php dynamic_sidebar( 'top-menu' ); ?>
			</ul>
		
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'middle-menu' ) ) : ?>
		
			<ul id="middle-menu" class="small-block-grid-3 medium-block-grid-<?php echo count_sidebar_widgets('middle-menu');?>">
				<?php dynamic_sidebar( 'middle-menu' ); ?>
			</ul>
		
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'bottom-menu' ) ) : ?>
		<ul id="bottom-menu" class="small-block-grid-1 medium-block-grid-<?php echo count_sidebar_widgets('bottom-menu');?>">
			<?php dynamic_sidebar( 'bottom-menu' ); ?>
		</ul>
	<?php endif; ?>
	
	

    

    </div>
</div>
<div class="header clearfix">
	<h1 id="logo" class='columns small-3 logo'><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/library/images/slam-logo.svg" ?></a></h1>
	<div class="columns small-6">
		<div id="nav-icon1">
		  <span></span>
		  <span></span>
		  <span></span>
		</div>
	</div>
</div>