<?php
/**
 * Honos 1.0 functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see honos_content_width()
 *
 * @since Honos 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * Honos 1.0 only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'honos_setup' ) ) :
	/**
	 * Honos 1.0 setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 * @since Honos 1.0
	 */
	function honos_setup() {
		global $wp_version;
		require(get_template_directory() . '/inc/metaboxes/layouts.php');

		/**
		 * Required: include TGM.
		 */
		require_once( get_template_directory() . '/functions/tgm-activation/class-tgm-plugin-activation.php' );

		/*
		 * Make Honos 1.0 available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Honos 1.0, use a find and
		 * replace to change 'honos' to the name of your theme in all
		 * template files.
		 */
		load_theme_textdomain( 'honos', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/editor-style.css' ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 672, 372, true );
		add_image_size( 'honos-full-width', 1170, 350, true );
		add_image_size( 'honos-small-thumb', 280, 220, true );
		add_image_size( 'honos-vertical-thumb', 190, 230, true );
		add_image_size( 'honos-latest-news', 500, 300, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list',
		) );

		// This theme allows users to set a custom background.
		add_theme_support( 'custom-background', apply_filters( 'honos_custom_background_args', array(
			'default-color' => 'fff',
		) ) );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary menu', 'honos' )
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		add_theme_support( 'title-tag' );

		if ( version_compare( $wp_version, '4.5', '>=' ) ) {
			add_theme_support( 'custom-logo' );
		} else {
			add_theme_support( 'custom-header' );
		}
	}
endif; // honos_setup
add_action( 'after_setup_theme', 'honos_setup' );

// Admin CSS
function honos_admin_css() {
	wp_enqueue_style( 'honos-admin-css', get_template_directory_uri() . '/css/wp-admin.css' );
}
add_action('admin_head','honos_admin_css');

function honos_category_list( $post_id, $return = false ) {
	$category_list = get_the_category_list( ', ', '', $post_id );
	$entry_utility = '';
	if ( $category_list ) {
		$entry_utility .= '
		<span class="post-category">
			'.esc_html__('in', 'honos').': ' . $category_list . '
		</span>';
	}

	if ( $return ) {
		return $entry_utility;
	} else {
		echo $entry_utility;
	}
}

function honos_tag_list( $post_id, $return = false ) {
	$tag_list = get_the_tag_list('', ', ', '');
	$entry_utility = '';
	if ( $tag_list ) {
		$entry_utility .= '
		<span class="post-category">
			'.esc_html__('tags', 'honos').': '. $tag_list . '
		</span>';
	}

	if ( $return ) {
		return $entry_utility;
	} else {
		echo $entry_utility;
	}
}

/**
 * Register one Honos 1.0 widget area.
 *
 * @since Honos 1.0
 *
 * @return void
 */
function honos_widgets_init() {

	register_sidebar(array(
		'name' => esc_html__('Footer Area One', 'honos'),
		'id' => 'sidebar-1',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Area Two', 'honos'),
		'id' => 'sidebar-2',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Area Three', 'honos'),
		'id' => 'sidebar-3',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Area Four', 'honos'),
		'id' => 'sidebar-4',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Post sidebar', 'honos'),
		'id' => 'sidebar-5',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Page sidebar', 'honos'),
		'id' => 'sidebar-6',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

}
add_action('widgets_init', 'honos_widgets_init');

/**
 * Custom template tags for honos 1.0
 *
 * @package WordPress
 * @subpackage honos
 * @since honos 1.0
 */

if ( ! function_exists( 'honos_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since honos 1.0
 *
 * @return void
 */
function honos_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => '',
		'next_text' => '',
	) );

	if ( $links ) :

	?>
	<div class="clearfix"></div>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo wp_kses($links,array(
		    'a' => array(
		        'href' => array(),
		        'class' => array()
		    ),
		    'span' => array(
		    	'class' => array()
		    	)
		)); ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Honos 1.0
 *
 * @return void
 */
function honos_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'honos_content_width' );

function honos_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'honos_excerpt_length', 999 );

function honos_excerpt_more( $more ) {
	return '..';
}
add_filter('excerpt_more', 'honos_excerpt_more');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Honos 1.0
 *
 * @return void
 */
function honos_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array() );

	// Add Google fonts
	wp_enqueue_style( 'honos-fonts', honos_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'honos-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'honos-style', get_stylesheet_uri(), array( 'honos-genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'honos-ie', get_template_directory_uri() . '/css/ie.css', array( 'honos-style', 'honos-genericons' ), '20131205' );
	wp_style_add_data( 'honos-ie', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'honos-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20131209', true );

	wp_enqueue_style( 'honos-animate', get_template_directory_uri() . '/css/animate.min.css', array() );

	wp_enqueue_script( 'jquery-ui-draggable' );

	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'jquery-jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array( 'jquery' ), '', true );

	// Add html5
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5.js' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'honos_scripts' );

