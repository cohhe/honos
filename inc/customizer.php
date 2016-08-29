<?php
/**
 * Honos 1.0 Theme Customizer support
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Honos 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function honos_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = esc_html__( 'Background may only be visible on wide screens.', 'honos' );
	$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Background may only be visible on wide screens.', 'honos' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'honos' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'honos' );

	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Logo', 'honos' );

	// Add Theme Options panel and configure settings inside it
	$wp_customize->add_panel( 'honos_theme_options_panel', array(
		'priority'       => 260,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Theme Options' , 'honos'),
		'description'    => esc_html__( 'You can configure your theme settings here' , 'honos')
	) );

	$wp_customize->add_section( 'honos_header_call_us', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Header Call us' , 'honos'),
		'description'    => esc_html__( 'Here you\'re able to configure your header call us link.' , 'honos'),
		'panel'          => 'honos_theme_options_panel'
	) );

	$wp_customize->add_setting( 'honos_header_call_us_text', array( 'default' => esc_html__('Call us:', 'honos'), 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_text',
		array(
			'label'      => esc_html__( 'Call us text', 'honos'),
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_call_us_link', array( 'sanitize_callback' => 'esc_url_raw' ) );

	$wp_customize->add_control(
		'honos_header_call_us_link',
		array(
			'label'      => esc_html__('Call us link', 'honos'),
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_call_us_link_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_link_text',
		array(
			'label'      => esc_html__('Call us link text', 'honos'),
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	// Consult
	$wp_customize->add_section( 'honos_header_consult', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Header Consult' , 'honos'),
		'description'    => esc_html__( 'Consult text at the header.' , 'honos'),
		'panel'          => 'honos_theme_options_panel'
	) );

	$wp_customize->add_setting( 'honos_header_consult_text', array( 'default' => esc_html__('Request a free consultation', 'honos'), 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_consult_text',
		array(
			'label'      => esc_html__('Consult text', 'honos'),
			'section'    => 'honos_header_consult',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_consult_text_link', array( 'sanitize_callback' => 'esc_url_raw' ) );

	$wp_customize->add_control(
		'honos_header_consult_text_link',
		array(
			'label'      => esc_html__('Consult link', 'honos'),
			'section'    => 'honos_header_consult',
			'type'       => 'text',
		)
	);

	// Footer columns
	$wp_customize->add_section( 'honos_footer_columns', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Footer columns' , 'honos'),
		'description'    => esc_html__( 'Footer column count.' , 'honos'),
		'panel'          => 'honos_theme_options_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_column_count', array( 'default' => '4', 'sanitize_callback' => 'absint' ) );

	$wp_customize->add_control(
		'honos_footer_column_count',
		array(
			'label'      => esc_html__('Footer columns', 'honos'),
			'section'    => 'honos_footer_columns',
			'type'       => 'select',
			'choices'  => array(
				'1' => esc_html__('1 column', 'honos'),
				'2' => esc_html__('2 columns', 'honos'),
				'3' => esc_html__('3 columns', 'honos'),
				'4' => esc_html__('4 columns', 'honos')
			)
		)
	);
}
add_action( 'customize_register', 'honos_customize_register' );

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Honos 1.0
 */
function honos_customize_preview_js() {
	wp_enqueue_script( 'honos_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'honos_customize_preview_js' );