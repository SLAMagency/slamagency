<?php
/* 
Message Post Type
*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'ak_';


$fields = array(

	array( // jQuery UI Date input
		'label'	=> 'Message Date', // <label>
		'desc'	=> 'When was this message?', // description
		'id'	=> $prefix.'date', // field id and name
		'type'	=> 'date' // type of field
	),

	array( // Taxonomy Select box
		'label'	=> 'Message Series', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'series', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_apply', // type of field
		'desc'	=> 'Is this a part of a series?', // description
	),

	array( // Taxonomy Select box
		'label'	=> 'Speaker', // <label>
		// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'speaker', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_apply', // type of field
		'desc'	=> 'Who spoke this message?', // description
	),

	array( // Text Input
		'label'	=> 'Message Audio', // <label>
		'desc'	=> 'Upload your mp3 file.', // description
		'id'	=> $prefix.'audio', // field id and name
		'type'	=> 'file' // type of field
	),

	array( // Text Input
		'label'	=> 'Message Audio - External', // <label>
		'desc'	=> 'If your mp3 file is stores elsewhere, place it\'s URL here.', // description
		'id'	=> $prefix.'audio_link', // field id and name
		'type'	=> 'text' // type of field
	),

	array( // Text Input
		'label'	=> 'Message Notes?', // <label>
		'desc'	=> 'Have notes or transcript? You can upload it here.', // description
		'id'	=> $prefix.'notes', // field id and name
		'type'	=> 'file' // type of field
	),

	array( // Text Input
		'label'	=> 'Message Video?', // <label>
		'desc'	=> 'Paste in a link to a YouTube or Vimeo video for this message.', // description
		'id'	=> $prefix.'video', // field id and name
		'type'	=> 'text' // type of field
	),

	
);

$slide_box = new custom_add_meta_box( 'ak_message_options', 'Message Set-up', $fields, 'message', true );



// let's create the function for the message
function message_post_type() { 
	// creating (registering) the message 
	register_post_type( 'message', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Messages', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Message', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Messages', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Message', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Message', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Message', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Message', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Message', 'bonestheme'), /* Search Message Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example message', 'bonestheme' ), /* Message Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the message type menu */
			'rewrite'	=> array( 'slug' => 'message', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'messages', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail')
	 	) /* end of options */
	); /* end of register post type */
	
	


	
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	

	// now let's add message Categories (these act like categories)
    register_taxonomy( 'series', 
    	array('message'), /* if you change the name of register_post_type( 'message', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Message Series', 'aktheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Message Series', 'aktheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Message Series', 'aktheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Message Series', 'aktheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Message Series', 'aktheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Message Series:', 'aktheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Message Series', 'aktheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Message Series', 'aktheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Message Series', 'aktheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Message Series Name', 'aktheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'series' ),
    	)
    );   
    

    // now let's add message speaker (these act like tags)
    register_taxonomy( 'speaker', 
    	array('message'), /* if you change the name of register_post_type( 'message', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Speaker', 'aktheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Speaker', 'aktheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Speakers', 'aktheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Speakers', 'aktheme' ), /* all title for taxonomies */
    			//'parent_item' => __( 'Parent Speaker', 'aktheme' ), /* parent title for taxonomy */
    			//'parent_item_colon' => __( 'Parent Speaker:', 'aktheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Speaker', 'aktheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Speaker', 'aktheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Speaker', 'aktheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Speaker', 'aktheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'speaker' ),
    	)
    );   
	
	


	/* this adds your post categories to your message type */
	register_taxonomy_for_object_type('category', 'message');
	/* this adds your post tags to your message type */
	register_taxonomy_for_object_type('post_tag', 'message');
	
}  

	// adding the function to the Wordpress init
	add_action( 'init', 'message_post_type');
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS


class Message {

	public $ID;
	public $title;

	public $date;

	public $audio;
	public $video;
	public $slug;
	public $notes;

