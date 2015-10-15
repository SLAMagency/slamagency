<?php
	// This file adds our own customization controls to the Theme Customization screen in WordPress Admin
 
	// All Sections, Settings, and Controls Added Here
	function ak_customize_register( $wp_customize ) {

		// Logo
		$wp_customize->add_section( 'ak_logo_options', array(
			'title'			=> __( 'Logo Options', 'jointstheme' ),
			'priority'		=> 30,
		));
			// Main Logo
			$wp_customize->add_setting('ak_logo', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ak_logo', array(
				'label'	=> 'Logo',
				'section'	=> 'ak_logo_options',
				'settings'	=> 'ak_logo',
			)));

			// Mobile Logo
			$wp_customize->add_setting('ak_mobile_logo', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ak_mobile_logo', array(
				'label'	=> 'Logo',
				'section'	=> 'ak_logo_options',
				'settings'	=> 'ak_mobile_logo',
			)));

			// Footer Logo
			$wp_customize->add_setting('ak_footer_logo', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ak_footer_logo', array(
				'label'	=> 'Footer Logo',
				'section'	=> 'ak_logo_options',
				'settings'	=> 'ak_footer_logo',
			)));

		// Default Image
		$wp_customize->add_section( 'ak_theme_settings', array(
			'title'			=> __( 'Theme Settings', 'jointstheme' ),
			'priority'		=> 40,
		));

			$wp_customize->add_setting('ak_default_image', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ak_default_image', array(
				'label'	=> 'Default Image',
				'section'	=> 'ak_theme_settings',
				'settings'	=> 'ak_default_image',
			)));


		// Advanced
		$wp_customize->add_section( 'ak_advanced', array(
			'title'			=> __( 'Advanced', 'jointstheme' ),
			'priority'		=> 1290,
		));

			$wp_customize->add_setting('ak_css', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new AK_Customize_Textarea_Control( $wp_customize, 'ak_css', array(
				'label'	=> 'Custom CSS',
				'section'	=> 'ak_advanced',
				'settings'	=> 'ak_css',
			)));

			$wp_customize->add_setting('ak_google_analytics', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new AK_Customize_Textarea_Control( $wp_customize, 'ak_google_analytics', array(
				'label'	=> 'Google Analytics Code',
				'section'	=> 'ak_advanced',
				'settings'	=> 'ak_google_analytics',
			)));


		// Contact Info
		$wp_customize->add_section( 'ak_info', array(
			'title'			=> __( 'Contact Info', 'jointstheme' ),
			'priority'		=> 40,
		));

			// Address
			$wp_customize->add_setting('address', array(
				'default'	=> '',
				'transport'	=> 'refresh',
			));

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'address', array(
				'label'	=> 'Address',
				'section'	=> 'ak_info',
				'settings'	=> 'address',
			)));

			ak_add_text_setting($wp_customize, 'address', 	'Address', 		'ak_info');
			ak_add_text_setting($wp_customize, 'city', 		'City, State', 		'ak_info');
			//ak_add_text_setting($wp_customize, 'state',		'State', 		'ak_info');
			ak_add_text_setting($wp_customize, 'email',		'Public Email', 'ak_info');
			ak_add_text_setting($wp_customize, 'phone',		'Phone', 		'ak_info');
			ak_add_text_setting($wp_customize, 'contact_form',		'Contact Form Shortcode', 		'ak_info');
			ak_add_text_setting($wp_customize, 'story_form',		'Story Form Shortcode', 		'ak_info');
			ak_add_text_setting($wp_customize, 'prayer_form',		'Prayer Request Form Shortcode', 		'ak_info');

		// Social Info
		$wp_customize->add_section( 'ak_social', array(
			'title'			=> __( 'Social Info', 'jointstheme' ),
			'priority'		=> 50,
		));

			ak_add_text_setting($wp_customize, 'facebook', 		'Facebook', 		'ak_social');
			ak_add_text_setting($wp_customize, 'twitter', 		'Twitter', 			'ak_social');
			ak_add_text_setting($wp_customize, 'vimeo', 		'Vimeo', 			'ak_social');
			ak_add_text_setting($wp_customize, 'youtube', 		'Youtube', 			'ak_social');
			ak_add_text_setting($wp_customize, 'instagram', 	'Instagram', 		'ak_social');
			ak_add_text_setting($wp_customize, 'pinterest', 	'Pinterest', 		'ak_social');
			ak_add_text_setting($wp_customize, 'flickr', 	'Flickr', 		'ak_social');




	}
	add_action('customize_register', 'ak_customize_register');
 


function ak_add_text_setting($wp_customize, $id, $label, $section, $default = '') {

	$wp_customize->add_setting($id, array(
		'default'	=> $default,
		'transport'	=> 'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $id, array(
		'label'	=> $label,
		'section'	=> $section,
		'settings'	=> $id,
	)));

}





// Create our Custom Controls Here:
if (class_exists('WP_Customize_Control')) {

	class AK_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

}






?>