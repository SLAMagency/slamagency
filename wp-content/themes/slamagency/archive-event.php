<?php get_header(); 
	//add_action('wp_footer', 'load_masonry_scripts', 10);
?>
			
			<div id="content">
				<?php
					$events_page = get_page_by_title( 'events', 'OBJECT', 'page');
					if ($events_page) {
						$this_post = new BasePost($events_page);
						$image = $this_post->image_src($this_post->background_image); //get_post_thumbnail_id( $this_post->ID );
					} else {


						$image = get_theme_mod('ak_default_image');
						if(!$image) {
							$image = get_stylesheet_directory_uri() . "/library/images/default_image.jpg";
						}
					} 
					
					
				?>
				<section id="post-heading" class='has_image slam_section lead-section  bg-gray' >
					<div style='background-image: url(<?php echo $image; ?>)' class='section_background_image section_background_div fade-50'></div>

					<div class="slam_section_content thick-padding" >
						<div class='row'>
							<div class='header-content text-center'>
									
								<h1 class='post-title'>Upcoming Events</h1>
								
							</div>
						</div>
					</div>
				</section>	
			
				<div class="inner-content row full-width clearfix">
				
				    <div id="main" class="clearfix" role="main">
				





					    

						
					    <?php if (have_posts()) : ?>

					    	<ul class='clearfix medium-block-grid-3 small-block-grid-1 list list-page-list event' >

						    	 <?php while (have_posts()) : the_post(); ?>
									<!-- <li class='event list-page-item fullwidth-style'> -->
						    		<?php
						    			
						    			$event = new Event($post);
						    			//echo "<a href='". get_permalink($post->ID) . "' class='info-overlay bg-blue'>";
						    			//echo ak_image($event->image, array('list','square'), 'fill');
						    			//echo "<div class='list_info'>{$event->info()}</div>";
						    			//echo "</a>";
						    			echo $event->block('title-below');

						    		?>
						    		<!-- </li> -->
						
						    	<?php endwhile; ?>
					    	</ul>		
					
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
					
    						<?php get_template_part( 'partials/content', 'missing' ); ?>
					
					    <?php endif; ?>

			
    				</div> <!-- end #main -->
    
	    			<?php //get_sidebar(); ?>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

<?php get_footer(); ?>