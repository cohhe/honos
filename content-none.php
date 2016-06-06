<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */
?>

<div class="no-results-wrapper">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'honos' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php esc_html_e( 'Ready to publish your first post?', 'honos' ); ?> <a href="<?php echo admin_url( 'post-new.php' ); ?>"><?php esc_html_e('Get started here', 'honos'); ?></a></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'honos' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'honos' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</div>