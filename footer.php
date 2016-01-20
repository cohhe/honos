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
				$footer_columns = get_option( 'vh_footer_columns' );
				if ( $footer_columns == false ) {
					$footer_columns = 4;
				}
			?>
			<div class="footer-links-container columns_count_<?php echo $footer_columns; ?>">
				<?php get_sidebar( 'footer' ); ?>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="bottom-footer-inner">
				<div class="copyright">Theme by <a href="https://cohhe.com/">Cohhe</a></div>
				<div class="footer-social">
					<?php if ( get_theme_mod( 'honos_footer_facebook_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-facebook"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_twitter_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-twitter"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_rss_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-rss-squared"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_dribbble_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-dribbble"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_linkedin_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-linkedin-squared"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_behance_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-behance"></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'honos_footer_pinterest_icon', '' ) ) { ?>
						<a href="#" class="footer-social icon-pinterest-squared"></a>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>