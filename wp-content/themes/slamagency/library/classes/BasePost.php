<?php 
//namespace BasePost;
require_once(get_template_directory().'/library/classes/traits/expires.php');
require_once(get_template_directory().'/library/classes/traits/Images.php');
require_once(get_template_directory().'/library/classes/traits/block_item.php');
/**
 * Serves as a parent for post types
 */
class BasePost {

	use traits\Expires;
	use traits\Images;
	use traits\block_item;
	// expire()
	// expire()

	function __construct(&$post) {

		// If $post is not a post object, we'll assume
		// that it's a post id and fetch it.
		if( gettype($post) != 'object') {

			$post = get_post($post);

		}

		$this->post = $post;

		$this->ID = $post->ID;

		// Load all meta values as properties.
		$this->load_meta_values();
		$this->image_id();

		$this->info = array(
			'title' => $this->title,
		);

	}

	private function load_meta_values() {
		// Load all Meta
		$meta = get_post_meta($this->post->ID);
		$this->meta = $meta;

		foreach ($meta as $key => $value) {

			$key = str_replace("ak_", "", $key);
			$key = str_replace("slam_", "", $key);

			if( is_array($value) && count($value) == 1) {
				$value = $value[0];
			}

			$this->$key = $value; //isset( $inputs[$key] ) ? $inputs[$key] : $default;

		}

		$this->title = $this->post->post_title;
		$this->content = $this->post->post_content;
		$this->permalink = get_permalink($this->post->ID);

	}

	function info(){
		foreach($this->info as $key => $value) {
			
			$out .= "<span class='info-item {$key}'>{$value}</span>";
			
		}
		return $out;
	}

	function date($format = 'M d') {
		
		$date = strtotime($this->date);
		$out =  "<span class='month'>" . date('M', $date) . "</span><span class='space'> </span>";
		$out .= "<span class='day'>" . date('d', $date) . "</span>";
		return $out;
	}

	function time($format = 'g:i a') {
		if ($this->time) {
			$time = strtotime($this->time);
			return date($format, $time);
		}
	}


	public function share(){

	}


}
