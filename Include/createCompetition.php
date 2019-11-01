<?php
include "Connection.php";

session_start();
if (($_SESSION['Access']) != true) {
    header("Location:http://localhost/ktech/login.php");
}

/*  DEFINING CUSTOM FUNCTIONS   */

function storeImage($image_data)    //This function takes an image as a file then extract its name and transfer that image to UPLOADS folder
{
    $image_name = $image_data['name'];

    $image_ext = explode('.', $image_name);
    $image_extension = strtolower(end($image_ext));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($image_extension, $allowed)) {
        if ($image_data['error'] === 0) {
            if ($image_data['size'] < 99999999) {
                $file_destination = 'uploads/' . $image_name;
                move_uploaded_file($image_data['tmp_name'], $file_destination);
                return $file_destination;
            } else {
                return "uploads/avatar.jpg";
            }
        } else {
            return "uploads/avatar.jpg";
        }
    } else {
        return "uploads/avatar.jpg";
    }
}



/*  GETTING DATA FROM ADMIN PANEL  */

if (isset($_POST['submit'])) {

    /*  Storing all the data in variables  */

    $competition_category = $_POST['competition_category'];
    $competition_name = $_POST['competition_name'];
    $competition_description = $_POST['competition_description'];
    $competition_rules = $_POST['competition_rules'];
    $members_per_team = $_POST['members_per_team'];
    $no_of_judges = $_POST['total_judges'];

    $supervisor_name = $_POST['supervisor_name'];
    $supervisor_email = $_POST['supervisor_email'];
    $supervisor_image = storeImage($_FILES['supervisor_image']);

    $organizer_name = $_POST['organizer_name'];
    $organizer_reg_year = $_POST['organizer_reg_year'];
    $organizer_reg_department = $_POST['organizer_reg_department'];
    $organizer_reg_roll = $_POST['organizer_reg_roll'];
    $organizer_cell_no = $_POST['organizer_cell_no'];
    $organizer_image = storeImage($_FILES["organizer_image"]);

    $organizer_regno = $organizer_reg_year . "-" . $organizer_reg_department . "-" . $organizer_reg_roll;


    $co_organizer_name = $_POST['co_organizer_name'];
    $co_organizer_reg_year = $_POST['co_organizer_reg_year'];
    $co_organizer_reg_department = $_POST['co_organizer_reg_department'];
    $co_organizer_reg_roll = $_POST['co_organizer_reg_roll'];
    $co_organizer_cell_no = $_POST['co_organizer_cell_no'];
    $co_organizer_image = storeImage($_FILES['co_organizer_image']);

    $co_organizer_regno = $co_organizer_reg_year . "-" . $co_organizer_reg_department . "-" . $co_organizer_reg_roll;


    /* AS there can be more than 1 judge so we have to store info of every single judge  */


    for ($a = 1; $a <= $no_of_judges; $a++) {

        $judge_name = $_POST['judge_name' . $a];
        $judge_email = $_POST['judge_email' . $a];
        $judge_image = storeImage($_FILES['judge_image' . $a]);

        $sql = "INSERT INTO JUDGE(JUDGE_Name,JUDGE_email,JUDGE_Image)
        VALUES('$judge_name','$judge_email','$judge_image');";

        mysqli_query($conn, $sql);
    }




    /*  INSERTING DATA INTO TABLES  */

    $sql = "INSERT INTO COMPETITION(Competition_Category,Competition_Name,Competition_Description,Competition_Rules,Members_Per_Team,Total_Judges)
    VALUES('$competition_category','$competition_name','$competition_description','$competition_rules','$members_per_team', '$no_of_judges');";

    mysqli_query($conn, $sql);

    $query = "SELECT Competition_Id FROM Competition ORDER BY Competition_Id DESC LIMIT 1";  //EXTRACTING THE ID of LATEST ENTERD Competition to SVAE AS foreign KEY in other relations
    $run = mysqli_query($conn, $query);
    $competition_id = null;
    if (mysqli_num_rows($run) > 0) {
        $result = mysqli_fetch_assoc($run);
        $competition_id = $result["Competition_Id"];
    }

    $sql = "INSERT INTO SUPERVISOR(Supervisor_Name,Supervisor_email,Supervisor_Image,Competition_Id)
    VALUES('$supervisor_name','$supervisor_email','$supervisor_image','$competition_id');";

    mysqli_query($conn, $sql);


    $sql = "INSERT INTO ORGANIZER(Organizer_Name,Organizer_regno,organizer_cell_no ,Organizer_Image,Competition_Id)
    VALUES('$organizer_name','$organizer_regno','$organizer_cell_no', '$organizer_image','$competition_id');";

    mysqli_query($conn, $sql);

    $sql = "INSERT INTO COORGANIZER(Co_Organizer_Name,Co_Organizer_regno,co_organizer_cell_no,Co_Organizer_Image,Competition_Id)
    VALUES('$co_organizer_name','$co_organizer_regno', '$co_organizer_cell_no', '$co_organizer_image','$competition_id');";

    mysqli_query($conn, $sql);


    $query = "SELECT Judge_Id FROM Judge ORDER BY Judge_Id DESC LIMIT $no_of_judges";
    $run = mysqli_query($conn, $query);
    for ($i = 1; $i <= $no_of_judges; $i++) {

        $result = $run->fetch_assoc();
        $judge_id = $result["Judge_Id"];

        mysqli_query($conn, "INSERT INTO Competition_judge(competition_id,judge_id) VALUES('$competition_id','$judge_id')");
    }

    header("Location:http://localhost/ktech/admin.php");
} else {
    echo ("Noooo");
}
