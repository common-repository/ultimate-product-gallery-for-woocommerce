(function ($) {
	"use strict";

	// on ready
	$(function() {
		resize();
		
		var swiper = new Swiper(".upgfw-image-gallery .swiper-container", {
			pagination: {
				el: ".upgfw-image-gallery .swiper-pagination",
				dynamicBullets: true,
			},
		});

		Array.from(document.querySelectorAll(".upgfw-lightbox-content img")).forEach(function (el) {
			new PinchZoom.default(el, {});
		});
	});
	
	// on resize
	$(window).on("resize", resize);

	// scripts
	$(document).on("keydown", function (event) {
		if(event.keyCode == 27) {
			lightbox_close();
		}
	});

	$(document).on("click", ".upgfw-image-gallery a", function (e) {
		e.preventDefault();
		scroll_enable();

		var $index = $(this).data("upgfw-index");
		var $type = $(this).data("upgfw-type");

		lightbox_open();
		lightbox_open_item($index, $type);
	});

	$(document).on("click", ".upgfw-lightbox-thumbnails .swiper-slide", function (e) {
		e.preventDefault();
		var $index = $(this).attr("data-upgfw-index");
		var $type = $(this).attr("data-upgfw-type");

		lightbox_open_item($index, $type);
	});

	$(document).on("click", ".upgfw-lightbox", function (e) {
		if (!$(event.target).closest(".upgfw-lightbox-wrapper").length) {
			lightbox_close();
		}
	});

	$(document).on("click", ".upgfw-lightbox-close, .upgfw-back-button", function (e) {
		lightbox_close();
	});

	function lightbox_open() {
		$(".upgfw-lightbox-container").show();
		$(".upgfw-lightbox-container").removeClass("close");
		$(".upgfw-lightbox-container").addClass("open");

		var swiper = new Swiper(".upgfw-lightbox-thumbnails .swiper-container", {
			slidesPerView: parseInt(upgfw_script_vars.mb_lightbox_thumbnails_number),
			spaceBetween: parseInt(upgfw_script_vars.mb_lightbox_thumbnails_space_between_items),
			centeredSlides: parseInt(upgfw_script_vars.mb_lightbox_thumbnails_centered_slides),
		});
	}

	function lightbox_close() {
		$(".upgfw-lightbox-container").removeClass("open");
		$(".upgfw-lightbox-container").addClass("close");

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

		$(".upgfw-lightbox-thumbnails .swiper-slide").removeClass("swiper-slide-active");
		$(".upgfw-lightbox-thumbnails").find("[data-upgfw-index=" + $index + "]").addClass("swiper-slide-active");
		$(".upgfw-lightbox-content li").removeClass("active");
		$(".upgfw-lightbox-content").find("[data-upgfw-index=" + $index + "]").addClass("active");

		if ($type == "image") {
			$("#upgfw-lightbox-image-" + $index).fadeOut(100, function () {
				$("#upgfw-lightbox-image-" + $index).attr("src", $(this).attr("data-upgfw-src")).one("load", function () {
					$("#upgfw-loading-wrapper-" + $index).fadeOut(100);
					$("#upgfw-lightbox-image-" + $index).fadeIn(100);
				});
			});
		} else {
			$("#upgfw-lightbox-video-" + $index).fadeOut(100, function () {
				$("#upgfw-lightbox-video-" + $index).attr("src", $(this).attr("data-upgfw-src")).one("load", function () {
					$("#upgfw-loading-wrapper-" + $index).fadeOut(100);
					$("#upgfw-lightbox-video-" + $index).fadeIn(100);
				});
			});
		}
	}

	function resize() {
		var width_offset, height_offset, top, left;
		switch (parseInt(upgfw_script_vars.mb_lightbox_size)) {
			case 1:
				width_offset = 0;
				height_offset = 0;
				top = 0;
				left = 0;
				break;
			case 2:
				width_offset = 10;
				height_offset = 10;
				top = 5;
				left = 5;
				break;
			default:
				width_offset = 10;
				height_offset = 10;
				top = 5;
				left = 5;
		}

		$(".upgfw-lightbox-wrapper").css({
			width: $(window).width() - width_offset,
			height: $(window).height() - height_offset,
			top: top,
			left: left,
		});
	}
}(jQuery));