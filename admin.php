<?php
include 'include/Connection.php';

session_start();
if (($_SESSION['Access']) != true) {
    header("Location:http://localhost/ktech/login.php");
}



$sql = "DELETE FROM JUDGE WHERE Judge_Id NOT IN (SELECT Judge_Id FROM Competition_Judge)"; // whenever the admin opens this page, judges will be deleted if they are not judging any event
mysqli_query($conn, $sql);

$sql = "SELECT COUNT(*) AS no_of_comp FROM Competition";
$run = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($run);

$sql = "SELECT COUNT(*) AS no_of_teams FROM Team";
$run = mysqli_query($conn, $sql);
$res = mysqli_fetch_assoc($run);

$sql = "SELECT Organizer_Name,Organizer_Cell_No ,Organizer_Image,Competition_Name FROM Competition,Organizer WHERE Competition.Competition_Id=Organizer.Competition_Id";
$run = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KTECH | Admin Panel</title>
    <link href="CSS/all.min.css" rel="stylesheet">
    <link href="CSS/admin.css" rel="stylesheet">
</head>

<body>
    <div id="main_container">
        <header>


            <img src="images/logo.png" alt="logo">


            <a href="Include/logout.php">Logout</a>

        </header>

        <nav>
            <ul>
                <li id="defaultOpen" class="tablinks" onclick="openSection(event,'dashboard')">Dashboard</li>
                <li class="tablinks" onclick="openSection(event,'create_competition')"> Create Competition </li>
                <li class="tablinks" onclick="openSection(event,'update')"> Modify Information </li>
                <li class="tablinks" onclick="openSection(event,'registered_students')"> Show registered Teams </li>
                <li class="tablinks" onclick="openSection(event,'report')"> Generate report </li>
            </ul>
        </nav>

        <main>

            <!-- DASHBOARD HTML -->

            <div id="dashboard" class="tabcontent">

                <section class="counters">

                    <div class="total_competitions">
                        <span class="fas fa-brain"> </span>
                        <h2> Competitions </h2>
                        <p> <?php echo ($result['no_of_comp']); ?> </p>
                    </div>

                    <div class="total_registered_teams">
                        <span class="fas fa-users"></span>
                        <h2> Teams </h2>
                        <p> <?php echo ($res['no_of_teams']); ?> </p>
                    </div>
                </section>

                <section class="involved_team">
                    <?php while ($organizer = mysqli_fetch_assoc($run)) { ?>
                    <div class="member">
                        <img src="Include/<?php echo ($organizer['Organizer_Image']); ?>" width="200px" height="200px">
                        <h2> <?php echo ($organizer['Organizer_Name']); ?> </h2>
                        <h3> <?php echo ($organizer['Organizer_Cell_No']); ?> </h3>
                        <p> <?php echo ($organizer['Competition_Name']); ?> </p>
                    </div>
                    <?php } ?>
                </section>

            </div>

            <!-- CREATE COMPETITION HTML -->

            <div id="create_competition" class="tabcontent">

                <section class="competition_details">

                    <form action="include/createCompetition.php" method="post" enctype="multipart/form-data">
                        <div class="competition_form">

                            <h1>Create new competition</h1>

                            <select name="competition_category" id="" required>
                                <option selected disabled value="">CHOOSE CATEGORY</option>
                                <option value="software"> Software </option>
                                <option value="hardware"> Hardware </option>
                                <option value="co-curricular"> Co-Curricular </option>
                            </select>

                            <input type="text" name="competition_name" id="competition_name" value=""
                                placeholder="Name of Competition" required onchange="validate(this.value)"
                                onkeyup="letterval(this.value,this.id)">
                            <input type="text" name="comepetition_date" id="competition_date" value=""
                                placeholder="yyyy-mm-dd" required>
                            <textarea name="competition_description" id="" cols="30" rows="10" placeholder="Description"
                                required></textarea>

                            <textarea name="competition_rules" id="" cols="30" rows="10" placeholder="Rules"
                                required></textarea>
                            <div class="select_group">
                                <label for="">Memebers Per Team</label>
                                <select name="members_per_team" id="" required>
                                    <option selected value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                </select>
                            </div>

                        </div>

                        <div class="supervisor_form">

                            <h1>Add supervisor</h1>

                            <input type="text" name="supervisor_name" value="" id="supervisor_name"
                                placeholder="Name of Supervisor" required onchange="letterval(this.value,this.id)">

                            <input type="text" name="supervisor_email" placeholder="Email of Supervisor" required>

                            <div>
                                <input type="file" name="supervisor_image">
                            </div>

                        </div>

                        <div class="organizer_form">

                            <h1>Add organizer</h1>

                            <input type="text" name="organizer_name" value="" placeholder="Name of organizer"
                                id="organizer_name" required onchange="letterval(this.value,this.id)">

                            <div class="reg_no_selection">
                                <select name="organizer_reg_year" id="">
                                    <option value="16S"> 16S </option>
                                    <option value="16F"> 16F</option>
                                    <option value="17S"> 17S </option>
                                    <option value="17F"> 17F </option>
                                    <option value="18S"> 18S </option>
                                    <option value="18F"> 18F </option>
                                    <option value="19S"> 19S </option>
                                    <option value="19F"> 19F </option>
                                </select>

                                <select name="organizer_reg_department" id="">
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSCE">BSCE</option>
                                </select>

                                <select name="organizer_reg_roll" id="">
                                    <?php

                                    for ($a = 1; $a <= 50; $a++) {
                                        ?>
                                    <option value=" <?php echo ($a); ?> "><?php echo ($a); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <input type="text" class="validate" name="organizer_cell_no"
                                placeholder="Cell Number 03211234567" id="organizer_cell_no"
                                onchange="numval(this.value,this.id)">

                            <div>
                                <input type="file" name="organizer_image">
                            </div>

                        </div>


                        <div class="co_organizer_form">

                            <h1>Add Co-organizer</h1>

                            <input type="text" name="co_organizer_name" value="" id="co_organizer_name"
                                placeholder="Name of Co-organizer" required onchange="letterval(this.value,this.id)">

                            <div class="reg_no_selection">
                                <select name="co_organizer_reg_year" id="">
                                    <option value="16S"> 16S </option>
                                    <option value="16F"> 16F</option>
                                    <option value="17S"> 17S </option>
                                    <option value="17F"> 17F </option>
                                    <option value="18S"> 18S </option>
                                    <option value="18F"> 18F </option>
                                    <option value="19S"> 19S </option>
                                    <option value="19F"> 19F </option>
                                </select>

                                <select name="co_organizer_reg_department" id="">
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSCE">BSCE</option>
                                </select>

                                <select name="co_organizer_reg_roll" id="">
                                    <?php

                                    for ($a = 1; $a <= 50; $a++) {
                                        ?>
                                    <option value=" <?php echo ($a); ?> "><?php echo ($a); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <input type="text" name="co_organizer_cell_no" id="co_organizer_cell_no"
                                placeholder="Cell Number 03211234567" onchange="numval(this.value,this.id)">

                            <div>
                                <input type="file" name="co_organizer_image">
                            </div>

                        </div>


                        <div class="judge_form">

                            <h1>Add Judge(s)</h1>

                            <div class="select_group">
                                <label for="">No. of Judges</label>
                                <select name="total_judges" id="total_judges" required onchange="selectTotalJudges()">
                                    <option selected disabled value="">select Judges</option>
                                    <option value="0">0</option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                </select>
                            </div>

                            <div id="judge_info">

                            </div>
                            <!-- <input type="text" name="judge_name" value="" placeholder="Name of Supervisor" required>

                            <input type="text" name="judge_rank" placeholder="Rank of Supervisor" required>

                            <input type="file" name="judge_image"> -->

                        </div>

                        <input type="submit" name="submit" class="submit_btn">
                        <!-- <button type="submit" class="submit_btn" name="create_competition">Create</button> -->
                    </form>
                </section>
            </div>

            <!-- UPDATE SECTION HTML -->

            <div id="update" class="tabcontent">

                <section class="show_information">

                    <table class="competition_detail_table">
                        <thead>
                            <tr>
                                <th>Competition Name</th>
                                <th>Category</th>
                                <th>Members Per Team</th>
                                <th>Supervisor Name</th>
                                <th>Organizer Name</th>
                                <th>Co-Organizer Name</th>
                                <th>Total Judges</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM COMPETITION,SUPERVISOR,ORGANIZER,COORGANIZER WHERE COMPETITION.Competition_Id=SUPERVISOR.Competition_Id AND COMPETITION.Competition_Id=ORGANIZER.Competition_Id AND COMPETITION.Competition_Id=COORGANIZER.Competition_Id";
                            $run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($run) > 0) {
                                while ($result = mysqli_fetch_assoc($run)) {
                                    ?>

                            <tr>
                                <td> <?php echo ($result['Competition_Name']);   ?></td>
                                <td> <?php echo ($result['Competition_Category']);  ?></td>
                                <td> <?php echo ($result['Members_Per_Team']);  ?></td>
                                <td> <?php echo ($result['Supervisor_Name']);  ?></td>
                                <td> <?php echo ($result['Organizer_Name']);  ?></td>
                                <td> <?php echo ($result['Co_Organizer_Name']);  ?></td>
                                <td> <?php echo ($result['Total_Judges']);  ?></td>
                                <?php $comp_id =  $result['Competition_Id']; ?>
                                <td> <a href="include/editCompetition.php?id=<?php echo $comp_id; ?>"
                                        class="edit_btn">Edit</a> </td>
                                <td> <a id="delete_event_btn" class="delete_btn"
                                        onclick="getconfirm( <?php echo $comp_id; ?> );">Delete</a> </td>
                            </tr>

                            <?php
                                }
                                //onclick=("getconfirm(<?php echo $result['Competition_Id']; 
                            }
                            ?>

                        </tbody>
                    </table>

                </section>

            </div>

            <div id="registered_students" class="tabcontent">

                <section class="registered_students" id="">

                    <section class="show_information">

                        <table class="competition_detail_table">
                            <thead>
                                <tr>
                                    <th>Team Name</th>
                                    <th>Email</th>
                                    <th>Members</th>
                                    <th>Competition</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT Competition_Name,Team_Name,Team_Email,No_Of_Participant FROM COMPETITION,Team WHERE Team.Competition_Id=Competition.Competition_Id";
                                $run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($run) > 0) {
                                    while ($result = mysqli_fetch_assoc($run)) {
                                        ?>

                                <tr>
                                    <td> <?php echo ($result['Team_Name']);   ?></td>
                                    <td> <?php echo ($result['Team_Email']);  ?></td>
                                    <td> <?php echo ($result['No_Of_Participant']);  ?></td>
                                    <td> <?php echo ($result['Competition_Name']);  ?></td>
                                </tr>

                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </section>

                </section>

            </div>

            <!-- GENERATE REPORT HTML -->

            <div id="report" class="tabcontent">
                <section>
                    <table class="competition_detail_table">
                        <thead>
                            <tr>
                                <th>Competition Category</th>
                                <th>Competition Name</th>

                                <th>Create PDF report</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select Competition_Category,Competition_Name,Competition_Id from competition";
                            $run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($run) > 0) {
                                while ($result = mysqli_fetch_assoc($run)) {
                                    ?>

                            <tr>
                                <td> <?php echo ($result['Competition_Category']);   ?></td>
                                <td> <?php echo ($result['Competition_Name']);  ?></td>

                                <td> <a href="pdf/createreport.php?id=<?php echo $result['Competition_Id']; ?>"
                                        class="edit_btn">Pdf report</a></td>
                            </tr>

                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </section>
            </div>

        </main>


        <footer>

        </footer>
    </div>





    <script src="JS/admin.js"></script>
    <script src="JS/validations.js"></script>
    <script src="JS/sweetalert.js"></script>
</body>

</html>