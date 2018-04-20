var $ = jQuery;
$(document).ready(function () {
	$hpRatio = 1;
	windowResize();
	$(window).resize(function () {
		windowResize();
	});
	$t = "";

	$("header nav.jumpnav a").click(function (e) {
		e.preventDefault();
		h = $(this).attr("href");
		o = $(h).offset().top - $("header").height() - 32;
		$('html, body').animate({
			scrollTop: o
		}, 750);
	});

	/*** NEWS AJAX ***/
	if ($("#newsfeed").length) {
		newsAjax();
		backButton('news');
	} /*** END NEWS AJAX ***/

	/*** PORTFOLIO AJAX ***/
	if ($("nav.filter").length) {
		filterAjax();
		backButton('filter');
	}

	$(".slideshowControls p").hide();
	if ($(".slideshow").length) {
		firstPhoto = $(".slideshow .slide:eq(0) img");
		firstPhoto.load(function () {
			$(".slideshow .slide:eq(0)").addClass("active");
			$hpWidth = $(".slideshow .slide img").width();
			$hpHeight = $(".slideshow .slide img").height();
			$hpRatio = $hpWidth / $hpHeight;
		});

		$(".slideshowControls button").click(function (e) {
			e.preventDefault();
			c = $(this).hasClass("pause") ? true : false;
			if (c) {
				$(this).removeClass("pause");
				$(this).addClass("play");
				clearTimeout($t);
			} else {
				$(this).removeClass("play");
				$(this).addClass("pause");
				$t = setTimeout(function () {
					slideshow_next();
				}, $homepage_slideshow_timing);
			}
		});

	}
});

$(window).load(function () {
	slideshow_init();
});

function windowResize() {

	$w = $(window).width();
	$h = $(window).height();

	if ($(".fssh").length) {

		slideshowHeight = $h - $("header").height() - $("footer").height() - parseInt($("header h1").css("margin-top"));
		$(".fssh,.fssh .slide").height(slideshowHeight);

	}

}

function slideshow_init() {
	if ($(".slideshow").length) {

		clearTimeout($t);
		$hpWidth = $(".slideshow .slide img").width();
		$hpHeight = $(".slideshow .slide img").height();
		$hpRatio = $hpWidth / $hpHeight;
		slideshow_start();
	}
	windowResize();
}

function slideshow_start() {

	$currentslide = 0;
	$homepage_slideshow_timing = parseInt($(".slideshow input[name='slideshow_timing']").val()) + 500;
	slideshow_next();

	$(".slideshowControls li").click(function (e) {
		e.preventDefault();
		clearTimeout($t);
		c = $(this).attr("class");
		if (c == 'prev') {
			$currentslide -= 2;
			if ($currentslide < 0) {
				$currentslide = $(".slideshow .slide").length - 1;
			}
		}
		slideshow_next();
	});

}

function slideshow_next() {
	$(".slideshow .slide").removeClass("active");
	$(".slideshow .slide:eq(" + $currentslide + ")").addClass("active");

	$currentslide++;
	if ($currentslide > $(".slideshow .slide").length - 1) {
		$currentslide = 0;
		$(".slideshowControls p").fadeIn(1000);
	}
	$t = setTimeout(function () {
		slideshow_next();
	}, $homepage_slideshow_timing);
}

function newsAjax() {

	$("#newsfeed .posts a").click(function (e) {

		$('html,body').animate({
			scrollTop: 0
		}, 500);

		e.preventDefault();
		h = $(this).attr("href");
		$("#singlePost").fadeOut(500, function () {
			$(this).load(h + " #singlePost .post", function () {

				if (h != window.location) {
					window.history.pushState({
						path: h
					}, '', h);
				}
				$(this).fadeIn(500);

			});
		});

	});

	$("#newsfeed .pages a, #newsFilters a").click(function (e) {
		e.preventDefault();
		h = $(this).attr("href");

		n = $("#news").height();
		$("#news").css({
			"min-height": n
		});

		$("#newsfeed").fadeOut(250, function () {
			$(this).load(h + " #newsfeed", function () {
				$(this).fadeIn(250);
				newsAjax();
			});
		});
	});

}

function backButton(loc) {
	$(window).bind('popstate', function () {
		h = location.pathname;

		if (loc == 'news') {
			$("#singlePost").fadeOut(500, function () {
				$(this).load(h + " #singlePost", function () {
					$(this).fadeIn(500);
				});
			});
		} else if (loc == 'filter') {
			$("main > section").fadeOut(500, function () {

				$("main").load(h + " main > section", function () {
					$("main > section").hide().fadeIn(500);
					newheight = $("main > section").height() + parseInt($("main > section").css('padding-top')) + parseInt($("main > section").css('padding-bottom'));
					$("main").height(newheight);
				});

			});
		}


	});
}

function filterAjax() {
	$("nav.filter a").click(function (e) {

		if ($(this).attr("target") != "_blank") {
			e.preventDefault();
			h = $(this).attr("href");

			$("main").height($("main").height());
			$("main > section").fadeOut(500, function () {

				$("main").load(h + " main > section", function () {
					if (h != window.location) {
						window.history.pushState({
							path: h
						}, '', h);
					}
					$("main > section").hide().fadeIn(500,function() {
						$("main").css({ "height" : "auto" });
						slideshow_init();
					});
					
					//newheight = $("main > section").height() + parseInt($("main > section").css('padding-top')) + parseInt($("main > section").css('padding-bottom'));
					//$("main").height(newheight);
				});
			});
		}
	});

}
