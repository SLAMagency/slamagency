<?php 

class AK {

	/**
	 * Grabs social links from the customize screen, and prints
	 * it out as a block-grid list of icons.
	 * @return html
	 */
	function get_social_links() {
		$social = array(
			'facebook' => get_theme_mod('facebook'), 
			'twitter' => get_theme_mod('twitter'), 
			'youtube' => get_theme_mod('youtube'),
			'vimeo' => get_theme_mod('vimeo'),
			'instagram' => get_theme_mod('instagram'),
			'pinterest' => get_theme_mod('pinterest'),
			'flickr' => get_theme_mod('flickr'),
		);
		foreach($social as $key => $value) {
			if(!$value) {
				unset($social[$key]);
			}
		}
			

		$num = count($social);

		?>

		<ul class="social-media clearfix full <?php echo $num; ?>">
			<?php
				foreach($social as $key => $value) {
					if( $value ) {
						echo '<li class="social-icon ' . $key . ' "><a href="' . $value . '" class="'.$key.' icon-' . $key . '" title="' . $key . '"><i class="fi-social-' . $key . '"></i><span>'.$key.'</span></a></li>';
					}
				}
			?>
		</ul>

		<?php
	}

	/**
	 * Returns a link to a google map
	 * @param  address that google understands
	 * @return url
	 */
	function get_directions_link($address) {

		$addressURL = urlencode($address);
		$link = 'http://maps.google.com/?daddr=' . $addressURL;
		return $link;

	}


	/**
	 * Returns an html button
	 * @param  address that google understands
	 * @return html button element
	 */
	function get_directions_button($address) {

		$link = AK::get_directions_link($address);
		$button = "<a href='{$link}' class='button button-get-directions' target='_blank' title='Get directions to {$address}'>Get Directions</a>";
		return $button;

	}



	/**
	 * Retrieves the attachment ID from the file URL
	 * @param  url $image_url url to the image
	 * @return integer            id of the attachment
	 */
	function get_image_id($image_url) {
		echo "<h1>Hello</h1>";
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	    return $attachment[0]; 

	}

	function get_default_image() {

		$image = get_theme_mod('ak_default_image');
		if(!$image) {
			$image = get_stylesheet_directory_uri() . "/library/images/default_image.jpg";
		}

		return $image;

	}




	/**
	 * ak_picklist() - Generates an array for use in metabox dropdown menus
	 *
	 *
	 * @param string $postType : Optional. Specify a post type for the list
	 * @param string $label : Optional. Specify a label for each item.
	 * @return array : An array of $ID => $label . $title
	 */
	function picklist($postType = '', $label = '') {
		//$args = 'numberposts=10000';
		if ($postType) {
			$args .= '&post_type=' . $postType;
		}


		//$pageposts = get_posts('numberposts=10000&post_type=' . $postType);
		$pageposts = get_posts($args);
		$picklist = array();
		foreach($pageposts as $pageentry) :
			$pagevalue = $pageentry->ID;
			$thetitle = $pageentry->post_title;
			$labelwrite = '';
			if ($label) { 
				$labelwrite = $label .': ';
			} 
			$picklist[$pagevalue] = $labelwrite . $thetitle;
		endforeach;	

		return $picklist;

	}

	/**********************************************/
	/***		Tag Drop Down 		 			***/
	/**********************************************/

	function tag_dropdown($args = array() ) {
		$out = '';

		$tags = get_tags($args);

		$out .= "<select class='tag-select'>";
		$out .= "<option value=''>Tags</option>";
		foreach($tags as $tag) {
			$out .= "<option value='{$tag->slug}'>{$tag->name}</option>";
		}
		$out .= "</select>";

		return $out;

	}




}