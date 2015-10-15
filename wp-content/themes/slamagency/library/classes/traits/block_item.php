<?php
namespace traits;

trait block_item {

	public function block($class = '', $image_size = 'block'){

		$image = $this->image(array( $image_size, 'thumbnail'));

		if(!$image) {
			$image = \AK::get_default_image();
		}

		$out = '';

		$out .= "<li class='list-item list-item--block block {$class}'>";
		$out .= 	"<a href='{$this->permalink}' title='{$this->title}'>";
		$out .= 		$this->image(array($image_size,'thumbnail'), '', true);
		$out .=		"<div class='info'>" . $this->info() . "</div>";
		$out .= 	"</a>";
		$out .= "</li>";

		// echo "<pre>";
		// print_r($this);
		// echo "</pre>";

		return $out;


	}

}