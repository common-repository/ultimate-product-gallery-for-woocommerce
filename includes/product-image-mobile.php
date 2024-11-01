<?php

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

?>

<div class="images upgfw-wrapper">
	<div class="upgfw-image-gallery">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php
				//if( has_post_thumbnail() ) {
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

					if( $attachment_ids ) {
						$max_thumbnail = 3;
						$loop = 1;

						foreach( $attachment_ids as $attachment_id ) {
							$video_url = null;

							echo '<div class="swiper-slide">';
							
							$props = wc_get_product_attachment_props( $attachment_id, $post );
							
							if( ! $props['url'] ) {
								continue;
							}
							
							echo apply_filters(
								'woocommerce_single_product_image_thumbnail_html',
								sprintf(
									'<a href="%s" class="%s" title="%s" data-upgfw-index="%s" data-upgfw-type="%s">%s</a>',
									//esc_url( $props['url'] ),
									'javascript:void(0);',
									( empty( $video_url ) ? 'upgfw-image-thumbnail' : 'upgfw-video-thumbnail upgfw-video-thumbnail-large' ),
									esc_attr( $props['caption'] ),
									$loop,
									( $video_url ? 'video' : 'image' ),
									wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) )
								),
								$attachment_id,
								$post->ID,
								esc_attr( '' )
							);
							
							echo '</div>';
							
							$loop++;
						}
					}
				//}
				?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</div>