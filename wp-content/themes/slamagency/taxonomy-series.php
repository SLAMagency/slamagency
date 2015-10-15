<?php



?>
<?php get_header(); ?>
	<?php

		// Check for Series Image
		// Display Series Image

	$messages = array();

	$series_id = get_queried_object()->term_id;

/*
	$attachment_id = get_terms_meta($series_id, 'image_id', true);

	$image = wp_get_attachment_image_src( $attachment_id, 'fullwidth' );
	$image = $image[0];

*/
	$image = ak_get_series_image($series_id);



	?>
	<div id="content">
		<section class="single has_image bg-navy normal-padding slam_section">
			<span class="overlay grayscale blur background-cover fade-85" style="background-image: url( <?php echo $image; ?> );"></span>
						
			<div class="inner-content row clearfix">
		
			    <div id="main" class="medium-10 columns clearfix medium-centered message-series" role="main">
			    	
				    <?php 

				    	$i=0;
				    	if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				    	<?php 
				    		$i++;


				    		$messages[$i] = new Message($post);
				    		
				    		$num = count($messages);

				    	?>
				
				    <?php endwhile; ?>	

				   

				    <div class="tabs-content video-box">
				    <?php 
				    	$i = 0;
				    	foreach($messages as $key => $message) {
				    		$i++;
				    		$active = '';
				    		end($messages);
				    		if ($key == key($messages)) {
				    			$active = 'active';
				    		}

				    		echo "<div class='content {$active}' id='week-{$i}'>";
				    			
				    			$player_number = $i-1;

				    			if ($message->video) {
					    			echo $message->video();
					    		} else { 
					    			if ($message->audio) {
					    				echo "<a class='linked-play-audio-button' data-player='#mep_{$player_number}'>";
					    			} ?>
					    			<img src="<?php echo $image; ?>" />
					    			<?php 
					    			if ($message->audio) {
					    				echo "</a>";
					    			} ?>
					    		<?php }

					    		$message->audio();
				    		
				    		echo "</div>";

				    	}

				    ?>
				    </div>


				    <dl class="tabs message-tabs" data-tab data-options="deep_linking:true; scroll_to_content: false">

				    <?php 
				    	$i = 0;
				    	foreach($messages as $key => $message) {
				    		$i++;
				    		$active = '';
				    		end($messages);
				    		if ($key == key($messages)) {
				    			$active = 'active';
				    		}

				    		echo "<dd class='{$active} count-{$num}'><a href='#week-{$i}' title='{$message->title}'>Week {$i}</a></dd>";

				    	}

				    ?>
				    </dl>
				    <div class="tabs-content content-box bg-white">
				    <?php 
				    	$i = 0;
				    	foreach($messages as $key => $message) {
				    		$i++;
				    		$active = '';
				    		end($messages);
				    		if ($key == key($messages)) {
				    			$active = 'active';
				    		}

				    		echo "<div class='content {$active}' id='week-{$i}'>";

				    		echo "<div class='message-content'><h4>{$message->title}</h4>";
				    		echo "<h6>";
				    		$speaker = $message->speakers;
				    		$atts = array(
				    			'show' => array('speaker', ' | ', 'date')
				    		);
				    		echo $message->display($atts);

				    		echo "</h6><hr>";

				    		$content = get_post_field('post_content', $message->ID);

				    		if($content) {

				    			echo "<article>{$content}</article><hr>";
				    		}

				    		//echo "<article>" . get_post_field('post_content', $message->ID) . "</article><hr>";

				    		$player_number = $i-1;

				    		if ($message->audio) {
				     			echo "<a class='button tiny linked-play-audio-button' data-player='#mep_{$player_number}'>Listen</a>&nbsp";
				     		}
				     		if ($message->video) {
				     			echo "<a class='button tiny linked-play-video-button' data-player='#week-{$i}'>Watch</a>";
				     		}

				     		

				    		echo "</div>";					    		
				    		
				    		echo "</div>";

				    	}

				    ?>
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
				    
						<?php get_template_part( 'partials/content', 'missing' ); ?>
				
				    <?php endif; ?>

				    <a class="button " href="<?php echo home_url(); ?>/messages/">See Full Message Archive</a>
		
		
			    </div> <!-- end #main -->

			    <?php //get_sidebar(); ?>
			    
			</div> <!-- end #inner-content -->
		</section>

	</div> <!-- end #content -->
<?php get_footer(); ?>