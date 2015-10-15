<?php
namespace traits;

trait Images {

	/**
	 * Sets and returns the attachment id of the featured image
	 * @return integer
	 */
	public function image_id() {
		$this->image = get_post_thumbnail_id( $this->post->ID );
		return $this->image;
	}

	/**
	 * Returns the url to the specified size of the featured image.
	 * @param  size
	 * @return string - url
	 */
	public function image_src($size = 'large') {
		$image = wp_get_attachment_image_src( $this->image, $size );
		return $image[0];
	}

	/**
	 * Returns a simple img html element for hte featured image. 
	 * @param  size
	 * @return html
	 */
	public function image_html($size = 'large') {
		if($this->image) {
			$image = wp_get_attachment_image_src( $this->image, $size );
			return "<img src='{$image[0]}' width='{$image[1]}' height='{$image[2]}' />";
		}
		// } else {
		// 	$image = get_theme_mod('ak_default_image');
		// 	return "<img class='lazy' data-original='{$image}' />";
		// }
	}

	/**
	 * Returns a responsive img element, using foundations interchange
	 * @param  size array (optional)
	 * @param  class (optional)
	 * @return html
	 */
	public function image($sizes = array('max','large'), $class = null, $required = false) {

		$classes = "";
		if($class) {
			$classes = " class='{$class}' ";
		}

		$big 	= $this->image_src( $sizes[0] );
		$medium = $this->image_src( $sizes[1] );
		$small 	= $this->image_src( 'medium' );

		if($required == true && !$small ) {

			$big 	= \AK::get_default_image();
			$medium = \AK::get_default_image();
			$small  = \AK::get_default_image();
		}

		$output = "<img data-interchange='[{$medium}, (default)], [{$big}, (large)]' {$classes} >";
		$output .= "<noscript><img src='{$medium}' {$classes}></noscript>";
		
		return $output;

	}


	public function background_image($sizes = array('full','large') ) {

		$image = $this->image;

		if(!$image) {
			//global $post;
			//$id = get_post_thumbnail_id( $post->ID );
			//$medium[0] 	= "http://unsplash.it/640/360/?random";
			//$big[0] 	= "http://unsplash.it/1200/675/?random";
			//return "data-interchange='[{$medium[0]}, (default)], [{$big[0]}, (large)]'";
			//return " style='background-image: url({$medium[0]});' ";
			return "";
		}

		if( is_numeric($image) ) {
			// This is the image id
			$id = $image;
		} else {
			// This is the image src
			$id = get_attachment_id_from_src($image); 
			//echo "src"
		}

		$classes = "";
		if($class) {
			$classes = " class='{$class}' ";
		}

		$big 	= wp_get_attachment_image_src($id, $sizes[0]);
		$medium = wp_get_attachment_image_src($id, $sizes[1]);
		$small 	= wp_get_attachment_image_src($id, 'medium');

		$output = "data-interchange='[{$medium[0]}, (default)], [{$big[0]}, (large)]'";
		
		return $output;

	}



}