<?php

?>
<?php get_header(); ?>
	<div class="content">

		<?php
			$messages_page = get_page_by_title( 'messages', 'OBJECT', 'page');
			if ($messages_page) {
				$this_post = new BasePost($messages_page);
				$image = $this_post->image_src($this_post->background_image); //get_post_thumbnail_id( $this_post->ID );
			} else {


				$image = get_theme_mod('ak_default_image');
				if(!$image) {
					$image = get_stylesheet_directory_uri() . "/library/images/default_image.jpg";
				}
			} 
			
			
		?>
		<section id="post-heading" class='has_image lead-section slam_section bg-gray ' >
			<div style='background-image: url(<?php echo $image; ?>)' class='section_background_image section_background_div fade-50'></div>

			<div class="slam_section_content normal-padding" >
				<div class='row'>
					<div class='header-content text-center'>
							
						<h1 class='post-title'>Messages</h1>
						
					</div>
				</div>
			</div>
		</section>
		<?php

			$args = array(
				'post_type' 		=> 'message',
				'posts_per_page'	=> 1,
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'ak_date',
				'order'				=> DESC,
			);

			$message_query = new WP_Query($args);
			if ( $message_query->have_posts() ) {
				
				while ( $message_query->have_posts() ) {
					$message_query->the_post();

					$message = new Message($message_query->post);
					$series_id = $message->series_id;
					
				}
				
			}


		?>
		<section class="slam_section bg-gray">
			<div class="slam_section_content no-padding" style="padding-bottom: 30px;">
				<div class="row">
					<div class="columns large-8 small-centered">
						<?php 
			    			$player_number = $i-1;

			    			if ($message->video) {
				    			echo $message->video();
				    		} else { 
				    			if ($message->audio) {
				    				echo "<a class='linked-play-audio-button' data-player='#mep_{$player_number}'>";
				    			} ?>
				    			<img src="<?php echo $message->image; ?>" />
				    			<?php 
				    			if ($message->audio) {
				    				echo "</a>";
				    			} ?>
				    		<?php }

				    		$message->audio();
						?>

					
						
						<h4><?php echo $message->title; ?></h4>
						<?php 
							//$message = new Message($post);

							echo "<p>";
							$speaker = $message->speakers;
							$atts = array(
								'show' => array('speaker', ' | ', 'date')
							);
							echo $message->display($atts);

							echo "</p>";

							$content = get_post_field('post_content', $message->ID);

							if($content) {

								echo "<article>{$content}</article><br/>";
							}
							
							echo "<a class='button' href='/series/{$message->series[0]->slug}/'>See Full Series</a>";

						?>
					</div>
					
				</div>
			</div>
		</section>
		
		<div class="inner-content row clearfix normal-padding">
	
		    <div id="main" class="large-12 medium-12 columns clearfix" role="main">
		    	<div class="text-center"><h2 class="blue-block">Series Archive</h2></div><br>
		    	
		    	<?php 

		    		echo ak_get_series(); 
		    		
		    	?>
	
		    </div> <!-- end #main -->

		   
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->
<?php get_footer(); ?>