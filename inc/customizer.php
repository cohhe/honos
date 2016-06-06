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

	// Add General setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_general_panel', array(
		'priority'       => 250,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'General settings' , 'honos'),
		'description'    => esc_html__( 'You can configure your general theme settings here' , 'honos')
	) );

	// Add Header setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_header_panel', array(
		'priority'       => 260,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Header settings' , 'honos'),
		'description'    => esc_html__( 'You can configure your header theme settings here' , 'honos')
	) );

	// Add Footer setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_footer_panel', array(
		'priority'       => 260,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Footer settings' , 'honos'),
		'description'    => esc_html__( 'You can configure your footer theme settings here' , 'honos')
	) );

	// Call us
	$wp_customize->add_section( 'honos_header_call_us', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__( 'Call us' , 'honos'),
		'description'    => esc_html__( 'Call us text at the header.' , 'honos'),
		'panel'          => 'honos_header_panel'
	) );

	$wp_customize->add_setting( 'honos_header_call_us_text', array( 'default' => 'Call us:', 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_text',
		array(
			'label'      => esc_html__( 'Call us text', 'honos'),
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_call_us_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );

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
		'title'          => esc_html__( 'Consult' , 'honos'),
		'description'    => esc_html__( 'Consult text at the header.' , 'honos'),
		'panel'          => 'honos_header_panel'
	) );

	$wp_customize->add_setting( 'honos_header_consult_text', array( 'default' => 'Request a free consultation', 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_consult_text',
		array(
			'label'      => esc_html__('Consult text', 'honos'),
			'section'    => 'honos_header_consult',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_consult_text_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );

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
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_column_count', array( 'default' => '4', 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_column_count',
		array(
			'label'      => esc_html__('Footer columns', 'honos'),
			'section'    => 'honos_footer_columns',
			'type'       => 'select',
			'choices'  => array(
				'1' => '1 column',
				'2' => '2 columns',
				'3' => '3 columns',
				'4' => '4 columns'
			)
		)
	);

	// Social links
	$wp_customize->add_section( new honos_Customized_Section( $wp_customize, 'honos_social_links', array(
		'priority'       => 300,
		'capability'     => 'edit_theme_options'
		) )
	);

	$wp_customize->add_setting( 'honos_fake_field', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_fake_field',
		array(
			'label'      => '',
			'section'    => 'honos_social_links',
			'type'       => 'text'
		)
	);
}
add_action( 'customize_register', 'honos_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) && !class_exists( 'honos_Customized_Section' ) ) {
	class honos_Customized_Section extends WP_Customize_Section {
		public function render() {
			$classes = 'accordion-section control-section control-section-' . $this->type;
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
				<style type="text/css">
					.cohhe-social-profiles {
						padding: 14px;
					}
					.cohhe-social-profiles li:last-child {
						display: none !important;
					}
					.cohhe-social-profiles li i {
						width: 20px;
						height: 20px;
						display: inline-block;
						background-size: cover !important;
						margin-right: 5px;
						float: left;
					}
					.cohhe-social-profiles li i.twitter {
						background: url(<?php echo get_template_directory_uri().'/images/icons/twitter.png'; ?>);
					}
					.cohhe-social-profiles li i.facebook {
						background: url(<?php echo get_template_directory_uri().'/images/icons/facebook.png'; ?>);
					}
					.cohhe-social-profiles li i.googleplus {
						background: url(<?php echo get_template_directory_uri().'/images/icons/googleplus.png'; ?>);
					}
					.cohhe-social-profiles li i.cohhe_logo {
						background: url(<?php echo get_template_directory_uri().'/images/icons/cohhe.png'; ?>);
					}
					.cohhe-social-profiles li a {
						height: 20px;
						line-height: 20px;
					}
					#customize-theme-controls>ul>#accordion-section-honos_social_links {
						margin-top: 10px;
					}
					.cohhe-social-profiles li.documentation {
						text-align: right;
						margin-bottom: 60px;
					}
				</style>
				<ul class="cohhe-social-profiles">
					<li class="documentation"><a href="http://documentation.cohhe.com/honos" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Documentation', 'honos' ); ?></a></li>
					<li class="social-twitter"><i class="twitter"></i><a href="https://twitter.com/Cohhe_Themes" target="_blank"><?php esc_html_e( 'Follow us on Twitter', 'honos' ); ?></a></li>
					<li class="social-facebook"><i class="facebook"></i><a href="https://www.facebook.com/cohhethemes" target="_blank"><?php esc_html_e( 'Join us on Facebook', 'honos' ); ?></a></li>
					<li class="social-googleplus"><i class="googleplus"></i><a href="https://plus.google.com/+Cohhe_Themes/posts" target="_blank"><?php esc_html_e( 'Join us on Google+', 'honos' ); ?></a></li>
					<li class="social-cohhe"><i class="cohhe_logo"></i><a href="https://cohhe.com/" target="_blank"><?php esc_html_e( 'Cohhe.com', 'honos' ); ?></a></li>
				</ul>
			</li>
			<?php
		}
	}
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Honos 1.0
 */
function honos_customize_preview_js() {
	wp_enqueue_script( 'honos_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'honos_customize_preview_js' );