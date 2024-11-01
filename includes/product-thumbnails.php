<?php

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

?>

<div class="upgfw-image-gallery">
	<?php
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
			$max_thumbnail = UPGFW::get_option( 'thumbnails_number' );
			$loop = 1;
			?>
			<ul>
				<?php
				foreach( $attachment_ids as $attachment_id ) {
					$video_url = null;
					echo '<li>';
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
							( empty( $video_url ) ? 'upgfw-image-thumbnail' : 'upgfw-video-thumbnail' ),
							esc_attr( $props['caption'] ),
							$loop,
							( $video_url ? 'video' : 'image' ),
							wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) )
						),
						$attachment_id,
						$post->ID,
						esc_attr( '' )
					);

					echo '</li>';
					
					if( $loop >= $max_thumbnail ) {
						break;
					}
					
					$loop++;
				}
				if( count( $attachment_ids ) > $max_thumbnail ) {
					?>
					<li>
						<a href="javascript:void(0);" title="<?php echo __( 'More', 'upgfw' ); ?>" data-upgfw-index="1">
							<svg><use xlink:href="<?php echo UPGFW_URL_PATH; ?>assets/svg/more.svg#Layer_1"></use></svg>
						</a>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
	}
	?>
</div>