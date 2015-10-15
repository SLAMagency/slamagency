<?php get_header(); ?>
<?php
	
	$group = new Group( $post );
	
	$image = $group->image_src('medium');
?>
	<div id="content">
			
			<section class="slam_section single has_image bg-navy normal-padding">
				<span class="overlay grayscale blur background-cover fade-85" style="background-image: url( <?php echo $image; ?> );"></span>
				

			
				<div class="inner-content row  clearfix">
			
					<div id="main" class="medium-8 columns clearfix medium-centered" role="main">
					
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="row" >
								<?php 
									//echo "<img class='fill' src='{$group->image('mobile-slider')}' />"; 
									echo $group->image( array('large', 'large') );
								?>
						    
						    		
						    	
						    </div>
						    <div class="row">
						    	<div class="columns medium-12 panel bg-white">
									
							    	<?php
							    		echo "<h2>{$group->title}</h2>";
							    		echo "<h6 class='info-list'>" . implode(' | ', $group->info) . "</h6>";
							    		the_content();	
							    	?>
							    	<?php
								    	if($group->address) {
									    	echo AK::get_directions_button($group->address);
									 	} 
									?>
							    </div>
							</div>
							

					    	
					    					
					    <?php endwhile; else : ?>
					
					   		<?php get_template_part( 'partials/content', 'missing' ); ?>

					    <?php endif; ?>

					    <center><a class="button" href="<?php echo home_url(); ?>/groups/">See All Groups</a></center>
			
					</div> <!-- end #main -->
					

				</div> <!-- end #inner-content -->

				<?php //get_template_part( 'partials/sections', 'single' ); ?>
    
			</section> <!-- end #content -->
	</div>

<?php get_footer(); ?>