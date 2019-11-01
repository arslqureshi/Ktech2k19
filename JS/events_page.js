new fullpage("#fullpage", {
  navigation: true,
  navigationPosition: "right",
  anchors: ["Home", "Events"],
  navigationTooltips: ["home", "events"],
  //sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C','red','black','blue'],
  scrollingSpeed: 900,
  scrollOverflow: true,
  css3: true,
  fixedElements: "#myModal",
  //   fixedElements: "#header",
  onLeave: function(origin, destination, index) {
    if (destination["anchor"] == "Events") {
      $(".event_container")
        .delay(350)
        .fadeIn(600);
    } else {
      $(".event_container").fadeOut(100);
    }
  },

  afterResize: function(width, height) {
    if (width < 1200) {
      $("#menu").css("display", "none");
    } else {
      $("#menu").css("display", "block");
    }
  }
});

//CALLED WHEN USER CLICKS THE CARD
function openModal(str) {
  var ajax = new XMLHttpRequest();
  ajax.open(
    "GET",
    "http://localhost/ktech/Include/validate.php?competition_id=" + str,
    true
  );
  ajax.send();
  ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("myModalContent").innerHTML = this.responseText;
      // Get the modal
      var modal = document.getElementById("myModal");
      modal.style.display = "block";
    }
  };
}

//CALLED WHEN USER CLICKS THE CROSS "X" ICON ON MODAL
function closeModal() {
  // Get the modal
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// Get the modal
var modal = document.getElementById("myModal");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
