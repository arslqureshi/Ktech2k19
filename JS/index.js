new fullpage("#fullpage", {
  navigation: true,
  scrollOverflow: true,
  navigationPosition: "right",
  anchors: [
    "Home",
    "About_Ktech",
    "About_Team",
    "Events",
    "Gallery",
    "Contact"
  ],
  navigationTooltips: [
    "home",
    "about_ktech",
    "about_team",
    "events",
    "gallery",
    "contact"
  ],
  //sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C','red','black','blue'],
  loopBottom: true,
  scrollingSpeed: 900,
  menu: "#menu",
  onLeave: function(origin, destination, index) {
    if (destination["anchor"] == "Home") {
      scrollOverflow: true;
      $("#Home_left").addClass("activate");
      $("#About_Ktech_left").removeClass("activate");
      $("#About_team_left").removeClass("activate");
      $("#Events_left").removeClass("activate");
      $("#Gallery_left").removeClass("activate");
      $("#Contact_left").removeClass("activate");
    } else if (destination["anchor"] == "About_Ktech") {
      scrollOverflow: true;
      $("#Home_left").removeClass("activate");
      $("#About_Ktech_left").addClass("activate");
      $("#About_team_left").removeClass("activate");
      $("#Events_left").removeClass("activate");
      $("#Gallery_left").removeClass("activate");
      $("#Contact_left").removeClass("activate");
    } else if (destination["anchor"] == "About_Team") {
      scrollOverflow: true;
      $("#Home_left").removeClass("activate");
      $("#About_Ktech_left").removeClass("activate");
      $("#About_team_left").addClass("activate");
      $("#Events_left").removeClass("activate");
      $("#Gallery_left").removeClass("activate");
      $("#Contact_left").removeClass("activate");
    } else if (destination["anchor"] == "Events") {
      scrollOverflow: true;
      $("#Home_left").removeClass("activate");
      $("#About_Ktech_left").removeClass("activate");
      $("#About_team_left").removeClass("activate");
      $("#Events_left").addClass("activate");
      $("#Gallery_left").removeClass("activate");
      $("#Contact_left").removeClass("activate");
    } else if (destination["anchor"] == "Gallery") {
      scrollOverflow: true;
      $("#Home_left").removeClass("activate");
      $("#About_Ktech_left").removeClass("activate");
      $("#About_team_left").removeClass("activate");
      $("#Events_left").removeClass("activate");
      $("#Gallery_left").addClass("activate");
      $("#Contact_left").removeClass("activate");
    } else if (destination["anchor"] == "Contact") {
      scrollOverflow: true;
      $("#Home_left").removeClass("activate");
      $("#About_Ktech_left").removeClass("activate");
      $("#About_team_left").removeClass("activate");
      $("#Events_left").removeClass("activate");
      $("#Gallery_left").removeClass("activate");
      $("#Contact_left").addClass("activate");
    }

    if (destination["anchor"] == "About_Team") {
      $(".team")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".team").fadeOut(300);
    }

    if (destination["anchor"] == "About_Ktech") {
      $(".about_ktech_container")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".about_ktech_container").fadeOut(300);
    }

    if (destination["anchor"] == "Events") {
      $(".about_events_container")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".about_events_container").fadeOut(300);
    }

    if (destination["anchor"] == "Gallery") {
      $(".gallery_container")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".gallery_container").fadeOut(300);
    }

    if (destination["anchor"] == "Contact") {
      $(".contact_container")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".contact_container").fadeOut(300);
    }
  },

  // afterLoad: function(origin, destination, index) {
  //   if ($(window).width() < 1260) {
  //     $("#menu").css("display", "none");
  //   } else {
  //     $("#menu").css("display", "block");
  //   }
  // },

  afterLoad: function(origin, destination, index) {
    if (destination["anchor"] == "Home") {
      scrollOverflow: true;
    } else if (destination["anchor"] == "About_Ktech") {
      scrollOverflow: true;
    } else if (destination["anchor"] == "About_Team") {
      scrollOverflow: true;
    } else if (destination["anchor"] == "Events") {
      scrollOverflow: true;
    } else if (destination["anchor"] == "Gallery") {
      scrollOverflow: true;
    } else if (destination["anchor"] == "Contact") {
      scrollOverflow: true;
    }
  },

  afterResize: function(width, height) {
    console.log(width);
    console.log(height);
    if (width < 1260) {
      $("#menu").css("display", "none");
    } else {
      $("#menu").css("display", "block");
    }
  }
});

/*  Nivo slider js  */

$("#slider").nivoSlider({
  boxCols: 8,
  boxRows: 4,
  effect: "fade"
});