// Admin Javascript
add_action( 'admin_enqueue_scripts', 'honos_admin_scripts' );
function honos_admin_scripts( $hook ) {
	if ( $hook == 'post.php' ) {
		wp_enqueue_script('honos-master', get_template_directory_uri() . '/inc/js/admin-master.js', array('jquery'));
	}	
}

function honos_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Domine, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Domine font: on or off', 'honos' ) ) {
		$fonts[] = 'Domine:100,300,400,500,600,700';
	}
	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'honos' ) ) {
		$fonts[] = 'Merriweather:100,300,400,500,600,700';
	}
	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'honos' ) ) {
		$fonts[] = 'Lato:100,300,400,500,600,700';
	}
	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'honos' ) ) {
		$fonts[] = 'Open+Sans:100,300,400,500,600,700';
	}
	/* translators: If there are characters in your language that are not supported by Libre Maskerville, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Libre Maskerville font: on or off', 'honos' ) ) {
		$fonts[] = 'Libre+Baskerville:100,300,400,500,600,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Honos 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function honos_body_classes( $classes ) {
	global $post;

	if ( ( is_single() || is_page() ) && has_shortcode( get_post_field( 'post_content', get_the_ID() ), 'honos_main_slider' ) ) {
		$classes[] = 'honos-slider-active';
	}

	$classes[] = HONOS_LAYOUT;

	return $classes;
}
add_filter( 'body_class', 'honos_body_classes' );

/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Honos_Header_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes         = empty ( $item->classes ) ? array () : (array) $item->classes;
		$has_description = '';

		$class_names = join(
			' '
		,   apply_filters(
				'nav_menu_css_class'
			,   array_filter( $classes ), $item
			)
		);

		// insert description for top level elements only
		// you may change this
		$description = ( ! empty ( $item->description ) )
			? '<small>' . esc_attr( $item->description ) . '</small>' : '';

		$has_description = ( ! empty ( $item->description ) )
			? 'has-description ' : '';

		! empty ( $class_names )
			and $class_names = ' class="' . esc_attr($has_description) . esc_attr( $class_names ) . ' depth-' . esc_attr( $depth ) . '"';

		$output .= "<li id='menu-item-$item->ID' $class_names>";

		$attributes  = '';

		if ( !isset($item->target) ) {
			$item->target = '';
		}

		if ( !isset($item->attr_title) ) {
			$item->attr_title = '';
		}

		if ( !isset($item->xfn) ) {
			$item->xfn = '';
		}

		if ( !isset($item->url) ) {
			$item->url = '';
		}

		if ( !isset($item->title) ) {
			$item->title = '';
		}

		if ( !isset($item->ID) ) {
			$item->ID = '';
		}

		if ( !isset($args->link_before) ) {
			$args = new stdClass();
			$args->link_before = '';
		}

		if ( !isset($args->before) ) {
			$args->before = '';
		}

		if ( !isset($args->link_after) ) {
			$args->link_after = '';
		}

		if ( !isset($args->after) ) {
			$args->after = '';
		}

		! empty( $item->attr_title )
			and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
		! empty( $item->target )
			and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
		! empty( $item->xfn )
			and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
		! empty( $item->url )
			and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output = $args->before
			. "<a $attributes>"
			. $args->link_before
			. $title
			. $description
			. '</a> '
			. $args->link_after
			. $args->after;

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el'
		,   $item_output
		,   $item
		,   $depth
		,   $args
		);
	}
}

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function honos_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     				=> esc_html__('Bootstrap 3 Shortcodes', 'honos'), // The plugin name
			'slug'     				=> 'bootstrap-3-shortcodes', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.3.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Contact Form 7', 'honos'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Easy Testimonials', 'honos'), // The plugin name
			'slug'     				=> 'easy-testimonials', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.34', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Newsletter', 'honos'), // The plugin name
			'slug'     				=> 'newsletter', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.0.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Functionality for Honos theme', 'honos'), // The plugin name
			'slug'     				=> 'functionality-for-honos-theme', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'honos',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'honos' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'honos' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'honos' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'honos' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'honos' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'honos' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'honos' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'honos' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'honos' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'honos' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'honos' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'honos' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'honos' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'honos' ),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'honos' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'honos' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'honos' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'honos_register_required_plugins' );