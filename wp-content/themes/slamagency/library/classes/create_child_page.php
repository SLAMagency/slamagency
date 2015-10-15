<?php

// Include the wp-load'er
require_once(dirname(__FILE__) . '/../../../../../wp-load.php' );

if( current_user_can('edit_posts') ) {

	$page_name = urldecode( $_GET['new_page_title'] );
	$page_parent_id = $_GET['parent_id'];
	$menu_order = $_GET['menu_order'];


	$post = array(
		'post_title' => $page_name,
		'post_type' => 'page',
		'post_parent' => $page_parent_id,
		'menu_order' => $menu_order,
	);

	$post_id = wp_insert_post( $post );
	if(is_numeric($post_id) ) {
		$go_to = "/wp-admin/post.php?action=edit&post={$post_id}";
		header( 'Location: ' . $go_to ); 
		exit;
	}
	else echo $post_id;
	exit;


	

} else {

	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	echo "Not allowed";
	exit;

}