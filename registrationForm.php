<?php
include "Include/Connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration | Ktech</title>
    <link href="CSS/register.css" rel="stylesheet">
    <link href="CSS/all.min.css" rel="stylesheet">
    <link href="CSS/all.min.css" rel="stylesheet">

</head>

<body>
    <div id="container">


        <header>
            <div class="logo">
                <img src="images/logo.png" alt="logo" width="100%" height="100%">
            </div>
            <h3>KTECH</h3>
            <div class="register_button">
                <a href="index.php">Ktech</a>
            </div>
        </header>

        <div class="main_section">
            <div class="registration_portal">
                <h1>Register Now</h1>
                <p>Fill the form and get yourself Registered in exciting events</p>
            </div>
            <div class="registration_form_container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="registration_form">
                    <div class="competition_form">

                        <select name="competition_category" id="category_type" required onchange="getCategory(this.value)">

                            <option selected disabled value="">Choose Category</option>
                            <option value="software">Software</option>
                            <option value="hardware">Hardware</option>
                            <option value="co-curricular">Co-Curricular</option>
                        </select>

                        <select name="competition_names" id="competition_names" required onchange="getMembersPerTeam(this.value)">
                            <!-- DATA IS COMING FROM REGISTER.PHP FILE IN THE INCLUDE FOLDER which is accessed though register.js file USING AJAX -->
                        </select>

                        <input id="team_name" type="text" name="team_name" placeholder="Team Name" required onchange="getTeamName(this.value)">

                        <input id="team_email" type="Email" name="team_email" placeholder="Team Email" required>

                        <select name="no_of_members" id="no_of_members" required onchange="getParticipantForm(this.value)">
                            <option selected disabled value="">No Of Team Members</option>
                        </select>
                    </div>

                    <div id="participant_form" class="">
                        <!-- <div class='member' id='member1'>
                            <input type='text' name='member1-name' placeholder='Name (Leader)' required>
                            <input type='email' name='member1-email' placeholder='Email Address' required>
                            <div class='reg_no_container'>
                                <select name='member1-reg-year' required>
                                    <option selected disabled value="">Reg-Year</option>
                                    <option value='16S'> 16S </option>
                                    <option value='16F'> 16F</option>
                                    <option value='17S'> 17S </option>
                                    <option value='17F'> 17F </option>
                                    <option value='18S'> 18S </option>
                                    <option value='18F'> 18F </option>
                                    <option value='19S'> 19S </option>
                                    <option value='19F'> 19F </option>
                                </select>

                                <select name='member1-reg-department' required>
                                    <option selected disabled value="">Department</option>
                                    <option value='BSCS'> BSCS </option>
                                    <option value='BSCE'> BSCE </option>
                                </select>

                                <select name='member1-reg-roll' required>
                                    <option selected disabled value="">Roll-No</option>

                                </select> -->
                        <!-- </div>
                        </div> -->
                    </div>











                    <div class="register_btn_container">
                        <input type="submit" name="register" id="register_btn" value="Register" onclick="displaymodel()">
                    </div>

                    <div class="model" id="mymodel">
                        <div class="modal_header">
                            <span class="close" id="close_btn" onclick="closeModal()">&times;</span>
                        </div>
                        <span class="fas fa-camera-retro big-font"></span>
                        <h3>Registration Succesfull</h3>
                    </div>
                </form>
            </div>

        </div>
    </div>





    <script src="JS/jquery.js"></script>
    <script src="JS/register.js"></script>
    <script src="JS/fontawesome.js"></script>
    <script src="JS/validations.js"></script>
    <script src="JS/sweetalert.js"></script>
</body>

</html>
<?php
if (isset($_POST['register'])) {
    $team_name = $_POST['team_name'];
    $team_email = $_POST['team_email'];
    $category = $_POST['competition_category'];
    $competition_name = $_POST['competition_names'];
    $members = $_POST['no_of_members'];

    $sql = "SELECT Competition_Id FROM COMPETITION WHERE Competition_Name='$competition_name'";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($run);
    $competition_id = $result['Competition_Id'];

    $sql = "INSERT INTO Team(Team_Name,Team_Email,No_Of_Participant,Competition_Id) VALUES('$team_name', '$team_email','$members','$competition_id')";
    $run = mysqli_query($conn, $sql);

    for ($a = 1; $a <= $members; $a++) {
        $member_name = $_POST['member' . $a . '-name'];
        $member_reg_year = $_POST['member' . $a . '-reg-year'];
        $member_reg_department = $_POST['member' . $a . '-reg-department'];
        $member_reg_roll = $_POST['member' . $a . '-reg-roll'];
        $member_reg_no = $member_reg_year . "-" . $member_reg_department . "-" . $member_reg_roll;

        $sql = "SELECT Team_Id FROM Team ORDER BY Team_Id DESC LIMIT 1";
        $run = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($run);
        $team_id = $result['Team_Id'];

        $sql = "INSERT INTO Participant(Participant_Name,Participant_RegNo,Team_Id) VALUES(' $member_name','$member_reg_no','$team_id')";
        $run = mysqli_query($conn, $sql);
    }
    sleep(5);
}
?>