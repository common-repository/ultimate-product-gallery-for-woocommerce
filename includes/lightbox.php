<?php

global $post, $product;

if( UPGFW::woocommerce_version_check() ) {
    // Use new, updated functions
	$attachment_ids = $product->get_gallery_image_ids();
} else {
	// Use older, deprecated functions
	$attachment_ids = $product->get_gallery_attachment_ids();
}

// Add thumbnail to gallery
if( has_post_thumbnail() ) {
	$product_thumbnail_id = get_post_thumbnail_id();
	if( $product_thumbnail_id ) {
		$attachment_ids = array_merge( array( $product_thumbnail_id ), $attachment_ids );
	}
}

?>

<div class="upgfw-lightbox">
	<div class="upgfw-lightbox-container close">
		<div class="upgfw-lightbox-overlay"></div>
		<div class="upgfw-lightbox-wrapper">
			<div class="upgfw-lightbox-close"></div>
			<?php if( UPGFW::get_option( 'lightbox_header' ) ) : ?>
			<div class="upgfw-header">
				<?php if( UPGFW::get_option( 'lightbox_product_name' ) ) : ?>
					<?php the_title('<span class="upgfw-product-title">', '</span>'); ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<ul class="upgfw-lightbox-thumbnails upgfw-position-<?php echo ( UPGFW::get_option( 'lightbox_thumbnails_position' ) == 2 ? 'right' : 'left' ); ?> <?php echo ( UPGFW::get_option( 'lightbox_thumbnails_style' ) ? 'upgfw-style-' . UPGFW::get_option( 'lightbox_thumbnails_style' ) : '' ); ?>">
				<?php
				if( $attachment_ids ) {
					$loop = 1;
					foreach( $attachment_ids as $attachment_id ) {
						$video_url = null;
						
						echo '<li data-upgfw-type="' . ( $video_url ? 'video' : 'image' ) . '" data-upgfw-index="' . esc_attr( $loop ) . '">';

						$props = wc_get_product_attachment_props( $attachment_id, $post );

						if( ! $props['url'] ) {
							continue;
						}

						echo apply_filters(
							'woocommerce_single_product_image_thumbnail_html',
							sprintf(
								'<a href="%s" class="%s" title="%s">%s</a>',
								esc_url( $props['url'] ),
								( empty( $video_url ) ? 'upgfw-image-thumbnail' : 'upgfw-video-thumbnail' ),
								esc_attr( $props['caption'] ),
								wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) )
							),
							$attachment_id,
							$post->ID,
							esc_attr( '' )
						);

						echo '</li>';
						
						$loop++;
					}
				}
				?>
			</ul>
			<ul class="upgfw-lightbox-content upgfw-position-<?php echo ( UPGFW::get_option( 'lightbox_thumbnails_position' ) == 2 ? 'left' : 'right' ); ?>">
				<?php
				if( $attachment_ids ) {
					$loop = 1;
					foreach( $attachment_ids as $attachment_id ) {
						$video_url = null;

						echo '<li data-upgfw-index="' . esc_attr( $loop ) . '">';

						$props = wc_get_product_attachment_props( $attachment_id, $post );

						if( ! $props['url'] ) {
							continue;
						}

						if( $video_url ) {
							echo '<iframe width="100%" height="100%" src="" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" data-upgfw-src="'.esc_url( $video_url ).'" id="upgfw-lightbox-video-' . esc_attr( $loop ) . '"></iframe>';
							echo '<div class="upgfw-loading-wrapper" id="upgfw-loading-wrapper-' . esc_attr( $loop ) .'" ><div class="upgfw-loader upgfw-loading-bar"></div></div>';
						} else {
							echo '<div class="upgfw-centered-flex">';
							?>
							
								<?php
								$image_attributes = wp_get_attachment_image_src( $attachment_id, 'large', false );
								?>
								<img alt="<?php echo $props['title']; ?>" src="" data-zoom-image="<?php echo $props['full_src']; ?>" data-upgfw-src="<?php echo $image_attributes[0]; ?>" id="upgfw-lightbox-image-<?php echo esc_attr( $loop ); ?>" class="upgfw-lightbox-image <?php echo ( UPGFW::get_option( 'lightbox_zoom_mode' ) == 2 ? 'upgfw-pan' : '' ); ?>">
								
								<div class="upgfw-loading-wrapper" id="upgfw-loading-wrapper-<?php echo esc_attr( $loop ); ?>" ><div class="upgfw-loader upgfw-loading-bar"></div></div>
							<?php
							echo '</div>';
						}

						echo '</li>';

						$loop++;
					}
				}
				?>
			</ul>
		</div>
	</div>
</div>