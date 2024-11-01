<?php

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

?>

<div class="images upgfw-wrapper">
	<div class="upgfw-product-image">
		<?php
		if( has_post_thumbnail() ) {
			if( UPGFW::woocommerce_version_check() ) {
			    // Use new, updated functions
				$attachment_count = count( $product->get_gallery_image_ids() );
			} else {
				// Use older, deprecated functions
				$attachment_count = count( $product->get_gallery_attachment_ids() );
			}
			
			$thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
			$gallery = $attachment_count > 0 ? '[product-gallery]' : '';
			$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $props['title'],
				'alt' => $props['alt'],
				'data-zoom-image' => $thumbnail_url,
				'class' => 'upgfw-thumbnail-image'
			) );
			
			
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="" title="%s">%s</a>',
					esc_attr('javascript:void(0);'),
					esc_attr( $props['caption'] ),
					$image
				),
				$post->ID
			);
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}
		
		?>
	</div>
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	
</div>