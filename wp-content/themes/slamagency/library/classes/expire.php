<?php
namespace Expire;

trait Expire {

	public function expire() {

		$now = time();

		$future = $this->expiration > $now;

		if(!$future) {

			$current_post = get_post( $this->ID, 'ARRAY_A' );
		    $current_post['post_status'] = 'draft';
		    wp_update_post($current_post);

		    return true;

		} else {

			return false;
			
		}

	}
}