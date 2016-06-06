<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<?php
global $honos_site_width, $honos_layout_type, $withcomments, $wp_version;
$withcomments = 1;

$form_class    = '';
$class         = '';
$honos_site_width    = 'col-sm-12 col-md-12 col-lg-12';
$layout_type   = get_post_meta(get_the_id(), 'layouts', true);

if ( !isset($search_string) ) {
	$search_string = '';
}

if ( is_archive() || is_search() || is_404() ) {
	$layout_type = 'full';
} elseif (empty($layout_type)) {
	$layout_type = get_theme_mod('honos_layout', 'full');
}

switch ($layout_type) {
	case 'right':
		define('HONOS_LAYOUT', 'sidebar-right');
		break;
	case 'full':
		define('HONOS_LAYOUT', 'sidebar-no');
		break;
	case 'left':
		define('HONOS_LAYOUT', 'sidebar-left');
		break;
}

if ( ( HONOS_LAYOUT != 'sidebar-no' && is_active_sidebar( 'sidebar-5' ) ) || ( HONOS_LAYOUT != 'sidebar-no' && is_active_sidebar( 'sidebar-6' ) ) ) {
	$honos_site_width = 'col-sm-9 col-md-9 col-lg-9';
}

if ( version_compare( $wp_version, '4.5', '>=' ) ) {
	$logo = '';
	if ( get_custom_logo() ) {
		$logo = get_custom_logo();
	};
} else {
	$logo_f = get_custom_header();
	$logo_f = $logo->url;
	$logo = '';
	if ( $logo_f ) {
		$logo = '<img src="'.esc_url($logo_f).'" alt="'.esc_attr__('Site logo', 'beryl').'">';
	}
}

if (get_search_query() == '') {
	$search_string = esc_html__('Search', 'honos');
} else {
	$search_string = get_search_query();
}

$call_us_text = get_theme_mod( 'honos_header_call_us_text', esc_html__('Call us:', 'honos') );
$call_us_link = get_theme_mod( 'honos_header_call_us_link', '' );
$call_us_link_text = get_theme_mod( 'honos_header_call_us_link_text', '' );

$consult_text = get_theme_mod( 'honos_header_consult_text', esc_html__('Request a free consultation', 'honos') );
$consult_text_link = get_theme_mod( 'honos_header_consult_text_link', '' );

?>
<body <?php body_class(); ?>>
<?php do_action('ase_theme_body_inside_top'); ?>
<div id="page" class="hfeed site">
	<header class="main-header">
		<div class="header-top-wrapper">
			<div class="header-top">
				<?php if ( $call_us_link && $call_us_link_text ) { ?>
					<span class="call-us"><?php echo esc_html($call_us_text); ?> <a href="<?php echo esc_url($call_us_link); ?>"><?php echo esc_html($call_us_link_text); ?></a></span>
				<?php } ?>
				<span class="header-search icon-search"></span>
				<?php get_search_form( true ); ?>
				<?php if ( $consult_text && $consult_text_link ) { ?>
					<a href="<?php echo esc_url($consult_text_link); ?>" class="free-consult icon-chat"><?php echo esc_html($consult_text); ?></a>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="header-bottom-wrapper">
			<div class="header-bottom">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo">
					<?php if ( $logo ) {
						echo $logo;
					} else { ?>
						<span class="blog-name"><?php bloginfo( 'name' ); ?></span>
						<span class="blog-description"><?php bloginfo( 'description' ); ?></span>
					<?php } ?>
				</a>
				<nav id="primary-navigation" class="primary-navigation" role="navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'nav-menu',
								'depth'          => 3,
								'walker'         => new Honos_Header_Menu_Walker
							)
						);
					?>
				</nav>
				<a href="javascript:void(0)" class="mobile-menu-button icon-menu"></a>
				<nav id="mobile-navigation" class="mobile-navigation" role="navigation">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'nav-mobile-menu',
								'depth'          => 3,
								'walker'         => new Honos_Header_Menu_Walker
							)
						);
					?>
				</nav>
				<div class="clearfix"></div>
			</div>
		</div>
	</header>
	<div id="main" class="site-main container">