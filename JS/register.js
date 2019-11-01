function getCategory(str) {
  document.getElementById("competition_names").style.display = "block";
  document.getElementById("no_of_members").innerHTML =
    "<option selected disabled value=''>No Of Team Members</option>";
  document.getElementById("team_name").style.display = "none";
  document.getElementById("team_email").style.display = "none";
  document.getElementById("team_name").value = "";
  document.getElementById("team_email").value = "";
  document.getElementById("no_of_members").style.display = "none";
  document.getElementById("participant_form").innerHTML = "";

  var ajax = new XMLHttpRequest();
  ajax.open(
    "GET",
    "http://localhost/ktech/include/register.php?category=" + str,
    true
  );
  ajax.send();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(
        "competition_names"
      ).innerHTML = this.responseText;
    }
  };
}

function getMembersPerTeam(str) {
  document.getElementById("team_name").style.display = "block";
  document.getElementById("team_email").style.display = "block";
  document.getElementById("no_of_members").innerHTML =
    "<option selected disabled value=''>No Of Team Members</option>";
  document.getElementById("participant_form").innerHTML = "";
  var ajax = new XMLHttpRequest();
  ajax.open(
    "GET",
    "http://localhost/ktech/include/register.php?event_name=" + str,
    true
  );
  ajax.send();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //alert(this.response);
      document.getElementById("no_of_members").innerHTML = this.responseText;
      /* To get the no of div elements inside participant form for styling purpose :)  */
      // var count = $("#participant_form > div").length;
      document.getElementById("no_of_members").style.display = "block";
    }
  };
}

function getParticipantForm(no_of_members) {
  document.getElementById("participant_form").innerHTML = "";
  for (var a = 1; a <= no_of_members; a++) {
    document.getElementById("participant_form").innerHTML +=
      "<div class='member' id='member" +
      a +
      "'><input type='text' value='' name='member" +
      a +
      "-name' placeholder='Member " +
      a +
      " Name' id='member" +
      a +
      "-name' onchange='letterval(this.value,this.id)' required> <div class='reg_no_container'> <select name='member" +
      a +
      "-reg-year' id='member" +
      a +
      "-reg-year'required><option selected disabled value=''>Reg-Year</option><option value='16S'> 16S </option><option value='16F'> 16F</option> <option value='17S'> 17S </option><option value='17F'> 17F </option><option value='18S'> 18S </option> <option value='18F'> 18F </option> <option value='19S'> 19S </option> <option value='19F'> 19F </option> </select><select name='member" +
      a +
      "-reg-department' id='member" +
      a +
      "-reg-department'required><option selected disabled value=' '>Department</option> <option value='BSCS'> BSCS </option> <option value='BSCE'> BSCE </option> </select>" +
      "<select name='member" +
      a +
      "-reg-roll' id='member" +
      a +
      "_reg_roll' required> <option selected disabled value=''>Roll-No</option>";
    for (var b = 1; b <= 50; b++) {
      document.getElementById("member" + a + "_reg_roll").innerHTML +=
        "<option value='" + b + "'>" + b + "</option>";
    }

    document.getElementById("participant_form").innerHTML += "</div></div>";
  }

  if (no_of_members == 1) {
    $("#participant_form").removeClass("participant_grid_2");
    $("#participant_form").removeClass("participant_grid_3");
    $("#participant_form").addClass("participant_grid_1");
  } else if (no_of_members == 2) {
    $("#participant_form").removeClass("participant_grid_1");
    $("#participant_form").removeClass("participant_grid_3");
    $("#participant_form").addClass("participant_grid_2");
  } else if (no_of_members == 3) {
    $("#participant_form").removeClass("participant_grid_1");
    $("#participant_form").removeClass("participant_grid_2");
    $("#participant_form").addClass("participant_grid_3");
  }
}

// function getMembersPerTeam(str) {
//   var members_per_team = 1;
//   var ajax = new XMLHttpRequest();
//   ajax.open(
//     "GET",
//     "http://localhost/ktech/include/register.php?event_name=" + str,
//     true
//   );
//   ajax.send();
//   ajax.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       document.getElementById(
//         "participant_form"
//       ).innerHTML += this.responseText;
//       /* To get the no of div elements inside participant form for styling purpose :)  */
//       var count = $("#participant_form > div").length;
//       document.getElementById("member1").style.display = "block";
//       if (count == 1) {
//         $("#participant_form").addClass("participant_grid_1");
//       } else if (count == 2) {
//         $("#participant_form").addClass("participant_grid_2");
//       } else if (count == 3) {
//         $("#participant_form").addClass("participant_grid_3");
//       }
//     }
//   };
// }

//team name validation
function getTeamName() {
  str = document.getElementById("team_name").value;
  var ajax = new XMLHttpRequest();
  ajax.open(
    "GET",
    "http://localhost/ktech/Include/register.php?team_name=" + str,
    true
  );
  ajax.send();
  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var val = this.responseText;
      if (val == 1) {
        document.getElementById("team_name").style.borderColor = "";
        document.getElementById("team_name").placeholder = "Name Of Team";
        document.getElementById("team_name").style.color = "black";
      } else if (val == 0) {
        document.getElementById("team_name").value = null;
        document.getElementById("team_name").style.borderColor = "red";
        document.getElementById("team_name").placeholder = "Name is taken";
      }
    }
  };
}
//end
//var model = (document.getElementsByClassName("model").style.display = "none");
function displaymodel() {
  category_type = document.getElementById("category_type").value;
  competition_names = document.getElementById("competition_names").value;
  team_name = document.getElementById("team_name").value;
  team_email = document.getElementById("team_email").value;
  no_of_members = document.getElementById("no_of_members").value;
  check = false;
  if (no_of_members != "") {
    for (i = 1; i <= no_of_members; i++) {
      id = "member" + i + "-name";

      member = document.getElementById(id).value;
      id = "member" + i + "-reg-year";

      reg_year = document.getElementById(id).value;
      id = "member" + i + "-reg-department";

      reg_dept = document.getElementById(id).value;
      id = "member" + i + "_reg_roll";

      reg_no = document.getElementById(id).value;
      if (member != "" && reg_year != "" && reg_dept != "" && reg_no != "") {
        check = true;
      } else {
        check = false;
      }
    }
  }


  // alert(category_type);
  // alert(competition_names);
  // alert(team_name);
  // alert(team_email);
  // alert(no_of_members);

  if (category_type != "" && competition_names != "" && team_name != "" && team_email != "" && no_of_members != "" && check) {
    console.log("in main if");
    swal({
      title: "Registration Complete",
      text: "An Email will be sent to you to acknowledge you registration. If you don't recieve the email within a day then contact us.",
      icon: "success",
      timer: 6000,
      buttons: false
    }).then(
      function () {},
      // handling the promise rejection
      function (dismiss) {
        if (dismiss === 'timer') {
          //console.log('I was closed by the timer')
        }
      });
  }
}