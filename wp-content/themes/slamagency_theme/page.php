<?php
	// Avoiding duplicate content for SEO
	// 
	// If this page is actually a subsection of a parent
	// page, then just redirect to the parent page.
	check_for_meta_and_redirect_to_parent();
?>
<?php get_header(); ?>
			
			<div id="content">
			
				<?php //get_template_part( 'partials/loop', 'page' ); ?>
				<?php 

		    		$section = new SLAM\Section($post);
		    		$section->build();

		    		//Load Child Pages
		    		$args = array(
		    			'post_parent' 	=> $post->ID,
		    			'post_type'		=> 'page',
		    			'orderby'		=> 'menu_order',
		    			'order'			=> 'ASC',
		    			'post_status' 	=> 'publish' 
		    		);

		    		$children = get_children($args);

		    		foreach($children as $child) {
		    			$section = new SLAM\Section($child);
		    			$section->build();
		    		}

		    	?>
					    					
			</div> <!-- end #content -->

<?php get_footer(); ?>