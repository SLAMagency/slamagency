<?php


/**
 * Generates a directions button. If an address is not supplied,
 * it defaults to the contact info address.
 * @param  address
 * @return html
 */
function ak_get_directions_button( $atts ) {
	$fulladdress = get_theme_mod('address') . ', ' . get_theme_mod('city');
	extract( shortcode_atts( array(
		'address' => $fulladdress,
	), $atts ));

	return AK::get_directions_button($address);

}
add_shortcode( 'get_directions', 'ak_get_directions_button' );



/**
 * Generate a block-grid style image link
 * @param  id = page id to which to link
 * @return html
 */
function ak_block_image_link( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'link_to' => $link_to,
		'id'	  => $id,
		'name'	  => '',
		'title'	  => '',
		'type' 	  => 'block',
		'info'	  => '',
		'class'	  => '',
		'size'	  => 'block',
	), $atts ));

	if ($id) {
		$post = new BasePost($id);
	}

	if ($name) {
		$link = get_page_by_title( $name );
		$post = new BasePost($link);
	}
	

	if($title) {
		$post->title = $title;
		$post->info['title'] = $title;
	}

	if($content) {
		$post->info['special'] = $content;
	}

	if($info && $post->$info) {
		$post->info[$info] = $post->$info;
	}


	$class = $type . " " . $class;


	if($type == 'circle') {
		$out = $post->block($class,'square');
	} else {
		$out = $post->block($class, $size);	
	}

	return $out;
	

}
add_shortcode( 'block_image_link', 'ak_block_image_link' );



/**
 * Generate a block-grid style image link
 * @param  id = page id to which to link
 * @return html
 */
function ak_slideover( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' 	=> '',
		'image' 	=> '',
		'class'		=> '',
	), $atts ));


	if($title) {
		
	}

	$out .= '';

	$out .= "<div class='slideover {$class}'>";
	$out .=		"<div class='slideover-top'>";
	$out .= 		"<img src='{$image}'/>";
	$out .=			"<h3 class='title slideover-title center'>{$title}</h3>";
	$out .= 	"</div>";
	$out .= 	"<div class='slideover-content'>{$content}</div>";
	$out .=	"</div>";

	return $out;

	

}
add_shortcode( 'slideover', 'ak_slideover' );


?>