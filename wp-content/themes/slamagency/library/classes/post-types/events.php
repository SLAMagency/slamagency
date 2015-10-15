<?php
//use Base;

/* 
Event Post Type
*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'ak_';


$fields = array(

	
	array( // jQuery UI Date input
		'label'	=> 'Date', // <label>
		//'desc'	=> 'When was this message?', // description
		'id'	=> $prefix.'date', // field id and name
		'type'	=> 'date' // type of field
	),
	array( // 
		'label'	=> 'Time', // <label>
		//'desc'	=> 'When does this group meet?', // description
		'id'	=> $prefix.'time', // field id and name
		'type'	=> 'time' // type of field
	),
	array( // 
		'label'	=> 'Where', // <label>
		//'desc'	=> 'Where does this group meet?', // description
		'id'	=> $prefix.'location', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // 
		'label'	=> 'Address', // <label>
		'desc'	=> 'If you include an address, we\'ll add a link to a google map.', // description
		'id'	=> $prefix.'address', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // 
		'label'	=> 'Registration Form', // <label>
		'desc'	=> 'Add a registration form?', // description
		'id'	=> $prefix.'registration', // field id and name
		'type'	=> 'checkbox' // type of field
	),
	array( // 
		'label'	=> 'Recipient Email', // <label>
		'desc'	=> 'Who should be notified of registrations?', // description
		'id'	=> $prefix.'registration_email', // field id and name
		'type'	=> 'text', // type of field
		'default' => get_theme_mod('email')
	),
	array( // 
		'label'	=> 'Childcare', // <label>
		'desc'	=> 'Will childcare be available?', // description
		'id'	=> $prefix.'childcare', // field id and name
		'type'	=> 'checkbox' // type of field
	),
	array( // Radio group
		'label'	=> 'Frequency', // <label>
		'desc'	=> 'Is this a recurring event?', // description
		'id'	=> $prefix.'frequency', // field id and name
		'type'	=> 'radio', // type of field
		'options' => array ( // array of options
			'once' => array ( // array key needs to be the same as the option value
				'label' => 'One-Time Event', // text displayed as the option
				'value'	=> 'once' // value stored for the option
			),
			'weekly' => array (
				'label' => 'Weekly Event',
				'value'	=> 'weekly'
			),
			'monthly' => array (
				'label' => 'Monthly Event',
				'value'	=> 'monthly'
			)
		),
		'default' => 'once',
	),

	
);

$event_box = new custom_add_meta_box( 'ak_event_options', 'Event Set-up', $fields, 'event', true );



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
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail',  'custom-fields')
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
	
	


	// now let's add event categories (these act like categories)
    register_taxonomy( 'event_cat', 
    	array('event'), /* if you change the name of register_post_type( 'event', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Event Categories', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Event Category', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Categories', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Event Categories', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Event Category', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Event Category:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Event Category', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Event Category', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Event Category', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Event Category Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'event-category' ),
    	)
    );   
	    

	


    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ADMIN LIST VIEW

	

    // SET-UP CUSTOM COLUMNS FOR THE EDIT SCREEN


    // Create a list of our custom columns
	add_filter( 'manage_edit-event_columns', 'ak_edit_event_columns' ) ;

	function ak_edit_event_columns( $columns ) {

		$columns = array(
			'cb' => '<input type="checkbox" />',
			
			'title' => __( 'Title' ),
			'event_date' => __( 'Date' ),
			'frequency' => __( 'Frequency' ),
			'image' => __( 'Image' ),
			//'actions' => __( 'Action' ),
			'event_cat' => __( 'Category' ),
			//'votes' => __( 'Votes' ),
			//'start-date' => __( 'video Date' ),		
			'date' => __( 'Published Date' )
		);

		return $columns;
	}

	// Tell WordPress what to do with these custom columns
	add_action( 'manage_event_posts_custom_column', 'ak_manage_event_columns', 10, 2 );

	function ak_manage_event_columns( $column, $post_id ) {
		global $post;
		$event = new Event($post);

		switch( $column ) {
			case 'event_date':
					// $event_date = get_post_meta($post->ID, "ak_date", true);
					echo $event->date();


				break;

			case 'frequency':
					
					echo $event->frequency;


				break;

			// If displaying the 'duration' column. 
			case 'image' :

				
				$image = get_the_post_thumbnail( $post_id, 'thumb' );
				//get_post_meta( $post_id, 'duration', true );
				$link = get_edit_post_link( $post_id ); 
				$video = get_post_meta($post_id, 'ak_video_url', true);

				// If no image is found, output a default message. 
				if ( empty( $image ) ) {
					echo "<a href='{$video}' rel='prettyPhoto'>";
					echo __( '(No image)' );
					echo "</a>";
				} else {
					echo "<a href='{$video}' rel='prettyPhoto' class='video'><span></span>";

					echo $image;	
					echo "</a>";			
				}
				break;


			case 'event_cat' :

				$event_cat = wp_get_post_terms( $post_id, 'event_cat');
				echo "<a href='edit.php?s&post_type=event&event_cat=" . $event_cat[0]->slug . "'>";
				echo $event_cat[0]->name;
				echo "</a>";

				break;


			// Just break out of the switch statement for everything else. 
			default :
				break;
		}
	}


	// Add Filter for our custom taxonomy:

	add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
	function my_restrict_manage_posts() {

	    // only display these taxonomy filters on desired custom post_type listings
	    global $typenow;
	    if ($typenow == 'event' ) {

	        // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
	        $filters = array('event_cat'); //get_taxonomies(); //array('plants', 'animals', 'insects');

	        foreach ($filters as $tax_slug) {
	            // retrieve the taxonomy object
	            $tax_obj = get_taxonomy($tax_slug);
	            $tax_name = $tax_obj->labels->name;
	            // retrieve array of term objects per taxonomy
	            $terms = get_terms($tax_slug);

	            // output html for taxonomy dropdown filter
	            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
	            echo "<option value=''>Show All $tax_name</option>";
	            foreach ($terms as $term) {
	                // output each select option line, check against the last $_GET to show the current option selected
	                echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
	            }
	            echo "</select>";
	        }
	    }
	}	




	// Make custom columns sortable:

	// First, tell WordPress which columns should be sortable:
	add_filter( 'manage_edit-event_sortable_columns', 'ak_event_sortable_columns' );

	function ak_event_sortable_columns( $columns ) {

		$columns['event_cat'] = 'event_cat';
		//$columns['event_date'] = 'ak_date';

		return $columns;
	}


	// Only run our customization on the 'edit.php' page in the admin. 
	add_action( 'load-edit.php', 'ak_edit_event_load' );

	function ak_edit_event_load() {
		add_filter( 'request', 'ak_sort_event' );
	}

	// Sorts the video. 
	function ak_sort_event( $vars ) {

		// Check if we're viewing the 'event' post type. 
		if ( isset( $vars['post_type'] ) && 'event' == $vars['post_type'] ) {

			// Check if 'orderby' is set to 'duration'. 
			if ( isset( $vars['event_cat'] ) && 'event_cat' == $vars['event_cat'] ) {

				// Merge the query vars with our custom variables. 
				$vars = array_merge(
					$vars,
					array(
						
						'orderby' => 'event_cat'
					)
				);
			}
		}

		return $vars;
	}



function orderby_tax_clauses( $clauses, $wp_query ) {
    global $wpdb;
    $taxonomies = get_taxonomies();
    foreach ($taxonomies as $taxonomy) {
        if ( isset( $wp_query->query['orderby'] ) && $taxonomy == $wp_query->query['orderby'] ) {
            $clauses['join'] .=<<<SQL
LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;
            $clauses['where'] .= " AND (taxonomy = '{$taxonomy}' OR taxonomy IS NULL)";
            $clauses['groupby'] = "object_id";
            $clauses['orderby'] = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
            $clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
        }
    }
    return $clauses;
}

    add_filter('posts_clauses', 'orderby_tax_clauses', 10, 2 );







// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS

class Event extends BasePost {

	

	function __construct(&$post) {

		parent::__construct($post);

		
		if(!$this->image ) {
			$this->image = get_theme_mod('ak_default_image');
		}
		
		$this->class = 'event';
		$this->get_expiration();
		$this->expire();

		$this->info = array(
			'title' => $this->title,
			'date'	=> $this->date(),
			//'date'	=> $this->expiration,
			'time'	=> $this->time(),
		);

	}

	public function form() {

		$out = '<hr><h4>Register:</h4>';

		$fields = array(
			'name' => 'text', 
			'email' => 'email',
			'phone'	=> 'phone',
		);

		if($this->childcare) {
			$fields['childcare'] = 'checkbox';
		}

		if(!$this->registration_email) {
			$this->registration_email = get_theme_mod('email');
		}




		$out .= "<form method='POST' action=''>";

		foreach($fields as $name => $type) {

			$title = ucfirst($name);
			$out .= "<label for='{$name}'>$title</label>";


			switch($type) {
				case 'text':
					$out .= "<input required type='{$type}' name='{$name}' value='{$_POST[$name]}'>";
					break;
				case 'phone':
					$out .= "<input type='tel' name='{$name}' value='{$_POST[$name]}'>";
					break;
				case 'email':
					$out .= "<input required type='{$type}' name='{$name}' value='{$_POST[$name]}'>";
					break;	
				case 'checkbox':
					$out .= "<input type='{$type}' name='{$name}' value='{$_POST[$name]}'><label for={$name}>I need {$name}.</label><br/>";
					break;	
				default:
					$out .= "<input required type='{$type}' name='{$name}' value='{$_POST[$name]}'>";
			}
			
		}

		$out .= "<input type='submit' value='Register' class='button'>";

		$out .= "</form><hr>";

		if($_POST['name'] && $_POST['email']){
			
			$out = "<h5 data-alert class='alert-box'>Thanks for registering!</h5>";
			$this->registration($_POST);

		}

		return $out;

	}

	private function registration($submission) {



		
		$message =  "New registration for {$this->title}, {$this->date} \n\n";
		$message .= "\nName: " . $submission['name'];
		$message .= "\nEmail: " . $submission['email'];
		$message .= "\nPhone: " . $submission['phone'];
		$message .= "\nChildcare: " . $submission['childcare'];

		//echo $message;

		wp_mail( 
			$this->registration_email, 
			$this->title . ' Registration',
			$message
		);

		echo $this->ID;
		echo add_post_meta($this->ID, 'registration', $submission);

	}


	/**
	 * Combine Date and Time values to get an expiration timestamp
	 * @return timestamp
	 */
	private function get_expiration() {
		$this->expiration = strtotime($this->date . ' ' . $this->time);
		update_post_meta($this->ID, 'ak_expiration', $this->expiration);
		$this->expiration_string = date('M d, g:i a', $this->expiration);
		return $this->expiration;
	}

	/**
	 * Replaces expiration method with one that checks first to see
	 * if the event is expired, but then also checks to see if it is a 
	 * recurring event, and updates the post accordingly.
	 * @return [type]
	 */
	public function expire() {

		$now = time();

		$future = $this->expiration > $now;

		if(!$future) {

			switch($this->frequency) {
				case 'weekly':
						$this->update_week();
					break;
				case 'monthly':
						$this->update_month();
					break;
				default:
						$current_post = get_post( $this->ID, 'ARRAY_A' );
					    $current_post['post_status'] = 'draft';
					    wp_update_post($current_post);
				    break;
			}

			return true;

		} else {

			return false;
			
		}
	}


	/**
	 * Updates event to next week
	 * @return [type]
	 */
	private function update_week(){

		$date = new DateTime();
		$date->setTimestamp( $this->expiration );
		$now = new DateTime();

		// Keep adding weeks until we get to the future.
		while ($date < $now) {

			$date->modify('+1 week');
			
		}

		$new_date = $date->format('Y-m-d');
		update_post_meta($this->ID, 'ak_date', $new_date);
		$this->date = $date->format('Y-m-d');


	}

	/**
	 * Updates the event to the next month. If it was set to the 2nd
	 * Tuesday of March, it will now set to the next 2nd Tuesday of the month.
	 * @return [type]
	 */
	private function update_month(){
		
			// Create DateTime Object
			$date = new DateTime();
			$date->setTimestamp( $this->expiration );

			$time = $date->format('H:i');

			//Past?
			$now = new DateTime(); // defaults to current time
			$past = $now > $date;

			// Calculate Ordinal
			$day = $date->format('l'); // Returns the day spelled out, like "Sunday";
			$dayth = $date->format('d'); // Returns the day of the month, like "14";

			// Determine the ordinal - Is this the "Second" Sunday?
			switch($dayth) {
		      case ($dayth < 8):
		        $ordinal = 'first';
		        break;

		      case ($dayth < 15):
		        $ordinal = 'second';
		        break;

		      case ($dayth < 22):
		        $ordinal = 'third';
		        break;

		      case ($dayth < 29):
		        $ordinal = 'fourth';
		        break;

		      case ($dayth >= 29):
		        $ordinal = 'fifth';
		        break;

		      default: 
		        $ordinal = 'first';
		    }

		    // A modify string that finds the next such day in the next month:
		    $modify_string = "{$ordinal} {$day} of next month";

		    // Push forward
		    if($ordinal == 'fifth') {
		      // We need an extra check for our fifths, since if PHP doesn't find a 'fifth' Sunday, it will default to the first.
		      // So, if we detect that this day is not actually a fifth, we'll keep adding months until we find one.
		      while ($date < $now || intval( $date->format('d') ) < 29) {
		        $date->modify( $modify_string );
		      }
		    } else {
		      // If it's not a fifth, then we just need to keep going until we're in the future.
		      while ($date < $now) {
		        $date->modify( $modify_string );
		      }
		    }

		    
		    $new_date = $date->format('Y-m-d');
		  

			update_post_meta($this->ID, 'ak_date', $new_date);
			$this->date = $date->format('Y-m-d');
		 

	}





}

