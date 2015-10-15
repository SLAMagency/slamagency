<?php
/* Bones Series Type Example
This page walks you through creating 
a series type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the series
function series_post_type() { 
	// creating (registering) the series 
	register_post_type( 'series', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Series', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Series', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Seriess', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Series', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Series', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Series', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Series', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Series', 'bonestheme'), /* Search Series Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Series are groups of messages.', 'bonestheme' ), /* Series Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the series type menu */
			'rewrite'	=> array( 'slug' => 'series', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'series', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your series type */
	register_taxonomy_for_object_type('category', 'series');
	/* this adds your post tags to your series type */
	register_taxonomy_for_object_type('post_tag', 'series');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'series_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	if (0>1) {

	// now let's add series Shows (these act like categories)
    register_taxonomy( 'custom_cat', 
    	array('series'), /* if you change the name of register_post_type( 'series', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Series Shows', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Series sHow', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Series Shows', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Series Shows', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Series Show', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Series Show:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Series Show', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Series Show', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Series Show', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Series Show Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'custom-slug' ),
    	)
    );   
    
	
	

	// now let's add custom tags (these act like categories)
    register_taxonomy( 'custom_tag', 
    	array('series'), /* if you change the name of register_post_type( 'series', then you have to change this */
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