<?php

return array(
	'title' => __('Ultimate Product Gallery For WooCommerce', 'upgfw'),
	'logo' => 'logo-256x256.png',
	'menus' => array(
		array(
			'title' => __('Desktop', 'upgfw'),
			'name' => 'upgfw_menu_1',
			'icon' => 'font-awesome:fa-desktop',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('General', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'toggle',
					        'name' => 'active',
					        'label' => __('Active', 'upgfw'),
					        'description' => __('Enable desktop mode', 'upgfw'),
					        'default' => 1,
					    ),

					),
				),
				array(
					'type' => 'section',
					'title' => __('Product Page Settings', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'toggle',
					        'name' => 'image_zoom',
					        'label' => __('Image Zoom', 'upgfw'),
					        'description' => __('Enable zoom for product single image', 'upgfw'),
					        'default' => 1,
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'zoom_window_position',
					        'label' => __('Zoom Window Position', 'upgfw'),
					        'description' => '<br><img src="' . UPGFW_URL_PATH . '/assets/images/window-positions.png">',
					        'min' => '1',
					        'max' => '16',
					        'step' => '1',
					        'default' => '3',
					   
							'dependency' => array(
							    'field'    => 'image_zoom',
							    'function' => 'vp_dep_boolean',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'zoom_window_width',
					        'label' => __('Zoom Window Width', 'upgfw'),
					        'description' => '',
					        'min' => '100',
					        'max' => '500',
					        'step' => '50',
					        'default' => '400',
					   
							'dependency' => array(
							    'field'    => 'image_zoom',
							    'function' => 'vp_dep_boolean',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'zoom_window_height',
					        'label' => __('Zoom Window Height', 'upgfw'),
					        'description' => '',
					        'min' => '100',
					        'max' => '500',
					        'step' => '50',
					        'default' => '400',
					   
							'dependency' => array(
							    'field'    => 'image_zoom',
							    'function' => 'vp_dep_boolean',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'zoom_window_border_size',
					        'label' => __('Zoom Window Border Size', 'upgfw'),
					        'description' => '',
					        'min' => '0',
					        'max' => '10',
					        'step' => '1',
					        'default' => '4',
					   
							'dependency' => array(
							    'field'    => 'image_zoom',
							    'function' => 'vp_dep_boolean',
							)
					    ),
					    array(
					        'type' => 'toggle',
					        'name' => 'mousewheel_zoom',
					        'label' => __('Mousewheel Zoom', 'upgfw'),
					        'description' => __('Active mouse wheel zoom. <br><b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'default' => 0,
					        
							'dependency' => array(
							    'field'    => 'image_zoom',
							    'function' => 'vp_dep_boolean',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'thumbnails_number',
					        'label' => __('Thumbnails Number', 'upgfw'),
					        'description' => '',
					        'min' => '1',
					        'max' => '10',
					        'step' => '1',
					        'default' => '3',
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'thumbnails_space_between_items',
					        'label' => __('Space Between Thumbnail Items', 'upgfw'),
					        'description' => '',
					        'min' => '0',
					        'max' => '20',
					        'step' => '1',
					        'default' => '5',
					    ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Product Page Colors', 'upgfw'),
					'fields' => array(

					    array(
					        'type' => 'color',
					        'name' => 'zoom_window_border_color',
					        'label' => __('Zoom Window Border Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(0,0,0,0.5)',
					        'format' => 'rgba',
					   
					    ),
					    array(
					        'type' => 'color',
					        'name' => 'thumbnails_bgcolor',
					        'label' => __('Thumbnails Background Color', 'upgfw'),
					        'description' => '',
					        'default' => '',
					        'format' => 'rgba',
					    ),
					    array(
					        'type' => 'color',
					        'name' => 'dots_icon_color',
					        'label' => __('Dotst Icon Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(217,217,217,1)',
					        'format' => 'rgba',
					    ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Lightbox Settings', 'upgfw'),
					'fields' => array(

					    array(
					        'type' => 'select',
					        'name' => 'lightbox_size',
					        'label' => __('Size', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '1',
					                'label' => __('Full - Without Overlay', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Large', 'upgfw'),
					            ),
					            array(
					                'value' => '3',
					                'label' => __('Medium', 'upgfw'),
					            ),
					            array(
					                'value' => '4',
					                'label' => __('Small', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '3',
					        ),
					    ),
					    array(
					        'type' => 'select',
					        'name' => 'lightbox_scrollbar_theme',
					        'label' => __('Scrollbar Theme', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '1',
					                'label' => __('Dark 1', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Dark 2 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '3',
					                'label' => __('Dark 3 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '4',
					                'label' => __('Dark 4 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '5',
					                'label' => __('Dark Thin - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '12',
					                'label' => __('Dark Thick - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '6',
					                'label' => __('Dark Inset 1 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '7',
					                'label' => __('Dark Inset 2 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '8',
					                'label' => __('Dark Inset 3 - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '9',
					                'label' => __('Dark Rounded - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '10',
					                'label' => __('Dark Rounded Dots - (work in PRO version)', 'upgfw'),
					            ),
					            array(
					                'value' => '11',
					                'label' => __('Dark Minimal Dark - (work in PRO version)', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '1',
					        ),
					    ),
						 array(
						     'type' => 'toggle',
						     'name' => 'lightbox_scrollbar_buttons',
						     'label' => __('Scroll Buttons', 'upgfw'),
						     'description' => __('Show buttons before and after scroll', 'upgfw'),
						     'default' => 0,
							'dependency' => array(
							    'field'    => 'lightbox_scrollbar_theme',
							    'function' => 'upgfw_vp_dep_scrollbar_theme_has_buttons',
							)
						 ),
						 array(
						     'type' => 'toggle',
						     'name' => 'lightbox_header',
						     'label' => __('Header', 'upgfw'),
						     'description' => __('Show lightbox header items', 'upgfw'),
						     'default' => 1,
						 ),

						 array(
						     'type' => 'toggle',
						     'name' => 'lightbox_product_name',
						     'label' => __('Product Name', 'upgfw'),
						     'description' => __('Show product name in lightbox header', 'upgfw'),
						     'default' => 1,
							'dependency' => array(
							    'field'    => 'lightbox_header',
							    'function' => 'vp_dep_boolean',
							)
						 ),

						 array(
						     'type' => 'toggle',
						     'name' => 'lightbox_add_to_cart',
						     'label' => __('Add To Cart', 'upgfw'),
						     'description' => __('Show add to cart button in lightbox header <br><b style="color: red;">work in PRO version</b>', 'upgfw'),
						     'default' => 0,
							'dependency' => array(
							    'field'    => 'lightbox_header',
							    'function' => 'vp_dep_boolean',
							)
						 ),


					    array(
					        'type' => 'select',
					        'name' => 'lightbox_zoom_mode',
					        'label' => __('Zoom Mode', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '0',
					                'label' => __('None', 'upgfw'),
					            ),
					            array(
					                'value' => '1',
					                'label' => __('Lens', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Fullscreen Zoom - (work in PRO version)', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '0',
					        ),
					        'description' => '',
					    ),
					    array(
					        'type' => 'select',
					        'name' => 'lightbox_zoom_lens_shape',
					        'label' => __('Lens Shape', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '1',
					                'label' => __('Square', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Round', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '1',
					        ),
							'dependency' => array(
							    'field'    => 'lightbox_zoom_mode',
							    'function' => 'upgfw_vp_dep_lightbox_zoom_mode_1',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'lightbox_zoom_lens_size',
					        'label' => __('Lens Size', 'upgfw'),
					        'description' => '',
					        'min' => '50',
					        'max' => '500',
					        'step' => '10',
					        'default' => '400',
					   
							'dependency' => array(
							    'field'    => 'lightbox_zoom_mode',
							    'function' => 'upgfw_vp_dep_lightbox_zoom_mode_1',
							)
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'lightbox_zoom_lens_border_size',
					        'label' => __('Lens Border Size', 'upgfw'),
					        'description' => '',
					        'min' => '0',
					        'max' => '10',
					        'step' => '1',
					        'default' => '5',
					   
							'dependency' => array(
							    'field'    => 'lightbox_zoom_mode',
							    'function' => 'upgfw_vp_dep_lightbox_zoom_mode_1',
							)
					    ),

					    array(
					        'type' => 'toggle',
					        'name' => 'lightbox_zoom_mousewheel',
					        'label' => __('Mousewheel Zoom', 'upgfw'),
					        'description' => __('<b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'default' => 0,
					        	
							'dependency' => array(
							    'field'    => 'lightbox_zoom_mode',
							    'function' => 'upgfw_vp_dep_lightbox_zoom_mode_1',
							)
					    ),
					    array(
					        'type' => 'select',
					        'name' => 'lightbox_thumbnails_position',
					        'label' => __('Thumbnails Position', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '1',
					                'label' => __('Left', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Right - (work in PRO version)', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '1',
					        ),
					    ),
					    array(
					        'type' => 'select',
					        'name' => 'lightbox_thumbnails_style',
					        'label' => __('Thumbnails Style', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '',
					                'label' => __('Without Style', 'upgfw'),
					            ),
					            array(
					                'value' => '1',
					                'label' => __('Style 1', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Style 2', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '2',
					        ),
					    ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Lightbox Colors', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_overlay_color',
					        'label' => __('Lightbox Overlay Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(0,0,0,0.3)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_header_bgcolor',
					        'label' => __('Lightbox Header Background Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(251,251,251,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_product_name_color',
					        'label' => __('Product Name Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(51,51,51,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_add_to_cart_bgcolor',
					        'label' => __('Add To Cart Button Background Color', 'upgfw'),
					        'description' => __('<b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'default' => 'rgba(105,105,105,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_add_to_cart_hover_bgcolor',
					        'label' => __('Add To Cart Button Background Hover Color <br><b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(255,255,255,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_add_to_cart_color',
					        'label' => __('Add To Cart Button Color <br><b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(255,255,255,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_add_to_cart_hover_color',
					        'label' => __('Add To Cart Button Hover Color <br><b style="color: red;">work in PRO version</b>', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(105,105,105,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_zoom_lens_border_color',
					        'label' => __('Lens Border Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(255,255,255,0.5)',
					        'format' => 'rgba',
					  
					    ),
					    array(
					        'type' => 'color',
					        'name' => 'lightbox_thumbnails_border_color',
					        'label' => __('Thumbnails Border Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(241,241,241,1)',
					        'format' => 'rgba',
					  
					    ),
					),
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_1',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:17px">The premium version of this plugin is available. <a target="_blank" href="http://www.barfaraz.com/plugin/ultimate-product-gallery-for-woocommerce/">Buy Now</a></p>', 'upgfw'),
					'status' => 'normal',
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_2',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:15px">For Plugin Support  <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-product-gallery-for-woocommerce">Click Here</a></p>', 'upgfw'),
					'status' => 'info',
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_3',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:15px">Please write a review on <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-product-gallery-for-woocommerce/reviews/#new-post">wordpress.org</a>  if you found this plugin helpful,Thanks.</p>', 'upgfw'),
					'status' => 'success',
				),
			),
		),
		array(
			'title' => __('Mobile & Tablet', 'upgfw'),
			'name' => 'upgfw_menu_2',
			'icon' => 'font-awesome:fa-mobile',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('General', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'toggle',
					        'name' => 'mb_active',
					        'label' => __('Active', 'upgfw'),
					        'description' => __('Enable mobile and tablet mode', 'upgfw'),
					        'default' => 1,
					    ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Product Page Colors', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'color',
					        'name' => 'mb_bullet_color',
					        'label' => __('Bullet Background', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(0,0,0,0.2)',
					        'format' => 'rgba',
					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_active_bullet_color',
					        'label' => __('Active Bullet Background', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(0,0,0,0.8)',
					        'format' => 'rgba',
					    ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Lightbox Settings', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'select',
					        'name' => 'mb_lightbox_size',
					        'label' => __('Size', 'upgfw'),
					        'items' => array(
					            array(
					                'value' => '1',
					                'label' => __('Full - Without Overlay', 'upgfw'),
					            ),
					            array(
					                'value' => '2',
					                'label' => __('Large', 'upgfw'),
					            ),
					        ),
					        'default' => array(
					            '2',
					        ),
					    ),
						 array(
						     'type' => 'toggle',
						     'name' => 'mb_lightbox_header',
						     'label' => __('Header', 'upgfw'),
						     'description' => __('Show lightbox header items', 'upgfw'),
						     'default' => 1,
						 ),
						 array(
						     'type' => 'toggle',
						     'name' => 'mb_lightbox_product_name',
						     'label' => __('Product Name', 'upgfw'),
						     'description' => __('Show product name in lightbox header', 'upgfw'),
						     'default' => 1,
							'dependency' => array(
							    'field'    => 'mb_lightbox_header',
							    'function' => 'vp_dep_boolean',
							)
						 ),

						 array(
						     'type' => 'toggle',
						     'name' => 'mb_lightbox_back_button',
						     'label' => __('Back Button', 'upgfw'),
						     'description' => __('Show back button in lightbox header', 'upgfw'),
						     'default' => 1,
							'dependency' => array(
							    'field'    => 'mb_lightbox_header',
							    'function' => 'vp_dep_boolean',
							)
						 ),
						 array(
						     'type' => 'textbox',
						     'name' => 'mb_lightbox_back_button_text',
						     'label' => __('Back Button Text', 'upgfw'),
						     'description' => '',
						     'default' => __( 'Back', 'upgfw' ),
							'dependency' => array(
							    'field'    => 'mb_lightbox_header',
							    'function' => 'vp_dep_boolean',
							)
						 ),
					    array(
					        'type' => 'slider',
					        'name' => 'mb_lightbox_thumbnails_number',
					        'label' => __('Thumbnails Number', 'upgfw'),
					        'description' => '',
					        'min' => '1',
					        'max' => '10',
					        'step' => '1',
					        'default' => '4',
					    ),
					    array(
					        'type' => 'slider',
					        'name' => 'mb_lightbox_thumbnails_space_between_items',
					        'label' => __('Space Between Thumbnail Items', 'upgfw'),
					        'description' => '',
					        'min' => '0',
					        'max' => '50',
					        'step' => '5',
					        'default' => '30',
					    ),
						 array(
						     'type' => 'toggle',
						     'name' => 'mb_lightbox_thumbnails_centered_slides',
						     'label' => __('Centered Slides', 'upgfw'),
						     'description' => __('Centered slides in lightbox header', 'upgfw'),
						     'default' => 1,
						 ),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Lightbox Colors', 'upgfw'),
					'fields' => array(
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_overlay_color',
					        'label' => __('Lightbox Overlay Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(0,0,0,0.3)',
					        'format' => 'rgba',
					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_header_bgcolor',
					        'label' => __('Lightbox Header Background Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(251,251,251,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_product_name_color',
					        'label' => __('Product Name Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(51,51,51,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_back_button_bgcolor',
					        'label' => __('Back Button Background Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(105,105,105,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_back_button_hover_bgcolor',
					        'label' => __('Back Button Background Hover Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(255,255,255,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_back_button_color',
					        'label' => __('Back Button Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(255,255,255,1)',
					        'format' => 'rgba',
					   

					    ),
					    array(
					        'type' => 'color',
					        'name' => 'mb_lightbox_back_button_hover_color',
					        'label' => __('Back Button Hover Color', 'upgfw'),
					        'description' => '',
					        'default' => 'rgba(105,105,105,1)',
					        'format' => 'rgba',
					   

					    ),
					),
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_1',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:17px">The premium version of this plugin is available. <a target="_blank" href="http://www.barfaraz.com/plugin/ultimate-product-gallery-for-woocommerce">Buy Now</a></p>', 'upgfw'),
					'status' => 'normal',
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_2',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:15px">For Plugin Support  <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-product-gallery-for-woocommerce">Click Here</a></p>', 'upgfw'),
					'status' => 'info',
				),
				array(
					'type' => 'notebox',
					'name' => 'upgfw_nb_3',
					'label' => __(' ', 'upgfw'),
					'description' => __('<p style="font-size:15px">Please write a review on <a target="_blank" href="https://wordpress.org/support/plugin/ultimate-product-gallery-for-woocommerce/reviews/#new-post">wordpress.org</a>  if you found this plugin helpful,Thanks.</p>', 'upgfw'),
					'status' => 'success',
				),
			),
		),
		array(
			'title' => __('Custom CSS', 'upgfw'),
			'name' => 'upgfw_menu_3',
			'icon' => 'font-awesome:fa-code',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => '',
					'fields' => array(
					    array(
					        'type' => 'codeeditor',
					        'name' => 'custom_css',
					        'label' => __('Custom CSS ', 'upgfw'),
					        'description' => '',
					        'theme' => 'github',
					        'mode' => 'css',
					    ),
					),
				),
			),
		)
	)
);

/**
 *EOF
 */