// var str = document.getElementsByClassName("validate");
// str.onchange = function() {
//   for (var i = 0; i < length(str); i++) {
//     if (!(str[i] >= "0" && str[i] <= "9")) {
//       alert("in");
//       str.value = "";
//       break;
//     }
//   }
// };

function numval(str, id) {
  flag = true;
  for (var i = 0; i < str.length; i++) {
    if (!(str[i] >= "0" && str[i] <= "9")) {
      flag = false;
      break;
    }
  }
  if (flag == false) {
    document.getElementById(id).value = "";
    document.getElementById(id).style.borderColor = "red";
    document.getElementById(id).placeholder =
      "Incorrect value for phone number";
  } else {
    document.getElementById(id).style.borderColor = "black";
    document.getElementById(id).placeholder = "Cell Number 03211234567";
  }
}
function letterval(str, id) {
  flag = true;
  for (var i = 0; i < str.length; i++) {
    if (
      !(str[i] >= "a" && str[i] <= "z") &&
      !(str[i] >= "A" && str[i] <= "Z") &&
      !(str[i] == " ")
    ) {
      flag = false;
      break;
    }
  }
  if (flag == false) {
    document.getElementById(id).value = "";
    document.getElementById(id).style.borderColor = "red";
    document.getElementById(id).placeholder = "You can't use a numeric value";
  } else {
    document.getElementById(id).placeholder = "Name..";
    document.getElementById(id).style.borderColor = "black";
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
