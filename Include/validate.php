<?php
include "Connection.php";
session_start();
if (($_SESSION['Access']) != true) {
    header("Location:http://localhost/ktech/login.php");
}

if (isset($_GET['competition_name'])) {   // Validating the duplication of Competition
    $check = strtolower($_GET['competition_name']);
    $sql = "SELECT LOWER(Competition_Name) AS Competition_Name FROM COMPETITION";
    $run = mysqli_query($conn, $sql);
    $flag = true;
    while ($result = mysqli_fetch_assoc($run)) {
        if ($check == $result['Competition_Name']) {
            $flag = false;
            break;
        }
    }

    if ($flag == false) {
        echo '0';
    } else {
        echo '1';
    }
}


if (isset($_GET['competition_id'])) {  // Generating a modal when user clicks on any event card
    $id = $_GET['competition_id'];
    $sql = "SELECT Organizer_Name,Organizer_Cell_No,Organizer_Image,Co_Organizer_Name,Co_Organizer_Cell_No,Co_Organizer_Image,Supervisor_Name,Supervisor_Image,Competition_Description,Competition_Rules FROM ORGANIZER,COORGANIZER,SUPERVISOR,COMPETITION WHERE COMPETITION.COMPETITION_Id='$id'
    AND ORGANIZER.Competition_Id=$id AND COORGANIZER.Competition_Id=$id AND SUPERVISOR.Competition_Id=$id";
    $run = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_assoc($run)) {
        echo '<div class="modal_header">
            <span class="close" id="close_btn" onclick="closeModal()">&times;</span>
            </div>
            <div class="heading_wrapper">
            <h3>Organizing Team</h3>
            </div>


    <div class="organizing_team">

        <div class="organizing_team_details supervisor">
            <img src="Include/' . $result['Supervisor_Image'] . '" alt="">
            <h4>' . $result['Supervisor_Name'] . '</h4>
            <p>Supervisor</p>
        </div>

        <div class="organizing_team_details organizer">
            <img src="Include/' . $result['Organizer_Image'] . '" alt="">
            <h4>' . $result['Organizer_Name'] . '</h4>
             <h5>' . $result['Organizer_Cell_No'] . '</h5>
            <p>Organizer</p>
           
        </div>

        <div class="organizing_team_details co_organizer">
            <img src="Include/' . $result['Co_Organizer_Image'] . '" alt="">
            <h4>' . $result['Co_Organizer_Name'] . '</h4>
            <h5>' . $result['Co_Organizer_Cell_No'] . '</h5>
            <p>Co-Organizer</p>
            
        </div>

    </div>
    <div class="heading_wrapper">
        <h3>Description</h3>
    </div>


    <div class="description">
        <pre>' . $result['Competition_Description'] . '</pre>
    </div>

    <div class="heading_wrapper">
        <h3>Rules</h3>
    </div>


    <div class="Rules">
        <pre>' . $result['Competition_Rules'] . '</pre>
    </div>

    <div class="heading_wrapper">
        <h3>Judges</h3>
    </div>


    <div class="judges">';
    }

    $sql_for_judge = "SELECT * FROM JUDGE WHERE JUDGE_Id IN (SELECT JUDGE_Id FROM Competition_Judge WHERE Competition_judge.Competition_Id=$id)";
    $run = mysqli_query($conn, $sql_for_judge);
    if (mysqli_num_rows($run) > 0) {
        while ($result = mysqli_fetch_assoc($run)) {
            echo '<div class="judge_details">
            <img src="Include/' . $result['JUDGE_Image'] . '" alt="">
            <h4>' . $result['JUDGE_Name'] . '</h4>
        </div>';
        }

        echo '</div>'; //Closing div tag of div with class judges
    }
}
