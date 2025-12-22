
//Typing animation
$(function () {
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

//Glowing search bar in library
  var glowOn = false;
  setInterval(function () {
    glowOn = !glowOn;
    $("#search-bar-library").css(
      "box-shadow",
      glowOn ? "0 0 16px #ec968eff, inset 0 0 6px #f5a39bff" : "none"
    );
  }, 700);

  // Library games fade in
  var $grid = $("#girdlibrary"); 
  var $items = $grid.children();
  $items.css({ opacity: 0, transform: "translateY(16px)", transition: "all 0.4s" });
  $items.each(function (index) {
    var $el = $(this);
    setTimeout(function () {
      $el.css({ opacity: 1, transform: "translateY(0)" });
    }, 120 * index);
  });

  // Hover scale for grid items 
  $(document).on("mouseenter", "#girdlibrary > *", function () {
    $(this).css({ transform: "scale(1.10)", transition: "transform 120ms" });
  });
  $(document).on("mouseleave", "#girdlibrary > *", function () {
    $(this).css({ transform: "scale(1)" });
  });

  // Pulse on admin button
  var $adminBtn = $(".add-button-admin");
  setInterval(function () {
    $adminBtn.css("transform", "scale(1.05)");
    setTimeout(function () {
      $adminBtn.css("transform", "scale(1)");
    }, 200);
  }, 1800);

  // Simple click animations for add and remove buttons
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
    burst($btn, "#22c55e");
  });

  $(document).on("click", ".remove-from-library-btn", function () {
    var $btn = $(this);
    bounce($btn);
    burst($btn, "#ef4444"); 
  });
  

  // Game cards fade in
  var $collection = $("#gamesCollection .game");
  $collection.css({ opacity: 0, transform: "translateY(16px)", transition: "all 0.4s" });
  $collection.each(function (index) {
    var $el = $(this);
    setTimeout(function () {
      $el.css({ opacity: 1, transform: "translateY(0)" });
    }, 120 * index);
  });

  $(document).on("mouseenter", "#gamesCollection .game", function () {
    $(this).css({ transform: "scale(1.02)", transition: "transform 120ms" });
  });
  $(document).on("mouseleave", "#gamesCollection .game", function () {
    $(this).css({ transform: "scale(1)" });
  });
});
