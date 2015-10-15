<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php 
				
				$this_post = new BasePost($post);
				$image = get_post_thumbnail_id( $post->ID );


			

			?>
		<div id="content">
			<section id="post-heading" class='has_image slam_section bg-gray' >
				<div style='background-image: url(<?php echo $this_post->image_src($this_post->background_image); ?>)' class='section_background_image section_background_div fade-50'></div>

				<div class="slam_section_content thick-padding" >
					<div class='row'>
						<div class='header-content text-center'>
								
							<h1 class='post-title'><?php the_title(); ?></h1>
							<?php get_template_part( 'partials/content', 'byline' ); ?>

						</div>
					</div>
				</div>
			</section>
			
			<section class="content bg-silver">

				<div class="slam_section_content normal-padding" >

					<div class="inner-content row clearfix">
				
						<div class="columns large-7 medium-8 medium-centered edge-hang" role="main">
						
						    
								
						    	<?php get_template_part( 'partials/loop', 'single' ); ?>

						    	<?php 

						    		// Subscribe form for MailPoet plugin
									if ( class_exists(WYSIJA_NL_Widget) ) {
							    		$widgetNL = new WYSIJA_NL_Widget(true);
										echo $widgetNL->widget(array('form' => 1, 'form_type' => 'php'));
									}
						    	?>
						    					
						    
							<div class='after-bar'>
								<?php if ( is_active_sidebar( 'postwidgets' ) ) : ?>

									<?php dynamic_sidebar( 'postwidgets' ); ?>

								<?php endif; ?>
							</div>
						</div> <!-- end #main -->
	    
					</div> <!-- end #inner-content -->

				</div>
    
			</section> 
		</div> <!-- end #content -->


	<?php endwhile; else : ?>
					
   		<?php get_template_part( 'partials/content', 'missing' ); ?>

    <?php endif; ?>

<?php get_footer(); ?>