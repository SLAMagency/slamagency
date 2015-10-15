<?php get_header(); ?>
			
			<div id="content">
			
				<?php 

					$transient_name = 'ak_page_'.$post->ID;
					$transient_page = get_transient( $transient_name );

					if( false === $transient_page ) {
						
			    		// - - - - - - - - - - - - - - 
			    		// Load Child Pages
			    		// - - - - - - - - - - - - - - 
			    		$args = array(
			    			'post_parent' 	=> $post->ID,
			    			'post_type'		=> 'page',
			    			'orderby'		=> 'menu_order',
			    			'order'			=> 'ASC',
			    		);

			    		$children = get_children($args);

			    		set_transient( $transient_name, $children, DAY_IN_SECONDS );
			    	} else {
			    		
			    		$children = $transient_page;
			    	}

		    		if($children) {
			    		$section = new Section($post);
			    		$section->add_class('lead-section');
			    		$section->build();


			    		foreach($children as $child) {
			    			$section = new Section($child);
			    			$section->build();
			    		}

			    	} else {

			    		$this_post = new BasePost($post);
						$image = get_post_thumbnail_id( $post->ID );

			    		?>

							<section id="post-heading" class='has_image slam_section bg-blue' >
								<div style='background-image: url(<?php echo $this_post->image_src($this_post->background_image); ?>)' class='section_background_image section_background_div fade-50'></div>

								<div class="slam_section_content thick-padding" >
									<div class='row'>
										<div class='header-content text-center'>
												
											<h1 class='post-title'><?php the_title(); ?></h1>
											
										</div>
									</div>
								</div>
							</section>	

						<?php		    		

			    		$section = new Section($post);
			    		$section->build();	

			    	}


		    	?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>