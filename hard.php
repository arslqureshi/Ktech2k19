<?php
include "Include/Connection.php";
$sql = "SELECT Organizer_Name,Organizer_Image,COMPETITION.Competition_Id,Competition_Name,SUBSTRING(Competition_Description,1,25) AS Competition_Description FROM COMPETITION INNER JOIN Organizer ON Competition.Competition_Id=Organizer.Competition_Id AND LOWER(Competition_Category)=LOWER('hardware')";
$run = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/mainPagestyle.css">
    <title>KTECH | Hardware</title>
</head>

<body>

    <div id="mainContainer">
        <!--Main Navigation-->
        <header>

            <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">

                <div class="navItems">
                    <a class="navbar-brand" href="#"> <img id="ktechLogo" src="images/logo.png"></a>

                    <div id="registerButtonDiv" class="registerButtonContainer text-right">
                        <a href="registrationForm.php"> <button class="btn btn-primary btn-md">Register</button> </a>
                    </div>
                </div>

            </nav>

            <div class="view intro-2 customeView">
                <div class="full-bg-img">
                    <div class="mask rgba-indigo-slight flex-center">
                        <div class="container">
                            <div class="col-md-12 text-center">
                                <h1 class="display-4 font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInUp"><span
                                        class="indigo-text font-weight-bold">Hardware</span> Events</h1>

                                <h5 class="pt-md-5 pt-sm-2 pt-5 pb-md-5 pb-sm-3 pb-5 wow fadeInUp"
                                    data-wow-delay="0.2s">It comes
                                    with a lot of new features, easy to follow videos and images. Check it out now!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </header>
        <!--Main Navigation-->

        <!-- Testimonial starts -->

        <div id="testimonialContainer">


            <!-- Section: Testimonials v.2 -->
            <section class="text-center">

                <div class="wrapper-carousel-fix">
                    <!-- Carousel Wrapper -->
                    <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide carousel-fade"
                        data-ride="carousel" data-interval="false">
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="testimonial">
                                    <!--Avatar-->
                                    <div class="avatar mx-auto mb-4">
                                        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg"
                                            width="250px" height="250px" class="rounded-circle img-fluid"
                                            alt="First sample avatar image">
                                    </div>
                                    <!--Content-->
                                    <p>
                                        <i class="fas fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur
                                        adipisicing elit. Quod
                                        eos
                                        id officiis hic tenetur quae quaerat ad velit ab. Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipisicing elit. Dolore cum accusamus eveniet molestias voluptatum inventore
                                        laboriosam labore
                                        sit, aspernatur praesentium iste impedit quidem dolor veniam.
                                    </p>
                                    <h4 class="font-weight-bold">Anna Deynah</h4>
                                    <h6 class="font-weight-bold my-3 indigo-text">Secretary Hardware</h6>
                                </div>
                            </div>
                            <!--First slide-->
                        </div>
                        <!--Slides-->
                    </div>
                    <!-- Carousel Wrapper -->
                </div>

            </section>
            <!-- Section: Testimonials v.2 -->


        </div>
        <!-- Testimonial Ends -->

        <!-- Competition Categoires -->

        <div id="competitionContainer">

            <div class="text-center">

                <div class="col-md-12 text-center">
                    <!-- Section heading -->
                    <h2 class="h1-responsive font-weight-bold my-5"><span
                            class="indigo-text font-weight-bold">Competition</span> Categories</h2>
                    <!-- Section description -->
                    <p class="lead grey-text w-responsive mx-auto mb-5">The ultimate victory in competition is derived
                        from the inner satisfaction of knowing that you have done your best and that you have gotten the
                        most out of what you had to give.
                    </p>
                </div>

            </div>

            <div id="cardContainer">

                <?php 
                 $i = 0;
                 
                 while ($result = mysqli_fetch_assoc($run)) {
                     if($result==NULL)
                     {
                         break;
                     }
                     $i++;   
                     $id = $result['Competition_Id'];
                     $sql = "SELECT competition_date,Organizer_Name,Organizer_Cell_No,Organizer_Image,Co_Organizer_Name,Co_Organizer_Cell_No,Co_Organizer_Image,Supervisor_Name,Supervisor_Image,Competition_Description,Competition_Rules FROM ORGANIZER,COORGANIZER,SUPERVISOR,COMPETITION WHERE COMPETITION.COMPETITION_Id='$id'
                     AND ORGANIZER.Competition_Id=$id AND COORGANIZER.Competition_Id=$id AND SUPERVISOR.Competition_Id=$id"; 
                     $execute=mysqli_query($conn,$sql);
                     $data=mysqli_fetch_assoc($execute);
                     
                    //  <!-- Card -->
                    echo '<div class="card hoverable customeCard" id="myCard' . $i .'">
     
                        
                         <div class="view overlay">
                             <img class="card-img-top" src="Include/' . $result['Organizer_Image'] . '" alt="Organizer_Image" width="200px" height="200px">
                            
                                 <div class="mask rgba-white-slight"></div>
                            
                         </div>
     
                        
                         <div class="card-body">
     
                        
                             <h4 class="text-uppercase indigo-text"><strong>' . $result['Competition_Name'] . '</strong></h4>
     
                             <p class="cardText text-uppercase">'. $result['Organizer_Name'] .'</p>
                             

                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal'.$i.'">
                             More Information
                           </button>

                            
                            <div class="modal fade" id="basicExampleModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-fluid" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">' . $result['Competition_Name'] . '</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
            <div class="heading_wrapper">
            <h3>Organizing Team</h3>
            </div>


    <div class="organizing_team">




    <div id="TeamContainer">

            <div id="teamCardConatiner">


                <!-- Section: Team v.1 -->
                <section class="team-section text-center my-5">

                    <!-- Grid row -->
                    <div class="row" id="customeGrid">

                        <!-- Grid column -->
                        <div class="memberCard col-lg-4 col-md-12 mb-lg-0 mb-5">
                            <div class="avatar mx-auto">
                                <img src="include/' . $data["Supervisor_Image"] . '" width="200px" height="200px"
                                    class="rounded-circle z-depth-1" alt="Sample avatar">
                            </div>
                            <h5 class="font-weight-bold mt-4 mb-3">' . $data["Supervisor_Name"] . '</h5>
                            <p class="text-uppercase indigo-text"><strong>Event Coordinator</strong></p>

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="memberCard col-lg-4 col-md-12 mb-lg-0 mb-5">
                            <div class="avatar mx-auto">
                                <img src="include/' . $data["Organizer_Image"] . '" width="200px" height="200px"
                                    class="rounded-circle z-depth-1" alt="Sample avatar">
                            </div>
                            <h5 class="font-weight-bold mt-4 mb-3">' . $data["Organizer_Name"] . '</h5>
                            <h5 class="font-weight-bold mt-4 mb-3">' . $data["Organizer_Cell_No"] . '</h5>
                            <p class="text-uppercase indigo-text"><strong>Event Organizer</strong></p>
                            
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="memberCard col-lg-4 col-md-12 mb-md-0 mb-5">
                            <div class="avatar mx-auto">
                                <img src="include/' . $data["Co_Organizer_Image"] . '" width="200px" height="200px"
                                    class="rounded-circle z-depth-1" alt="Sample avatar">
                            </div>
                            <h5 class="font-weight-bold mt-4 mb-3">' . $data["Co_Organizer_Name"] . '</h5>
                            <h5 class="font-weight-bold mt-4 mb-3">' . $data["Co_Organizer_Cell_No"] . '</h5>
                            <p class="text-uppercase indigo-text"><strong>Event Co-Organizer</strong></p>

                        </div>
                        <!-- Grid column -->
                        
                    </div>
                    <!-- Grid row -->

                </section>
                <!-- Section: Team v.1 -->


            </div>

        </div>

    </div>
    <div class="heading_wrapper">
    <h2 class="h2-responsive indigo-text font-weight-bold my-5">Description</h2>
    </div>


    <div class="description text-left">
        <pre class="lead">' . $data['Competition_Description'] . '</pre>
    </div>

    <div class="heading_wrapper">
    <h2 class="h2-responsive indigo-text font-weight-bold my-5">Rules</h2>
    </div>


    <div class="Rules text-left">
        <pre class="lead my-5">' . $data['Competition_Rules'] . '</pre>
    </div>

    <div class="heading_wrapper">
    <h2 class="h2-responsive indigo-text font-weight-bold my-5">Judges</h2>
    </div>


    <div class="judges">';


    $sql_for_judge = "SELECT * FROM JUDGE WHERE JUDGE_Id IN (SELECT JUDGE_Id FROM Competition_Judge WHERE Competition_judge.Competition_Id=$id)";
    $execute = mysqli_query($conn, $sql_for_judge);
    if (mysqli_num_rows($execute) > 0) {
        echo ' <!-- Grid row -->
        <div class="row" id="customGrid">';
        while ($data = mysqli_fetch_assoc($execute)) {
            echo ' <!-- Grid column -->
            <div class="memberCard col-lg-4 col-md-12 mb-lg-0 mb-5">
                <div class="avatar mx-auto">
                    <img src="include/' . $data["JUDGE_Image"] . '" width="200px" height="200px"
                        class="rounded-circle z-depth-1" alt="Sample avatar">
                </div>
                <h5 class="font-weight-bold mt-4 mb-3">' . $data["JUDGE_Name"] . '</h5>

            </div>
            <!-- Grid column -->';
        }

    }

        echo '</div></div>'; //Closing div tag of div with class judges and grid row
                                
                                
                                
                               echo '</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
     
     
                         </div>
     
                     </div>';
                    //  <!-- Card -->
                 }
            ?>



            </div>

        </div>
        <!-- Competition Categories closed -->


        <!-- Footer starts -->

        <div id="footerContainer">
            <!-- Footer -->
            <footer class="page-footer font-small indigo pt-4">

                <!-- Footer Elements -->
                <div class="container">

                    <!-- Social buttons -->
                    <ul class="list-unstyled list-inline text-center">
                        <li class="list-inline-item">
                            <a class="btn-floating btn-fb mx-1">
                                <i class="fab fa-facebook-f"> </i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-tw mx-1">
                                <i class="fab fa-twitter"> </i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-gplus mx-1">
                                <i class="fab fa-google-plus-g"> </i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-li mx-1">
                                <i class="fab fa-linkedin-in"> </i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn-floating btn-dribbble mx-1">
                                <i class="fab fa-dribbble"> </i>
                            </a>
                        </li>
                    </ul>
                    <!-- Social buttons -->

                </div>
                <!-- Footer Elements -->

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© 2018 Copyright:
                    <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
                </div>
                <!-- Copyright -->

            </footer>
            <!-- Footer -->
        </div>

        <!-- footer ends -->

    </div>


    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/js/mdb.min.js">
    </script>


</body>

</html>