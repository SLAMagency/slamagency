<?php

/* 
Event Post Type
*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'slam_';


$fields = array(

	
	array( // jQuery UI Date input
		'label'	=> 'Date', // <label>
		//'desc'	=> 'When was this message?', // description
		'id'	=> $prefix.'date', // field id and name
		'type'	=> 'date' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Time', // <label>
		//'desc'	=> 'When does this group meet?', // description
		'id'	=> $prefix.'time', // field id and name
		'type'	=> 'time' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Link', // <label>
		//'desc'	=> 'Where does this group meet?', // description
		'id'	=> $prefix.'link', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Where', // <label>
		//'desc'	=> 'Where does this group meet?', // description
		'id'	=> $prefix.'location', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Address', // <label>
		'desc'	=> 'If you include an address, we\'ll add a link to a google map.', // description
		'id'	=> $prefix.'address', // field id and name
		'type'	=> 'text' // type of field
	),
	// array( // Radio group
	// 	'label'	=> 'Frequency', // <label>
	// 	'desc'	=> 'Is this a recurring event?', // description
	// 	'id'	=> $prefix.'frequency', // field id and name
	// 	'type'	=> 'radio', // type of field
	// 	'options' => array ( // array of options
	// 		'once' => array ( // array key needs to be the same as the option value
	// 			'label' => 'One-Time Event', // text displayed as the option
	// 			'value'	=> 'once' // value stored for the option
	// 		),
	// 		'weekly' => array (
	// 			'label' => 'Weekly Event',
	// 			'value'	=> 'weekly'
	// 		),
	// 		'monthly' => array (
	// 			'label' => 'Monthly Event',
	// 			'value'	=> 'monthly'
	// 		)
	// 	),
	// 	'default' => 'once',
	// ),

	
);

$event_box = new custom_add_meta_box( 'slam_event_options', 'Event Set-up', $fields, 'event', true );



// let's create the function for the event
function event_post_type() { 
	// creating (registering) the event 
	register_post_type( 'event', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Events', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Event', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Events', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Event', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Event', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Event', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Event', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Events', 'bonestheme'), /* Search Event Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Use events to tell people what is going on.', 'bonestheme' ), /* Event Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the event type menu */
			'rewrite'	=> array( 'slug' => 'event', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your event type */
	//register_taxonomy_for_object_type('category', 'event');
	//register_taxonomy_for_object_type('group-cat', 'event');
	/* this adds your post tags to your event type */
	//register_taxonomy_for_object_type('post_tag', 'event');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'event_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	


	// // now let's add event categories (these act like categories)
 //    register_taxonomy( 'event_cats', 
 //    	array('event'), /* if you change the name of register_post_type( 'event', then you have to change this */
 //    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
 //    		'labels' => array(
 //    			'name' => __( 'Event Categories', 'bonestheme' ), /* name of the custom taxonomy */
 //    			'singular_name' => __( 'Event Category', 'bonestheme' ), /* single taxonomy name */
 //    			'search_items' =>  __( 'Search Categories', 'bonestheme' ), /* search title for taxomony */
 //    			'all_items' => __( 'All Event Categories', 'bonestheme' ), /* all title for taxonomies */
 //    			'parent_item' => __( 'Parent Event Category', 'bonestheme' ), /* parent title for taxonomy */
 //    			'parent_item_colon' => __( 'Parent Event Category:', 'bonestheme' ), /* parent taxonomy title */
 //    			'edit_item' => __( 'Edit Event Category', 'bonestheme' ), /* edit custom taxonomy title */
 //    			'update_item' => __( 'Update Event Category', 'bonestheme' ), /* update title for taxonomy */
 //    			'add_new_item' => __( 'Add New Event Category', 'bonestheme' ), /* add new title for taxonomy */
 //    			'new_item_name' => __( 'New Event Category Name', 'bonestheme' ) /* name title for taxonomy */
 //    		),
 //    		'show_ui' => true,
 //    		'query_var' => true,
 //    		'rewrite' => array( 'slug' => 'custom-slug' ),
 //    	)
 //    );   
	    

	
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS

class Event extends SlamPost {

	function __construct(&$post) {

		parent::__construct($post);

		$this->get_expiration();

		$this->expired = $this->expire();

	}

	function get_expiration() {

		$this->expiration = strtotime($this->date . ' ' . $this->time);
		$this->expiration_string = date('M d, g:i a', $this->expiration);

	}

}

 function slam_sort_events_by_date( $query ) {


	//if( $query->query_var['post_type'] == 'message' || $query->is_tax == 1) {
	if( $query->query_vars['post_type'] == 'event' ) {
		//echo "<h1>hi</h1>";
		$query->set( 'meta_key', 'slam_date' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
	}
	
}
add_action( 'pre_get_posts', 'slam_sort_events_by_date', 1000 );




	

?>