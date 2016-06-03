<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Zap
 * @since Zap 1.0
 */

global $zap_article_width;
if ( !is_single() ) {
	$post_class = 'not-single-post';
	$header_class = 'simple';
} else {
	$post_class = 'single-post';
	$header_class = '';
}

$comments = wp_count_comments( get_the_ID() ); 
$comment_count = $comments->approved;

if ( $comment_count == 0 ) {
	$comment_count = __('No', 'honos');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($zap_article_width.$post_class); ?>>
	<header class="entry-header <?php echo $header_class; ?>">
		<?php
			if ( !is_single() && ( is_home() || is_archive() || is_search() ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'honos-latest-news' );
				echo '<div class="single-image-container">';
				if ( !empty($img) ) {
					echo '<img src="'.esc_url($img['0']).'" class="single-post-image" alt="'.__('Post with image', 'honos').'">';
				} else {
					echo '<span class="post-no-image"></span>';
				}
				echo '</div>';
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				echo '<div class="post-meta">';
					echo '<span class="post-date">' . get_the_date( get_option( 'date_format' ), get_the_ID() ) . '</span>';
					echo honos_category_list( get_the_ID(), true );
					echo '<span class="post-comments"><a href="' . get_the_permalink() . '#comments">' . $comment_count . ' ' . __('comments', 'honos') . '</a></span>';
				echo '</div>';
				echo '</header><!-- .entry-header -->';
			} elseif ( is_single() && !is_home() ) {
				echo '</header><!-- .entry-header -->';
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'honos-full-width' );
				echo '<div class="single-post-image-container">';
				if ( !empty($img) ) {
					echo '<img src="'.esc_url($img['0']).'" class="single-post-image" alt="'.__('Post with image', 'honos').'">';
				}
				echo '</div>';
				the_title( '<h3 class="entry-title">', '</h3>' );
				echo '<div class="post-meta">';
					echo '<span class="post-date">' . get_the_date( get_option( 'date_format' ), get_the_ID() ) . '</span>';
					echo '<span class="post-author">' . __('By', 'honos') . ': ' . get_the_author() . '</span>';
					echo '<span class="post-comments"><a href="' . get_the_permalink() . '#comments">' . $comment_count . ' ' . __('comments', 'honos') . '</a></span>';
				echo '</div>';
			}
		?>
	

	<?php if ( !is_single() && ( is_home() || is_archive() || is_search() ) ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<div id="entry-content-wrapper">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'honos' ) ); ?>
		</div>
		<?php if ( function_exists('honos_get_content_share()') ) { echo honos_get_content_share(); } ?>
		<?php if ( get_the_author_meta( 'description' ) ) { ?>
			<div id="author-info">
				<h3 class="author-title"><?php _e('About post author', 'honos'); ?></h3>
				<div class="author-infobox">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'vh_author_bio_avatar_size', 83 ) ); ?>
					</div>
					<div id="author-description">
						<span class="author-text"><?php _e('Author:', 'honos'); ?></span>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div><!-- end of author-description -->
				</div>
				<div class="clearfix"></div>
			</div><!-- end of entry-author-info -->
		<?php } ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'honos' ) . '</span>',
				'after'       => '<div class="clearfix"></div></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->