<?php

if( ! class_exists( 'UPGFW' ) )  {
	
	class UPGFW {
		private $opts, $mobile_opts;

		public function __construct() {

			$this->default_options = array(
				'active' => 1,
				'image_zoom' => 1,
				'zoom_window_position' => '2',
				'zoom_window_width' => '400',
				'zoom_window_height' => '400',
				'zoom_window_border_size' => '4',
				'thumbnails_number' => '3',
				'thumbnails_space_between_items' => '5',
				'zoom_window_border_color' => 'rgba(0,0,0,0.5)',
				'thumbnails_bgcolor' => '',
				'dots_icon_color' => 'rgba(217,217,217,1)',
				'lightbox_size' => '3',
				'lightbox_scrollbar_buttons' => 0,
				'lightbox_header' => 1,
				'lightbox_product_name' => 1,
				'lightbox_zoom_mode' => '0',
				'lightbox_zoom_lens_shape' => '1',
				'lightbox_zoom_lens_size' => '400',
				'lightbox_zoom_lens_border_size' => '5',
				'lightbox_thumbnails_position' => '2',
				'lightbox_thumbnails_style' => '2',
				'lightbox_overlay_color' => 'rgba(0,0,0,0.3)',
				'lightbox_header_bgcolor' => 'rgba(251,251,251,1)',
				'lightbox_product_name_color' => 'rgba(51,51,51,1)',
				'lightbox_zoom_lens_border_color' => 'rgba(255,255,255,0.5)',
				'lightbox_thumbnails_border_color' => 'rgba(255,255,255,0.5)',
				'mb_active' => 1,
				'mb_bullet_color' => 'rgba(0,0,0,0.2)',
				'mb_active_bullet_color' => 'rgba(0,0,0,0.8)',
				'mb_lightbox_size' => '2',
				'mb_lightbox_scrollbar_theme' => '1',
				'mb_lightbox_scrollbar_buttons' => 0,
				'mb_lightbox_header' => 1,
				'mb_lightbox_product_name' => 1,
				'mb_lightbox_back_button' => 1,
				'mb_lightbox_back_button_text' => __( 'Back', 'upgfw' ),
				'mb_lightbox_thumbnails_number' => '4',
				'mb_lightbox_thumbnails_space_between_items' => '30',
				'mb_lightbox_thumbnails_centered_slides' => 1,
				'mb_lightbox_overlay_color' => 'rgba(0,0,0,0.3)',
				'mb_lightbox_header_bgcolor' => 'rgba(251,251,251,1)',
				'mb_lightbox_product_name_color' => 'rgba(51,51,51,1)',
				'mb_lightbox_back_button_bgcolor' => 'rgba(105,105,105,1)',
				'mb_lightbox_back_button_hover_bgcolor' => 'rgba(255,255,255,1)',
				'mb_lightbox_back_button_color' => 'rgba(255,255,255,1)',
				'mb_lightbox_back_button_hover_color' => 'rgba(105,105,105,1)',
				'custom_css' => '',
			);
			
			add_action( 'wp_head', array( $this, 'localize_inline_css' ) );
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_footer', array( $this, 'popup_content' ) );
			add_action( 'wp', array( $this, 'remove_woocommerce_product_thumbnails' ) );
			add_action( 'wp', array( $this, 'remove_woocommerce_product_images' ) );
			add_action( 'woocommerce_product_thumbnails', array( $this, 'show_product_thumbnails' ), 20 );
			add_action( 'woocommerce_before_single_product_summary', array( $this, 'show_product_image' ), 10 ); 
			add_filter( 'plugin_action_links_' . UPGFW_BASENAME, array( $this, 'add_action_links' ) );
			add_filter( 'wp_calculate_image_srcset', array( $this, 'disable_image_srcset' ) );
		}

		public function load_textdomain() {
			load_plugin_textdomain( 'ultimate-product-gallery-for-woocommerce', false, UPGFW_DIR_PATH . '/languages' ); 
		}

		public function add_action_links( $links ) {
			$mylinks = array(
				'<a style="font-weight:bold;color:green" target="_blank" href="http://www.barfaraz.com/plugin/ultimate-product-gallery-for-woocommerce/">Get the Pro Version!</a>',
			);
			return array_merge( $links, $mylinks );
		}
		
		public function enqueue_scripts() {
			wp_enqueue_style( 'upgfw-common', UPGFW_URL_PATH . 'assets/css/common.min.css' );

			if( wp_is_mobile() ) {
				if( $this->get_option( 'mb_active' ) ) {
					wp_enqueue_script( 'upgfw-swiper', UPGFW_URL_PATH . 'assets/js/swiper.min.js', array( 'jquery' ), '', false );
					wp_enqueue_script( 'upgfw-scripts', UPGFW_URL_PATH . 'assets/js/scripts-mobile.min.js', array('upgfw-swiper'), '', false );
					wp_enqueue_script( 'upgfw-pinch-zoom', UPGFW_URL_PATH . 'assets/js/pinch-zoom.umd.min.js', array(), '', false );

					wp_enqueue_style( 'upgfw-style', UPGFW_URL_PATH . 'assets/css/style-mobile.min.css' );
					wp_enqueue_style( 'upgfw-lightbox', UPGFW_URL_PATH . 'assets/css/lightbox-mobile.min.css' );
					wp_enqueue_style( 'upgfw-swiper', UPGFW_URL_PATH . 'assets/css/swiper.min.css' );
				}
			} else {
				if( $this->get_option( 'active' ) ) {
					wp_enqueue_script( 'upgfw-elevateZoom', UPGFW_URL_PATH . 'assets/js/jquery.elevateZoom-3.0.8-custom.min.js', array( 'jquery' ), false );
					wp_enqueue_script( 'upgfw-scripts', UPGFW_URL_PATH . 'assets/js/scripts.min.js', array( 'upgfw-custom-scrollbar' ), '', false );
					wp_enqueue_script( 'upgfw-custom-scrollbar', UPGFW_URL_PATH . 'assets/js/jquery.mCustomScrollbar.min.js', array( 'jquery' ), false );
					
					wp_enqueue_style( 'upgfw-style', UPGFW_URL_PATH . 'assets/css/style.min.css' );
					wp_enqueue_style( 'upgfw-lightbox', UPGFW_URL_PATH . 'assets/css/lightbox.min.css' );
					wp_enqueue_style( 'upgfw-custom-scrollbar', UPGFW_URL_PATH . 'assets/css/jquery.mCustomScrollbar.min.css' );
				}
			}

			wp_localize_script('upgfw-scripts', 'upgfw_script_vars', array(
				'image_zoom' => $this->get_option( 'image_zoom' ),
				'zoom_window_position' => $this->get_option( 'zoom_window_position' ),
				'zoom_window_width' => $this->get_option( 'zoom_window_width' ),
				'zoom_window_height' => $this->get_option( 'zoom_window_height' ),
				'zoom_window_border_size' => $this->get_option( 'zoom_window_border_size' ),
				'zoom_window_border_color' => $this->get_option( 'zoom_window_border_color' ),
				'lightbox_size' => $this->get_option( 'lightbox_size' ),
				'lightbox_scrollbar_buttons' => $this->get_option( 'lightbox_scrollbar_buttons' ),
				'lightbox_zoom_mode' => $this->get_option( 'lightbox_zoom_mode' ),
				'lightbox_zoom_lens_shape' => $this->get_option( 'lightbox_zoom_lens_shape' ),
				'lightbox_zoom_lens_size' => $this->get_option( 'lightbox_zoom_lens_size' ),
				'lightbox_zoom_lens_border_size' => $this->get_option( 'lightbox_zoom_lens_border_size' ),
				'lightbox_zoom_lens_border_color' => $this->get_option( 'lightbox_zoom_lens_border_color' ),
				
				'mb_lightbox_size' => $this->get_option( 'mb_lightbox_size' ),
				'mb_lightbox_thumbnails_number' => $this->get_option( 'mb_lightbox_thumbnails_number' ),
				'mb_lightbox_thumbnails_space_between_items' => $this->get_option( 'mb_lightbox_thumbnails_space_between_items' ),
				'mb_lightbox_thumbnails_centered_slides' => $this->get_option( 'mb_lightbox_thumbnails_centered_slides' ),

			) );
		}

		public function remove_woocommerce_product_thumbnails() {
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		}
		
		public function remove_woocommerce_product_images() {
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		}

		public function popup_content() {
			global $product;
			
			if( !is_product() ) {
				return;
			}
			
			if( wp_is_mobile() ) {
				if( $this->get_option( 'mb_active' ) ) {
					include( UPGFW_DIR_PATH . 'includes/lightbox-mobile.php' );
				}
			} else {
				if( $this->get_option( 'active' ) ) {
					include( UPGFW_DIR_PATH . 'includes/lightbox.php' );
				}
			}
		}

		public function show_product_image() {
			if( wp_is_mobile() ) {
				if( $this->get_option( 'mb_active' ) ) {
					require_once UPGFW_DIR_PATH . 'includes/product-image-mobile.php';
				}
			} else {
				if( $this->get_option( 'active' ) ) {
					require_once UPGFW_DIR_PATH . 'includes/product-image.php';
				}
			}
		}
		
		public function show_product_thumbnails() {
			if( wp_is_mobile() ) {
				//
			} else {
				require_once UPGFW_DIR_PATH . 'includes/product-thumbnails.php';
			}
		}

		public function disable_image_srcset() {
			return false;
		}

		public function localize_inline_css() {
			?>
			<style>
			<?php if( wp_is_mobile() ) : ?>
				.upgfw-image-gallery .swiper-pagination-bullet {
					background: <?php echo esc_attr( $this->get_option( 'mb_bullet_color' ) ); ?>;
				}
				.upgfw-image-gallery .swiper-pagination-bullet-active {
					background: <?php echo esc_attr( $this->get_option( 'mb_active_bullet_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-overlay {
					background-color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_overlay_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header {
					background-color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_header_bgcolor' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header span.upgfw-product-title {
					color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_product_name_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header .upgfw-back-button span {
					background-color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_back_button_bgcolor' ) ); ?>;
					color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_back_button_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header .upgfw-back-button:hover span {
					background-color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_back_button_hover_bgcolor' ) ); ?>;
					color: <?php echo esc_attr( $this->get_option( 'mb_lightbox_back_button_hover_color' ) ); ?>;
				}
				<?php if( !$this->get_option( 'mb_lightbox_header' ) ) : ?>
				.upgfw-lightbox-container .upgfw-lightbox-content {
					height: calc(100% - 100px);
				<?php endif; ?>
				?>
			<?php else : ?>
				.upgfw-image-gallery ul {
					background-color: <?php echo esc_attr( $this->get_option( 'thumbnails_bgcolor' ) ); ?>;
					margin: 0 -<?php echo esc_attr( $this->get_option( 'thumbnails_space_between_items' ) ); ?>px;
				}
				.upgfw-image-gallery ul li {
					margin: <?php echo esc_attr( $this->get_option( 'thumbnails_space_between_items' ) ); ?>px;
				}
				.upgfw-image-gallery ul li a svg {
					fill: <?php echo esc_attr( $this->get_option( 'dots_icon_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-overlay {
					background-color: <?php echo esc_attr( $this->get_option( 'lightbox_overlay_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header {
					background-color: <?php echo esc_attr( $this->get_option( 'lightbox_header_bgcolor' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-header span.upgfw-product-title {
					color: <?php echo esc_attr( $this->get_option( 'lightbox_product_name_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-thumbnails.upgfw-position-right.upgfw-style-1 li.active:after {
					border-right: solid 6px <?php echo esc_attr( $this->get_option( 'lightbox_thumbnails_border_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-thumbnails.upgfw-position-left.upgfw-style-1 li.active:after {
					border-left: solid 6px <?php echo esc_attr( $this->get_option( 'lightbox_thumbnails_border_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-thumbnails.upgfw-style-1 li a {
					border-color: <?php echo esc_attr( $this->get_option( 'lightbox_thumbnails_border_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-thumbnails.upgfw-position-right.upgfw-style-2 li.active a {
					border-left: solid 1px <?php echo esc_attr( $this->get_option( 'lightbox_thumbnails_border_color' ) ); ?>;
				}
				.upgfw-lightbox-container .upgfw-lightbox-thumbnails.upgfw-position-left.upgfw-style-2 li.active a {
					border-right: solid 1px <?php echo esc_attr( $this->get_option( 'lightbox_thumbnails_border_color' ) ); ?>;
				}
			<?php endif; ?>
			<?php echo( esc_attr( $this->get_option('custom_css') ) ); ?>
			</style>
			<?php
		}
		
		public function woocommerce_version_check( $version = '3.0' )  {
			if( class_exists( 'WooCommerce' ) ) {
				global $woocommerce;
				if( version_compare( $woocommerce->version, $version, ">=" ) ) {
					return true;
				}
			}
			
			return false;
		}
		
		public function get_option( $name ) {
			$options = wp_parse_args( vp_option( 'upgfw_option' ), $this->defaults );
			return $options[$name];
		}
	}
}

?>