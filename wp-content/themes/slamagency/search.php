<?php get_header(); 
	//add_action('wp_footer', 'load_masonry_scripts', 10);
	if(!$_GET['ajax']) {
?>
			
		<div id="content">

			<div class="slam_section">
			
				<div class="inner-content row full-width clearfix">
				
				    <div id="main" class="clearfix" role="main">
						
						<div class="archive-title clearfix">
							<hr/>
						    
							    <h1>
								    <span><?php _e("Search:", "jointstheme"); ?></span> <?php echo esc_attr(get_search_query()); ?>
						    	</h1>
						    	
						    <hr/>
						</div>
					     



	<?php } // !ajax ?>

						
					    <?php if (have_posts()) : ?>

					    	<div class='masonry clearfix'>

					    	 <?php while (have_posts()) : the_post(); ?>
					
					    		<?php get_template_part( 'partials/loop', 'archive' ); ?>
					
					    	<?php endwhile; ?>
					    	</div>		
					
					        <?php if (function_exists('joints_page_navi')) { ?>
						        <?php joints_page_navi(); ?>
					        <?php } else { ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "jointstheme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "jointstheme")) ?></li>
							        </ul>
					    	    </nav>
					        <?php } ?>
					
					    <?php else : ?>
					
    						<?php //get_template_part( 'partials/content', 'missing' ); ?>
    						<h3>No posts found for that time period</h3>

					
					    <?php endif; ?>

	<?php if(!$_GET['ajax']) { ?>

			
    				</div> <!-- end #main -->
    
	    			<?php //get_sidebar(); ?>
                
                </div> <!-- end #inner-content -->

            </div>
                
		</div> <!-- end #content -->

<?php get_footer(); ?><?php } // !ajax ?>