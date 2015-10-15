<?php
/* Bones Staff Type Example
This page walks you through creating 
a staff type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'ak_';


$fields = array(

	array( // jQuery UI Date input
		'label'	=> 'Title', // <label>
		//'desc'	=> 'When was this message?', // description
		'id'	=> $prefix.'staff_title', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Email', // <label>
		//'desc'	=> 'When was this message?', // description
		'id'	=> $prefix.'staff_email', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Twitter', // <label>
		//'desc'	=> 'When does this group meet?', // description
		'id'	=> $prefix.'staff_twitter', // field id and name
		'type'	=> 'text' // type of field
	),
	
);

$event_box = new custom_add_meta_box( 'ak_staff_options', 'Staff Set-up', $fields, 'staff', true );


// let's create the function for the staff
function staff_post_type() { 
	// creating (registering) the staff 
	register_post_type( 'staff', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Staff Members', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Staff', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Staff Members', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Staff', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Staff', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Staff', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Staff', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Staffs', 'bonestheme'), /* Search Staff Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Members of your team.', 'bonestheme' ), /* Staff Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the staff type menu */
			'rewrite'	=> array( 'slug' => 'staff', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'staff', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your staff type */
	//register_taxonomy_for_object_type('category', 'staff');
	/* this adds your post tags to your staff type */
	//register_taxonomy_for_object_type('post_tag', 'staff');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'staff_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	if (true) { // turn this stuff off


		// now let's add staff Shows (these act like categories)
	    register_taxonomy( 'staff-cat', 
	    	array('staff'), /* if you change the name of register_post_type( 'staff', then you have to change this */
	    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
	    		'labels' => array(
	    			'name' => __( 'Departments', 'bonestheme' ), /* name of the custom taxonomy */
	    			'singular_name' => __( 'Department', 'bonestheme' ), /* single taxonomy name */
	    			'search_items' =>  __( 'Search Departments', 'bonestheme' ), /* search title for taxomony */
	    			'all_items' => __( 'All Departments', 'bonestheme' ), /* all title for taxonomies */
	    			'parent_item' => __( 'Parent Department', 'bonestheme' ), /* parent title for taxonomy */
	    			'parent_item_colon' => __( 'Parent Department:', 'bonestheme' ), /* parent taxonomy title */
	    			'edit_item' => __( 'Edit SDepartment', 'bonestheme' ), /* edit custom taxonomy title */
	    			'update_item' => __( 'Update Department', 'bonestheme' ), /* update title for taxonomy */
	    			'add_new_item' => __( 'Add New Department', 'bonestheme' ), /* add new title for taxonomy */
	    			'new_item_name' => __( 'New Department Name', 'bonestheme' ) /* name title for taxonomy */
	    		),
	    		'show_ui' => true,
	    		'query_var' => true,
	    		'rewrite' => array( 'slug' => 'custom-slug' ),
	    	)
	    );   
	
	} 
	
	if (false) { // turn this stuff off
		// now let's add custom tags (these act like categories)
	    register_taxonomy( 'staff_tag', 
	    	array('staff'), /* if you change the name of register_post_type( 'staff', then you have to change this */
	    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
	    		'labels' => array(
	    			'name' => __( 'Tags', 'bonestheme' ), /* name of the custom taxonomy */
	    			'singular_name' => __( 'Tag', 'bonestheme' ), /* single taxonomy name */
	    			'search_items' =>  __( 'Search Tags', 'bonestheme' ), /* search title for taxomony */
	    			'all_items' => __( 'All Tags', 'bonestheme' ), /* all title for taxonomies */
	    			'parent_item' => __( 'Parent Tag', 'bonestheme' ), /* parent title for taxonomy */
	    			'parent_item_colon' => __( 'Parent Tag:', 'bonestheme' ), /* parent taxonomy title */
	    			'edit_item' => __( 'Edit Tag', 'bonestheme' ), /* edit custom taxonomy title */
	    			'update_item' => __( 'Update Tag', 'bonestheme' ), /* update title for taxonomy */
	    			'add_new_item' => __( 'Add New Tag', 'bonestheme' ), /* add new title for taxonomy */
	    			'new_item_name' => __( 'New Tag Name', 'bonestheme' ) /* name title for taxonomy */
	    		),
	    		'show_ui' => true,
	    		'query_var' => true,
	    	)
	    ); 
	}

	
    
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS

class Staff extends AKPost {	

	function __construct(&$post) {

		parent::__construct($post);

	}

}





	

?>