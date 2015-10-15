<?php
/* 
SLIDES POST TYPE

*/


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - METABOXES

$prefix = 'ak_';


$fields = array(
	array( // Image ID field
		//'class'	=> 'sixcol first',
		'label'	=> 'Link to', // <label>
		'desc'	=> 'Use this to link to content on your site.',
		'id'	=> $prefix.'link_id', // field id and name
		'post_type' => array('page', 'event', 'group'),
		'type'	=> 'post_select' // type of field
	),
	array( // Text Input
		'label'	=> 'Link URL', // <label>
		'desc'	=> 'This will override the above. Use it to link to any URL', // description
		'id'	=> $prefix.'link_custom', // field id and name
		'type'	=> 'URL', // type of field
	),
	array(
		'type' => 'break',
	),

	
	array( // 
		'label'	=> 'Overlay Color', // <label>
		//'desc'	=> 'Use', // description
		'id'	=> $prefix.'background_color', // field id and name
		'type'	=> 'select', // type of field
		//'default' => 'white',
		'options' => ak_get_color_options('name')
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
	array(
		'type' => 'break',
	),
	
);

$slide_box = new custom_add_meta_box( 'ak_slide_options', 'Slide Options', $fields, 'slide', true );

$fields = array(
	// Always
	array( // Additional Classes
		'label'	=> 'Additional Classes', // <label>
		'desc'	=> '(Advanced) Add extra CSS classes here.', // description
		'id'	=> $prefix.'additional_classes', // field id and name
		'type'	=> 'text' // type of field
	),
);
$slide_box = new custom_add_meta_box( 'ak_advanced_slide_options', 'Advanced Settings', $fields, 'slide', true );


$fields = array(
	array( // jQuery UI Date input
		'label'	=> 'Expiration Date', // <label>
		'desc'	=> 'When would you like this Slide to un-publish itself?', // description
		'id'	=> $prefix.'expiration', // field id and name
		'type'	=> 'date' // type of field
	),
);


$expire_box = new custom_add_meta_box( 'ak_expiration_options', 'Expiration', $fields, 'slide', true );


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - REGISTER

// let's create the function for the slide
function slide_post_type() { 
	// creating (registering) the slide 
	register_post_type( 'slide', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Slides', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Slide', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Slides', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Slide', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Slides', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Slide', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Slide', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Slides', 'bonestheme'), /* Search Slide Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Slides for your slide shows', 'bonestheme' ), /* Slide Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/add.png', /* the icon for the slide type menu */
			'rewrite'	=> array( 'slug' => 'slide', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'slide', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => true,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'thumbnail', 'page-attributes')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your slide type */
	//register_taxonomy_for_object_type('category', 'slide');
	/* this adds your post tags to your slide type */
	//register_taxonomy_for_object_type('post_tag', 'slide');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'slide_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - TAXONOMY

	// now let's add slide Shows (these act like categories)
    register_taxonomy( 'slide_show', 
    	array('slide'), /* if you change the name of register_post_type( 'slide', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Slide Shows', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Slide sHow', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Slide Shows', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Slide Shows', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Slide Show', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Slide Show:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Slide Show', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Slide Show', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Slide Show', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Slide Show Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'custom-slug' ),
    	)
    );   
    
	
	if (0>1) {

	// now let's add custom tags (these act like categories)
    register_taxonomy( 'slide_tag', 
    	array('slide'), /* if you change the name of register_post_type( 'slide', then you have to change this */
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
    

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ADMIN LIST VIEW

	

    // SET-UP CUSTOM COLUMNS FOR THE EDIT SCREEN


    // Create a list of our custom columns
	add_filter( 'manage_edit-slide_columns', 'ak_edit_slide_columns' ) ;

	function ak_edit_slide_columns( $columns ) {

		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title' ),
			'image' => __( 'Image' ),
			//'actions' => __( 'Action' ),
			'slide_show' => __( 'Slide Show' ),
			//'votes' => __( 'Votes' ),
			//'start-date' => __( 'video Date' ),		
			'date' => __( 'Published Date' )
		);

		return $columns;
	}

	// Tell WordPress what to do with these custom columns
	add_action( 'manage_slide_posts_custom_column', 'ak_manage_slide_columns', 10, 2 );

	function ak_manage_slide_columns( $column, $post_id ) {
		global $post;

		switch( $column ) {

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


			case 'slide_show' :

				$slide_show = wp_get_post_terms( $post_id, 'slide_show');
				echo "<a href='edit.php?s&post_type=slide&slide_show=" . $slide_show[0]->slug . "'>";
				echo $slide_show[0]->name;
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
	    if ($typenow == 'slide' ) {

	        // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
	        $filters = array('slide_show'); //get_taxonomies(); //array('plants', 'animals', 'insects');

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


/*

	// Make custom columns sortable:

	// First, tell WordPress which columns should be sortable:
	add_filter( 'manage_edit-slide_sortable_columns', 'ak_slide_sortable_columns' );

	function ak_slide_sortable_columns( $columns ) {

		$columns['slide_show'] = 'slide_show';

		return $columns;
	}


	// Only run our customization on the 'edit.php' page in the admin. 
	add_action( 'load-edit.php', 'ak_edit_slide_load' );

	function ak_edit_slide_load() {
		add_filter( 'request', 'ak_sort_slide' );
	}

	// Sorts the video. 
	function ak_sort_slide( $vars ) {

		// Check if we're viewing the 'slide' post type. 
		if ( isset( $vars['post_type'] ) && 'slide' == $vars['post_type'] ) {

			// Check if 'orderby' is set to 'duration'. 
			if ( isset( $vars['slide_show'] ) && 'slide_show' == $vars['slide_show'] ) {

				// Merge the query vars with our custom variables. 
				$vars = array_merge(
					$vars,
					array(
						//'meta_key' => 'ak_votes',
						'orderby' => 'slide_show'
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

*/



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - CLASS


class Slide extends AKPost {

	public $ID;



	public $expiration;


	function __construct(&$post) {

		parent::__construct($post);



		
		
		

		$this->slide_shows = get_the_terms( $id, 'slide_show');
     
        $expiration = get_post_meta($id, 'ak_expiration', true);

        if ($expiration) {
			$this->expiration = strtotime( $expiration );
		}
		// If an expiration date is set, let's check to see if it's expires. If so, we'll unpublish the slide.
		if($this->expiration) {
			$this->expire();
		}
        


		// - - - - - - - Get Caption Settings
		/*
        $this->caption_title = get_post_meta($id, 'ak_caption_title', true);
        $this->caption_text = get_post_meta($id, 'ak_caption_text', true);

        $this->caption_background = get_post_meta($id, 'ak_caption_background', true);
        $this->caption_position = get_post_meta($id, 'ak_caption_position', true);

        $this->caption_settings = 'data-fade-effect="" data-move-offset="10" data-move-effect="bottom" data-speed="200"';
		*/


		// - - - - - - - Get Image Settings
        /*$grayscale = '';

        if (get_post_meta($id, 'ak_grayscale', true)) {
            $grayscale = 'grayscale';
        }*/

        // Get Full Size Image
        $this->big = 	wp_get_attachment_image_src(  get_post_thumbnail_id( $post->ID ), 'slider' );
       

        // Get Small Image
        $this->small = 	wp_get_attachment_image_src(  get_post_thumbnail_id( $post->ID ), 'mobile-slider' );
       

       

       	// - - - - - - - Video Settings
        //$this->video_url = get_post_meta($id, 'ak_video_url', true);
        


        // - - - - - - - Set up Links
        $link_url = '';
        //$link_custom = '';
        $link_id  = get_post_meta($this->ID, 'ak_link_id', true);
       // $link_custom = get_post_meta($id, 'ak_link_url', true);
        $this->link_id = $link_id;

        if ($this->link_custom) {  

            $this->link_url = $this->link_custom;

        } elseif($link_id) {

            $this->link_url = get_permalink( $link_id[0] );

        }

		


	}


	public function make_slide($type = "royal", $height = 500) {



		$output .= '';
		$width = intval( (16*$height)/6 );

		//$overlay_color = new Color('color', $this->overlay_color);
		global $colors;

		$overlay_color = $GLOBALS['colors'][$this->overlay_color];

		if($overlay_color) {

			$color = $overlay_color->rgba($this->overlay_opacity/100);

		}

		if ($this->link_url) {
			$link = "href='{$this->link_url}'";
		}

		// Do we have an image?
		if($this->big ) {
			$output .= '<div class="rsContent">';

			$output .= "<img 
							data-rsw='{$width}' 
							data-rsh='{$height}'
							class='rsImg {$classes}'
							src='{$this->image('mobile-slider')}'
							data-src='{$this->image('slider')}'
							alt='{$this->title}'
							/>";

			$output .= "<a 
							{$link} 
							class='
								full-link 
								{$this->overlay_color} 
								'
							style='
								background-color: {$color};
								' 
							></a>";


			if($this->caption_title || $this->caption_text) {

				
					$output .= 	"<div 
									class='rsABlock row fullwidth'
									style='top: {$this->vertical_offset}%' 
									>";

						$output .= 	"<div 
										class='columns medium-6 large-8 
											{$this->caption_alignment} 
											{$this->overlay_color}-overlay 
											'
										{$caption_settings}
									>";

							//$output .=  "<h1>" . print_array($this->link_id) . "</h1>";

							$output .=	"<h3 class='caption-title'>" . do_shortcode($this->caption_title) . "</h3>";

							$output .=	"<div class='caption-text'>" . do_shortcode($this->caption_text) . "</div>";

						$output .= 	"</div>";


					$output .= 	"</div>";
				

			}



			$output .= 	'</div>';				



		}

		return $output;

	}



	public function make_slide_2($type = "royal", $height = 500) {


		$output .= '';

		if($type == 'royal') {

			$linked = false;

			$width = intval( (7*$height)/4 );

			// Video
			$video = '';
	        if($this->video_url) {
	            $video = 'data-rsvideo="' . $this->video_url . '"';
	        }

	        if($this->big) {

	            $output .= '<div class="rsContent">';

	                $output .= "<img data-rsw='{$width}' data-rsh='{$height}' class='rsImg {$this->grayscale}' src='{$this->small[0]}' data-src='{$this->big[0]}' {$video} alt='" . str_replace("'", '', $this->title) . "' >";

	                if ( !empty($this->link_url ) ) {
	                    $output .= "<a href='{$link_url}' class='full-link'></a>";
	                    $linked = 'linked';
	                }

	                if ($this->caption_title || $this->caption_description) {
	                    $output .= "<div class='infoBlock rsABlock {$this->caption_background} position-{$this->caption_position} {$linked}' {$caption_settings}>
	                    				<div class='row clearfix'>";
	                    
	                    if ($this->caption_position == 'left' || $this->caption_position == 'right') {
	                    	 $output .= "<div class='table-cell'>";
	                    }

	                    if ( $this->caption_title ) { 

	                        
	                            $output .= "<h3><span>";
	                            if($linked){
	                                $output .= "<a href='{$this->link_url}'>";
	                            }
	                            $output .= do_shortcode($this->caption_title);
	                            if($linked){
	                                $output .= "</a>";
	                            }
	                            $output .= "</span></h3>";                        


	                    }
	                    if ( $caption_description ) { 

	                    	$output .= "<div class='caption-description'>{$this->caption_description}</div>"; 

	                   	}
	                   	if ($this->caption_position == 'left' || $this->caption_position == 'right') {
	                    	 $output .= "</div>";
	                    }

	                    $output .= "</div></div>";
	                }


	            $output .= '</div>';

	        }


	    } // End type = 'royal'    

	    return $output;

	}




}


function ak_slide_show_init() {


	?>
	<script>

	jQuery(document).ready(function($) {

		$('.full-width-slider').show().royalSlider({
            arrowsNav: true,
            loop: true,
            keyboardNavEnabled: true,
            controlsInside: true,
            imageScaleMode: 'fill',
            arrowsNavAutoHide: false,
            autoScaleSlider: true,
            //autoScaleSliderWidth: 1400,
            //autoScaleSliderHeight: 800,
            //autoScaleSliderWidth: 1200,
            //autoScaleSliderHeight: 500,
            controlNavigation: 'bullets',
            thumbsFitInViewport: false,
            navigateByClick: false,
            startSlideId: 0,
            autoPlay: {
                enabled: true,
                pauseOnHover: false,
                delay: 6000
            },
            //delay: 10000,
            transitionType:'fade',
            globalCaption: false,
            deeplinking: {
              enabled: true,
              change: false
            },
            // size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images 
            //imgWidth: 1400,
            //imgHeight: 800
            imgWidth: 1200,
            //imgHeight: 500,
            imgHeight: $(this).data('height'),
        }).find('img').each(function(){

            var big = $(this).data('src');
            console.log('found an image', big);
            if(big && $(window).width() > 700 ) {
                $(this).attr('src',big);
            }
        });

    });

	</script>

	<?php

}





function ak_slide_show($slide_show = null, $height = 500) {

	add_action('wp_footer', 'load_slider_scripts', 10);
	

	$args = array(
	    'post_type' => 'slide',
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	);

	if ($slide_show) {
	    $args['tax_query'] = array(
	    	array(
	    		'taxonomy'	=> 'slide_show',
	    		'terms'		=> $slide_show
	    	)
	    );
	}

	$slides_query = new WP_Query();
	$slides_query->query($args);

	$slider_id = 'slider-' . $slide_show;

	$data = '';

	$data .= "data-height='{$height}'";


	$output = '';
	$output .= "<div id='{$slider_id}' style='height: {$height};' class='full-width-slider royalSlider rsDefault heroSlider rsMinW' {$data}>";

	$i = 0;

	// Process normal Slides
    while ($slides_query->have_posts()) : $slides_query->the_post();

    	$i++;


       $slide = new Slide($slides_query->post);
       $output .= $slide->make_slide(); 
     

    endwhile;

	$output .= '</div> <!-- end slideshow -->';

	echo $output;





	//add_action('wp_footer', 'ak_slide_show_init', 1000);
	/*
	$args = array(
		'id' => $slider_id,
	);
	do_action
	*/

	

}



?>