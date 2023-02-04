<?php
/**
 * Display featured content on the homepage.
 *
 * @package Floral Lite
 */

$featured_posts = floral_get_featured_posts();
if ( empty( $featured_posts ) ) {
	return;
}
?>
<div class="clearfix featured-posts container">
	<div class="featured-post__content">

		<?php
		if ( floral_is_amp() ) : ?>
		<amp-carousel class="amp-slider amp-featured-post" layout="responsive" type="slides" width="1170" height="540" delay="3500">
		<?php endif; ?>


		<?php
		foreach ( $featured_posts as $index => $post ) : setup_postdata( $post ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						if ( floral_is_amp() ) {
							$url_image = get_the_post_thumbnail_url( $post, 'full' );
						} else {
							$url_image = get_the_post_thumbnail_url( $post, 'floral-featured' );
						}
						echo '<img src="' . esc_url( $url_image ) . '" data-lazy="' . esc_url( $url_image ) . '" alt="' . esc_attr( get_the_title() ) . '">';
					}
					?>
					<div class="featured-content">
						<div class="featured-posts-text">
							<?php the_title( '<h3 class="entry-title">' , '</h3>' ); ?>
							<div class="entry-meta posted-on">
								<?php floral_featured_posted_on(); ?>
							</div>
						</div>
					</div>
				</a>
			</article>
		<?php endforeach; ?>


		<?php
		if ( floral_is_amp() ) : ?>
		</amp-carousel>
		<?php endif; ?>
	</div>
</div>
<?php
wp_reset_postdata();
