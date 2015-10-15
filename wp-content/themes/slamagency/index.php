<?php

	if($_GET['ajax']) {

		$args = array(
			'nopaging'	=> true,
		);

		if($_GET['cat']){
			$args['cat'] = $_GET['cat'];
		}

		if($_GET['tag']){
			$args['tag'] = $_GET['tag'];
		}

		if($_GET['year']){
			$args['year'] = $_GET['year'];
		}

		if($_GET['monthnum']){
			$args['monthnum'] = $_GET['monthnum'];
		}

		$posts = new WP_Query($args);
		echo "<div class='masonry'>";
		while($posts->have_posts()) : $posts->the_post();

			get_template_part( 'partials/loop', 'archive' );

		endwhile;
		echo "</div>";



		exit();
	}

?><?php get_header(); ?>
		<div id="content">
			<?php 
				$blog_page = get_option( 'page_for_posts' );
				if($blog_page) {
					$this_page = new Section($blog_page);
					$this_page->build();
				}

			?>
			

				<section class='sort-bar bg-gray no-padding'>
					<div class='row collapse'>
						<form id='sort-bar' action=''>
						<?php

						?>
							<div class="columns medium-4 ">
								<?php 
									$args = array(
										'show_option_all'	=> 'Categories'
									);
									wp_dropdown_categories($args); 
								?>
					        </div>
					        <?php /*
					        <div class="columns medium-4">
								<?php 
									echo AK::tag_dropdown();
								?>
					        </div>
					        <div class="columns medium-4">
					        	<select class='date-select' name='date'>
					        		<option value=''>Dates</option>
								<?php 
									$args = array(
										'type'	=> 'monthly',
										'format'	=> 'option',
									);
									wp_get_archives($args);
								?>
								</select>
					        </div>

					        */ ?>
					       
						</form>
						<div class="columns medium-4 right">
							<?php get_search_form(); ?>
						</div>

					</div>
				</section>

				<section class="no-padding">
			
					<div class="inner-content row fullwidth clearfix">
				
					    <div id="main" class="clearfix" role="main">

						    <?php if (have_posts()) : ?>

						    	<div class='masonry'>

						    	 <?php while (have_posts()) : the_post(); ?>
						
						    		<?php get_template_part( 'partials/loop', 'archive' ); ?>
						
						    	<?php endwhile; ?>
						    	</div>	
						
						       	
						
						    <?php else : ?>
						    
	    						<?php get_template_part( 'partials/content', 'missing' ); ?>
						
						    <?php endif; ?>
				
					    </div> <!-- end #main -->
	    				 <?php if (function_exists('joints_page_navi')) { ?>
				            <?php joints_page_navi(); ?>
				        <?php } else { ?>
				        
				            <nav class="wp-prev-next row">
				                <ul class="clearfix">
				        	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "jointstheme")) ?></li>
				        	        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "jointstheme")) ?></li>
				                </ul>
				            </nav>
				        <?php } ?>	
					  
					    
					</div> <!-- end #inner-content -->

				<section>
    
		</div> <!-- end #content -->

<?php get_footer(); ?>