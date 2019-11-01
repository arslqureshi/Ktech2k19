function openSection(evt, sectionName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(sectionName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
/*  FOR SELECTING JUDGES  */

function selectTotalJudges() {
  var no_of_judges = document.getElementById("total_judges").value;

  document.getElementById("judge_info").innerHTML = "";
  for (var a = 1; a <= no_of_judges; a++) {
    document.getElementById("judge_info").innerHTML +=
      '<div class="judge_info_group">  <input type="text" name="judge_name' +
      a +
      '" value="" id="judge_name' +
      a +
      '" placeholder="Name of Judge" required onchange="letterval(this.value,this.id)">  <input type="text" name="judge_email' +
      a +
      '" placeholder="Email of Judge" required> <div> <input type="file" name="judge_image' +
      a +
      '"></div> </div>';
  }
}

function validate(str) {
  var ajax = new XMLHttpRequest();
  ajax.open(
    "GET",
    "http://localhost/ktech/Include/validate.php?competition_name=" + str,
    true
  );
  ajax.send();
  ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var val = this.responseText;
      if (val == "1") {
        document.getElementById("competition_name").style.borderColor = "black";
        document.getElementById("competition_name").placeholder =
          "Name Of Competition";
      } else if (val == "0") {
        document.getElementById("competition_name").value = null;
        document.getElementById("competition_name").style.borderColor = "red";
        document.getElementById("competition_name").placeholder =
          "This event Already Exisits";
      }
    }
  };
}

function getconfirm(id) {
  // var retVal = confirm("Do you Want to Delete Competition ?");
  // if (retVal == true) {
    // location.replace(
    //   "http://localhost/ktech/include/deleteCompetition.php?id=" + id
    // );
  //   return true;
  // } else {
  //   return false;
  // }
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this Event",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      location.replace(
        "http://localhost/ktech/include/deleteCompetition.php?id=" + id
      );
    } else {
      swal("Event not deleted!");
    }
  });
}
