<?php
include "Include/Connection.php";
$sql = "SELECT Organizer_Name,Organizer_Image,COMPETITION.Competition_Id,Competition_Name,SUBSTRING(Competition_Description,1,25) AS Competition_Description FROM COMPETITION INNER JOIN Organizer ON Competition.Competition_Id=Organizer.Competition_Id AND LOWER(Competition_Category)=LOWER('hardware')";
$run = mysqli_query($conn, $sql);
?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hardware | Ktech</title>
    <link href="CSS/full_page_custom.css" rel="stylesheet">
    <link href="CSS/events_page.css" rel="stylesheet">
    <link href="CSS/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/mdb.min.css"> -->

</head>

<body>
    <!-- The video -->
    <video autoplay muted loop id="myVideo">
        <source src="../Ktech/videos/Network.mp4" type="video/mp4">
    </video>


    <div id="fullpage">



        <div class="section" id="home">

            <div class="header">
                <div class="logo">
                    <img src="images/logo.png" alt="logo" width="100%" height="100%">
                </div>
                <h3>KTECH</h3>
                <div class="register_button">
                    <a href="registrationForm.php">Register</a>
                </div>
            </div>


            <div class="landing">

                <div class="landing_heading">
                    <h1>Hardware EVENTS</h1>

                </div>

                <div class="landing_para">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime qui molestias consequuntur. </p>

                </div>

                <div class="landing_logo">
                    <img src="images/logo.png" alt="Ktech Logo" width="100%" height="100%">
                </div>

            </div>

        </div>

        <div class="section" id="events">


            <div class="event_container">
                <div class="back_heading">
                    <h1>Hardware</h1>
                </div>

                <?php



                while ($result = mysqli_fetch_assoc($run)) {


                    echo '<div class="cards" onclick="openModal(' . $result['Competition_Id'] . ')">
                    <div class="organizer_name">
                        <h3>' . $result['Organizer_Name'] . '</h3>
                    </div>

                    <div class="organizer_image">
                        <img src="Include/' . $result['Organizer_Image'] . '" alt="Organizer_Image">
                    </div>

                    <div class="event_name">
                        <h4>' . $result['Competition_Name'] . '</h4>
                    </div>

                    <div class="event_description">
                        <p>' . $result['Competition_Description'] . '...</p>
                    </div>

                </div>';
                }

                ?>

                <!-- <div class="cards">
                    <div class="organizer_name">
                        <h2>Orgainzer Name Here</h2>
                    </div>

                    <div class="organizer_image">
                        <img src="images/#.jpg" alt="Organizer_Image">
                    </div>

                    <div class="event_name">
                        <h2>Software Project Exhibition</h2>
                    </div>

                    <div class="event_description">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla odit culpa alias dicta aliquam quam.</p>
                    </div>

                </div> -->

            </div>

            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content" id="myModalContent">
                    <!-- <div class="modal_header">
                        <span class="close" id="close_btn" onclick="closeModal()">&times;</span>
                    </div> -->


                    <!-- <div class="heading_wrapper">
                        <h3>Organizing Team</h3>
                    </div>


                    <div class="organizing_team">

                        <div class="organizing_team_details supervisor">
                            <img src="images/avatar.jpg" alt="">
                            <h4>Name</h4>
                        </div>

                        <div class="organizing_team_details organizer">
                            <img src="images/avatar.jpg" alt="">
                            <h4>Name</h4>
                            <h5>111-222-3333</h5>
                        </div>

                        <div class="organizing_team_details co_organizer">
                            <img src="images/avatar.jpg" alt="">
                            <h4>Name</h4>
                            <h5>111-222-3333</h5>
                        </div>

                    </div>
                    <div class="heading_wrapper">
                        <h3>Description</h3>
                    </div>


                    <div class="description">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, et. Distinctio vero velit porro cum molestiae natus quo asperiores voluptatem cupiditate, assumenda minus! Sint dolore recusandae nesciunt sit optio temporibus laudantium magnam accusantium sed non itaque nobis est officia eligendi, facilis eos tempore ratione repudiandae laboriosam, quibusdam voluptatibus. Ducimus, inventore esse. Accusantium reprehenderit aliquid unde eaque consequatur culpa earum quidem fugiat eius. Officiis excepturi quia, distinctio eligendi esse voluptatibus, amet nemo nisi sapiente aliquam sequi nam aut iste rerum harum. Accusantium illo sunt non omnis doloribus. Aliquid exercitationem corrupti error atque ipsam voluptate velit delectus minima. Magni, velit! Qui, distinctio.</p>
                    </div>

                    <div class="heading_wrapper">
                        <h3>Rules</h3>
                    </div>


                    <div class="Rules">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis consectetur dolor vero quo provident sunt assumenda quia hic voluptates ea delectus beatae totam voluptas consequatur ipsa placeat, deserunt explicabo obcaecati libero ab nesciunt eum! In voluptatibus commodi, id, totam dolores, omnis eius dolorem ipsa voluptate nostrum deleniti. Facere, qui officia.</p>
                    </div>

                    <div class="heading_wrapper">
                        <h3>Judges</h3>
                    </div>


                    <div class="judges">
                        <div class="judge_details">
                            <img src="images/avatar.jpg" alt="">
                            <h4>Name</h4>
                        </div>
                    </div> -->

                </div>

            </div>


        </div>

    </div>

    <script src="JS/jquery.js"></script>
    <script src="JS/scrolloverflow.min.js"></script>
    <script src="JS/mdb.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/popper.min.js"></script>
    <script src="JS/fullpage.js"></script>
    <script src="JS/fontawesome.js"></script>
    <script src="JS/events_page.js"></script>

</body>

</html>