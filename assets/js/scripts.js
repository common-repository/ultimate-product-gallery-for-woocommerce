(function ($) {
	"use strict";

	// on ready
	$(function() {
		resize();

		product_image_zoom_init();

		lightbox_scrollbar_set();
	});

	// on resize
	$(window).on("resize", resize);
	$(window).on("resize", lightbox_img_resize);

	// scripts
	$(document).on("keydown", function (event) {
		if(event.keyCode == 27) {
			if($(".panWrapper").length) {
				if($(".panWrapper").is(":hidden")) {
					lightbox_close();
				}
			} else {
				lightbox_close();
			}
		}
	});

	$(document).on("click", ".upgfw-image-gallery ul li a", function (e) {
		e.preventDefault();
		scroll_enable();

		var $index = $(this).data("upgfw-index");
		var $type = $(this).data("upgfw-type");

		lightbox_open();

		lightbox_open_item($index, $type);
	});

	$(document).on("click", ".upgfw-lightbox-thumbnails li", function (e) {
		e.preventDefault();
		var $index = $(this).attr("data-upgfw-index");
		var $type = $(this).attr("data-upgfw-type");

		lightbox_open_item($index, $type);
	});

	$(document).on("click", ".upgfw-lightbox", function (e) {
		if (!$(event.target).closest(".upgfw-lightbox-wrapper").length && !$(event.target).closest(".zoomContainer").length) {
			lightbox_close();
		}
	});

	$(document).on("click", ".upgfw-lightbox-close", function (e) {
		lightbox_close();
	});

	function lightbox_open() {
		$(".upgfw-lightbox-container").show();
		$(".upgfw-lightbox-container").removeClass("close");
		$(".upgfw-lightbox-container").addClass("open");

		resize();
		lightbox_img_resize();
	}

	function lightbox_close() {
		$(".upgfw-lightbox-container").removeClass("open");
		$(".upgfw-lightbox-container").addClass("close");

		product_image_zoom_init();
		lightbox_videos_stop();

		$(".upgfw-lightbox-container").hide(500);
		scroll_disable();
	}

	function scroll_enable() {
		$("html").css({
			overflow: "hidden",
			height: "100%"
		});
	}

	function scroll_disable() {
		$("html").css({
			overflow: "auto",
			height: "auto"
		});
	}

	function lightbox_videos_stop() {
		$(".upgfw-lightbox-container iframe").each(function () {
			var VideoURL = $(this).attr("src");
			$(this).attr("src", "");
			$(this).attr("src", VideoURL);
		});
	}

	function lightbox_open_item($index, $type) {
		lightbox_videos_stop();
		$(".upgfw-lightbox-thumbnails").mCustomScrollbar("scrollTo", $(".upgfw-lightbox-thumbnails").find("[data-upgfw-index=" + $index + "]"));
		$(".upgfw-lightbox-thumbnails li").removeClass("active");
		$(".upgfw-lightbox-thumbnails").find("[data-upgfw-index=" + $index + "]").addClass("active");
		$(".upgfw-lightbox-content li").removeClass("active");
		$(".upgfw-lightbox-content").find("[data-upgfw-index=" + $index + "]").addClass("active");
		if ($type == "image") {
			$("#upgfw-lightbox-image-" + $index).fadeOut(100, function () {
				$("#upgfw-lightbox-image-" + $index).attr("src", $(this).attr("data-upgfw-src")).one("load", function () {
					var lensShape;
					switch (parseInt(upgfw_script_vars.lightbox_zoom_lens_shape)) {
						case 1:
							lensShape = "square";
							break;
						case 2:
							lensShape = "round";
							break;
						default:
							lensShape = "square";
					}

					$("#upgfw-loading-wrapper-" + $index).fadeOut(100);
					$("#upgfw-lightbox-image-" + $index).fadeIn(100);
					if (parseInt(upgfw_script_vars.lightbox_zoom_mode) == 1) {
						$("#upgfw-lightbox-image-" + $index).elevateZoom({
							zoomType: "lens",
							lensShape: lensShape,
							lensSize: upgfw_script_vars.lightbox_zoom_lens_size,
							borderSize: upgfw_script_vars.lightbox_zoom_lens_border_size,
							borderColour: upgfw_script_vars.lightbox_zoom_lens_border_color,
							custom_class: 'zoomContainerLightbox'
						});
					}
				});
			});
		} else if ($type == "video") {
			$("#upgfw-lightbox-video-" + $index).fadeOut(100, function () {
				$("#upgfw-lightbox-video-" + $index).attr("src", $(this).attr("data-upgfw-src")).one("load", function () {
					$("#upgfw-loading-wrapper-" + $index).fadeOut(100);
					$("#upgfw-lightbox-video-" + $index).fadeIn(100);
				});
			});
		}
	}

	function product_image_zoom_init() {
		if (parseInt(upgfw_script_vars.image_zoom) == 1) {
			$(".upgfw-product-image img.upgfw-thumbnail-image").elevateZoom({
				zoomWindowWidth: upgfw_script_vars.zoom_window_width,
				zoomWindowHeight: upgfw_script_vars.zoom_window_height,
				zoomWindowFadeIn: 200,
				zoomWindowFadeOut: 200,
				lensFadeIn: 200,
				lensFadeOut: 200,
				zoomWindowPosition: parseInt(upgfw_script_vars.zoom_window_position),
				borderSize: upgfw_script_vars.zoom_window_border_size,
				borderColour: upgfw_script_vars.zoom_window_border_color,
			});
		}
	}

	function resize() {
		var width_offset, height_offset, top, left;
		switch (parseInt(upgfw_script_vars.lightbox_size)) {
			case 1:
				width_offset = 0;
				height_offset = 0;
				top = 0;
				left = 0;
				break;
			case 2:
				width_offset = 20;
				height_offset = 20;
				top = 10;
				left = 10;
				break;
			case 3:
				width_offset = 200;
				height_offset = 30;
				top = 15;
				left = 100;
				break;
			case 4:
				width_offset = 400;
				height_offset = 100;
				top = 50;
				left = 200;
				break;
			default:
				width_offset = 200;
				height_offset = 30;
				top = 15;
				left = 100;
		}

		$(".upgfw-lightbox-wrapper").css({
			width: $(window).width() - width_offset,
			height: $(window).height() - height_offset,
			top: top,
			left: left,
		});
	};

	function lightbox_img_resize() {
		var $lightbox_content_width = $(".upgfw-lightbox-content").width();

		$(".upgfw-lightbox-container .upgfw-centered-flex").each(function (i, obj) {
			$(this).width($lightbox_content_width);
		});
	};

	function lightbox_scrollbar_set() {
		$(".upgfw-lightbox-thumbnails").mCustomScrollbar({
			theme: "dark",
			scrollButtons: {
				enable: (parseInt(upgfw_script_vars.lightbox_scrollbar_buttons) ? true : false)
			},
		});
	};
}(jQuery));