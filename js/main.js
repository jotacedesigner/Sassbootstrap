/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */
// You might need this, usually it's autoloaded
jQuery.noConflict();
jQuery(document).ready(function ($) {
  "use strict";
  // Back to top button
  jQuery(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      jQuery(".back-to-top").fadeIn("slow");
    } else {
      jQuery(".back-to-top").fadeOut("slow");
    }
  });
  jQuery(".back-to-top").click(function () {
    jQuery("html, body").animate(
      {
        scrollTop: 0,
      },
      1500,
      "easeInOutExpo"
    );
    return false;
  });
  var siteMenuClone = function () {
    jQuery(".js-clone-nav").each(function () {
      var $this = $(this);
      $this
        .clone()
        .attr("class", "site-nav-wrap")
        .appendTo(".site-mobile-menu-body");
    });
    setTimeout(function () {
      var counter = 0;
      jQuery(".site-mobile-menu .has-children").each(function () {
        var $this = $(this);
        $this.prepend('<span class="arrow-collapse collapsed">');
        $this.find(".arrow-collapse").attr({
          "data-toggle": "collapse",
          "data-target": "#collapseItem" + counter,
        });
        $this.find("> ul").attr({
          class: "collapse",
          id: "collapseItem" + counter,
        });
        counter++;
      });
    }, 1000);
    jQuery("body").on("click", ".arrow-collapse", function (e) {
      var $this = $(this);
      if ($this.closest("li").find(".collapse").hasClass("show")) {
        $this.removeClass("active");
      } else {
        $this.addClass("active");
      }
      e.preventDefault();
    });
    jQuery(window).resize(function () {
      var $this = $(this),
        w = $this.width();
      if (w > 768) {
        if ($("body").hasClass("offcanvas-menu")) {
          $("body").removeClass("offcanvas-menu");
        }
      }
    });
    jQuery("body").on("click", ".js-menu-toggle", function (e) {
      var $this = $(this);
      e.preventDefault();
      if ($("body").hasClass("offcanvas-menu")) {
        $("body").removeClass("offcanvas-menu");
        $("body").find(".js-menu-toggle").removeClass("active");
      } else {
        $("body").addClass("offcanvas-menu");
        $("body").find(".js-menu-toggle").addClass("active");
      }
    });
    // click outisde offcanvas
    jQuery(document).mouseup(function (e) {
      var container = $(".site-mobile-menu");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($("body").hasClass("offcanvas-menu")) {
          $("body").removeClass("offcanvas-menu");
          $("body").find(".js-menu-toggle").removeClass("active");
        }
      }
    });
  };
  siteMenuClone();
  var siteScroll = function () {
    jQuery(window).scroll(function () {
      var st = $(this).scrollTop();
      if (st > 100) {
        $(".js-sticky-header").addClass("shrink");
      } else {
        $(".js-sticky-header").removeClass("shrink");
      }
    });
  };
  siteScroll();
  var siteSticky = function () {
    jQuery(".js-sticky-header").sticky({
      topSpacing: 0,
    });
  };
  siteSticky();
});
// $j optional alias to jQuery noConflict()
var $j = jQuery.noConflict();

$j(document).ready(function () {
  $j('[data-toggle="popover"]').popover();
});

AOS.init({
  easing: "ease",
  duration: 1000,
  once: true,
});
jQuery(document).ready(function () {
  (function ($) {
    jQuery(".testimonial-carousel").owlCarousel({
      center: true,
      items: 1,
      loop: true,
      margin: 0,
      autoplay: true,
      smartSpeed: 1000,
    });
  })(jQuery);
});
