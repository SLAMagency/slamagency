<?php


class SlamPost {

	function __construct(&$post) {

		if( gettype($post) != 'object') {

			$post = get_post($post);

		}

		$this->post = $post;

		// Load all meta values as properties.
		$this->load_meta_values();

		// If expiration date is past, change status to draft.
		//$this->expire();

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

	}

	public function expire() {

		$now = time();

		$future = $this->expiration > $now;

		if(!$future && $this->expiration) {

			$current_post = get_post( $this->ID, 'ARRAY_A' );
		    $current_post['post_status'] = 'draft';
		    wp_update_post($current_post);

		    return true;

		} else {

			return false;

		}

	}

	public function time($format = 'g:i a') {

		return date($format, $this->expiration);

	}

}