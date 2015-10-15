<?php
/* 
Group Post Type
*/


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'ak_';


$fields = array(

	
	array( // Speaker
		'label'	=> 'Day', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'day', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_apply', // type of field
		'taxonomy' => 'day',
		'desc'	=> 'When does this group meet?', // description
	),
	array( // Speaker
		'label'	=> 'Hub', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'hub', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_apply', // type of field
		'taxonomy' => 'hub',
		'desc'	=> 'What kind of group is this?', // description
	),
	array( // jQuery UI Date input
		'label'	=> 'Time', // <label>
		'desc'	=> 'When does this group meet?', // description
		'id'	=> $prefix.'time', // field id and name
		'type'	=> 'time' // type of field
	),
	array( // jQuery UI Date input
		'label'	=> 'Where', // <label>
		'desc'	=> 'Where does this group meet?', // description
		'id'	=> $prefix.'location', // field id and name
		'type'	=> 'text' // type of field
	),
	
);

$group_box = new custom_add_meta_box( 'ak_group_options', 'Group Set-up', $fields, 'group', true );


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - REGISTER GROUP

// let's create the function for the small group
function group_post_type() { 
	// creating (registering) the small group 
	register_post_type( 'group', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Groups', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Group', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Groups', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Group', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Group', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Group', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Group', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Groups', 'bonestheme'), /* Search Small group Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Use groups to tell people what is going on.', 'bonestheme' ), /* Small group Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the small group type menu */
			'rewrite'	=> array( 'slug' => 'group', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'groups', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your small group type */
	//register_taxonomy_for_object_type('category', 'group');
	/* this adds your post tags to your small group type */
	register_taxonomy_for_object_type('post_tag', 'group');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'group_post_type');
	

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CUSTOM TAXONOMIES

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add small group Categories (these act like categories)
    register_taxonomy( 'hub', 
    	array('group'), /* if you change the name of register_post_type( 'small group', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Group Hubs', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Group Hub', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Group Hubs', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Group Hubs', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Group Hub', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Group Hub:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Group Hub', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Group Hub', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Group Hub', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Group Hub Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'show_admin_column' => true,
    		'rewrite' => array( 'slug' => 'hub' ),
    	)
    );   


	// now let's add small group Categories (these act like categories)
    register_taxonomy( 'day', 
    	array('group'), /* if you change the name of register_post_type( 'small group', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Day', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Day', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Days', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Days', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Day', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Day:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Day', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Day', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Day', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Day Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'day' ),
    		'show_admin_column' => true,
    		'sort' => true,
    	)
    );   

	// Pre-load days
	wp_insert_term('Monday', 'day');
	wp_insert_term('Tuesday', 'day');
	wp_insert_term('Wednesday', 'day');
	wp_insert_term('Thursday', 'day');
	wp_insert_term('Friday', 'day');
	wp_insert_term('Saturday', 'day');
	wp_insert_term('Sunday', 'day');
	wp_insert_term('Various', 'day');
	
	 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS

class Group extends BasePost{

	function __construct($post) {

		parent::__construct($post);

		//$this->day = implode(', ', wp_get_post_terms( $this->ID, 'day') );

		$this->info = array(
			'title' => $this->title,
		);

	}


	public function get_hubs() {

		$args = array(
			'hide_empty' => false,
		);

		$out = '';

		$out .= "<ul class='small-block-grid-2 medium-block-grid-3 large-block-grid-4'>";

		$hubs = get_terms( 'hub', $args );
		foreach($hubs as $hub) {
			//print_r($hub);
			$hub = new Hub($hub);
			$out .= $hub->dropdown();
		}

		$out .= "</ul>";

		return $out;

	}


}



class Hub {

	public $image;
	public $term;
	public $info;
	public $permalink;
	public $title;

	use traits\block_item;

	function __construct($term) {

		$this->term = $term; //get_term_by('id', $id, 'hub');
		$this->image = get_terms_meta($term->term_id, 'hub_image');
		$this->image = $this->image[0];
		$this->title = $this->term->name;
		$this->permalink = "/hub/{$this->term->slug}";

		$this->info = array(
			'title' => $this->term->name,
		);
		;
	}

	function info(){
		foreach($this->info as $key => $value) {
			
			$out .= "<span class='info-item {$key}'>{$value}</span>";
			
		}
		return $out;
	}

	function image($input) {
		return "<img src='{$this->image}'>";
	}

	function get_groups() {

		$args = array(
			'post_type'	=> 'group',
			'tax_query' => array(
				array(
					'taxonomy' => 'hub',
					'field'    => 'id',
					'terms'    => $this->term->term_id,
				),
			),
		);
		$group_query = new WP_Query($args);

		$out .= "<ul id='hover-{$this->term->slug}' data-dropdown-content class='f-dropdown content'>";

		if ( $group_query->have_posts() ) {
			
			while ( $group_query->have_posts() ) {
				$group_query->the_post();

				$group = new Group($group_query->post);
				$out .= "<li><a href='{$group->permalink}'>{$group->title}</a></li>";
				
			}
			
		} else {
			$out .= "<li><a>Coming Soon!</a></li>";
		}

		$out .= "</ul>";

		return $out;

	}


	function dropdown() {

		$image = $this->image;

		if(!$image) {
			$image = \AK::get_default_image();
		}

		$out = '';

		$out .= "<li class='list-item list-item--block block hub {$class}'>";
		$out .= 	"<a href='#' data-dropdown='hover-{$this->term->slug}' title='{$this->title}'>";
		$out .= 		"<img src='{$this->image}' alt='{$this->title}'>";
		$out .=		"<div class='info'>" . $this->info() . "</div>";
		$out .= 	"</a>";
		$out .= 	$this->get_groups();
		$out .= "</li>";


		return $out;

	}


}

function ak_get_hubs( $atts ) {
	$atts = shortcode_atts( array(
		'default' => 'values'
	), $atts );

	return Group::get_hubs();
}
add_shortcode( 'get_hubs','ak_get_hubs' );


	

?>