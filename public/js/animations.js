// Simple, beginner-style animations for the library page
// Uses jQuery (already loaded in template)

$(function () {
  // Typewriter effect for the main title
  var $title = $(".title-size");
  var fullText = $title.text();
  $title.text("");
  var i = 0;
  var typeTimer = setInterval(function () {
    $title.text($title.text() + (fullText.charAt(i) || ""));
    i++;
    if (i >= fullText.length) {
      clearInterval(typeTimer);
    }
  }, 60);

  // Glow effect on search bar to draw attention
  var glowOn = false;
  setInterval(function () {
    glowOn = !glowOn;
    $("#search-bar-library").css(
      "box-shadow",
      glowOn ? "0 0 16px #f65c4eff, inset 0 0 6px #ee6255ff" : "none"
    );
  }, 700);

  // Fade-in the library grid items one by one
  var $grid = $("#girdlibrary"); // id from template
  var $items = $grid.children();
  $items.css({ opacity: 0, transform: "translateY(20px)", transition: "all 0.5s" });
  $items.each(function (index) {
    var $el = $(this);
    setTimeout(function () {
      $el.css({ opacity: 1, transform: "translateY(0)" });
    }, 150 * index);
  });

  // Gentle pulse on the Admin button so it's obvious in demos
  var $adminBtn = $(".add-button-admin");
  setInterval(function () {
    $adminBtn.css("transform", "scale(1.05)");
    setTimeout(function () {
      $adminBtn.css("transform", "scale(1)");
    }, 200);
  }, 1800);

  // Tiny tilt on game images when scrolling (eye-catching yet simple)
  $(window).on("scroll", function () {
    var s = $(this).scrollTop();
    var deg = ((s % 80) / 80) * 4 - 2; // -2deg..2deg
    $("#girdlibrary img").css("transform", "rotate(" + deg + "deg)");
  });

  // Simple click animations for Add/Remove buttons
  function bounce($el) {
    $el.css({ transition: "transform 150ms", transform: "scale(1.08)" });
    setTimeout(function () { $el.css({ transform: "scale(1)" }); }, 150);
  }

  function burst($el, color) {
    var pos = $el.offset();
    var x = pos.left + $el.outerWidth() / 2;
    var y = pos.top + $el.outerHeight() / 2;

    var $dot = $("<div></div>").css({
      position: "absolute",
      left: (x - 4) + "px",
      top: (y - 4) + "px",
      width: "8px",
      height: "8px",
      "border-radius": "50%",
      background: color,
      opacity: 0.9,
      transform: "scale(1)",
      transition: "all 400ms ease-out",
      "z-index": 9999
    });

    $("body").append($dot);
    setTimeout(function () { $dot.css({ opacity: 0, transform: "scale(6)" }); }, 10);
    setTimeout(function () { $dot.remove(); }, 420);
  }

  $(document).on("click", ".add-to-library-btn", function () {
    var $btn = $(this);
    bounce($btn);
    burst($btn, "#22c55e"); // green
  });

  $(document).on("click", ".remove-from-library-btn", function () {
    var $btn = $(this);
    bounce($btn);
    burst($btn, "#ef4444"); // red
  });
  
  // --- Collection View Effects ---
  // Glow for collection search bar
  var glowOn2 = false;
  setInterval(function () {
    glowOn2 = !glowOn2;
    $("#search-bar").css(
      "box-shadow",
      glowOn2 ? "0 0 14px #f75f4eff, inset 0 0 5px #f46c51ff" : "none"
    );
  }, 900);

  // Fade-in the collection cards one by one
  var $collection = $("#gamesCollection .game");
  $collection.css({ opacity: 0, transform: "translateY(16px)", transition: "all 0.4s" });
  $collection.each(function (index) {
    var $el = $(this);
    setTimeout(function () {
      $el.css({ opacity: 1, transform: "translateY(0)" });
    }, 120 * index);
  });

  // Simple hover pop for cards
  $(document).on("mouseenter", "#gamesCollection .game", function () {
    $(this).css({ transform: "scale(1.02)", transition: "transform 120ms" });
  });
  $(document).on("mouseleave", "#gamesCollection .game", function () {
    $(this).css({ transform: "scale(1)" });
  });
});
