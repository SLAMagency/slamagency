<?php

// List Events Shortcode

function slam_list_auctions($atts, $content = null) {
	$defaults = array(
		'category' 	=> '',
		'number'	=> 10,
	);
	$atts = extract( shortcode_atts( $defaults, $atts ) );

	$out = '';

	$args = array(
		'post_type' => 'auction',
		//'number'	=> $number,
	);

	if ($category) {
		$args['tax_query'] = array(
			array(
				'taxonomy'	=> 'auction_category',
				'field'		=> 'name',
				'term'		=> $category,
			)
		); 
	}

	$auctions_query = new WP_Query($args);

	// if( $auctions_query->have_posts() ) {
		$out .= "<ul class='auction-list bxslider'>";
		while($auctions_query->have_posts()) : $auctions_query->the_post();
			$auction = new Auction($auctions_query->post);
			$out .= "<li class='auction-list-item'>";
			$out .= "<h4 class='auction-title'>{$auction->post->post_title}</h4>";
			$out .= "<h6 class='auction-info'>";

			if ($auction->date) { $out .= "<span>{$auction->expiration_string}</span>"; }
			if ($auction->location) { $out .= "<span>{$auction->location()}</span>"; }


			$out .= "</h6>";
			//$out .= "<a class='button'>View & Bid</a> <a class='button'>Register</a> <a class='button'>See Details</a>";
			$out .= "<a class='button' href='{$auction->post->guid}'>See Details</a>";
			$out .= '</li>';
		endwhile;
		$out .= "</ul>";
	// } else {

	// }



	return $out;


}
add_shortcode( 'list_events','slam_list_auctions' );
add_shortcode( 'list_auctions','slam_list_auctions' );