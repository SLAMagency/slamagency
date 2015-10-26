<?php

$prefix = 'slam_';

add_action( 'add_meta_boxes', 'slam_page_children_meta_box' );



$fields = array(


	array( // 
		'label'	=> 'Page Type', // <label>
		'id'	=> $prefix.'type', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'normal',
		'options' => array(
			'Normal' 				=> 'normal',
			//'Header'				=> 'header',
			//'Slider'				=> 'slider',
			//'List' 					=> 'list',
			
			'Split Left'			=> 'split',
			'Split Right'			=> 'split-right',
			//'Custom Background' 	=> 'custom',
			'Video with Video BG'	=> 'videos',
			
		),
	),

	array( // 
		'label'	=> 'iFrame Code', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('videos'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'iframe', // field id and name
		'type'	=> 'textarea', // type of field
		'sanitizer' => 'none',
	),	
	array( // 
		'label'	=> 'BG Video: MP4', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('videos'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'mp4', // field id and name
		'type'	=> 'text', // type of field
		'sanitizer' => 'none',
	),	
	array( // 
		'label'	=> 'BG Video: OGG', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('videos'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'ogg', // field id and name
		'type'	=> 'text', // type of field
		'sanitizer' => 'none',
	),	
	array( // 
		'label'	=> 'BG Video: webm', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('videos'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'webm', // field id and name
		'type'	=> 'text', // type of field
		'sanitizer' => 'none',
	),	

	array( // 
		'label'	=> 'Background Color', // <label>
		'id'	=> $prefix.'background_color', // field id and name
		'type'	=> 'select', // type of field
		'default' => 'white',
		'options' => slam_get_color_options('name')
	),
	array( // 
		'label'	=> 'Padding', // <label>
		'id'	=> $prefix.'padding', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'normal-padding',
		'options' => array(
			'None' 		=> 'no-padding',
			'Thin'		=> 'thin-padding',
			'Normal' 	=> 'normal-padding',
			'Thick'		=> 'thick-padding',
			'Mega'		=> 'mega-padding',
		),
	),
	array( // 
		'label'	=> 'Content Width', // <label>
		'id'	=> $prefix.'content_width', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'boxed',
		'options' => array(
			'Full Width' 		=> 'fullwidth',
			'Normal'			=> 'boxed',
			'Two-Thirds' 		=> 'two-thirds',
			'Half'				=> 'half',
		),
	),
	// Image Options
	array( // Messages Notes
		'label'	=> 'Background Image', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'background_image', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // 
		'label'	=> 'Image Opacity', // <label>
		'id'	=> $prefix.'image_opacity', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'opaque',
		'options' => array(
			'Opaque' => 'opaque',
			'85%'	=> 'fade-85',
			'50%'	=> 'fade-50',
			'15%'	=> 'fade-15',
		),
	),
	array( // Messages Notes
		'label'	=> 'Additional Classes', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'additional_classes', // field id and name
		'type'	=> 'text' // type of field
	),
		
);

$page_box = new custom_add_meta_box( 'slam_page_options', 'Page Set-up', $fields, 'page', true );



function slam_page_children_meta_box_callback($post) {
	
	$editurl = get_site_url() . '/wp-admin/post.php?action=edit&post=';

	$parent = get_page($post->post_parent);

	if($post->ID == $parent->ID) {
		echo "<p>Subsections: </p>";
	} else {
		echo "<p>This is a sub-section of <a href='{$editurl}{$parent->ID}'>{$parent->post_title}</a>.</p>";
	}

	//Load Child Pages
	$args = array(
		'post_parent' 	=> $parent->ID,
		'post_type'		=> 'page',
		'order'			=> 'ASC',
		'orderby'		=> 'menu_order'
	);

	$children = get_children($args);
	echo "<div>";

	$kid_count = count($children);

	foreach($children as $child) {
		$active = '';
		if ($child->ID == $post->ID) {
			$active = ' disabled="disabled" ';
		}
		echo "<a class='button' {$active} href='{$editurl}{$child->ID}'>{$child->post_title}</a>";
	}
	echo "</div>";

	$menu_order = $kid_count+1;

	$add_url = get_template_directory_uri() . "/library/SLAM/create_child_page.php?parent_id={$parent->ID}&menu_order={$menu_order}";

	//echo "<form action='{$add_url}' method='POST'>";
	echo "<input type='hidden' name='parent_id' value='{$parent->ID}'>";
	echo "<p><input type='text' id='new_page_title' name='new_page_title'></input>";
	echo "<a id='new_page_button' class='button' type='submit' href={$add_url}>+ Add Section</a>";
	echo "</p>";



}

function slam_page_children_meta_box() {
	add_meta_box( 'slam_page_children_meta_box', 'Page Sections', 'slam_page_children_meta_box_callback', 'page', 'normal', 'high' );

}


function check_for_meta_and_redirect_to_parent() {
	global $post;
	$post_id = $post->ID;
	$subsection_field = get_post_meta ( $post_id, 'subsection', true );
	error_log("SUBSECTION FIELD: " . $subsection_field);
	if ( $subsection_field ) {
		error_log("SUBSECTION FIELD IS NON-NULL");
		//Get permalink of parent page
		$post_parent_id = $post->post_parent;
		error_log("POST PARENT: " . $post_parent_id);
		if ( $post_parent_id ) {
			//Get permalink of parent page
			$parent_page_plink = get_permalink ( $post_parent_id );
			error_log("PARENT_PAGE_PLINK: " . $parent_page_plink);
			//Redirect to parent page permalink
			wp_redirect( $parent_page_plink);
			exit;	
		}
			
	} else {
		error_log("SUBSECTION FIELD IS NULL");	
	}
}
