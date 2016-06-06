<?php
/**
 * Custom template tags for Honos 1.0
 *
 * @package WordPress
 * @subpackage Honos
 * @since Honos 1.0
 */

if ( ! function_exists( 'honos_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Honos 1.0
 *
 * @return void
 */
function honos_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'honos' ) );
			else :
				previous_post_link( '%link', __( '<span class="glyphicon glyphicon-chevron-left"></span><span class="post-left">%title</span>', 'honos' ) );
				next_post_link( '%link', __( '<span class="glyphicon glyphicon-chevron-right"></span><span class="post-right">%title</span>', 'honos' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;