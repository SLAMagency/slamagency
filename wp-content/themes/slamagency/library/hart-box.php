<?php

$prefix = 'ak_';


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// 							LIST PAGE OPTIONS
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$post_types = get_post_types( array('public' => true), 'objects');

$post_types = array(
	
	'Messages'		=> 'message',
	'Groups'		=> 'group',
	//'Pages'		=> 'page',
	'Staff'			=> 'staff',
	'Events'		=> 'event',
	'Posts' 		=> 'post',
);



$post_type_options = array();
foreach ($post_types as $key => $value) {
	$post_type_options[$value] = array('label' => $key, 'value' => $value);

}


$fields = array(
	array( // 
		'label'	=> 'List What?', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_what', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => $post_types,
		/*array ( // array of options
			'post' => array ( // array key needs to be the same as the option value
				'label' => 'Posts', // text displayed as the option
				'value'	=> 'post' // value stored for the option
			),
			'message' => array (
				'label' => 'Messages',
				'value'	=> 'message'
			),
			
		)*/
	),
	array( // 
		'label'	=> 'Category', // <label>
		//'desc'	=> 'Use', // description
		'class' => 'contingent',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('message','post',),
			),
		'id'	=> $prefix.'list_category', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'category',
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
		'label'	=> 'Group Category', // <label>
		//class' => 'contingent message',
		'dependent' => array(
			'field'	=> $prefix.'list_what',
			'value' => array('group'),
			),

		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'list_group_category', // field id and name
		'type'	=> 'tax_select', // type of field
		'taxonomy'	=> 'group_cat',
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
		'label'	=> 'Layout:', // <label>
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
		'id'	=> $prefix.'list_row', // field id and name
		'type'	=> 'number', // type of field
		'default'	=> 4
	),
	array(
		'label' 	=> 'Max items to show',
		'id'	=> $prefix.'max', // field id and name
		'type'	=> 'number', // type of field
		'default'	=> 12
	),
);

// I need select boxes for all the taxonomies of all post types, 
// and then I need to selectively show them when the list what box changes.


if( ak_check_template(array('page-list.php') ) ) {
	$list_page_box = new custom_add_meta_box( 'ak_list_page_box', 'List Page Options', $fields, 'page', true );
}


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// 							IMAGE LINKS PAGE OPTIONS
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$fields = array(
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Image Links', // <label>
		'desc'	=> 'Add Image Links to this page.', // description
		'id'	=> $prefix.'imagelinks_repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'link_label' 	=> 'sanitize_text_field',
			'link_image' 	=> 'wp_kses_data',
			'classes' 		=> 'sanitize_text_field',
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			'link_label' => array(
				'label' => 'Title',
				'id' => 'link_label',
				'type' => 'text'
			),
			'link_image' => array( // Image ID field
				//'class'	=> 'sixcol first',
				'label'	=> 'Image', // <label>
				'id'	=> 'link_image', // field id and name
				'type'	=> 'image' // type of field
			),
			array( // 
				'label'	=> 'Background Color', // <label>
				//'desc'	=> 'Use', // description
				'id'	=> $prefix.'link_background_color', // field id and name
				'type'	=> 'select', // type of field
				'default' => '000000',
				'options' => ak_get_color_options('hex')
			),
			'link_to' => array( // Image ID field
				//'class'	=> 'sixcol first',
				'label'	=> 'Link to', // <label>
				'id'	=> 'link_to', // field id and name
				'post_type' => 'page',
				'type'	=> 'post_select' // type of field
			),
			'link_override' => array( // Image ID field
				//'class'	=> 'sixcol first',
				'label'	=> 'Custom URL', // <label>
				'id'	=> 'link_override', // field id and name
				//'post_type' => 'page',
				'type'	=> 'text' // type of field
			),
			'classes' => array(
				'label' => 'Classes',
				'id' => 'link_classes',
				'type' => 'text'
			),
			
		)
	)
);


