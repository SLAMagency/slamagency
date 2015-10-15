<?php

$prefix = 'ak_';

add_action( 'add_meta_boxes', 'ak_page_children_meta_box' );

$post_types = array(
	
//	'Messages'		=> 'message',
//	'Groups'		=> 'group',
//	'Staff'			=> 'staff',
	'Events'		=> 'event',
	'Posts' 		=> 'post',
);

$fields = array(

	array( // 
		'label'	=> 'Page Type', // <label>
		'id'	=> $prefix.'type', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'normal',
		'options' => array(
			'Normal' 				=> 'normal',
			//'Header'				=> 'header',
			'Slider'				=> 'slider',
			'List' 					=> 'list',
			
			'Split Left'			=> 'split',
			'Split Right'			=> 'split-right',
			'Custom Background' 	=> 'custom',
		),
	),

	array( // 
		'label'	=> 'Custom Background:', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('custom'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'custom', // field id and name
		'type'	=> 'textarea', // type of field
		'sanitizer' => 'none',
		
	),

	// List Options
	array( // 
		'label'	=> 'List What?', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('list'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_what', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => $post_types,
	),
	array( // 
		'label'	=> 'Series', // <label>
		'class' => 'contingent message',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('message'),
			),

		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_series', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'series',
	),
	array( // 
		'label'	=> 'Event Category', // <label>
		//class' => 'contingent message',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('event'),
			),

		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_event_category', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'event_cat',
	),
	array( // 
		'label'	=> 'Staff Category', // <label>
		//class' => 'contingent message',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('staff'),
			),

		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_staff_category', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'staff_cat',
	),
	array( // 
		'label'	=> 'Category', // <label>
		//'desc'	=> 'Use', // description
		'class' => 'contingent',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('message','post'),
			),
		'id'	=> $prefix.'list_category', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'category',
	),

	array( // 
		'label'	=> 'Layout:', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('list'),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_layout', // field id and name
		'default'	=> 'boxed',
		'type'	=> 'akselect', // type of field
		'options'	=> array(
			'Full Width'	=> 'full width',
			'Default'		=> 'boxed',
			'Circles'		=> 'circles',
		)
		
	),
	array(
		'label' 	=> 'Items per row',
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('list'),
			),
		'id'	=> $prefix.'list_row', // field id and name
		'type'	=> 'number', // type of field
		'default'	=> 4
	),
	array(
		'label' 	=> 'Max items to show',
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('list'),
			),
		'id'	=> $prefix.'max', // field id and name
		'type'	=> 'number', // type of field
		'default'	=> 12
	),

	// Slider Options
	array( // Slide Show
		'label'	=> 'Slide Show', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('slider'),
			),
		// 'id'	=> 'slide_show', // field id and name, needs to be the exact name of the taxonomy
		// 'type'	=> 'tax_select', // type of field
		// 'taxonomy' => 'slide_show',
		// 'desc'	=> 'You can display a slide show on this page. Just select the slide show.', // description
		'id'	=> $prefix.'slide_show',
		'type'	=> 'text',
		'desc'	=> 'Paste in the shortcode from <a href="/wp-admin/admin.php?page=new_royalslider">RoyalSlider</a> for the slide show you want.',
	),

	// General Options
	array(
		'type' => 'break',
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header', 'list',),
			),

	),
	array( // 
		'label'	=> 'Background Style', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header','list',),
			),
		'id'	=> $prefix.'background_color', // field id and name
		'type'	=> 'select', // type of field
		'default' => 'white',
		'options' => array_merge( ak_get_color_options('name'), ak_get_texture_options() ),
	),
	array( // 
		'label'	=> 'Padding', // <label>
		'id'	=> $prefix.'padding', // field id and name
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header', 'list',),
			),
		'type'	=> 'akselect', // type of field
		'default' => 'normal-padding',
		'options' => array(
			'None' 		=> 'no-padding',
			'Thin'		=> 'thin-padding',
			'Normal' 	=> 'normal-padding',
			'Thick'		=> 'thick-padding',
		),
	),
	array( // 
		'label'	=> 'Content Width', // <label>
		'id'	=> $prefix.'content_width', // field id and name
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header', 'list',),
			),
		'type'	=> 'akselect', // type of field
		'default' => 'boxed',
		'options' => array(
			'Full Width' 		=> 'fullwidth',
			'Normal'			=> 'boxed',
			'Two-Thirds' 		=> 'two-thirds',
			'Half'				=> 'half',
		),
	),
	array( 
		'label'	=> 'Background Image', // <label>
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header', 'list', 'split', 'split-right',),
			),
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'background_image', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // 
		'label'	=> 'Image Opacity', // <label>
		'id'	=> $prefix.'image_opacity', // field id and name
		'dependent' => array(
			'field'	=> $prefix.'type',
			'value' => array('normal','header', 'list',),
			),
		'type'	=> 'akselect', // type of field
		'default' => 'opaque',
		'options' => array(
			'Opaque' => 'opaque',
			'85%'	=> 'fade-85',
			'50%'	=> 'fade-50',
			'15%'	=> 'fade-15',
		),
	),
	
	

	
);

$page_box = new custom_add_meta_box( 'ak_page_options', 'Page Set-up', $fields, 'page', true );

$fields = array(
	// Always
	array( // Additional Classes
		'label'	=> 'Additional Classes', // <label>
		'desc'	=> '(Advanced) Add extra CSS classes here.', // description
		'id'	=> $prefix.'additional_classes', // field id and name
		'type'	=> 'text' // type of field
	),
);
$page_box = new custom_add_meta_box( 'ak_advanced_page_options', 'Advanced Settings', $fields, 'page', true );



/*
	Display list of child pages
*/
function ak_page_children_meta_box_callback($post) {
	
	$editurl = '/wp-admin/post.php?action=edit&post=';

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

	$add_url = get_template_directory_uri() . "/library/classes/create_child_page.php?parent_id={$parent->ID}&menu_order={$menu_order}";

	//echo "<form action='{$add_url}' method='POST'>";
	echo "<input type='hidden' name='parent_id' value='{$parent->ID}'>";
	echo "<p><input type='text' id='new_page_title' name='new_page_title'></input>";
	echo "<a id='new_page_button' class='button' type='submit' href={$add_url}>+ Add Section</a>";
	echo "</p>";



}

function ak_page_children_meta_box() {
	add_meta_box( 'slam_page_children_meta_box', 'Page Sections', 'ak_page_children_meta_box_callback', 'page', 'normal', 'high' );
}