	public $speakers;
	public $series;
	public $series_id;

	public $content;



	private $expiration;


	function __construct($post) {

		$id = $post->ID;
		$this->ID = $id;
		
		$this->title = get_the_title($id);
		$this->slug = $post->post_name;



		// - - - - - - - Message Data
		$date = get_post_meta($id, 'ak_date', true);
		$this->date = strtotime($date);
		$this->speaker = get_post_meta($id, 'ak_speaker', true);

		// - - - - - - - Message Files
		$this->audio = get_post_meta($id, 'ak_audio', true);
		$this->video = get_post_meta($id, 'ak_video', true);
		$this->notes = get_post_meta($id, 'ak_notes', true);

		$audiolink = get_post_meta($id, 'ak_audio_link', true);
		if($audiolink) {
			$this->audio = $audiolink;
		}

		// - - - - - - - Taxonomies
		// Get series
		// Get Speaker
		// Cats and Tags
		// Maybe we don't need these as public variables?

		$this->series = wp_get_post_terms( $this->ID, 'series');
		$this->speakers = wp_get_post_terms( $this->ID, 'speaker');
		$this->categories = wp_get_post_terms( $this->ID, 'category');
		$this->tags = wp_get_post_terms( $this->ID, 'tag');



		$this->speaker = $this->speakers[0]->name;
		

		$this->series_id = $this->series[0]->term_id;

		$this->image = $this->image();

	}
	
	public function image($size = 'thumb') {
		// - - - - - - - Images
		// Check for featured image
		// Check for seires image
		// If featured image use that.
		// If no featured image, use series image.
		// If no series image, set our featured image as the series image.

		// Get Message Image
		if ( has_post_thumbnail($this->ID) ) {
			$message_image_id = get_post_thumbnail_id($post->ID);
		}

		// Check for Series Image
		if ( function_exists('get_terms_meta') ) {

			// First, check for image_id:
			$series_image_id = get_terms_meta($this->series_id, 'image_id', true);

			// But wait -- is this a valid image?
			$valid_image = wp_get_attachment_image_src($series_image_id);

			// If we don't yet have an image_id...
			if(!$series_image_id || !$valid_image) {

				// ... let's check if there's an image url:
				$series_image = get_terms_meta($this->series_id, 'image', true);

				// If we have an image url, let's turn it into an image id
				// so we can take advantage of different image sizes.
				if($series_image) {
					// We'll use a custom function to find the attachment
					$series_image_id = get_attachment_id_from_src($series_image);

					// Then we'll use the Category Meta Plugin function to add it:
					if ($series_image_id) {
						update_terms_meta($this->series_id, 'image_id', $series_image_id);
					}
				} else { // We don't have an image for this series

					// If the message has an image, let's add that as the series image:
					if($message_image_id) {
						update_terms_meta($this->series_id, 'image_id', $message_image_id);
					}

				}


			}

		}



		if($message_image_id) { // use message image if we have one
			$image = wp_get_attachment_image_src($message_image_id, $size);
			return $image[0];
		} elseif( $series_image_id ) { // then use series image if we have one
			$image = wp_get_attachment_image_src($series_image_id, $size);
			return $image[0];
		} else { // then use default

		}


	}

	public function audio() {
		if ($this->audio) {
	            		
    		echo do_shortcode('[audio src="' . $this->audio . '"]');
    		
    	}
	}
	public function video() {
		//echo " ";
		if ($this->video) {
	            		
    		$video = new Video($this->video);
    		$video->thumb = ak_get_series_image($this->series_id);
    		$video->embed();
    		
    	}
	}
	public function date($format = null) {

		//echo $this->date;
		if (!$format) {
			$date_format = get_option('date_format');
		} else {
			$date_format = $format;
		}

		if ($this->date) {
			return date($date_format, $this->date);
    		//echo "<time class='date' datetime='" . date('Y-m-d H:i', $this->date) . "'>". date($date_format, $this->date) ."</time>";
    	}
	}