if( ak_check_template(array('page-imagelinks.php','template-home.php') ) ) {
	$imagelinks_page_box = new custom_add_meta_box( 'ak_imagelinks_page_box', 'Image Link Options', $fields, 'page', true );
}



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// 							HEADER OPTIONS
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$fields = array(
	array( // 
		'label'	=> 'Header Style', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'header_style', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'none'			=>  'none',
			'Simple'		=>  'simple',
			//'parallax'		=>	'parallax',
			'Image Fill - The image will scale to fill the area, cropping parts of the image.'	=> 	'image_fill',
			'Image Fit - The image will shrink to fit inside the header.'						=> 	'image_fit',
			'Image Scale - The header will expand to show the whole image.'						=> 	'image_scale',
			'Slide Show'																		=> 	'slide_show',
			'Video'																				=>	'video',
		),
		'default' => 'none',
	),

	array( // Slide Show
		'label'	=> 'Slide Show', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('slide_show'),
			),
		'id'	=> 'slide_show', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select', // type of field
		'taxonomy' => 'slide_show',
		'desc'	=> 'You can display a slide show on this page. Just select the slide show.', // description
	),

	array( // Text Input
		'label'	=> 'Video', // <label>
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('video'),
			),
		'desc'	=> 'Paste in the url to a YouTube or Vimeo Video', // description
		'id'	=> $prefix.'video', // field id and name
		'type'	=> 'text' // type of field
	),

	// Image Options
	array( // Messages Notes
		'label'	=> 'Header Background Image', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale', 'parallax'),
			),
		'id'	=> $prefix.'header_background_image', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // Text Input
		'label'	=> 'Header Height', // <label>
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'slide_show', 'parallax'),
			),
		'desc'	=> 'How tall is the header?', // description
		'id'	=> $prefix.'header_height', // field id and name
		'type'	=> 'slider', // type of field
		'min'	=> '0', // lowest possible number
		'max'	=> '800', // highest possible number
		'step'	=> '5', //  how the slider steps as it is dragged
		'default' => 300,
	),
	array( // Checkbox group
		'label'	=> 'Image Options', // <label>
		//'desc'	=> 'A description for the field.', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill'),
			),
		'id'	=> $prefix.'image_options', // field id and name
		'type'	=> 'checkbox_group', // type of field
		'options' => array ( // array of options
			'one' => array ( // array key needs to be the same as the option value
				'label' => 'Parallax Effect', // text displayed as the option
				'value'	=> 'parallax' // value stored for the option
			),/*
			'two' => array (
				'label' => 'Option Two',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)*/
		)
	),




	array( // 
		'label'	=> 'Header Background Color', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale'),
			),
		'id'	=> $prefix.'header_background_color', // field id and name
		'type'	=> 'select', // type of field
		'default' => '000000',
		'options' => ak_get_color_options('hex')
	),
	array( 
		'label'	=> 'Fade Background Image', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale'),
			),
		'id'	=> $prefix.'header_background_opacity', // field id and name
		'type'	=> 'slider', // type of field
		'min'	=> '0', // lowest possible number
		'max'	=> '100', // highest possible number
		'step'	=> '1', //  how the slider steps as it is dragged
		'default' => '50',
	),
	array( // 
		'label'	=> 'Header Text Color', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale', 'simple'),
			),
		'id'	=> $prefix.'header_text_color', // field id and name
		'type'	=> 'akselect', // type of field
		'default' => 'default',
		'options' => array('Default' => 'default') + ak_get_color_options('name','akselect')
	),
	
	
	array( // 
		'label'	=> 'Header Alignment', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale', 'simple'),
			),
		'id'	=> $prefix.'header_alignment', // field id and name
		'default' => 'text-center',
		'type'	=> 'select', // type of field
		'options' => array ( // array of options
			'text-left' => array ( // array key needs to be the same as the option value
				'label' => 'Left', // text displayed as the option
				'value'	=> 'text-left' // value stored for the option
			),
			'text-center' => array (
				'label' => 'Center',
				'value'	=> 'text-center'
			),
			'text-right' => array (
				'label' => 'Right',
				'value'	=> 'text-right'
			)
		)
	),
	
	
	
	array(
	    'label' => 'Header Text',
	    'desc'  => 'You can use this instead of the page title.',
	    'dependent' => array(
			'field'	=> $prefix.'header_style',
			'value' => array('image_fill', 'image_fit', 'image_scale'),
			),
	    'id'    => $prefix.'header_override',
	    'type'  => 'editor',
	    'sanitizer' => 'wp_kses_post',
	    'settings' => array(
	        'textarea_name' => $prefix.'header_override',
	    )
	),
	array( // Messages Notes
		'label'	=> 'Additional Classes', // <label>
		'desc'	=> '(Advanced) Add extra CSS classes here.', // description
		'id'	=> $prefix.'header_classes', // field id and name
		'type'	=> 'text' // type of field
	),
);

