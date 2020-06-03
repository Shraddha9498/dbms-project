<?php
session_start();
require_once "connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png">
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
				<a class="navbar-brand" href="index.php"><B>BOOK MY DOCTOR</B></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="index.html">Logout</a></li>

					<?php


					if (isset($_SESSION['personID'])) {

						//logged in
						echo '
							<li><a href="person/profile.php">My Profile</a></li>
							<li><a href="logout.php">Log Out</a></li>';
					}
                    else {

						//not logged in
						echo '
							<li><a href="trylogin.html">Log In</a></li>
							<li><a href="trysignup.html">Sign Up</a></li>';
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

		<?php
			$doctorID = $_GET["doctorID"];
			$sql = "select * from docreg where DoctorID = '$doctorID';";
			$result = $conn->query($sql);

			if($row = $result->fetch_assoc()) {

		        $firstName = $row["FirstName"];
		        $lastName = $row["LastName"];
		        $gender = $row["Gender"];
		        $phone = $row["PhoneNumber"];
		        $qualification = $row["Qualification"];
		        $department = $row['Department'];
		        $experience = $row["Experience"];
		        $fee = $row["Fee"];
			}
			$conn->close();
		?>

		<div class="media thumb">
            <div class="media-body b">
                <div class="row"><div class="col-md-12">
                    <h3 class="media-heading">
                    <?php echo "Dr. ".$firstName." ".$lastName;?></h3>
                    <br>
                </div></div>
                <div class="row">

                <div class="col-md-5"><h4>
                	  <div class="col-md-7"><h4>
                	  	<form action="booking.php" method="GET">
                <p>Gender:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $gender;?></p>
                <p>Phone Number:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $phone;?> </p>
               	<p>Qualification:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $qualification;?></p>
                <p>Department:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $department;?> </p>
                <p>Experience:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $experience."years";?></p>
                <p>Fee:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "&#8377; ".$fee;?></p></h4>
                 </form>
                </div>
                </div>
                </div>
                <br>
                <br>
                <div class="row">
                   
                	<div class="col-md-2">
                <br>
                <br>
                <br>
                <a href="booking.php?doctorID=<?php echo $doctorID; ?>"><span class="btn btn-i btn-danger"style="color: #ffffff; border-color: #000000; background-color: #000000;">
                Book &rsaquo;&rsaquo;
                </span></a>
                </div>
                </div>

            </div>
        </div><br>
        </div></div>
    </div>
</body>
</html>
