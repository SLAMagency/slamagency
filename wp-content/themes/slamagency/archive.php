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
						    <?php if (is_category()) { ?>
							    <h1 class='post-title'>
								    <span><?php _e("Topic:", "jointstheme"); ?></span> <?php single_cat_title(); ?>
						    	</h1>
						    	<?php
							    	// Try out terms meta:
							    	if(function_exists('get_terms_meta')) {
							    		//$cat_ID = get_cat_ID( single_cat_title() );
							    		$image = get_terms_meta(get_query_var('cat'), 'category-image', true);
							    		echo "<img src='{$image}'/>";
							    	}
						    	?>
						    
						    <?php } elseif (is_tag()) { ?> 
							    <h1 class='post-title'>
								    <span><?php _e("Tagged:", "jointstheme"); ?></span> <?php single_tag_title(); ?>
							    </h1>
						    
						    <?php } elseif (is_author()) { 
						    	global $post;
						    	$author_id = $post->post_author;
						    ?>
							    <h1 class='post-title'>

							    	<span><?php _e("Posts By ", "jointstheme"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>

							    </h1>
						    <?php } elseif (is_day()) { ?>
							    <h1 class='post-title'>
		    						<span><?php _e("Daily Archives:", "jointstheme"); ?></span> <?php the_time('l, F j, Y'); ?>
							    </h1>
			
			    			<?php } elseif (is_month()) { ?>
				    		    <h1 class='post-title'>
					    	    	<span><?php _e("Monthly Archives:", "jointstheme"); ?></span> <?php the_time('F Y'); ?>
						        </h1>
						
						    <?php } elseif (is_year()) { ?>
						        <h1 class='post-title'>
						    	    <span><?php _e("Yearly Archives:", "jointstheme"); ?></span> <?php the_time('Y'); ?>
						        </h1>
						    <?php } else { ?>
						    	<h1 class='post-title'>
						    	    <span><?php echo single_term_title(); ?></span>
						        </h1>
						    <?php } ?>
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