$header_box = new custom_add_meta_box( 'ak_header_box', 'Header Options', $fields, array('page'), true );




// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// 							PAGE OPTIONS
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


/*

Page options:

	Show sidebar?
	Use sticky nav?
	Include in sticky nav?
	Width:
		full width
		box width
		centered
	padding


Background Options
	Color
	Image
	Parallax

	background style:
	 - colors, textures
	 - Image
	 - custom color

	 if image:
	  - fade
	  - Parallax?
	  - 


*/





$fields = array(

	/*
	- - - - - - - - - - - - - - Content Options - - - - - - - - - - - - - - - - - - - 
	*/

	array( // Checkbox group
		'label'	=> 'Page Options', // <label>
		//'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'page_options', // field id and name
		'type'	=> 'checkbox_group', // type of field
		'options' => array ( // array of options
			'sidebar' => array ( // array key needs to be the same as the option value
				'label' => 'Show Sidebar', // text displayed as the option
				'value'	=> 'sidebar' // value stored for the option
			),
			'sticky' => array (
				'label' => 'Show Sub Navigation',
				'value'	=> 'sticky'
			),/*
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)*/
		)
	),
	array( // 
		'label'	=> 'Content Style', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'page_style', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'Centered'			=>  'medium-centered',
			'Left' 				=> 	'split-left',
			'Right' 			=> 	'split-right',
		),
		'default' => 'medium-centered',
	),
	array( // 
		'label'	=> 'Content Width', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'page_width', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'Full Width (12)'		=>  'columns medium-12',
			'Medium (8)' 			=> 	'columns medium-8',// medium-centered',
			'Half (6)' 				=> 	'columns medium-6', // medium-centered',
			'Third (4)'				=>  'columns medium-4',
		),
		'default' => 'columns medium-8 medium-centered',
	),

	array( // 
		'label'	=> 'Content Padding', // <label>
		'desc'	=> 'How much top and bottom margin?', // description
		'id'	=> $prefix.'page_padding', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'Thick'				=>  'thick-padding',
			'Normal' 			=> 	'normal-padding',
			'Thin' 				=> 	'thin-padding',
			'None' 				=> 	'no-padding',
		),
		'default' => 'normal-padding',
	),

	array( // 
		'label'	=> 'Section Options', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'page_section_style', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'None'			=> 	'none',
			'Columns'		=>  'columns',
			'Top Tabs' 		=> 	'top-tabs',
			'Left Tabs' 	=> 	'left-tabs',
			'Tooltips'		=> 	'tooltips',
			'Dropdowns'		=> 	'dropdowns',
			'Accordion'		=>	'accordion',
			
		),
		'default' => 'none',
	),

	array( // 
		'label'	=> 'Section Columns', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'page_section_style',
			'value' => array('columns', 'tootips', 'dropdowns'),
			),
		'id'	=> $prefix.'page_section_columns', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'1'			=> 	'1',
			'2'			=>  '2',
			'3' 		=> 	'3',
			'4' 		=> 	'4',
			'6'			=> 	'6',
			
		),
		'default' => '3',
	),

	





	array(
		'type' => 'break'
	),


	/*
	- - - - - - - - - - - - - - Background Options - - - - - - - - - - - - - - - - - - - 
	*/

	array( // 
		'label'	=> 'Background Style', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'page_background_style', // field id and name
		'type'	=> 'akselect', // type of field
		'options' => array ( // array of options
			'Color'			=>  'color',
			'Cardboard'		=> 	'cardboard',
			'Wood'			=> 	'wood',
			'Image' 		=> 	'image',

		),
		'default' => 'none',
	),


	array( // Messages Notes
		'label'	=> 'Page Background Image', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'page_background_style',
			'value' => array('image'),
			),
		'id'	=> $prefix.'page_background_image', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // Checkbox group
		'label'	=> 'Image Options', // <label>
		//'desc'	=> 'A description for the field.', // description
		'dependent' => array(
			'field'	=> $prefix.'page_background_style',
			'value' => array('image'),
			),
		'id'	=> $prefix.'page_background_image_options', // field id and name
		'type'	=> 'checkbox_group', // type of field
		'options' => array ( // array of options
			'one' => array ( // array key needs to be the same as the option value
				'label' => 'Parallax Effect', // text displayed as the option
				'value'	=> 'parallax' // value stored for the option
			),/*
			'two' => array (
				'label' => 'Option Two',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)*/
		)
	),
	array( // Messages Notes
		'label'	=> 'Background Image Opacity', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'page_background_style',
			'value' => array('image'),
			),
		'id'	=> $prefix.'page_background_opacity', // field id and name
		'type'	=> 'slider', // type of field
		'min'	=> '0', // lowest possible number
		'max'	=> '100', // highest possible number
		'step'	=> '1', //  how the slider steps as it is dragged
		'default' => '100',
	),
	array( // 
		'label'	=> 'Page Color', // <label>
		//'desc'	=> 'Use', // description
		'dependent' => array(
			'field'	=> $prefix.'page_background_style',
			'value' => array('image', 'color'),
			),
		'id'	=> $prefix.'page_color', // field id and name
		'type'	=> 'select', // type of field
		'default' => 'white',
		'options' => ak_get_color_options('name')
	),
	
	/*
	array( // Text Input
		'label'	=> 'Video', // <label>
		'desc'	=> 'Paste in the url to a YouTube or Vimeo Video', // description
		'id'	=> $prefix.'page_video', // field id and name
		'type'	=> 'text' // type of field
	),
*/
	array( // Messages Notes
		'label'	=> 'Additional Classes', // <label>
		'desc'	=> '(Advanced) Add extra CSS classes here.', // description
		'id'	=> $prefix.'page_classes', // field id and name
		'type'	=> 'text' // type of field
	),
	
);

