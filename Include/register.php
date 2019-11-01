<?php

include 'Connection.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT Competition_Name FROM COMPETITION WHERE LOWER(Competition_Category)=LOWER('$category')";
    $run = mysqli_query($conn, $sql);
    echo "<option selected disabled value=''>SELECT EVENT</option>";
    while ($result = mysqli_fetch_assoc($run)) {
        echo "<option value='" . $result['Competition_Name'] . "'>" . $result['Competition_Name'] . "</option>";
    }
}
if (isset($_GET['team_name'])) {
    $check = strtolower($_GET['team_name']);
    $sql = "SELECT LOWER(Team_Name) AS Team_Name FROM team";
    $run = mysqli_query($conn, $sql);
    $flag = true;
    while ($result = mysqli_fetch_assoc($run)) {
        if ($check == $result['Team_Name']) {
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
if (isset($_GET['event_name'])) {
    $event = $_GET['event_name'];
    $sql = "SELECT Members_Per_Team FROM COMPETITION WHERE Competition_Name='$event'";
    $run = mysqli_query($conn, $sql);
    $limit = null;
    while ($result = mysqli_fetch_assoc($run)) {
        $limit = $result['Members_Per_Team'];
    }
    echo " <option selected disabled value=''>No Of Team Members</option>";
    //echo $limit;
    for ($a = 1; $a <= $limit; $a++) {
        echo "<option value='$a'>$a</option>";
    }

    //     for ($a = 2; $a <= (int)$limit; $a++) {
    //         echo "<div class='member' id='member$a'><input type='text' value='' name='member$a-name' placeholder='Member $a Name'> <input type='email' value='' name='member$a-email' placeholder='Email Address'> <div class='reg_no_container'> <select name='member$a-reg-year'>
    //         <option selected disabled value=' '>Reg-Year</option>
    //         <option value='16S'> 16S </option>
    //         <option value='16F'> 16F</option>
    //         <option value='17S'> 17S </option>
    //         <option value='17F'> 17F </option>
    //         <option value='18S'> 18S </option>
    //         <option value='18F'> 18F </option>
    //         <option value='19S'> 19S </option>
    //         <option value='19F'> 19F </option>
    //         </select>";

    //         echo "<select name='member$a-reg-department'>
    //         <option selected disabled value=' '>Department</option>
    //         <option value='BSCS'> BSCS </option>
    //         <option value='BSCE'> BSCE </option>
    //         </select>";

    //         echo "<select name='member$a-reg-roll'> <option selected disabled value='null'>Roll-No</option>";


    //         for ($b = 1; $b <= 50; $b++) {

    //             echo "<option value='$b'> $b </option>";
    //         }
    //         echo "</select> </div>
    //     </div>
    //         ";
    //     }
}

// if (isset($_POST['register'])) {
//     $team_name = $_POST['team_name'];
//     $team_email = $_POST['team_email'];
//     $category = $_POST['competition_category'];
//     $competition_name = $_POST['competition_names'];
//     $members = $_POST['no_of_members'];

//     $sql = "SELECT Competition_Id FROM COMPETITION WHERE Competition_Name='$competition_name'";
//     $run = mysqli_query($conn, $sql);
//     $result = mysqli_fetch_assoc($run);
//     $competition_id = $result['Competition_Id'];

//     $sql = "INSERT INTO Team(Team_Name,Team_Email,No_Of_Participant,Competition_Id) VALUES('$team_name', '$team_email','$members','$competition_id')";
//     $run = mysqli_query($conn, $sql);

//     for ($a = 1; $a <= $members; $a++) {
//         $member_name = $_POST['member' . $a . '-name'];
//         $member_reg_year = $_POST['member' . $a . '-reg-year'];
//         $member_reg_department = $_POST['member' . $a . '-reg-department'];
//         $member_reg_roll = $_POST['member' . $a . '-reg-roll'];
//         $member_reg_no = $member_reg_year . "-" . $member_reg_department . "-" . $member_reg_roll;

//         $sql = "SELECT Team_Id FROM Team ORDER BY Team_Id DESC LIMIT 1";
//         $run = mysqli_query($conn, $sql);
//         $result = mysqli_fetch_assoc($run);
//         $team_id = $result['Team_Id'];

//         $sql = "INSERT INTO Participant(Participant_Name,Participant_RegNo,Team_Id) VALUES(' $member_name','$member_reg_no','$team_id')";
//         $run = mysqli_query($conn, $sql);
//     }
// } else {