	public function display( $inputs = array() ) {

		$defaults = array(
			'show'	=> array(
					//'<div class="columns large-2">',
					//'image',
					//'</div><div class="columns large-10">',
					'title',
					'date',
					'speaker',
					'series',
					'video',
					'audio',
					'notes',
					//'</div>',
				),
			'date_format' => get_option('date_format'),
		);

		foreach ($defaults as $key => $default) {
		    $$key = isset( $inputs[$key] ) ? $inputs[$key] : $default;
		}

		

		$terms = array_merge($this->series, $this->speakers, $this->categories, (array)$this->tags);

		$term_classes = '';
		
		foreach($terms as $term) {
			if($term->slug) {
				$term_classes .= "term-{$term->slug} ";
			}
		}


		$data = '';

		if ($this->series) {
			$data_series = "data-series='";
			foreach($this->series as $term) {
				$data_series .= $term->slug;
			}
			$data_series .= "' ";
			$data .= $data_series;
		}
		if ($this->speakers) {
			$data_speaker = "data-speaker='";
			foreach($this->speakers as $term) {
				$data_speaker .= $term->slug;
			}
			$data_speaker .= "' ";
			$data .= $data_speaker;
		}
		if ($this->categories) {
			$data_category = "data-category='";
			foreach($this->categories as $term) {
				$data_category .= $term->slug;
			}
			$data_category .= "' ";
			$data .= $data_category;
		}
		if ($this->tags) {
			$data_tag = "data-tag='";
			foreach($this->tags as $term) {
				$data_tag .= $term->slug;
			}
			$data_tag .= "' ";
			$data .= $data_tag;
		}


		//$out .= "<li class='list-item {$this->class} '>";

		//echo "<article class='row message list-item {$term_classes}' {$data} >";

		foreach( $show as $element ) {
			switch ($element) {
				case 'image':
						$out .= "<img src='{$this->image()}' />";
					break;
				case 'title':
						$out .= "<h6 class='title'>{$this->title}</h6>";
					break;
				
				case 'speaker':
						$out .= "<span class='speaker'>";
						the_terms($this->ID, 'speaker');
						$out .= "</span>";
					break;
				case 'series':
						$out .= "<span class='series'>";
						the_terms($this->ID, 'series');
						$out .= "</span>";
					break;
				case 'date':
					if ($this->date) {
	            		//$out .= "<time class='date' datetime='" . date('Y-m-d H:i', $this->date) . "'>". date($date_format, $this->date) ."</time>";
	            		$out .= "<time class='date' datetime='" . date('Y-m-d H:i', $this->date) . "'>". $this->date() ."</time>";
	            	}
	            	break;
	            case 'video':
	            	if ($this->video) {
	            		$out .= "<a class='video' href='{$this->video}'>Video</a>";
	            	}
	            	break;
	            case 'audio':
	            	if ($this->audio) {
	            		
	            		$out .= do_shortcode('[audio src="' . $this->audio . '"]');
	            		
	            	}
	            	break;
	            case 'notes':
	            	if ($this->notes) {
	            		$out .= "<a href='{$this->notes}'>Notes</a>";
	            	}
	            	break;
	            case 'boxed':
						
						$out .= "<a href='" . get_permalink($this->post->ID) . "''>";
						//$out .=	"<img src='" . get_image_from_post_id($this->post->ID,'small') . "' />";
						$out .= $this->imageHTML('medium');
						$out .=	"<div class='info'>" . $this->info . "</div>";
						$out .=	"</a>";
						

					break;
	            default:
		        	$out .= $element;
		        	break;
				
			}
		}

		//$out .= '</li>';


		return $out;

		//echo $this->title;
		//echo do_shortcode('[audio src="' . $this->audio . '"]');

	}