$header_box = new custom_add_meta_box( 'ak_page_box', 'Page Options', $fields, 'page', true );



$fields = array(
	
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Sections', // <label>
		'desc'	=> 'Add sections to this page.', // description
		'id'	=> $prefix.'section_repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'classes' => 'sanitize_text_field',
			'background_image' => 'wp_kses_data',
			'background_color' => 'wp_kses_data',
			'content' => 'wp_kses_post'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			'title' => array(
				'label' => 'Title',
				'id' => 'section_title',
				'type' => 'text'
			),
			
			/*'background_image' => array( // Image ID field
				'class'	=> 'sixcol first',
				'label'	=> 'Background Image', // <label>
				'id'	=> 'background_image', // field id and name
				'type'	=> 'image' // type of field
			),
			'background_color' => array(
			    'label' => 'Background Color',
			    'class' => 'threecol',
			   // 'desc'  => 'Previews the hexidecimal color and opens a color chooser when the field is clicked.',
			    'id'    =>  'background_color',
			    'type'  => 'color',
			),	
			'text_color' => array(
			    'label' => 'Text Color',
			    'class' => 'threecol last',
			   // 'desc'  => 'Previews the hexidecimal color and opens a color chooser when the field is clicked.',
			    'id'    =>  'text_color',
			    'type'  => 'color',
			),	*/		
			'content' => array(
				'label' => 'Content',
				'id' => 'sectioncontentfield',
				'type' => 'editor',
				'settings' => array(
					'textarea_name' => 'sectioncontentfield',
					'textarea_rows'	=> 4,
					'wpautop'		=> true,

					//'tinymce'	=> false,
				)
			),
			'classes' => array(
				'label' => 'Classes',
				'id' => 'section_classes',
				'type' => 'text'
			),
		)
	)
);

$sections_box = new custom_add_meta_box( 'ak_sections_box', 'Page Sections', $fields, 'page', true );





