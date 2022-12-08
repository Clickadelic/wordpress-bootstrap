<?php
/**
 * Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Bootstrap_Init_Customizer_Settings {
	// Get our default values
	private $customizer_defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->customizer_defaults = skyrocket_generate_defaults();

		// Register our sections
		add_action('customize_register', array($this, 'bootstrap_add_customizer_sections'));
		
		// Register our controls
		add_action('customize_register', array($this, 'bootstrap_register_theme_options_controls'));

	}

	/**
	 * Register the Customizer sections
	 */
	public function bootstrap_add_customizer_sections( $wp_customize ) {
		
		// Styles Panel
		$wp_customize->add_panel('style_controls_panel',
			array(
				'title' => __('Theme options', 'bootstrap'),
				'description' => esc_html__('Style settings for the theme.', 'bootstrap'  ),
				'priority' => 81
				
			)
		);
		
		// Search function section
		$wp_customize->add_section('nav_menus_custom', array(
			'title' => __('Search function', 'bootstrap' ),
			'panel' => 'nav_menus'
		));
		// Canvas function section
		$wp_customize->add_section('canvas_menu_select_custom', array(
			'title' => __('Canvas', 'bootstrap' ),
			'panel' => 'nav_menus'
		));

		// Topbar
		$wp_customize->add_section('style_controls_section_topbar',
			array(
				'title' => __('Topbar', 'bootstrap'),
				'description' => esc_html__('Style the topbar according to your needs.', 'bootstrap'),
				'priority' => 81,
				'panel' => 'style_controls_panel'
			)
		);
		
		// Navbar
		$wp_customize->add_section('style_controls_section_navbar',
			array(
				'title' => __('Navbar', 'bootstrap'),
				'description' => esc_html__('Navbar styling', 'bootstrap'),
				'priority' => 82,
				'panel' => 'style_controls_panel'
			)
		);
		// Bottombar
		$wp_customize->add_section('style_controls_section_bottombar',
			array(
				'title' => __('Bottombar', 'bootstrap'),
				'description' => esc_html__('Bottom bar styling', 'bootstrap'),
				'priority' => 83,
				'panel' => 'style_controls_panel'
			)
		);
		// Alert
		$wp_customize->add_section('style_controls_section_alert',
			array(
				'title' => __('Alert', 'bootstrap'),
				'description' => esc_html__('Show a nice alert message', 'bootstrap'),
				'priority' => 84,
				'panel' => 'style_controls_panel'
			)
		);
		// Slideshow
		$wp_customize->add_section('style_controls_section_slideshow',
			array(
				'title' => __('Slideshow', 'bootstrap'),
				'description' => esc_html__('Slideshow styling', 'bootstrap'),
				'priority' => 85,
				'panel' => 'style_controls_panel'
			)
		);
		// Breadcrumbs
		$wp_customize->add_section('style_controls_section_breadcrumbs',
			array(
				'title' => __('Breadcrumbs', 'bootstrap'),
				'description' => esc_html__('Breadcrumbs styling', 'bootstrap'),
				'priority' => 86,
				'panel' => 'style_controls_panel'
			)
		);
		// Body
		$wp_customize->add_section('style_controls_section_body',
			array(
				'title' => __('Body', 'bootstrap'),
				'description' => esc_html__('Body styling', 'bootstrap'),
				'priority' => 87,
				'panel' => 'style_controls_panel'
			)
		);

		// Footer widgets
		$wp_customize->add_section('style_controls_section_footer_widgets',
			array(
				'title' => __('Footer widgets', 'bootstrap'),
				'description' => esc_html__('Footer widget styling', 'bootstrap'),
				'priority' => 88,
				'panel' => 'style_controls_panel'
			)
		);

		// Credits
		$wp_customize->add_section('style_controls_section_credits',
			array(
				'title' => __('Credits', 'bootstrap'),
				'description' => esc_html__('Credits styling', 'bootstrap'),
				'priority' => 89,
				'panel' => 'style_controls_panel'
			)
		);
		// Canvas
		$wp_customize->add_section('canvas_controls_section',
			array(
				'title' => __('Canvas', 'bootstrap'),
				'description' => esc_html__('A sidepanel, which slides out, either left or right.', 'bootstrap'),
				'priority' => 105
			)
		);

		// Rename and reorder default sections
		$wp_customize->get_section('title_tagline')->title = __( 'Website information & Logo', 'bootstrap');
		// throws warning..
		// $wp_customize->get_panel('widgets')->title = __( 'Sidebar & footer widgets', 'bootstrap');
		$wp_customize->get_section('title_tagline')->priority = 18;
		$wp_customize->get_section('static_front_page')->priority = 20;

	}

	public function bootstrap_register_theme_options_controls( $wp_customize ) {

		// Show topbar 
		$wp_customize->add_setting('show_topbar',
			array(
				'default' => $this->customizer_defaults['show_topbar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'show_topbar',
			array(
				'section' => 'style_controls_section_topbar',
				'label' => esc_html__('Show a top navigation bar', 'bootstrap'),
				'description' => esc_html__('Show a top navigation bar above the main navbar.', 'bootstrap')
			)
		));

		// Topbar width
		$wp_customize->add_setting('topbar_width',
			array(
				'default' => $this->customizer_defaults['topbar_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'topbar_width',
			array(
				'label' => __( 'Topbar width', 'bootstrap'),
				'description' => esc_html__( 'Select the container width of the topbar.', 'bootstrap'),
				'section' => 'style_controls_section_topbar',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		// Topbar Background Color
		$wp_customize->add_setting('topbar_bg_color',
			array(
				'default' => $this->customizer_defaults['topbar_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'topbar_bg_color',
			array(
				'label' => __( 'Topbar background color', 'bootstrap'),
				'description' => esc_html__( 'Select the background color of the topbar.' ),
				'section' => 'style_controls_section_topbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Topbar font-weight, font-style
		$wp_customize->add_setting( 'topbar_font_weight',
			array(
				'default' => $this->customizer_defaults['topbar_font_weight'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'topbar_font_weight',
			array(
				'label' => __( 'Topbar font-weight', 'bootstrap'),
				'description' => esc_html__( 'Select the font-weight of the topbar', 'bootstrap'),
				'section' => 'style_controls_section_topbar',
				'choices' => array(
					'' => array(  // Required. Value for this particular radio button choice
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/normal.png', // Required. URL for the image
						'name' => __('normal', 'bootstrap') // Required. Title text to display
					),
					'bold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/bold.png',
						'name' => __('bold', 'bootstrap')
					)
				)
			)
		));

		// Topbar Link Color Default
		$wp_customize->add_setting('topbar_link_color_default',
			array(
				'default' => $this->customizer_defaults['topbar_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'topbar_link_color_default',
			array(
				'label' => __( 'Topbar link color (default)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links.', 'bootstrap'),
				'section' => 'style_controls_section_topbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Topbar Link ColorHover
		$wp_customize->add_setting('topbar_link_color_hover',
			array(
				'default' => $this->customizer_defaults['topbar_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'topbar_link_color_hover',
			array(
				'label' => __( 'Topbar link color (hover)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links on hover.', 'bootstrap'),
				'section' => 'style_controls_section_topbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		/**
		 * style_controls_section_navbar
		 */
		// Navbar width
		$wp_customize->add_setting('navbar_width',
			array(
				'default' => $this->customizer_defaults['navbar_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'navbar_width',
			array(
				'label' => __( 'Navbar width', 'bootstrap'),
				'description' => esc_html__( 'Select the container width of the main navbar.', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));
		// Navbar centered
		$wp_customize->add_setting('navbar_centered',
			array(
				'default' => $this->customizer_defaults['navbar_centered'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'navbar_centered',
			array(
				'section' => 'style_controls_section_navbar',
				'label' => esc_html__('Center main navigation bar', 'bootstrap'),
				'description' => esc_html__('Center the items in the main navbar.', 'bootstrap')
			)
		));
		// Navbar Background Color
		$wp_customize->add_setting('navbar_bg_color',
			array(
				'default' => $this->customizer_defaults['navbar_bg_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'navbar_bg_color',
			array(
				'label' => __( 'Navbar background color', 'bootstrap'),
				'description' => esc_html__( 'Main navbar background color.', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Navbar font-weight, font-style
		$wp_customize->add_setting( 'navbar_font_weight',
			array(
				'default' => $this->customizer_defaults['navbar_font_weight'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'navbar_font_weight',
			array(
				'label' => __( 'Navbar font-weight', 'bootstrap'),
				'description' => esc_html__( 'Select the font-weight of the navbar', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'choices' => array(
					'normal' => array(  // Required. Value for this particular radio button choice
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/normal.png', // Required. URL for the image
						'name' => __('normal', 'bootstrap') // Required. Title text to display
					),
					'bold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/bold.png',
						'name' => __('bold', 'bootstrap')
					)
				)
			)
		));

		// Navbar Link Color Default
		$wp_customize->add_setting('navbar_link_color_default',
			array(
				'default' => $this->customizer_defaults['navbar_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'navbar_link_color_default',
			array(
				'label' => __('Navbar link color (default)', 'bootstrap'),
				'description' => esc_html__('Adjust the color of the links.', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Navbar Link ColorHover
		$wp_customize->add_setting('navbar_link_color_hover',
			array(
				'default' => $this->customizer_defaults['navbar_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'navbar_link_color_hover',
			array(
				'label' => __( 'Navbar link color (hover)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links on hover.', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		$wp_customize->add_setting('navbar_padding_top',
			array(
				'default' => '0',
				// 'default' => $customizer_defaults['navbar_padding_top'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'navbar_padding_top',
			array(
				'label' => esc_html__('Navbar padding  top (px)', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'input_attrs' => array(
					'min' => 0, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));

		$wp_customize->add_setting('navbar_padding_bottom',
			array(
				'default' => '0',
				// 'default' => $customizer_defaults['navbar_padding_bottom'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'navbar_padding_bottom',
			array(
				'label' => esc_html__('Navbar padding bottom (px)', 'bootstrap'),
				'section' => 'style_controls_section_navbar',
				'input_attrs' => array(
					'min' => 0, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));

		/**
		 * style_controls_section_bottombar
		 */
		// Show bottombar 
		$wp_customize->add_setting('show_bottombar',
			array(
				'default' => $this->customizer_defaults['show_bottombar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'show_bottombar',
			array(
				'section' => 'style_controls_section_bottombar',
				'label' => esc_html__('Show a bottom navigation bar', 'bootstrap'),
				'description' => esc_html__('Show a bottom navigation bar below the main navbar.', 'bootstrap')
			)
		));

		// Bottombar width
		$wp_customize->add_setting('bottombar_width',
			array(
				'default' => $this->customizer_defaults['bottombar_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'bottombar_width',
			array(
				'label' => __( 'Bottombar width', 'bootstrap'),
				'description' => esc_html__( 'Select the container width of the bottombar.', 'bootstrap'),
				'section' => 'style_controls_section_bottombar',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		// Bottombar Background Color
		$wp_customize->add_setting('bottombar_bg_color',
			array(
				'default' => $this->customizer_defaults['bottombar_bg_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'bottombar_bg_color',
			array(
				'label' => __( 'Bottombar background color', 'bootstrap'),
				'description' => esc_html__( 'Select the background color of the lower navbar.', 'bootstrap'),
				'section' => 'style_controls_section_bottombar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Bottombar font-weight, font-style
		$wp_customize->add_setting( 'bottombar_font_weight',
			array(
				'default' => $this->customizer_defaults['bottombar_font_weight'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'bottombar_font_weight',
			array(
				'label' => __( 'Bottombar font-weight', 'bootstrap'),
				'description' => esc_html__( 'Select the font-weight of the bottombar', 'bootstrap'),
				'section' => 'style_controls_section_bottombar',
				'choices' => array(
					'' => array(  // Required. Value for this particular radio button choice
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/normal.png', // Required. URL for the image
						'name' => __('normal', 'bootstrap') // Required. Title text to display
					),
					'bold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/bold.png',
						'name' => __('bold', 'bootstrap')
					)
				)
			)
		));

		// Bottombar Link Color Default
		$wp_customize->add_setting('bottombar_link_color_default',
			array(
				'default' => $this->customizer_defaults['bottombar_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'bottombar_link_color_default',
			array(
				'label' => __( 'Bottombar link color (default)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links.', 'bootstrap'),
				'section' => 'style_controls_section_bottombar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Bottombar Link ColorHover
		$wp_customize->add_setting('bottombar_link_color_hover',
			array(
				'default' => $this->customizer_defaults['bottombar_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'bottombar_link_color_hover',
			array(
				'label' => __( 'Bottombar link color (hover)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links on hover.', 'bootstrap'),
				'section' => 'style_controls_section_bottombar',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Show alert 
		$wp_customize->add_setting('show_alert',
			array(
				'default' => $this->customizer_defaults['show_alert'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'show_alert',
			array(
				'section' => 'style_controls_section_alert',
				'label' => esc_html__('Alert', 'bootstrap'),
				'description' => esc_html__('Show an alert window.', 'bootstrap')
			)
		));

		// Link target
		$wp_customize->add_setting('alert_width',
			array(
				'default' => '_blank',
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'alert_width',
			array(
				'label' => __('Alert width', 'bootstrap'),
				'section' => 'style_controls_section_alert',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		// Alert color
		$wp_customize->add_setting('alert_color', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skyrocket_text_sanitization',
			'default' => 'default',
		));

		$wp_customize->add_control('alert_color', array(
			'type' => 'select',
			'section' => "style_controls_section_alert",
			'label' => __('Alert color', 'bootstrap'),
			'description' => __('Pick the color of the alert window.', 'bootstrap'),
				'choices' => array(
					'primary' => __('Alert Primary', 'bootstrap'),
					'secondary' => __('Alert Secondary', 'bootstrap'),
					'success' => __('Alert Success', 'bootstrap'),
					'danger' => __('Alert Danger', 'bootstrap'),
					'warning' => __('Alert Warning', 'bootstrap'),
					'info' => __('Alert Info', 'bootstrap'),
					'light' => __('Alert Light', 'bootstrap'),
					'dark' => __('Alert Dark', 'bootstrap')
				)
			)
		);

		// Alert text
		$wp_customize->add_setting('alert_text',
			array(
				'default' => $this->customizer_defaults['alert_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control('alert_text',
			array(
				'label' => __( 'Alert text', 'bootstrap' ),
				'description' => esc_html__('Type the text, you want to show.', 'bootstrap'),
				'section' => 'style_controls_section_alert',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'cstmzr-customer-street',
					'style' => 'border: 1px solid #ddd',
					'placeholder' => __('Hello world!', 'bootstrap'),
				),
			)
		);

		$wp_customize->add_setting('alert_link_url', array(
			'sanitize_callback' => 'skyrocket_url_sanitization',
		));
		$wp_customize->add_control('alert_link_url', array(
			'type' => 'url',
			'section' => 'style_controls_section_alert', // Add a default or your own section
			'label' => __('Alert Link URL', 'bootstrap'),
			'description' => __( 'Enter your link url.', 'bootstrap'),
			'input_attrs' => array(
				'placeholder' => __( 'http://www.example.com', 'bootstrap'),
			),
			)
		);

		// Alert link text
		$wp_customize->add_setting('alert_link_text',
			array(
				'default' => $this->customizer_defaults['alert_link_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control('alert_link_text',
			array(
				'label' => __( 'Alert link text', 'bootstrap' ),
				'description' => esc_html__('Type the text, you want to show for the link', 'bootstrap'),
				'section' => 'style_controls_section_alert',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'cstmzr-alert-link-text',
					'style' => 'border: 1px solid #ddd',
					'placeholder' => __('Example', 'bootstrap'),
				),
			)
		);

		// Link target
		$wp_customize->add_setting('alert_link_target',
			array(
				'default' => '_blank',
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'alert_link_target',
			array(
				'label' => __('Alert link target', 'bootstrap'),
				'description' => esc_html__( 'Open the link internally or in an external window.', 'bootstrap'),
				'section' => 'style_controls_section_alert',
				'choices' => array(
					'_self' => __( '_self' ), // Required. Setting for this particular radio button choice and the text to display
					'_blank' => __( '_blank' ) // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		// Slideshow width
		$wp_customize->add_setting('slideshow_width',
			array(
				'default' => $this->customizer_defaults['slideshow_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'slideshow_width',
			array(
				'label' => __( 'Slideshow width', 'bootstrap'),
				'description' => esc_html__( 'Select the container width of the slideshow.', 'bootstrap'),
				'section' => 'style_controls_section_slideshow',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		// Slideshow Shortcode frontpage
		$wp_customize->add_setting('slideshow_shortcode_frontpage',
			array(
				'default' => $this->customizer_defaults['slideshow_shortcode_frontpage'],
				'transport' => 'refresh'
				// 'sanitize_callback' => 'bootstrap_text_sanitization'
			)
		);
		$wp_customize->add_control('slideshow_shortcode_frontpage',
			array(
				'label' => __( 'Slideshow shortcode (Frontpage)', 'bootstrap' ),
				'description' => esc_html__('Enter the shortcode of the frontpage slideshow.', 'bootstrap' ),
				'section' => 'style_controls_section_slideshow',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'cstmzr-slide-1-title',
					'style' => 'border: 1px solid #ddd',
					'placeholder' => __( '[smartslider3 slider="1"]', 'bootstrap' ),
				),
			)
		);

		// Slideshow Shortcode subpage
		$wp_customize->add_setting('slideshow_shortcode_subpage',
			array(
				'default' => $this->customizer_defaults['slideshow_shortcode_subpage'],
				'transport' => 'refresh'
				// 'sanitize_callback' => 'bootstrap_text_sanitization'
			)
		);
		$wp_customize->add_control('slideshow_shortcode_subpage',
			array(
				'label' => __( 'Slideshow shortcode (Subpage)', 'bootstrap' ),
				'description' => esc_html__('Enter the shortcode of the subpage slideshow.', 'bootstrap' ),
				'section' => 'style_controls_section_slideshow',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'cstmzr-slide-1-title',
					'style' => 'border: 1px solid #ddd',
					'placeholder' => __( '[smartslider3 slider="2"]', 'bootstrap' ),
				),
			)
		);

		// Show Breadcrumbs switch
		$wp_customize->add_setting('show_breadcrumbs',
			array(
				'default' => $this->customizer_defaults['show_breadcrumbs'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'show_breadcrumbs',
			array(
				'section' => 'style_controls_section_breadcrumbs',
				'label' => esc_html__('Show breadcrumbs', 'bootstrap'),
				'description' => esc_html__('Show breadcrumb links below the slider.', 'bootstrap')
			)
		));

		// Breadcrumbs links
		$wp_customize->add_setting('bc_link_color_default',
			array(
				'default' => $this->customizer_defaults['bc_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'bc_link_color_default',
			array(
				'label' => __( 'Breadcrumbs link color', 'bootstrap' ),
				'description' => esc_html__( 'The link color of the breadcrumbs.', 'bootstrap' ),
				'section' => 'style_controls_section_breadcrumbs',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Breadcrumbs links hover
		$wp_customize->add_setting('bc_link_color_hover',
			array(
				'default' => $this->customizer_defaults['bc_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'bc_link_color_hover',
			array(
				'label' => __( 'Breadcrumbs link hover color', 'bootstrap' ),
				'description' => esc_html__( 'The hover color of the breadcrumbs.', 'bootstrap' ),
				'section' => 'style_controls_section_breadcrumbs',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Body width
		$wp_customize->add_setting('body_width',
			array(
				'default' => $this->customizer_defaults['body_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'body_width',
			array(
				'label' => __( 'Body width', 'bootstrap'),
				'description' => esc_html__( 'Select the container width of the body.', 'bootstrap'),
				'section' => 'style_controls_section_body',
				'choices' => array(
					'container' => __('Container', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'container-fluid' => __('Container-Fluid', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		$wp_customize->add_setting('body_bg_color',
			array(
				'default' => $this->customizer_defaults['body_bg_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'body_bg_color',
			array(
				'label' => __( 'Body background color', 'bootstrap' ),
				'description' => esc_html__( 'The background color of the body.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7'
				)
			)
		));

		// Body text color
		$wp_customize->add_setting('body_text_color',
			array(
				'default' => $this->customizer_defaults['body_text_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'body_text_color',
			array(
				'label' => __( 'Body text color', 'bootstrap' ),
				'description' => esc_html__( 'The color of the body text.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7'
				)
			)
		));

		// Primary color
		$wp_customize->add_setting('primary_brand_color',
			array(
				'default' => $this->customizer_defaults['primary_brand_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'primary_brand_color',
			array(
				'label' => __( 'Primary brand color', 'bootstrap' ),
				'description' => esc_html__( 'The main color of the theme.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Primary hover color
		$wp_customize->add_setting('primary_hover_color',
			array(
				'default' => $this->customizer_defaults['primary_hover_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'primary_hover_color',
			array(
				'label' => __( 'Primary hover color', 'bootstrap' ),
				'description' => esc_html__( 'The hover color of the theme.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Posttitle color default
		$wp_customize->add_setting('posttitle_link_color_default',
			array(
				'default' => $this->customizer_defaults['posttitle_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'posttitle_link_color_default',
			array(
				'label' => __( 'Posttitle color (default)', 'bootstrap' ),
				'description' => esc_html__( 'The color of the postttitle on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Posttitle color default
		$wp_customize->add_setting('posttitle_link_color_hover',
			array(
				'default' => $this->customizer_defaults['posttitle_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'posttitle_link_color_hover',
			array(
				'label' => __( 'Posttitle color (hover)', 'bootstrap' ),
				'description' => esc_html__( 'The color of the postttitle on the blog page on hover.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Category color default
		$wp_customize->add_setting('cat_link_color_default',
			array(
				'default' => $this->customizer_defaults['cat_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'cat_link_color_default',
			array(
				'label' => __( 'Category link color (default)', 'bootstrap' ),
				'description' => esc_html__( 'The color of the category-link on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Category color hover
		$wp_customize->add_setting('cat_link_color_hover',
			array(
				'default' => $this->customizer_defaults['cat_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'cat_link_color_hover',
			array(
				'label' => __( 'Category link color (hover)', 'bootstrap' ),
				'description' => esc_html__( 'The hover color of the category-link on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		

		// Tag color default
		$wp_customize->add_setting('tag_link_bg_color_default',
			array(
				'default' => $this->customizer_defaults['tag_link_bg_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'tag_link_bg_color_default',
			array(
				'label' => __( 'Tag link color (default)', 'bootstrap' ),
				'description' => esc_html__( 'The default color of the tag-link on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Tag color hover
		$wp_customize->add_setting('tag_link_bg_color_hover',
			array(
				'default' => $this->customizer_defaults['tag_link_bg_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'tag_link_bg_color_hover',
			array(
				'label' => __( 'Tag link color (hover)', 'bootstrap' ),
				'description' => esc_html__( 'The hover color of the tag-link on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		
		// Permalink color default
		$wp_customize->add_setting('permalink_bg_color_default',
			array(
				'default' => $this->customizer_defaults['permalink_bg_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'permalink_bg_color_default',
			array(
				'label' => __( 'The permalink color (default)', 'bootstrap' ),
				'description' => esc_html__( 'The permalink color on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Permalink color hover
		$wp_customize->add_setting('permalink_bg_color_hover',
			array(
				'default' => $this->customizer_defaults['permalink_bg_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'permalink_bg_color_hover',
			array(
				'label' => __( 'The permalink color (hover)', 'bootstrap' ),
				'description' => esc_html__( 'The permalink hover color on the blog page.', 'bootstrap' ),
				'section' => 'style_controls_section_body',
				'show_opacity' => true,
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));


		// Footer widgets
		// style_controls_section_footer_widgets
		$wp_customize->add_setting('widgets_size',
			array(
				'default' => $this->customizer_defaults['widgets_size'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'widgets_size',
			array(
				'label' => __('Footer widgets', 'bootstrap'),
				'description' => esc_html__('How many footer widgets do you want to show? ATTENTION: this setting requires a hard browser-refresh. [CTRL + R or browser refresh.]', 'bootstrap'),
				'section' => 'style_controls_section_footer_widgets',
				'choices' => array(
					'0' => __('No widgets', 'bootstrap'),
					'1' => __('1 widget (centered)', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'2' => __('2 widgets (2 columns)', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'3' => __('3 widgets (3 columns)', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					'4' => __('4 widgets (4 columns)', 'bootstrap')
				)
			)
		));

		// Footer widgets background color
		$wp_customize->add_setting('footer_bg_color',
			array(
				'default' => $this->customizer_defaults['footer_bg_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'footer_bg_color',
			array(
				'label' => __( 'Footer wigets background color', 'bootstrap'),
				'description' => esc_html__('Select the background color of widget area.', 'bootstrap'),
				'section' => 'style_controls_section_footer_widgets',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		$wp_customize->add_setting('footer_widget_title_color',
			array(
				'default' => $this->customizer_defaults['footer_widget_title_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'footer_widget_title_color',
			array(
				'label' => __( 'Footer wigets title color', 'bootstrap'),
				'description' => esc_html__('Select the color of title.', 'bootstrap'),
				'section' => 'style_controls_section_footer_widgets',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));


		// Back to top button color default
		$wp_customize->add_setting('btt_btn_bg_color_default',
			array(
				'default' => $this->customizer_defaults['btt_btn_bg_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'btt_btn_bg_color_default',
			array(
				'label' => __( 'Back to top button background', 'bootstrap'),
				'description' => esc_html__( 'Select the background color of the back to top button.', 'bootstrap'),
				'section' => 'style_controls_section_credits',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Back to top button color hover
		$wp_customize->add_setting('btt_btn_bg_color_hover',
			array(
				'default' => $this->customizer_defaults['btt_btn_bg_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'btt_btn_bg_color_hover',
			array(
				'label' => __( 'Back to top button background (hover).', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the credits links.', 'bootstrap'),
				'section' => 'style_controls_section_credits',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Credits Background Color
		$wp_customize->add_setting('credits_bg_color',
			array(
				'default' => $this->customizer_defaults['credits_bg_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'credits_bg_color',
			array(
				'label' => __( 'Credits background color', 'bootstrap'),
				'description' => esc_html__( 'Select the background color of the credits section.', 'bootstrap'),
				'section' => 'style_controls_section_credits',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Credits Link Color Default
		$wp_customize->add_setting('credits_link_color_default',
			array(
				'default' => $this->customizer_defaults['credits_link_color_default'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'credits_link_color_default',
			array(
				'label' => __( 'Credits link color (default)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the credits links.', 'bootstrap'),
				'section' => 'style_controls_section_credits',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Credits Link Color Hover
		$wp_customize->add_setting('credits_link_color_hover',
			array(
				'default' => $this->customizer_defaults['credits_link_color_hover'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'credits_link_color_hover',
			array(
				'label' => __('Credits link color (hover)', 'bootstrap'),
				'description' => esc_html__( 'Adjust the color of the links in the credits section on hover.', 'bootstrap'),
				'section' => 'style_controls_section_credits',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		/**
		 * ==================================================================
		 * Section add-ons to existing sections
		 * ==================================================================
		 */
		// static_front_page
		$wp_customize->add_setting('frontpage_title',
			array(
				'default' => 0,
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'frontpage_title',
			array(
				'label' => esc_html__('Show title on front page?', 'bootstrap'),
				'section' => 'static_front_page'
			)
		));
		// Sidebar option
		$wp_customize->add_setting('frontpage_sidebar_option',
			array(
				'default' => $this->customizer_defaults['frontpage_sidebar_option'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'frontpage_sidebar_option',
			array(
				'label' => __( 'Sidebars', 'bootstrap'),
				'description' => esc_html__( 'How many sidebars do you want on the frontpage?', 'bootstrap'),
				'section' => 'static_front_page',
				'choices' => array(
					'sidebar_left' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/sidebar-left.png',
						'name' => __('Left Sidebar', 'bootstrap')
					),
					'full_width' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/sidebar-none.png',
						'name' => __('Full width', 'bootstrap')
					),
					'content_only' => array(  // Required. Value for this particular radio button choice
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/centered-content-no-sidebars.png', // Required. URL for the image
						'name' => __('centered content only, no sidebars', 'bootstrap') // Required. Title text to display
					),
					'sidebar_right' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/sidebar-right.png',
						'name' => __('Right Sidebar', 'bootstrap')
					),
					'two_sidebars' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'components/images/customizer/two-sidebars.png',
						'name' => __('Two sidebars', 'bootstrap')
					)
				)
			)
		));

		// static_front_page
		$wp_customize->add_setting('post_suggestions',
			array(
				'default' => $this->customizer_defaults['post_suggestions'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'post_suggestions',
			array(
				'label' => esc_html__('Post suggestions', 'bootstrap'),
				'description' => esc_html__('Make suggestions for posts to the user below an article?', 'bootstrap'),
				'section' => 'static_front_page'
			)
		));

		// static_front_page
		$wp_customize->add_setting('show_search',
			array(
				'default' => $this->customizer_defaults['show_search'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'show_search',
			array(
				'label' => esc_html__('Enable search?', 'bootstrap'),
				'section' => 'nav_menus_custom'
			)
		));

		// main_menu_indentation
		$wp_customize->add_setting('main_menu_indentation',
			array(
				'default' => $this->customizer_defaults['main_menu_indentation'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'main_menu_indentation',
			array(
				'label' => __( 'Main menu indentation by the search button', 'bootstrap'),
				'description' => esc_html__( 'Which nth-child should push the menu to the left side?', 'bootstrap'),
				'section' => 'nav_menus_custom',
				'choices' => array(
					1 => __('1st child', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					2 => __('2nd child', 'bootstrap'), // Required. Setting for this particular radio button choice and the text to display
					3 => __('3rd child', 'bootstrap'),
					4 => __('4th child', 'bootstrap') // Required. Setting for this particular radio button choice and the text to display
				)
			)
		));

		$wp_customize->add_setting('canvas_enabled',
			array(
				'default' => $this->customizer_defaults['canvas_enabled'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'canvas_enabled',
			array(
				'label' => esc_html__('Enable canvas sidebar', 'bootstrap'),
				'section' => 'canvas_menu_select_custom'
			)
		));

		// Attached menu id
		$wp_customize->add_setting('canvas_attached_menu_id', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skyrocket_text_sanitization',
			'default' => '',
		));

		$menus = get_registered_nav_menus();
        $menu_options = [];
 
 		if (is_iterable( $menus ) ) {
			foreach ( $menus as $location_name => $description ) {
				$locations = get_nav_menu_locations();
				$menu_id   = $locations[ $location_name ];
				if ( ! empty( wp_get_nav_menu_object( $menu_id )->name ) ) {
					$menu_options[$location_name] = wp_get_nav_menu_object( $menu_id )->name;
				}
			}
		}

		$wp_customize->add_control('canvas_attached_menu_id', array(
			'type' => 'select',
			'section' => "canvas_menu_select_custom",
			'label' => __('Canvas select', 'bootstrap'),
			'description' => __('Where to attach the canvas button.', 'bootstrap'),
				'choices' => $menu_options
			)
		);

		// Canvas button text
		$wp_customize->add_setting('canvas_button_text',
			array(
				'default' => $this->customizer_defaults['canvas_button_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control('canvas_button_text',
			array(
				'label' => __( 'Canvas button text', 'bootstrap' ),
				'description' => esc_html__('Show a panel that slides out', 'bootstrap'),
				'section' => 'canvas_menu_select_custom',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'cstmzr-customer-street',
					'style' => 'border: 1px solid #ddd',
					'placeholder' => __('Menu', 'bootstrap'),
				),
			)
		);
		// Canvas replace menu completely
		$wp_customize->add_setting('canvas_replace_menu_completely',
			array(
				'default' => 0,
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'canvas_replace_menu_completely',
			array(
				'label' => esc_html__( 'Replace the menu completely.', 'bootstrap'),
				'section' => 'canvas_menu_select_custom'
			)
		));

		// Canvas background color
		$wp_customize->add_setting('canvas_background_color',
			array(
				'default' => $this->customizer_defaults['canvas_background_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'canvas_background_color',
			array(
				'label' => __('Canvas background color', 'bootstrap'),
				'description' => esc_html__( 'The background color of the canvas slide-out panel.', 'bootstrap'),
				'section' => 'canvas_menu_select_custom',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		$wp_customize->add_setting('canvas_text_color',
			array(
				'default' => $this->customizer_defaults['canvas_text_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'canvas_text_color',
			array(
				'label' => __('Canvas text color', 'bootstrap'),
				'description' => esc_html__( 'The text color of the canvas slide-out panel.', 'bootstrap'),
				'section' => 'canvas_menu_select_custom',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));

		// Canvas title color
		$wp_customize->add_setting('canvas_widgettitle_color',
			array(
				'default' => $this->customizer_defaults['canvas_widgettitle_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'canvas_widgettitle_color',
			array(
				'label' => __('Canvas widgettitle color', 'bootstrap'),
				'description' => esc_html__( 'The color of the widgettitles in the  slide-out panel.', 'bootstrap'),
				'section' => 'canvas_menu_select_custom',
				'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
				'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
					'#000',
					'#fff',
					'#307882',
					'#9CC5CA',
					'#5c5e62'
				)
			)
		));


		// Custom brand logo
		$wp_customize->add_setting('custom_logo_upload',
			array(
				'default' => $this->customizer_defaults['custom_logo_upload'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_url_sanitization'
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_upload',
			array(
				'label' => __( 'Logo upload', 'bootstrap'),
				'description' => esc_html__( 'Company logo (upper left corner).', 'bootstrap'),
				'section' => 'title_tagline',
				'button_labels' => array(
					'add' => __( 'Logo upload', 'bootstrap'), // Optional. Button label for Add button. Default: Add
				)
			)
		));
		// Margins
		$wp_customize->add_setting('custom_logo_width',
			array(
				'default' => $this->customizer_defaults['custom_logo_width'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'custom_logo_width',
			array(
				'label' => esc_html__('Logo width (px)', 'bootstrap'),
				'section' => 'title_tagline',
				'input_attrs' => array(
					'min' => 80, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));
		$wp_customize->add_setting('custom_logo_height',
			array(
				'default' => $this->customizer_defaults['custom_logo_height'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'custom_logo_height',
			array(
				'label' => esc_html__('Logo height (px)', 'bootstrap'),
				'section' => 'title_tagline',
				'input_attrs' => array(
					'min' => 20, // Required. Minimum value for the slider
					'max' => 250, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));
		$wp_customize->add_setting('custom_logo_margin_top',
			array(
				'default' => $this->customizer_defaults['custom_logo_margin_top'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'custom_logo_margin_top',
			array(
				'label' => esc_html__('Logo margin-top (px)', 'bootstrap'),
				'section' => 'title_tagline',
				'input_attrs' => array(
					'min' => 0, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));
		$wp_customize->add_setting('custom_logo_margin_right',
			array(
				'default' => $this->customizer_defaults['custom_logo_margin_right'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'custom_logo_margin_right',
			array(
				'label' => esc_html__('Logo margin-right (px)', 'bootstrap'),
				'section' => 'title_tagline',
				'input_attrs' => array(
					'min' => 0, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));
		$wp_customize->add_setting('custom_logo_margin_bottom',
			array(
				'default' => $this->customizer_defaults['custom_logo_margin_bottom'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'custom_logo_margin_bottom',
			array(
				'label' => esc_html__('Logo margin-bottom (px)', 'bootstrap'),
				'section' => 'title_tagline',
				'input_attrs' => array(
					'min' => 0, // Required. Minimum value for the slider
					'max' => 400, // Required. Maximum value for the slider
					'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
				),
			)
		));
	}
}

/**
 * Render Callback for displaying the footer credits
 */
function skyrocket_get_credits_render_callback() {
	echo skyrocket_get_credits();
}

/**
 * Load all our Customizer Custom Controls
 */
require_once trailingslashit( dirname(__FILE__) ) . 'Class-custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$skyrocket_settings = new Bootstrap_Init_Customizer_Settings();