function ak_sort_events_by_date( $query ) {


	//if( $query->query_var['post_type'] == 'message' || $query->is_tax == 1) {
	if( $query->query_vars['post_type'] == 'event' ) {
		//echo "<h1>hi</h1>";
		$query->set( 'meta_key', 'ak_date' );
		$query->set( 'meta_type', 'DATE' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
	}

	
}
add_action( 'pre_get_posts', 'ak_sort_events_by_date', 1000 );


function ak_get_event_list($args) {

}


function ak_get_events( $atts ) {
	extract( shortcode_atts( array(
		'number' 	=> '3',
		'class'		=> '',
		'info'		=> array('date', 'title', 'image'),
		'category'	=> '',
		'style'		=> 'list',
	), $atts ));


	$args = array(
		'post_type'			=> 'event',
		'posts_per_page'	=> $number,
		'category' 			=> $category,
	);

	$transient_name = 'ak_events_' . implode('-', $args);
	$transient_events = get_transient( $transient_name );
	
	if( false === $transient_events ) {
		$list = new AKList($args);
		$out = $list->build($style);
		set_transient( $transient_name, $out, HOUR_IN_SECONDS/4 );
	} else {
		$out = $transient_events;
	}

	return $out;
}
add_shortcode( 'get_events','ak_get_events' );	



	

?>