$fields = array(
	/*
	array( // Text Input
		'label'	=> 'Text Input', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'text', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Textarea
		'label'	=> 'Textarea', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'textarea', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array(
	    'label' => 'WYSIWYG Field',
	    'desc'  => 'A description goes here',
	    'id'    => 'editorField',
	    'type'  => 'editor',
	    'sanitizer' => 'wp_kses_post',
	    'settings' => array(
	        'textarea_name' => 'editorField'
	    )
	),
	array( // Single checkbox
		'label'	=> 'Checkbox Input', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'checkbox', // field id and name
		'type'	=> 'checkbox' // type of field
	),
	array( // Select box
		'label'	=> 'Select Box', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'select', // field id and name
		'type'	=> 'select', // type of field
		'options' => array ( // array of options
			'one' => array ( // array key needs to be the same as the option value
				'label' => 'Option One', // text displayed as the option
				'value'	=> 'one' // value stored for the option
			),
			'two' => array (
				'label' => 'Option Two',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)
		)
	),
	array( // Radio group
		'label'	=> 'Radio Group', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'radio', // field id and name
		'type'	=> 'radio', // type of field
		'options' => array ( // array of options
			'one' => array ( // array key needs to be the same as the option value
				'label' => 'Option One', // text displayed as the option
				'value'	=> 'one' // value stored for the option
			),
			'two' => array (
				'label' => 'Option Two',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)
		)
	),
	array( // Checkbox group
		'label'	=> 'Checkbox Group', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'checkbox_group', // field id and name
		'type'	=> 'checkbox_group', // type of field
		'options' => array ( // array of options
			'one' => array ( // array key needs to be the same as the option value
				'label' => 'Option One', // text displayed as the option
				'value'	=> 'one' // value stored for the option
			),
			'two' => array (
				'label' => 'Option Two',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Option Three',
				'value'	=> 'three'
			)
		)
	),
	array( // Taxonomy Select box
		'label'	=> 'Category', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'category', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	),
	array( // Post ID select box
		'label'	=> 'Post List', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=>  $prefix.'post_id', // field id and name
		'type'	=> 'post_select', // type of field
		'post_type' => 'post', //array('post','page') // post types to display, options are prefixed with their post type
	),
	array( // jQuery UI Date input
		'label'	=> 'Date', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'date', // field id and name
		'type'	=> 'date' // type of field
	),
	array( // jQuery UI Slider
		'label'	=> 'Slider', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'slider', // field id and name
		'type'	=> 'slider', // type of field
		'min'	=> '0', // lowest possible number
		'max'	=> '100', // highest possible number
		'step'	=> '5' // how the slider steps as it is dragged
	),
	array( // Image ID field
		'label'	=> 'Image', // <label>
		'desc'	=> 'A description for the field.', // description
		'id'	=> $prefix.'image', // field id and name
		'type'	=> 'image' // type of field
	),
	*/
/*
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Sections', // <label>
		'desc'	=> 'Add sections to this page.', // description
		'id'	=> $prefix.'section_repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'classes' => 'sanitize_text_field',
			'background_image' => 'wp_kses_data',
			'background_color' => 'wp_kses_data',
			'content' => 'wp_kses_post'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			'classes' => array(
				'label' => 'Classes',
				'id' => 'section_classes',
				'type' => 'text'
			),
			'background_image' => array( // Image ID field
				'class'	=> 'sixcol first',
				'label'	=> 'Background Image', // <label>
				'id'	=> 'background_image', // field id and name
				'type'	=> 'image' // type of field
			),
			'background_color' => array(
			    'label' => 'Background Color',
			    'class' => 'threecol',
			   // 'desc'  => 'Previews the hexidecimal color and opens a color chooser when the field is clicked.',
			    'id'    =>  'background_color',
			    'type'  => 'color',
			),	
			'text_color' => array(
			    'label' => 'Text Color',
			    'class' => 'threecol last',
			   // 'desc'  => 'Previews the hexidecimal color and opens a color chooser when the field is clicked.',
			    'id'    =>  'text_color',
			    'type'  => 'color',
			),			
			'content' => array(
				'label' => 'Content',
				'id' => 'sectioncontentfield',
				'type' => 'editor',
				'settings' => array(
					'textarea_name' => 'sectioncontentfield',
					'textarea_rows'	=> 8,
					'wpautop'		=> true,

					//'tinymce'	=> false,
				)
			)
		)
	)
	*/
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
//$sections_box = new custom_add_meta_box( 'ak_sections_box', 'Page Sections', $fields, 'page', true );














?>