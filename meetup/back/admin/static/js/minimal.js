var widthLess1024 = function () {
    if ($(window).width() < 1024) {
        $("#sidebar, #navbar").addClass("collapsed");
        $("#navigation").find(".dropdown.open").removeClass("open");
        $("#navigation").find(".dropdown-menu.animated").removeClass("animated");
        if ($("#sidebar").hasClass("collapsed")) {
            $("#content").animate({
                left: "0px",
                paddingLeft: "55px"
            }, 150)
        } else {
            $("#content").animate({
                paddingLeft: "55px"
            }, 150)
        }
    } else {
        $("#sidebar, #navbar").removeClass("collapsed");
        if ($("#sidebar").hasClass("collapsed")) {
            $("#content").animate({
                left: "210px",
                paddingLeft: "265px"
            }, 150)
        } else {
            $("#content").animate({
                paddingLeft: "265px"
            }, 150)
        }
    }
};
var widthLess768 = function () {
    if ($(window).width() < 768) {
        if ($(".collapsed-content .search").length === 1) {
            $("#main-search").appendTo(".collapsed-content .search")
        }
        if ($(".collapsed-content li.user").length === 0) {
            $(".collapsed-content li.search").after($("#current-user"))
        }
    } else {
        $("#current-user").show();
        if ($(".collapsed-content .search").length === 2) {
            $(".nav.refresh").after($("#main-search"))
        }
        if ($(".collapsed-content li.user").length === 1) {
            $(".quick-actions >li:last-child").before($("#current-user"))
        }
    }
};
$(function () {
    // $("#mmenu").mmenu({
    // 	position: "right",
    // 	zposition: "next",
    // 	moveBackground: false
    // });
    $(".quick-actions .dropdown").on("show.bs.dropdown", function (d) {
        $(this).find(".dropdown-menu").addClass("animated fadeInDown");
        $(this).find("#user-inbox").addClass("animated bounceIn")
    });
    $("#navigation .dropdown").on("show.bs.dropdown", function (d) {
        $(this).find(".dropdown-menu").addClass("animated fadeInLeft")
    });
    // $("#sales-chart").sparkline([5, 6, 7, 2, 1, 4, 6, 8, 10, 14], {
    // 	width: "60px",
    // 	type: "bar",
    // 	height: "40px",
    // 	barWidth: "6px",
    // 	barSpacing: 1,
    // 	barColor: "#d9544f"
    // });
    // $("#balance-chart").sparkline([5, 6, 7, 2, 1, 4, 6, 8, 10, 14], {
    // 	width: "60px",
    // 	type: "bar",
    // 	height: "40px",
    // 	barWidth: "6px",
    // 	barSpacing: 1,
    // 	barColor: "#418bca"
    // });
    $("#sidebar .sidebar-toggle").on("click", function () {
        var d = $(this).data("toggle");
        $(d).toggleClass("collapsed")
    });
  // $("#sidebar").niceScroll({
  //     cursorcolor: "#000000",
  //     zindex: 999999,
  //     bouncescroll: true,
  //     cursoropacitymax: 0.4,
  //     cursorborder: "",
  //     cursorborderradius: 0,
  //     cursorwidth: "7px",
  //     railalign: "left",
  //     railoffset: {
  //         top: 45,
  //         left: 0
  //     }
  // });
  // $("#content").niceScroll({
  //     cursorcolor: "#000000",
  //     zindex: 999999,
  //     bouncescroll: true,
  //     cursoropacitymax: 0.4,
  //     cursorborder: "",
  //     cursorborderradius: 7,
  //     cursorwidth: "7px",
  //     background: "rgba(0,0,0,.1)",
  //     autohidemode: false,
  //     railpadding: {
  //         top: 0,
  //         right: 2,
  //         left: 2,
  //         bottom: 0
  //     }
  // });
  // $("#mmenu").on("opened.mm", function () {
  //     $("#content").getNiceScroll().hide()
  // });
  // $("#mmenu").on("closed.mm", function () {
  //     $("#content").getNiceScroll().show()
  // });
    $("#navigation .dropdown.open").data("closable", false);
    $("#navigation .dropdown").on({
        "shown.bs.dropdown": function () {
            $(this).data("closable", false);
          // $("#sidebar").getNiceScroll().resize()
          $("#sidebar").resize()
        },
        click: function (d) {
            $(this).data("closable", true);
            if (!$(this).hasClass("open")) {
                $("li.dropdown.open").removeClass("open")
            }
            if ($("#sidebar").hasClass("collapsed")) {
                d.stopPropagation()
            }
          // $("#sidebar").getNiceScroll().resize()
          $("#sidebar").resize()
        },
        "hide.bs.dropdown": function () {
            return $(this).data("closable");
          // $("#sidebar").getNiceScroll().resize()
          $("#sidebar").resize()
        }
    });
    $(".sidebar-collapse a").on("click", function () {
        $("#sidebar, #navbar").toggleClass("collapsed");
        $("#navigation").find(".dropdown.open").removeClass("open");
        $("#navigation").find(".dropdown-menu.animated").removeClass("animated");
        $("#sidebar > li.collapsed").removeClass("collapsed");
        if ($("#sidebar").hasClass("collapsed")) {
            if ($(window).width() < 1024) {
                $("#content").animate({
                    left: "0px"
                }, 150)
            } else {
                $("#content").animate({
                    paddingLeft: "55px"
                }, 150)
            }
        } else {
            if ($(window).width() < 1024) {
                $("#content").animate({
                    left: "210px"
                }, 150)
            } else {
                $("#content").animate({
                    paddingLeft: "265px"
                }, 150)
            }
        }
    });
    $("#navigation .menu > li").hover(function () {
        $(this).addClass("hovered");
        $("#sidebar").addClass("open")
    }, function () {
        $(this).removeClass("hovered");
        $("#sidebar").removeClass("open")
    });
    widthLess1024();
    widthLess768();
    $(window).resize(function () {
        widthLess1024();
        widthLess768()
    });
    $(".animate-number").each(function () {
        var d = $(this).data("value");
        var e = $(this).data("animation-duration");
        $(this).animateNumbers(d, true, e, "linear")
    });
    $(".animate-progress-bar").each(function () {
        var d = $(this).data("percentage");
        $(this).css("width", d)
    });
    $("#color-schemes li a").click(function () {
        var d = $(this).attr("class");
        var e = $("body").attr("class").split(" ").pop();
        $("body").removeClass(e).addClass(d)
    });
    var a = function () {
        $("body .videocontent").prepend('<div class="video-background"></div>');
        $(".video-background").videobackground({
            videoSource: [
                ["http://tattek.com/minimal/assets/videos/videobg.mp4", "video/mp4"],
                ["http://tattek.com/minimal/assets/videos/videobg.webm", "video/webm"],
                ["http://tattek.com/minimal/assets/videos/videobg.ogv", "video/ogg"]
            ],
            controlPosition: "#video",
            poster: "assets/images/video.jpg",
            loop: true,
            controlText: "",
            resizeTo: "window",
            loadedCallback: function () {
                $(this).videobackground("mute")
            }
        })
    };
    if ($("#videobg-check").is(":checked")) {
        a()
    }
    $("#videobg-check").change(function () {
        if ($(this).is(":checked")) {
            a()
        } else {
            $("#video").html("")
        }
    });
    $(".page-refresh").click(function () {
        location.reload()
    });

    function b(d) {
        $(d).block({
            message: '<div class="el-reloader"></div>',
            overlayCSS: {
                opacity: 0.6,
                cursor: "wait",
                backgroundColor: "#000000"
            },
            css: {
                padding: "5px",
                border: "0",
                backgroundColor: "transparent"
            }
        })
    }

    function c(d) {
        $(d).unblock()
    }

    $(".tile-header .controls .refresh").click(function () {
        var d = $(this).parent().parent().parent();
        b(d);
        window.setTimeout(function () {
            c(d)
        }, 1000);
        return false
    });
    $(".tile-header .controls .remove").click(function () {
        $(this).parent().parent().parent().addClass("animated fadeOut");
        $(this).parent().parent().parent().attr("id", "el_remove");
        setTimeout(function () {
            $("#el_remove").remove()
        }, 500);
        return false
    })
});

$(window).on('load', function () {
    $("#loader").delay(500).fadeOut(300);
    $(".mask").delay(800).fadeOut(300, function () {
        widthLess1024();
        widthLess768()
    })
});