	public function share() {
		 $which = array('facebook'); 
		foreach ($which as $destination) {

			switch($destination) {
				case 'facebook':

						$out .= "<a class='share-button button tiny facebook' href='https://www.facebook.com/sharer/sharer.php?u={$this->permalink}' >Share</a>";

					break;
				default:
					break;
			}

		}

		return $out;


	}



}


 function ak_sort_by_date( $query ) {


	//if( $query->query_var['post_type'] == 'message' || $query->is_tax == 1) {
	if( /*$query->query_vars['post_type'] == 'message' ||*/ $query->is_tax('series') ) {

		$query->set( 'meta_key', 'ak_date' );
		$query->set( 'orderby', 'meta_value_num meta_value' );
		$query->set( 'order', 'ASC' );
		//print_r($query);

	}
	return $query;
	
}
add_action( 'pre_get_posts', 'ak_sort_by_date', 1 );


/*********************
Get Series Image
*********************/
function ak_get_series_image($series_id, $size='hd') {

	if (function_exists(get_terms_meta)) {
		$attachment_id = get_terms_meta($series_id, 'image_id', true);

		$image = wp_get_attachment_image_src( $attachment_id, $size );
		$image = $image[0];

	}

	if(!$image) {
		$image = get_theme_mod('ak_default_image');
	}

	return $image;

}	

/*********************
Get Series 
*********************/


function ak_get_series($atts = array(), $content = null) {
	$defaults = array(
		'number' => '',
		'offset' => '',
	);
	$atts = extract( shortcode_atts( $defaults, $atts ) );



	$args = array(
		'orderby' 	=> 'slug',
		'order'		=> 'DESC',
	);
	if($number) {
		$args['number'] = $number;
	}
	if($offset) {
		$args['offset'] = $offset;
	}

	$series = get_terms('series', $args);
	$output = "<ul class='medium-block-grid-3 large-block-grid-4' >";

	foreach($series as $term) {

		$series_id = $term->term_id;

		ak_get_term_slug($term);

		$attachment_id = get_terms_meta($series_id, 'image_id', true);

		$image = wp_get_attachment_image_src( $attachment_id, 'list' );
		$image = $image[0];

		if(!$image) {
			$image = get_theme_mod('ak_default_image');
		}

		$link = get_term_link( $term );

		$output .= "<li class='AKList list-item series'><a href='{$link}#week-1' class='' ><img src='{$image}' /><h6 class='info'>{$term->name}</h6></a></li>";

	}

	$output .= "</ul>";

	return $output;

}
add_shortcode( 'get_series','ak_get_series' );


function startsWithNumber($str) {
    return preg_match('/^\d/', $str) === 1;
}

/**
 * The whole point of this is to provide a way of ordering our series
 * chronologically. This is not an ideal solution. Unlike posts, terms do not have an option
 * for ordering by meta information. So, we are going to store our sorting data in the slug.
 * This function checks the slug for the given 
 * series to see if it starts with a number. 
 * If it does, then we assume that we have already set the slug appropriately.
 * If not, then we're going to grab the oldest message in the series and append the year and month
 * of that message to the beginning of the slug, so that we can then order by slug.
 * already changed
 * @param  [term object] $term 
 * @return [string] the slug  
 */
function ak_get_term_slug($term) {

	$slug = $term->slug;

	if( startsWithNumber($slug) ) {
		return $slug;
	} else {

		$args = array(
			'post_type' 		=> 'message',
			'posts_per_page' 	=> 1,
			'orderby'			=> 'meta_value',
			'meta_key'			=> 'ak_date',
			'order'				=> ASC,
			'tax_query' => array(
				array(
					'taxonomy' => 'series',
					'field'	=> 'term_id',
					'terms'	=> $term->term_id,
				)
			)
		);

		$message = get_posts($args);

		$message = new Message($message[0]);

		$date = $message->date;
		$date = date('Y-m', $date);

		$new_slug = $date . '-' . $slug;

		wp_update_term( $term->term_id, 'series', array(
				'slug' => $date . '-' . $slug
			)
		);

		return $new_slug;

	}

}


