<?php
/* Bones Image-link Type Example
This page walks you through creating 
a image-link type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the image-link
function image_link_post_type() { 
	// creating (registering) the image-link 
	register_post_type( 'image-link', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Image-Links', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Image-Link', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Image-Links', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Image-Link', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Image-Link', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Image-Link', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Image-Link', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Image-Links', 'bonestheme'), /* Search Image-link Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Members of your team.', 'bonestheme' ), /* Image-link Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/image-link-icon.png', /* the icon for the image-link type menu */
			'rewrite'	=> array( 'slug' => 'image-link', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'image-link', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your image-link type */
	//register_taxonomy_for_object_type('category', 'image-link');
	/* this adds your post tags to your image-link type */
	//register_taxonomy_for_object_type('post_tag', 'image-link');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'image_link_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	


		// now let's add staff Shows (these act like categories)
	    register_taxonomy( 'link-cat', 
	    	array('image-link'), /* if you change the name of register_post_type( 'staff', then you have to change this */
	    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
	    		'labels' => array(
	    			'name' => __( 'Link Groups', 'bonestheme' ), /* name of the custom taxonomy */
	    			'singular_name' => __( 'Link Group', 'bonestheme' ), /* single taxonomy name */
	    			'search_items' =>  __( 'Search Link Groups', 'bonestheme' ), /* search title for taxomony */
	    			'all_items' => __( 'All Link Groups', 'bonestheme' ), /* all title for taxonomies */
	    			'parent_item' => __( 'Parent Link Group', 'bonestheme' ), /* parent title for taxonomy */
	    			'parent_item_colon' => __( 'Parent Link Group:', 'bonestheme' ), /* parent taxonomy title */
	    			'edit_item' => __( 'Edit Link Group', 'bonestheme' ), /* edit custom taxonomy title */
	    			'update_item' => __( 'Update Link Group', 'bonestheme' ), /* update title for taxonomy */
	    			'add_new_item' => __( 'Add New Link Group', 'bonestheme' ), /* add new title for taxonomy */
	    			'new_item_name' => __( 'New Link Group Name', 'bonestheme' ) /* name title for taxonomy */
	    		),
	    		'show_ui' => true,
	    		'query_var' => true,
	    		'rewrite' => array( 'slug' => 'custom-slug' ),
	    	)
	    );   
	    
	if (0 > 1) { // turn this stuff off
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
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>