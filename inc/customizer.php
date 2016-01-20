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
	$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'honos' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'honos' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'honos' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'honos' );

	$wp_customize->get_section( 'header_image' )->title = __( 'Logo', 'honos' );

	// Add General setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_general_panel', array(
		'priority'       => 250,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'General settings' , 'honos'),
		'description'    => __( 'You can configure your general theme settings here' , 'honos')
	) );

	// Add Header setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_header_panel', array(
		'priority'       => 260,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Header settings' , 'honos'),
		'description'    => __( 'You can configure your header theme settings here' , 'honos')
	) );

	// Add Footer setting panel and configure settings inside it
	$wp_customize->add_panel( 'honos_footer_panel', array(
		'priority'       => 260,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Footer settings' , 'honos'),
		'description'    => __( 'You can configure your footer theme settings here' , 'honos')
	) );

	// Call us
	$wp_customize->add_section( 'honos_header_call_us', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Call us' , 'honos'),
		'description'    => __( 'Call us text at the header.' , 'honos'),
		'panel'          => 'honos_header_panel'
	) );

	$wp_customize->add_setting( 'honos_header_call_us_text', array( 'default' => 'Call us:', 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_text',
		array(
			'label'      => 'Call us text',
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_call_us_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_link',
		array(
			'label'      => 'Call us link',
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_call_us_link_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_call_us_link_text',
		array(
			'label'      => 'Call us link text',
			'section'    => 'honos_header_call_us',
			'type'       => 'text',
		)
	);

	// Consult
	$wp_customize->add_section( 'honos_header_consult', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Consult' , 'honos'),
		'description'    => __( 'Consult text at the header.' , 'honos'),
		'panel'          => 'honos_header_panel'
	) );

	$wp_customize->add_setting( 'honos_header_consult_text', array( 'default' => 'Request a free consultation', 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_consult_text',
		array(
			'label'      => 'Consult text',
			'section'    => 'honos_header_consult',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'honos_header_consult_text_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_header_consult_text_link',
		array(
			'label'      => 'Consult link',
			'section'    => 'honos_header_consult',
			'type'       => 'text',
		)
	);

	// Facebook
	$wp_customize->add_section( 'honos_footer_facebook', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Facebook link' , 'honos'),
		'description'    => __( 'Facebook social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_facebook_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_facebook_icon',
		array(
			'label'      => 'Facebook icon link',
			'section'    => 'honos_footer_facebook',
			'type'       => 'text',
		)
	);

	// Twitter
	$wp_customize->add_section( 'honos_footer_twitter', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Twitter link' , 'honos'),
		'description'    => __( 'Twitter social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_twitter_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_twitter_icon',
		array(
			'label'      => 'Twitter icon link',
			'section'    => 'honos_footer_twitter',
			'type'       => 'text',
		)
	);

	// RSS
	$wp_customize->add_section( 'honos_footer_rss', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'RSS link' , 'honos'),
		'description'    => __( 'RSS social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_rss_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_rss_icon',
		array(
			'label'      => 'RSS icon link',
			'section'    => 'honos_footer_rss',
			'type'       => 'text',
		)
	);

	// Dribbble
	$wp_customize->add_section( 'honos_footer_dribbble', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Dribbble link' , 'honos'),
		'description'    => __( 'Dribbble social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_dribbble_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_dribbble_icon',
		array(
			'label'      => 'Dribbble icon link',
			'section'    => 'honos_footer_dribbble',
			'type'       => 'text',
		)
	);

	// Linkedin
	$wp_customize->add_section( 'honos_footer_linkedin', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Linkedin link' , 'honos'),
		'description'    => __( 'Linkedin social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_linkedin_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_linkedin_icon',
		array(
			'label'      => 'Linkedin icon link',
			'section'    => 'honos_footer_linkedin',
			'type'       => 'text',
		)
	);

	// Behance
	$wp_customize->add_section( 'honos_footer_behance', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Behance link' , 'honos'),
		'description'    => __( 'Behance social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_behance_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_behance_icon',
		array(
			'label'      => 'Behance icon link',
			'section'    => 'honos_footer_behance',
			'type'       => 'text',
		)
	);

	// Pinterest
	$wp_customize->add_section( 'honos_footer_pinterest', array(
		'priority'       => 90,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Pinterest link' , 'honos'),
		'description'    => __( 'Pinterest social icon at footer.' , 'honos'),
		'panel'          => 'honos_footer_panel'
	) );

	$wp_customize->add_setting( 'honos_footer_pinterest_icon', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	$wp_customize->add_control(
		'honos_footer_pinterest_icon',
		array(
			'label'      => 'Pinterest icon link',
			'section'    => 'honos_footer_pinterest',
			'type'       => 'text',
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
					<li class="documentation"><a href="http://documentation.cohhe.com/honos" class="button button-primary button-hero" target="_blank"><?php _e( 'Documentation', 'honos' ); ?></a></li>
					<li class="social-twitter"><i class="twitter"></i><a href="https://twitter.com/Cohhe_Themes" target="_blank"><?php _e( 'Follow us on Twitter', 'honos' ); ?></a></li>
					<li class="social-facebook"><i class="facebook"></i><a href="https://www.facebook.com/cohhethemes" target="_blank"><?php _e( 'Join us on Facebook', 'honos' ); ?></a></li>
					<li class="social-googleplus"><i class="googleplus"></i><a href="https://plus.google.com/+Cohhe_Themes/posts" target="_blank"><?php _e( 'Join us on Google+', 'honos' ); ?></a></li>
					<li class="social-cohhe"><i class="cohhe_logo"></i><a href="https://cohhe.com/" target="_blank"><?php _e( 'Cohhe.com', 'honos' ); ?></a></li>
				</ul>
			</li>
			<?php
		}
	}
}

function honos_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function honos_sanitize_textarea( $text ) {
	return wp_kses_post( $text );
}

/**
 * Sanitize the Featured Content layout value.
 *
 * @since Honos 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function honos_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'slider' ) ) ) {
		$layout = 'slider';
	}

	return $layout;
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

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since Honos 1.0
 *
 * @return void
 */
function honos_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'honos',
		'title'   => __( 'Honos 1.0', 'honos' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by the <a href="%1$s">featured</a> tag; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'honos' ), admin_url( '/edit.php?tag=featured' ), admin_url( 'customize.php' ), admin_url( '/edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Honos 1.0 uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'honos' ), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Honos 1.0 documentation</a>.', 'honos' ), 'http://codex.wordpress.org/Honos' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'honos_contextual_help' );
add_action( 'admin_head-edit.php',   'honos_contextual_help' );