function ak_latest_message_widget($content = null) {
	$defaults = array(
		'align' => 'left',
	);
	$atts = extract( shortcode_atts( $defaults, $atts ) );

	$args = array(
		'post_type' 		=> 'message',
		'posts_per_page'	=> 1,
		'orderby'			=> 'meta_value',
		'meta_key'			=> 'ak_date',
		'order'				=> DESC,
	);



	

	$transient_name = 'ak_latest_message_' . implode('-', $args);
	$transient_latest_message = get_transient( $transient_name );
	
	if( false === $transient_latest_message ) {
		$message_query = new WP_Query($args);
		set_transient( $transient_name, $message_query, 0);
	} else {
		$message_query = $transient_latest_message;
	}



	if ( $message_query->have_posts() ) {
		
		while ( $message_query->have_posts() ) {
			$message_query->the_post();

			$message = new Message($message_query->post);
			$series_id = $message->series_id;
			
		}
		
	}

	$image = ak_get_series_image($series_id, 'list');
	$link = get_term_link($series_id, 'series');

	

	$out = "<a href='{$link}'><img src='{$image}' /><span class='date bold uppercase'>{$message->date('M d')}</span> {$message->title}</a>";

	
	return $out;
}
add_shortcode( 'latest_message','ak_latest_message_widget' );



function ak_latest_message_section($atts, $content = null) {
	$defaults = array(
		'align' => 'left',
	);
	$atts = extract( shortcode_atts( $defaults, $atts ) );

	$args = array(
		'post_type' 		=> 'message',
		'posts_per_page'	=> 1,
		'orderby'			=> 'meta_value',
		'meta_key'			=> 'ak_date',
		'order'				=> DESC,
	);



	

	$transient_name = 'ak_latest_message_' . implode('-', $args);
	$transient_latest_message = get_transient( $transient_name );
	
	if( false === $transient_latest_message ) {
		$message_query = new WP_Query($args);
		set_transient( $transient_name, $message_query, 0);
	} else {
		$message_query = $transient_latest_message;
	}



	if ( $message_query->have_posts() ) {
		
		while ( $message_query->have_posts() ) {
			$message_query->the_post();

			$message = new Message($message_query->post);
			$series_id = $message->series_id;
			
		}
		
	}

	$image = ak_get_series_image($series_id, 'full');
	$link = get_term_link($series_id, 'series');

	$video = new Video($message->video);

	$id = $message->ID;

	$out = '';
	$out .= "<div class='message-section has_image clearfix'>";
	$out .= "<div style='background-image: url({$image})' class='section_background_image section_background_div fade-50'></div>";
	$out .= 	"<div class='thick-padding'>";
	$out .= 		"<div class='row'>" . $video->prep_embed() . "</div>";
	$out .=			"<div class='row message-section-content'>";
	$out .=				$video->play_button('button round icon-button green big');
	$out .=				$content;
	$out .=			"</div>";
	$out .=		"</div>";
	$out .=	"</div>";
	$out .= "</div>";		


	// $out .= "<div id='{$id}' class='message-section-image'><img src='{$image}' class='fade-50'/>";
	
	// $out .= "</div>";
	// $out .= "<div class='message-section-content'><a data-div='{$id}' data-videoid='{$video->id}' href='{$message->video}' class='message-section-play button round icon-button green big'><i class='fi-play'></i></a>{$content}</div>";
	// $out .= "</div>";

	

	//$out = "<a href='{$link}'><img src='{$image}' /><span class='date bold uppercase'>{$message->date('M d')}</span> {$message->title}</a>";

	
	return $out;
}
add_shortcode( 'latest_message_section','ak_latest_message_section' );
?>