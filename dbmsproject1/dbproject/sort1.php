<?php
session_start();
require_once "connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>BOOK MY DOCTOR- LOGIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="scripts/jquery.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
</head>
<style>
body{
  scroll-behavior: smooth;
  overflow-x: hidden;
}
.b{padding-left:15px;
padding-top:10px;}

.c{padding:3px;}
.a{margin-top:55px;}

.thumb{margin-top:2px;
border:1px solid black;
background-color:rgb(240, 240, 240);
}
 #footer{ margin-top:3px;
padding:10px;
border-top:1px solid DodgerBlue;
color: #eeeeee;
background-color: #211f22;
text-allign:centre;
}
.btn-i{ margin-right:25px; margin-bottom: 25px;float:right;}

</style>
<body>
    <!-- Bootstrap Navigation Bar Top -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbarTop">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">BOOK MY DOCTOR</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="signout.html">Logout</a></li>

					<?php

					if (isset($_SESSION['personID'])) {

						//logged in
						echo '
							<li><a href="person/profile.php">My Profile</a></li>
							<li><a href="includes/person-logout.php">Log Out</a></li>';
					}
                    else {

						//not logged in
						echo '
							<li><a href="person/login.php">Log In</a></li>
							<li><a href="person/signup.php">Sign Up</a></li>';
					}

					?>
				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;"></nav>

    <div class="container-fluid">
	<div class="container a">
	<div class="row">
		<div class="col-sm-9">

            <?php

                $x = $_GET["searchtext"];
               $sql1 = "select * from docreg where Department like '$x';";
               $result1 = $conn->query($sql1);

          
                                                                                        
                       

              
             
                //$result = mysqli_query("select * from doctor where department = '$x';");

                //$sql = "select * from doctor where department = '$x';";

                //$result = mysqli_query($conn, $sql);

                if ($result1->num_rows > 0) {
                    // output data of each row
                    while($row = $result1->fetch_assoc()) {
                        $firstName = $row["FirstName"];
                        $lastName = $row["LastName"];
                        $gender = $row["Gender"];
                        $experience = $row["Experience"];
                        $qualification = $row["Qualification"];
                        $fee = $row["Fee"];
                        $doctorID = $row["DoctorID"];
                        $departmentName=$row["Department"];
                       
                    ?>
                    <div class="media thumb">
                        <div class="media-body b">
                            <div class="row"><div class="col-md-12">
                                <h3 class="media-heading">
                                <?php echo "Dr. ".$firstName." ".$lastName;?></h3>
                                <br>
                            </div></div>
                            <div class="row">

                            <div class="col-md-3"><h4>
                                 <div class="col-md-7"><h4>
                            <p>Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $gender;?></p>
                           	<p>Qualification:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qualification;?></p>
                            <p>Department:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $departmentName;?></p>
		                    <p>Experience:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $experience."years";?></p>
                            <p>Fee:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "&#8377; ".$fee;?></p>
                            </h4>
                            

                         </div>                              
                        </div>
                            <div class="col-md-2">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a href="sort2.php?doctorID=<?php echo $doctorID; ?>"><span class="btn btn-i btn-danger" style="color: #ffffff; border-color: #000000; background-color: #000000;" >
                            VIEW &rsaquo;&rsaquo;
                            </span></a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <br>
           <?php   
               }
                }
                else {
                    echo "<h4>Your search - '$x' - did not match any doctors.</h4>";
                }

                $conn->close();
           ?>
           </div></div></div></div>
</body>
</html>
