<?php
include 'Connection.php';

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
if (isset($_POST['cancel'])) {
    header("Location:http://localhost/ktech/admin.php");
}


if (isset($_POST['update'])) {

    /*  Storing all the data in variables  */
    $competition_id = $_POST['competition_id'];
    $competition_category = $_POST['competition_category'];
    $competition_name = $_POST['competition_name'];
    $competition_description = $_POST['competition_description'];
    $competition_rules = $_POST['competition_rules'];
    $members_per_team = $_POST['members_per_team'];
    $no_of_judges = $_POST['total_judges'];

    $supervisor_name = $_POST['supervisor_name'];
    $supervisor_email = $_POST['supervisor_email'];

    if ($_FILES['supervisor_image']['name'] != "") {
        $supervisor_image = storeImage($_FILES['supervisor_image']);
        $sql = "UPDATE SUPERVISOR SET Supervisor_Name='$supervisor_name',Supervisor_Email='$supervisor_email',Supervisor_Image='$supervisor_image' WHERE Supervisor.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE SUPERVISOR SET Supervisor_Name='$supervisor_name',Supervisor_Email='$supervisor_email' WHERE Supervisor.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    }

    //$supervisor_image = storeImage($_FILES['supervisor_image']);

    $organizer_name = $_POST['organizer_name'];
    $organizer_reg_year = $_POST['organizer_reg_year'];
    $organizer_reg_department = $_POST['organizer_reg_department'];
    $organizer_reg_roll = $_POST['organizer_reg_roll'];
    $organizer_cell_no = $_POST['organizer_cell_no'];
    $organizer_regno = $organizer_reg_year . "-" . $organizer_reg_department . "-" . $organizer_reg_roll;

    if ($_FILES['organizer_image']['name'] != "") {
        $organizer_image = storeImage($_FILES["organizer_image"]);
        $sql = "UPDATE ORGANIZER SET Organizer_Name='$organizer_name',Organizer_regno='$organizer_regno',Organizer_Cell_No='$organizer_cell_no' ,Organizer_Image='$organizer_image' WHERE Organizer.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE ORGANIZER SET Organizer_Name='$organizer_name',Organizer_regno='$organizer_regno',Organizer_Cell_No='$organizer_cell_no' WHERE Organizer.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    }

    //$organizer_image = storeImage($_FILES["organizer_image"]);



    $co_organizer_name = $_POST['co_organizer_name'];
    $co_organizer_reg_year = $_POST['co_organizer_reg_year'];
    $co_organizer_reg_department = $_POST['co_organizer_reg_department'];
    $co_organizer_reg_roll = $_POST['co_organizer_reg_roll'];
    $co_organizer_cell_no = $_POST['co_organizer_cell_no'];
    $co_organizer_regno = $co_organizer_reg_year . "-" . $co_organizer_reg_department . "-" . $co_organizer_reg_roll;
    if ($_FILES['co_organizer_image']['name'] != "") {
        $co_organizer_image = storeImage($_FILES['co_organizer_image']);
        $sql = "UPDATE COORGANIZER SET Co_Organizer_Name='$co_organizer_name',Co_Organizer_regno='$co_organizer_regno',Co_Organizer_Cell_No='$co_organizer_cell_no' ,Co_Organizer_Image='$co_organizer_image' WHERE Coorganizer.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE COORGANIZER SET Co_Organizer_Name='$co_organizer_name',Co_Organizer_regno='$co_organizer_regno',Co_Organizer_Cell_No='$co_organizer_cell_no' WHERE Coorganizer.Competition_Id='$competition_id'";
        mysqli_query($conn, $sql);
    }



    /* AS there can be more than 1 judge so we have to store info of every single judge  */

    $sql = "SELECT Judge_Id From Competition_Judge WHERE Competition_Id='$competition_id'";
    $run = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_assoc($run)) {
        $judge_id = $result['Judge_Id'];
        $sql = "DELETE FROM Competition_Judge WHERE Judge_Id='$judge_id'";
        mysqli_query($conn, $sql);
    }
    for ($a = 1; $a <= $no_of_judges; $a++) {
        $judge_name = $_POST['judge_name' . $a];
        $judge_email = $_POST['judge_email' . $a];
        if ($_FILES['judge_image' . $a]['name'] != "") {
            $judge_image = storeImage($_FILES['judge_image' . $a]);
            $sql = "INSERT INTO JUDGE(JUDGE_Name,JUDGE_Email,JUDGE_Image)
            VALUES('$judge_name','$judge_email','$judge_image');";
            mysqli_query($conn, $sql);
        }
    }




    /*  INSERTING DATA INTO TABLES  */



    $sql = "UPDATE COMPETITION SET Competition_Category='$competition_category',Competition_Name='$competition_name',Competition_Description='$competition_description',Competition_Rules='$competition_rules',Members_Per_Team='$members_per_team',Total_Judges='$no_of_judges' WHERE Competition_Id='$competition_id'";
    mysqli_query($conn, $sql);

    // $sql = "UPDATE SUPERVISOR SET Supervisor_Name='$supervisor_name',Supervisor_Email='$supervisor_email',Supervisor_Image='$supervisor_image' WHERE Supervisor.Competition_Id='$competition_id'";
    // mysqli_query($conn, $sql);


    // $sql = "UPDATE ORGANIZER SET Organizer_Name='$organizer_name',Organizer_regno='$organizer_regno',Organizer_Cell_No='$organizer_cell_no' ,Organizer_Image='$organizer_image' WHERE Organizer.Competition_Id='$competition_id'";
    // mysqli_query($conn, $sql);

    // $sql = "UPDATE COORGANIZER SET Co_Organizer_Name='$co_organizer_name',Co_Organizer_regno='$co_organizer_regno',Co_Organizer_Cell_No='$co_organizer_cell_no' ,Co_Organizer_Image='$co_organizer_image' WHERE Coorganizer.Competition_Id='$competition_id'";
    // mysqli_query($conn, $sql);


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
