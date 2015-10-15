<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>
<?php get_header(); ?>
<?php
	
	$message = new Message( $post ); 
	
	$image = $message->image('full');

?>
			
			<div class="content single">
				<span class="overlay grayscale" style="background-image: url( <?php echo $image; ?> );"></span>
				

			
				<div class="inner-content row clearfix">
			
					<div id="main" class="medium-8 columns clearfix medium-centered" role="main">
					
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="row">
						    	
						    		<?php //echo "<img src='{$message->image('full')}' />"; ?>

						    		<?php
						    		if ($message->video) {
						    			echo $message->video();
						    		} else {
						    			echo "<img src='{$message->image('full')}' />";

						    		}

						    		?>

						    
						    </div>
						    <div class="row">
						    	<div class="columns medium-12 panel">
									
							    	<?php
							    		//echo "<h1>{$message->title}</h1>";
							    		//the_content();
							    		//$message->display();


							    		echo "<div class='message-content'><h2>{$message->title}</h2>";
							    		echo "<small>";
							    		$speaker = $message->speakers;
							    		$atts = array(
							    			'show' => array('speaker', ' | ', 'date')
							    		);
							    		$message->display($atts);

							    		echo "</small><hr>";

							    		echo "<article>" . get_post_field('post_content', $message->ID) . "</article>";

							    		echo "</div>";


							    		$message->audio();
							    					    		
							    		
							    		echo "</div>";



							    	?>
							    </div>
							</div>
							

					    	
					    					
					    <?php endwhile; else : ?>
					
					   		<?php get_template_part( 'partials/content', 'missing' ); ?>

					    <?php endif; ?>
			
					</div> <!-- end #main -->
					<!-- <div class="medium-4 columns panel">
						<?php
				    		echo $message->date;
				    		echo $message->time;
				    		echo $message->map;
				    	?>
					</div> -->
    
					<?php//get_sidebar(); ?>

				</div> <!-- end #inner-content -->

				<?php //get_template_part( 'partials/sections', 'single' ); ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>