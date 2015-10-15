<?php get_header(); ?>
<?php
	
	$event = new Event( $post );
	
	$image = $event->image_src('square');
?>
	<div id="content">
			
			<section class="slam_section single has_image bg-gray normal-padding">
				<span class="overlay grayscale blur background-cover fade-85 hide-for-small-only" style="background-image: url( <?php echo $image; ?> );"></span>
				

			
				<div class="inner-content row  clearfix">
			
					<div id="main" class="medium-8 columns clearfix medium-centered" role="main">
					
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="row" >
								<?php 
									//echo "<img class='fill' src='{$event->image('mobile-slider')}' />"; 
									echo $event->image( array('hd', 'list') );
								?>
						    
						    		
						    	
						    </div>
						    <div class="row">
						    	<div class="columns medium-12 panel bg-white">
									
							    	<?php
							    		echo "<h2>{$event->title}</h2>";
							    		echo "<h6 class='info-list'>" . implode(' | ', $event->info) . "</h6>";
							    		echo "<hr>";
							    		the_content();	
							    	?>
					    	    	<?php
					    		    	if($event->registration) {
					    			    	echo $event->form();
					    			 	} 
					    			?>
							    	<?php
								    	if($event->address) {
									    	echo AK::get_directions_button($event->address);
									 	} 
									?>
							    </div>
							</div>
							

					    	
					    					
					    <?php endwhile; else : ?>
					
					   		<?php get_template_part( 'partials/content', 'missing' ); ?>

					    <?php endif; ?>

					    <center><a class="button" href="<?php echo home_url(); ?>/events/">See All Events</a></center>
			
					</div> <!-- end #main -->
					

				</div> <!-- end #inner-content -->

				<?php //get_template_part( 'partials/sections', 'single' ); ?>
    
			</section> <!-- end #content -->
	</div>

<?php get_footer(); ?>