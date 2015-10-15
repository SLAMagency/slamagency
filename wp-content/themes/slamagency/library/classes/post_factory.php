<?php

class Post_Factory {

	public static function create(&$post) {

		$post_type = get_post_type( $post );

		switch ($post_type) {
			case 'event':

					return new Event($post);

				break;
			case 'staff':

					return new Staff($post);

				break;
			case 'message':

					return new Message($post);

				break;

			default:

				return new BasePost($post);
		}

	}

}