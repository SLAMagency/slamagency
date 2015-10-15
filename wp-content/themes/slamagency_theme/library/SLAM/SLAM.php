<?php

class SLAM {


	static function get_social_links() {

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

		<ul class="social-media clearfix full ">
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

}