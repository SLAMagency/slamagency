<?php

class AKList {

	public $query;

	function __construct($inputs) {



		$this->query($inputs);

	}

	public function query($inputs) {

		$defaults = array(
			'post_type' => 'post',
			'number'	=> '3',
			'category'	=> '',
			'per_row'	=> 4,
		);

		foreach ($defaults as $key => $default) {
			$$key = isset( $inputs[$key] ) ? $inputs[$key] : $default;
			$this->$key = $$key;
		}

		$args = array(
			'post_type' => $post_type,
			'posts_per_page'	=> $number,
		);



		if($post_type == 'event') {
			$args['orderby'] 	= 'meta_value_num';
			//$args['meta_type']	= 'DATE';
			$args['meta_key']	= 'ak_date';
			$args['order']		= 'ASC';
		}



		if($category) {

			//$field = gettype($category);
			//echo "$field = " . $field;
			//echo $category;
			if( is_numeric($category) ) {
				$field = 'id';
			} else {
				$field = 'name';
			}

			switch($post_type) {

				case 'event':
					$args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'event_cat',
							'field'		=> $field,
							'terms'		=> $category,
						)
					);

					break;

				case 'message':
					$args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'series',
							'field'		=> $field,
							'terms'		=> $category,
						)
					);

					break;

				case 'staff':
					$args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'department',
							'field'		=> $field,
							'terms'		=> $category,
						)
					);

					break;

				default:
					$args['tax_query'] = array(
						array(
							'taxonomy' 	=> 'category',
							'field'		=> $field,
							'terms'		=> $category,
						)
					);

					break;


			}

		}
		//print_r($args);
		$this->query = new WP_Query($args);
		// echo "SQL-Query: <br/>{$this->query->request}";

	}

	public function build($style = 'list', $columns = 4) {

		$query = $this->query;
		$num = $query->post_count;
		


		if ( $query->have_posts() ) {

			$out = '';

			switch ($style) {

				case 'block':

					$classes = array();
					


					$out .= "<ul class='list block {$this->post_type} small-block-grid-2 medium-block-grid-3 large-block-grid-{$columns}'>";

						while ( $query->have_posts() ) {
							$query->the_post();

							$AKPost = Post_Factory::create($query->post);

							// echo "<pre>"; 
							// echo '<li>' . $AKPost->date . " | " . get_post_meta($query->post->ID, 'ak_date', true) . " | " . the_date('Y-m-d', '', '', false) . '</li>';
							// echo "</pre>";

							if($AKPost) {
							
								$out .= $AKPost->block();
							
							}

						}

					$out .= "</ul>";



					break;

				default:

					$out .= "<ul class='list default {$this->post_type}'>";

						while ( $query->have_posts() ) {
							$query->the_post();

							$AKPost = Post_Factory::create($query->post);

							$out .= "<li>";
							$out .= "<a href='{$AKPost->permalink}'>";
							$out .= $AKPost->info();
							$out .= "</a>";
							$out .= "</li>";

						}

					$out .= "</ul>";

					break;

			} //switch

		} //if

		return $out;

	}

	

}