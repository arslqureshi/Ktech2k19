<?php
include 'Connection.php';
session_start();
if (($_SESSION['Access']) != true) {
    header("Location:http://localhost/ktech/login.php");
}


$id = $_GET['id'];
$sql = "SELECT * FROM COMPETITION,SUPERVISOR,ORGANIZER,COORGANIZER,Judge WHERE COMPETITION.Competition_Id='$id' AND SUPERVISOR.Competition_Id='$id' AND ORGANIZER.Competition_Id='$id' AND COORGANIZER.Competition_Id='$id' ";
$run = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($run);

$total_judges_before = $result['Total_Judges'];
$total_judges_before = (int)$total_judges_before;
$sql = "SELECT  * FROM Judge WHERE Judge_Id IN (SELECT Judge_Id FROM Competition_Judge WHERE Competition_Id='$id')";
$run_judge_query = mysqli_query($conn, $sql);



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Information</title>
    <link href="../CSS/all.min.css" rel="stylesheet">
    <link href="../CSS/admin.css" rel="stylesheet">
</head>

<!-- <body onload="selectTotalJudges(<?php
                                        ?>)"> -->

<body>
    <section class="competition_details">

        <form action="update.php" method="post" enctype="multipart/form-data">
            <div class="competition_form">

                <h1>Edit Competition</h1>
                <input class="hidden" type="text" name="competition_id" value="<?php echo $result['Competition_Id'] ?>" readonly>
                <select name="competition_category" id="" required>
                    <option disabled value="">CHOOSE CATEGORY</option>
                    <option <?php if ($result['Competition_Category'] === 'software') echo ("selected");  ?> value="software"> Software </option>
                    <option <?php if ($result['Competition_Category'] === 'hardware') echo ("selected");  ?> value="hardware"> Hardware </option>
                    <option <?php if ($result['Competition_Category'] === 'co-curricular') echo ("selected");  ?> value="co-curricular"> Co-Curricular </option>
                </select>

                <input type="text" name="competition_name" id="competition_name" onchange="letterval(this.value,this.id);" value="<?php echo ($result['Competition_Name']);  ?>" placeholder="Name of Competition" required>

                <textarea name="competition_description" id="" cols="30" rows="10" placeholder="Description" required><?php echo ($result['Competition_Description']);  ?></textarea>

                <textarea name="competition_rules" id="" cols="30" rows="10" placeholder="Rules" required><?php echo ($result['Competition_Rules']);  ?></textarea>
                <div class="select_group">
                    <label for="">Memebers Per Team</label>
                    <select name="members_per_team" id="" required>
                        <option <?php if ($result['Members_Per_Team'] === '1') echo ("selected");  ?> value="1"> 1 </option>
                        <option <?php if ($result['Members_Per_Team'] === '2') echo ("selected");  ?> value="2"> 2 </option>
                        <option <?php if ($result['Members_Per_Team'] === '3') echo ("selected");  ?> value="3"> 3 </option>
                    </select>
                </div>

            </div>

            <div class="supervisor_form">

                <h1>Edit supervisor</h1>

                <input type="text" name="supervisor_name" id="supervisor_name" onchange="letterval(this.value,this.id)" value="<?php echo ($result['Supervisor_Name']);  ?>" placeholder="Name of Supervisor" required>

                <input type="text" name="supervisor_email" placeholder="Email of Supervisor" value="<?php echo ($result['Supervisor_Email']);  ?>" required>

                <div>
                    <input type="file" name="supervisor_image" value="<?php echo ($result['Supervisor_Image']);  ?>">
                </div>

            </div>

            <div class="organizer_form">

                <h1>Edit organizer</h1>

                <input type="text" name="organizer_name" id="organizer_name" onchange="letterval(this.value,this.id)" value="<?php echo ($result['Organizer_Name']);  ?>" placeholder="Name of organizer" required>

                <div class="reg_no_selection">
                    <?php
                    $reg = $result['Organizer_RegNo'];
                    $reg_year = substr($reg, 0, 3);
                    $reg_depart = substr($reg, 4, 4);
                    $reg_roll = substr($reg, 9);

                    ?>
                    <select name="organizer_reg_year" id="">
                        <option <?php if ($reg_year === '16S') echo ("selected");  ?> value="16S"> 16S </option>
                        <option <?php if ($reg_year === '16F') echo ("selected");  ?> value="16F"> 16F</option>
                        <option <?php if ($reg_year === '17S') echo ("selected");  ?> value="17S"> 17S </option>
                        <option <?php if ($reg_year === '17F') echo ("selected");  ?> value="17F"> 17F </option>
                        <option <?php if ($reg_year === '18S') echo ("selected");  ?> value="18S"> 18S </option>
                        <option <?php if ($reg_year === '18F') echo ("selected");  ?> value="18F"> 18F </option>
                        <option <?php if ($reg_year === '19S') echo ("selected");  ?> value="19S"> 19S </option>
                        <option <?php if ($reg_year === '19F') echo ("selected");  ?> value="19F"> 19F </option>
                    </select>

                    <select name="organizer_reg_department" id="">
                        <option <?php if ($reg_depart === 'BSCS') echo ("selected");  ?> value="BSCS">BSCS</option>
                        <option <?php if ($reg_depart === 'BSCE') echo ("selected");  ?> value="BSCE">BSCE</option>
                    </select>

                    <select name="organizer_reg_roll" id="">
                        <?php

                        for ($a = 1; $a <= 50; $a++) {
                            ?>
                            <option <?php if ((int)$reg_roll === $a) echo ("selected");  ?> value=" <?php echo ($a); ?> "><?php echo ($a); ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>

                <div>

                    <input type="text" name="organizer_cell_no" id="organizer_cell_no" onchange="numval(this.value,this.id)" value="<?php echo ($result['Organizer_Cell_No']);  ?>" placeholder="Cell Number">

                    <input type="file" name="organizer_image" value="<?php echo ($result['Organizer_Image']);  ?>">
                </div>

            </div>


            <div class="co_organizer_form">
                <?php
                $reg = $result['Co_Organizer_RegNo'];
                $reg_year = substr($reg, 0, 3);
                $reg_depart = substr($reg, 4, 4);
                $reg_roll = substr($reg, 9);
                ?>
                <h1>Edit Co-organizer</h1>

                <input type="text" name="co_organizer_name" id="co_organizer_name" onchange="letterval(this.value,this.id)" value="<?php echo ($result['Co_Organizer_Name']);  ?>" placeholder="Name of Co-organizer" required>

                <div class="reg_no_selection">
                    <select name="co_organizer_reg_year" id="">
                        <option <?php if ($reg_year === '16S') echo ("selected");  ?> value="16S"> 16S </option>
                        <option <?php if ($reg_year === '16F') echo ("selected");  ?> value="16F"> 16F</option>
                        <option <?php if ($reg_year === '17S') echo ("selected");  ?> value="17S"> 17S </option>
                        <option <?php if ($reg_year === '17F') echo ("selected");  ?> value="17F"> 17F </option>
                        <option <?php if ($reg_year === '18S') echo ("selected");  ?> value="18S"> 18S </option>
                        <option <?php if ($reg_year === '18F') echo ("selected");  ?> value="18F"> 18F </option>
                        <option <?php if ($reg_year === '19S') echo ("selected");  ?> value="19S"> 19S </option>
                        <option <?php if ($reg_year === '19F') echo ("selected");  ?> value="19F"> 19F </option>
                    </select>

                    <select name="co_organizer_reg_department" id="">
                        <option <?php if ($reg_depart === 'BSCS') echo ("selected");  ?> value="BSCS">BSCS</option>
                        <option <?php if ($reg_depart === 'BSCE') echo ("selected");  ?> value="BSCE">BSCE</option>
                    </select>

                    <select name="co_organizer_reg_roll" id="">
                        <?php

                        for ($a = 1; $a <= 50; $a++) {
                            ?>
                            <option <?php if ((int)$reg_roll === $a) echo ("selected");  ?> value=" <?php echo ($a); ?> "><?php echo ($a); ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>

                <div>

                    <input type="text" name="co_organizer_cell_no" id="co_organizer_cell_no" onchange="numval(this.value,this.id)" value="<?php echo ($result['Co_Organizer_Cell_No']);  ?>" placeholder="Cell Number">

                    <input type="file" name="co_organizer_image" value="<?php echo ($result['Co_Organizer_Image']);  ?>">
                </div>

            </div>


            <div class="judge_form">

                <h1>Edit Judge(s)</h1>

                <div class="select_group hidden">
                    <label for="">No. of Judges</label>
                    <select name="total_judges" id="total_judges">
                        <option <?php if ($result['Total_Judges'] === '0') echo ("selected");  ?> value="0"> 0 </option>
                        <option <?php if ($result['Total_Judges'] === '1') echo ("selected");  ?> value="1"> 1 </option>
                        <option <?php if ($result['Total_Judges'] === '2') echo ("selected");  ?> value="2"> 2 </option>
                        <option <?php if ($result['Total_Judges'] === '3') echo ("selected");  ?> value="3"> 3 </option>
                    </select>
                </div>

                <div id="judge_info">

                </div>
                <!-- <input type="text" name="judge_name" value="" placeholder="Name of Supervisor" required>

                        <input type="text" name="judge_rank" placeholder="Rank of Supervisor" required>

                        <input type="file" name="judge_image"> -->

            </div>
            <button onclick="add()">add</button>
            <input type="submit" name="update" class="submit_btn">
            <input type="reset" name="reset" value="Reset">
            <input type="submit" name="cancel" value="Cancel">
            <!-- <button type="submit" class="submit_btn" name="create_competition">Create</button> -->

        </form>


    </section>


    <!-- <script src="../JS/admin.js"></script> -->

    <!-- JAVASCRIPT USED IN THIS PAGE -->


    <script src="../JS/jquery.js"></script>
    <script src="../JS/validations.js"></script>
    <script>
        function add() {
            var number_of_judges = document.getElementById("total_judges").value;
            var remaining = 3 - number_of_judges;
            if (remaining > 0) {

                info_div = document.createElement("div");
                info_div.className = "judge_info_group";
                // document.getElementById("judge_info")
                info_div.innerHTML =
                    '<input type="text" name="judge_name' +
                    (parseInt(number_of_judges) + 1) + '" value="" placeholder="Name of Judge" id="judge_name' + (parseInt(number_of_judges) + 1) + '" onchange="letterval(this.value,this.id)" required>  <input type="text" name="judge_email' +
                    (parseInt(number_of_judges) + 1) +
                    '" placeholder="Email of Judge" required> <button id="delete_btn' + (parseInt(number_of_judges) + 1) + '" onclick="del(' + "delete_btn" + (parseInt(number_of_judges) + 1) + ')" >delete</button> <input type="file" name="judge_image' +
                    (parseInt(number_of_judges) + 1) +
                    '">  ';
                // info_div.addId("judge_info_group");
                document.getElementById("judge_info").appendChild(info_div);
                document.getElementById("total_judges").value = parseInt(number_of_judges) + 1;
            }
        }
        window.onload = function() {
            total = <?php echo $total_judges_before; ?>;
            var no_of_judges = 1;
            var id = 1;
            // for(var no_of_judges=1;no_of_judges<=parseInt(total);no_of_judges++){
            <?php
            while ($res =  mysqli_fetch_assoc($run_judge_query)) {
                ?>


                info_div = document.createElement("div");
                info_div.className = "judge_info_group";
                // document.getElementById("judge_info")
                info_div.innerHTML =
                    '<input type="text" name="judge_name' +
                    parseInt(no_of_judges) +
                    '" value="<?php echo $res['JUDGE_Name']; ?>" placeholder="Name of Judge" id="judge_name' + id + '" onchange="letterval(this.value,this.id)" required>  <input type="email" name="judge_email' +
                    parseInt(no_of_judges) +
                    '" placeholder="Email of Judge" value="<?php echo $res['Judge_email']; ?>" required> <button id="delete_btn' + parseInt(no_of_judges) + '" onclick="del(' + "delete_btn" + parseInt(no_of_judges) + ')" >delete</button> <input type="file" name="judge_image' +
                    parseInt(no_of_judges) +
                    '">  ';
                no_of_judges++;
                id++;
                // info_div.addId("judge_info_group");
                document.getElementById("judge_info").appendChild(info_div);
            <?php
        }
        ?>

            //}
            document.getElementById("total_judges").value = parseInt(total);
        }

        function del(delete_id) {
            $('#' + delete_id.id).parent().remove();
            number_of_judges = document.getElementById("total_judges").value;
            document.getElementById("total_judges").value = parseInt(number_of_judges) - 1;
            var remaining = document.getElementById("total_judges").value;
            count = 1;
            index = 0;
            skip = delete_id.id[10];
            for (var i = 1; i <= 3; i++) {
                if (i == skip) {
                    continue;
                } else {
                    $('#delete_btn' + i).attr('onclick', 'del(delete_btn' + count + ')');
                    $('#delete_btn' + i).attr('id', 'delete_btn' + count);
                    $(".judge_info_group")[index].children[0].name = "judge_name" + count;
                    $(".judge_info_group")[index].children[1].name = "judge_email" + count;
                    $(".judge_info_group")[index].children[3].name = "judge_image" + count;
                }
                count++;
                index++;
            }

        }
    </script>
</body>

</html>