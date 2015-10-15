<?php
//ob_start(); // Why is this here?
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*********************
INCLUDE NEEDED FILES
*********************/

// metaboxes directory constant
define( 'DIR', get_template_directory() );


// LOAD JOINTSWP CORE (if you remove this, the theme will break)
require_once(get_template_directory().'/library/joints.php'); 

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once(get_template_directory().'/library/post-types/events.php'); // you can disable this if you like

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once(get_template_directory().'/library/admin.php'); 

// CUSTOMIZATION MENU
require_once(get_template_directory().'/library/customize.php'); 

// SUPPORT FOR OTHER LANGUAGES (off by default)
// require_once(get_template_directory().'/library/translation/translation.php'); 

/*
// autoload function
spl_autoload_register(function ($class) {
	//$class = strtolower($class);
	$class = str_replace('\\', '/', $class);

	$file = DIR . '/library/classes/' . $class . '.php';

	if(file_exists($file)) {
        include $file;   
    } else {
    	//echo $file;
        throw new Exception("Unable to load $file ");
    }


});

$postID = 1;
$frank = new BasePost($postID);
*/

require_once(get_template_directory().'/library/classes/ak.php'); 
require_once(get_template_directory().'/library/classes/BasePost.php');

// LOAD Metaboxes
require_once(get_template_directory().'/library/classes/metaboxes/meta_box.php'); 

// classes CLASSES
require_once(get_template_directory().'/library/classes/video.php'); 
require_once(get_template_directory().'/library/classes/colors.php'); 
require_once(get_template_directory().'/library/classes/list.php'); 
require_once(get_template_directory().'/library/classes/post_factory.php'); 
require_once(get_template_directory().'/library/classes/views/section.php'); 
require_once(get_template_directory().'/library/classes/post-types/page.php'); 
require_once(get_template_directory().'/library/classes/post-types/events.php'); 
require_once(get_template_directory().'/library/classes/post-types/message.php'); 
require_once(get_template_directory().'/library/classes/post-types/group.php'); 

require_once(get_template_directory().'/library/classes/shortcodes.php'); 
require_once(get_template_directory().'/library/classes/transients.php'); 

//Custom Menu Walker
require_once(get_template_directory().'/library/classes/Thumbnail_Walker.php'); 

/*********************
IMAGE SIZES
*********************/
$row_size = 1200;
$column_size = $row_size/12;
// add_image_size( 'col1', 	$column_size, 		$column_size*2, 	false );
// add_image_size( 'col2', 	$column_size*2, 	$column_size*4, 	false );
// add_image_size( 'col3', 	$column_size*3, 	$column_size*6, 	false );
// add_image_size( 'col4', 	$column_size*4, 	$column_size*8, 	false );
// add_image_size( 'col6', 	$column_size*6, 	$column_size*12, 	false );
// add_image_size( 'col12', 	$column_size*12, 	$column_size*12, 	false );
// add_image_size( 'full', 	1600, 				1600, 				false );
add_image_size( 'list', 800, 450, true);
add_image_size( 'menu', 600, 200, true);
add_image_size( 'block', 600, 400, true);
add_image_size( 'square', 500, 500, true);
add_image_size( 'max', 1600, 1200, true);
add_image_size( 'hd', 1920, 1080, true);
add_image_size( 'portrait', 400, 500, true);

/*********************
MENUS & NAVIGATION
*********************/
// REGISTER MENUS
register_nav_menus(
	array(
		'top-nav' => __( 'The Top Menu' ),   // main nav in header
		'main-nav' => __( 'The Main Menu' ),   // main nav in header
		'footer-links' => __( 'Footer Links' ) // secondary nav in footer
	)
);

// THE TOP MENU
function joints_top_nav() {
    ak_transient_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => __( 'The Top Menu', 'jointstheme' ),  // nav name
    	'menu_class' => '',         // adding custom nav class
    	'theme_location' => 'top-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
    	'fallback_cb' => 'joints_main_nav_fallback'      // fallback function
	));
} /* end joints main nav */

// THE MAIN MENU
function joints_main_nav() {
    //wp_nav_menu(array(
    ak_transient_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => '',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'jointstheme' ),  // nav name
    	'menu_class' => '',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
    	'fallback_cb' => 'joints_main_nav_fallback'      // fallback function
	));
} /* end joints main nav */

// THE FOOTER MENU
function joints_footer_links() {
    ak_transient_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'jointstheme' ),   // nav name
    	'menu_class' => 'not-sub-nav',      				// adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'joints_footer_links_fallback'  // fallback function
	));
} /* end joints footer link */

// HEADER FALLBACK MENU
function joints_main_nav_fallback() {
	ak_transient_menu( array(
		'show_home' => true,
    	'menu_class' => '',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// FOOTER FALLBACK MENU
function joints_footer_links_fallback() {
	/* you can put a default here if you like */
}


add_filter( 'nav_menu_link_attributes', 'wpse_100726_extra_atts', 10, 3 );

function wpse_100726_extra_atts( $atts, $item, $args )
{
    // inspect $item, then …
    
    if( $atts['rel'] ) {
    	$atts['data-reveal-id'] = $atts['rel'];
    	return $atts;
    }
    return $atts;

}

/*********************
SIDEBARS
*********************/

add_filter('widget_text', 'do_shortcode');

// SIDEBARS AND WIDGETIZED AREAS
function joints_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'jointstheme'),
		'description' => __('The first (primary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'jointstheme'),
		'description' => __('The offcanvas sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'footer_widgets',
		'name' => __('Footer Widgets', 'jointstheme'),
		'description' => __('The Footer Widgets.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="large-3 medium-6 columns widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'bottom_widgets',
		'name' => __('Bottom Widgets', 'jointstheme'),
		'description' => __('The Bottom Widgets.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="bottom-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'jointstheme'),
		'description' => __('The second (secondary) sidebar.', 'jointstheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/*********************
COMMENT LAYOUT
*********************/

// Comment Layout
function joints_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('panel'); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix large-12 columns">
			<header class="comment-author">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<?php printf(__('<cite class="fn">%s</cite>', 'jointstheme'), get_comment_author_link()) ?> on
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__(' F jS, Y - g:ia', 'jointstheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'jointstheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'jointstheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!



// stop wp removing div tags
function ikreativ_tinymce_fix( $init ) 
{
    // html elements being stripped
    $init['extended_valid_elements'] = 'div[*],article[*],span[*],i[*],a[*]';

    // don't remove line breaks
    $init['remove_linebreaks'] = false; 

    // convert newline characters to BR
    //$init['convert_newlines_to_brs'] = true; 

    // don't remove redundant BR
    $init['remove_redundant_brs'] = false;

    // pass back to wordpress
    return $init;
}
add_filter('tiny_mce_before_init', 'ikreativ_tinymce_fix');




?>