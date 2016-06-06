<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */
?>

		</div><!-- #main -->
	</div><!-- #page -->
	<div class="footer-wrapper">
		<div class="top-footer">
			<?php
				// How many footer columns to show?
				$footer_columns = get_theme_mod('honos_footer_column_count', '4');
			?>
			<div class="footer-links-container columns_count_<?php echo esc_attr( $footer_columns ); ?>">
				<?php get_sidebar( 'footer' ); ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="bottom-footer-inner">
				<div class="copyright"><?php printf( esc_html__( 'Theme by %s', 'honos' ), '<a href="https://cohhe.com" target="_blank">Cohhe</a>' ); ?></div>
				<?php if ( function_exists('honos_get_footer_social') ) { echo honos_get_footer_social(); } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>