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
			<?php if( !UPGFW::get_option( 'mb_lightbox_back_button' ) ) : ?>
			<div class="upgfw-lightbox-close"></div>
			<?php endif; ?>
			<?php if( UPGFW::get_option( 'mb_lightbox_header' ) ) : ?>
			<div class="upgfw-header">
				<?php if( UPGFW::get_option( 'mb_lightbox_product_name' ) ) : ?>
					<?php the_title('<span class="upgfw-product-title">', '</span>'); ?>
				<?php endif; ?>
				<?php if( UPGFW::get_option( 'mb_lightbox_back_button' ) ) : ?>
					<a class="upgfw-button upgfw-back-button"><span><?php echo UPGFW::get_option( 'mb_lightbox_back_button_text' ); ?></span></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="upgfw-lightbox-thumbnails">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						if( $attachment_ids ) {
							$loop = 1;
							foreach( $attachment_ids as $attachment_id ) {
								$video_url = null;
								
								echo '<div data-upgfw-type="' . ( $video_url ? 'video' : 'image' ) . '" data-upgfw-index="' . $loop . '" class="swiper-slide">';

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

								echo '</div>';

								$loop++;
							}
						}
						?>
					</div>
				</div>
			</div>
			<ul class="upgfw-lightbox-content">
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
							echo '<div class="upgfw-middle-table-cell">';
							
							$image_attributes = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single', false );
							?>
							<img alt="<?php echo $props['title']; ?>" src="" data-upgfw-src="<?php echo $props['full_src']; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" id="upgfw-lightbox-image-<?php echo esc_attr( $loop ); ?>" class="upgfw-lightbox-image">
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