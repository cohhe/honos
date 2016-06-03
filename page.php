<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */

get_header();

global $honos_site_width, $honos_layout_type;

?>

<div id="main-content" class="main-content ">
	<?php if ( !is_front_page() ) { ?>
		<h1 class="main-page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	<?php } ?>
	<?php
		if ( HONOS_LAYOUT == 'sidebar-left' ) {
			get_sidebar( 'page' );
		}
	?>
	<div class="content-wrapper <?php echo esc_attr($honos_site_width); ?>">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				endwhile;
				
			?>

	</div><!-- .content-wrapper -->
	<?php
		if ( HONOS_LAYOUT == 'sidebar-right' ) {
			get_sidebar( 'page' );
		}
	?>
</div><!-- #main-content -->

<?php
get_footer();