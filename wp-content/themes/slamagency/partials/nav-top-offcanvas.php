<div class="_sticky show-for-medium-up"> 
	<div class="super-header">
		<div class="fullwidth row">
		<?php joints_top_nav(); ?>
		</div>
	</div>
	<nav class="top-bar" data-topbar>
		<h1 id="logo">
			<a href="<?php echo home_url(); ?>" rel="nofollow"><span><?php bloginfo('name'); ?></span>
			


				

			</a>
		</h1>		
		<section class="ak-top-bar-section right">
			<?php joints_main_nav(); ?>
		</section>
	</nav>
</div>

<div class="show-for-small-only">
	<nav class="tab-bar">
		<section class="middle tab-bar-section">
			<h1 class="title"><?php bloginfo('name'); ?></h1>
		</section>
		<section class="left-small">
			<a href="#" class="left-off-canvas-toggle menu-icon" ><span></span></a>
		</section>
	</nav>
</div>
						
<aside class="left-off-canvas-menu show-for-small-only">
	<ul class="off-canvas-list">
		<li><label>Navigation</label></li>
			<?php joints_main_nav(); ?>
			<?php //ak_transient_menu(); ?>     
	</ul>
</aside>
			
<a class="exit-off-canvas"></a>