<?php  
/*
	Section Class
*/


class Section {

	public $background_image;
	public $background_color;
	public $padding;
	public $class;

	public function __construct($input) {

		// Accept input as array of key => value pairs
		if( is_array($input) ) {

			foreach($input as $key => $value ) {
				$this->$key = $value;
			}

		} elseif( is_object($input) ) { // Accept input as post object

			$this->post = $input;

			$this->get_values_from_meta($this->post->ID);

			$this->title = $this->post->title;

		}	elseif( is_numeric($input) ) { // Accept input as post id

			$this->get_values_from_meta($input);

			$this->post = get_post($input);

		}

	}

	private function get_values_from_meta($id) {

		$this->meta = get_post_meta($id);

		if( is_array($this->meta) ) {

			foreach ($this->meta as $key => $value) {

				$key = str_replace("ak_", "", $key);
				$key = str_replace("slam_", "", $key);

				if( is_array($value) && count($value) == 1) {
					$value = $value[0];
				}

				$this->$key = $value; //isset( $inputs[$key] ) ? $inputs[$key] : $default;

			}

		}

	}

	public function add_class($class) {
		$this->additional_classes .= ' ' . $class;
	}

	private function get_section_classes() {
		$classes = array();
		$classes[] = 'slam_section';
		//$classes[] = 'parallax__group';
		$classes[] = $this->additional_classes;
		$classes[] = 'bg-' . $this->background_color;
		//$classes[] = 'bg-' . $this->background_color;
		//$classes[] = $this->padding;
		//$classes[] = $this->content_width;
		$classes[] = $this->_wp_page_template . '-template';

		if($this->background_image) {
			$classes[] = 'has_image';
		}

		return implode(' ', $classes);
	}

	private function get_content_classes() {
		$classes = array();
		$classes[] = 'slam_section_content';
		//$classes[] = 'parallax__layer';
		//$classes[] = 'parallax__layer--base';
		
		$classes[] = $this->padding;
		$classes[] = $this->content_width;

		return implode(' ', $classes);
	}

	private function get_image($id, $size = 'max') {
		$image = wp_get_attachment_image_src( $id, $size );
		return $image[0];
	}

	public function build() {

		$content = do_shortcode( $this->post->post_content );

		$type = $this->type;

		switch($type) {

			case 'slider':

					// Extract slider id from shortcode
					preg_match_all('!\d+!', $this->slide_show, $matches);
					$slider_id = implode('', $matches[0]);

					// Load Royal Slider files
					register_new_royalslider_files($slider_id); 

					echo "<section id='{$this->post->post_name}' class='slider-section slider-{$slider_id}'>";

						// Do Shortcode
						echo do_shortcode($this->slide_show);

					echo "</section>";

				break;

			case 'list':

				switch($this->list_what) {
					case 'event':
						$category = $this->list_event_category;
						break;
					case 'staff':
						$category = $this->list_staff_category;
						break;
					case 'message':
						$category = $this->list_series;
						break;
					default:
						$category = $this->list_category;
				}

				$args = array(
					'post_type' => $this->list_what,
					'category'	=> $category,
					'number'	=> $this->max,
				);

				// $content = new List($args);

				echo "<section id='{$this->post->post_name}' class='{$this->get_section_classes()}'><br/>";
					echo "<div class='{$this->get_content_classes()}'>";
						echo "<div class='row'>";
							
							if($this->post->post_content) {
								
								echo "<div class='columns small-12'>"; 
									echo $content;
								echo "</div>";
						
							}

							$list = new AKList($args);
							echo $list->build('block', $this->list_row);

						echo "</div>";
					echo "</div>";
				echo "</section>";

				break;

			case 'split':

				$push = 'large-push-4';
				$pull = 'large-pull-8';
				$overfade = 'overfade-left';

				echo "<section id='{$this->post->post_name}' class='{$this->get_section_classes()}'>";


					if($this->post->post_content) {
						echo "<div class='slam_section_content split no-padding fullwidth'>";
							echo "<div class='row'>";
								echo "<div class='columns small-12'>"; 

									echo "<div class='row'>";
									echo "	<div class='columns large-8 paddingless overfade {$overfade} {$push}'>";
									echo "		<img src='{$this->get_image($this->background_image)}' class='fill'/>";
									echo "	</div>";
									echo "	<div class='columns large-4 thin-padding {$pull}'><div class='side-padding'>";
									echo 		$content;
									echo "	</div>";
									echo "</div>";
									
								echo "</div>";
							echo "</div>";
						echo "</div>";
					}

				echo "</section>";				


				break;


			case 'split-right':

				$push = '';
				$pull = '';
				$overfade = '';


				echo "<section id='{$this->post->post_name}' class='{$this->get_section_classes()}'>";


					if($this->post->post_content) {
						echo "<div class='slam_section_content split no-padding fullwidth'>";
							echo "<div class='row'>";
								echo "<div class='columns small-12'>"; 

									echo "<div class='row'>";
									echo "	<div class='columns large-8 paddingless overfade {$overfade} {$push}'>";
									echo "		<img src='{$this->get_image($this->background_image)}' class='fill' />";
									echo "	</div>";
									echo "	<div class='columns large-4 thin-padding {$pull}'><div class='side-padding'>";
									echo 		$content;
									echo "	</div>";
									echo "</div>";
									
								echo "</div>";
							echo "</div>";
						echo "</div>";
					}

				echo "</section>";				


				break;

			default:


		
				echo "<section id='{$this->post->post_name}' class='{$this->get_section_classes()}'>";

					if($type == 'custom') {
						
						echo $this->custom;

					} elseif($this->background_image) {
						//echo "<img src='{$this->get_image($this->background_image)}' class='section_background_image parallax__layer parallax__layer--back {$this->image_opacity}' />";
						echo "<div style='background-image: url({$this->get_image($this->background_image)})' class='section_background_image section_background_div {$this->image_opacity}'></div>";

					}

					if($this->post->post_content) {
						echo "<div class='{$this->get_content_classes()}'>";
							echo "<div class='row'>";
								echo "<div class='columns small-12'>"; 
									echo $content;
								echo "</div>";
							echo "</div>";
						echo "</div>";
					}

				echo "</section>";

		}

	}

}