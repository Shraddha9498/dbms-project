<?php

session_start();

//require_once "../includes/connect.php";
$con=mysqli_connect('127.0.0.1','root','','mybmd');
if(!$con)
{
	header("refresh:10; url=fail.html");
}

if (!isset($_SESSION['PatientID'])) {

	header("Location: ../index.php");
	exit();
}

$sql_person = $_SESSION['PatientID'];
$sql = "select * from patientreg where PatientID = '$sql_person';";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$first = $row['FirstName'];
$last = $row['LastName'];
$phone = $row['PhoneNumber'];

$sql2 = "select * from today where PatientID = '$sql_person';";
$result2 = $con->query($sql2);

$sql3="select * from history where patientID = '$sql_person';";
$result3 = $con->query($sql3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BOOK MY DOCTOR - Profile</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>



</head>
<style>
body{
	scroll-behavior: smooth;
	overflow-x: hidden;
}
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
				<a class="navbar-brand" href="../index.php">BOOK MY DOCTOR</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../index.php">Home</a></li>

					<?php

					if (isset($_SESSION['PatientID'])) {

						//logged in
						echo '
							<li class="active"><a href="profile.php">My Profile</a></li>
							<li><a href="person-logout.php">Log Out</a></li>';
					}
					else {
						// logged out
						echo '
							<li><a href="doctor.php">Doctors</a></li>';
					}
					?>

				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;"></nav>

	<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading" style="background-color: black;">
				<h4 style="text-align: center;">Your Profile</h4>
			</div>
			<div class="panel-body">

				<p align="right"><?php echo "Last Login: ".$_SESSION['LastLogin'] ?></p>

				<h2><?php echo "Welcome ".$first." ".$last ?></h2>
				<div class="row">

				<div class="col-md-3">
				<h4>Email: </h4>
				<h4>Phone Number: </h4>
				</div>

				<div class="col-md-9">
				<h4><?php echo $_SESSION['Email'] ?></h4>
				<h4><?php echo $phone ?></h4>
				</div>

				</div>
				<hr>
				<div>
				<?php
					if ($result2->num_rows < 1) {

						echo "<h2>No Upcoming Bookings!</h2>";
					}
					else {
						echo '
				  <h2>Your Upcoming Bookings</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Booking Date</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Doctor Name</th>
				        <th>Status</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result2->fetch_assoc()) {
				    	$sql_doctor = $row['DoctorID'];
				    	$sql4 = "select FirstName, LastName from docreg where DoctorID = '$sql_doctor';";
						$result4 = $con->query($sql4);
						$row2 = $result4->fetch_assoc();

				    echo "<tr>
				        <td>".$row['BookingID']."</td>
				        <td>".$row['BookingDate']."</td>
				        <td>".$row['AppointmentDate']."</td>
				        <td>".$row['Slot']."</td>
				        <td>"."Dr. ".$row2['FirstName']." ".$row2['LastName']."</td>
				        <td>".$row['BookingStatus']."</td>
				      </tr>";
				    }
					}
				    ?>
				    </tbody>
				  </table>
				</div>

                <div>
                <?php
					if ($result3->num_rows < 1) {

						echo "<h2>No Past Bookings!</h2>";
					}
					else {
						echo '
				  <h2>Your Past Bookings</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Booking Date</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Doctor Name</th>
				        <th>Status</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result3->fetch_assoc()) {
				    	$sql_doctor = $row['doctorId'];
				    	$sql5 = "select FirstName, LastName from docreg where DoctorID = '$sql_doctor';";
						$result5 = $con->query($sql5);
						$row2 = $result5->fetch_assoc();

				    echo "<tr>
				        <td>".$row['bookingId']."</td>
				        <td>".$row['bookingDate']."</td>
				        <td>".$row['appointmentDate']."</td>
				        <td>".$row['slot']."</td>
				        <td>"."Dr. ".$row2['FirstName']." ".$row2['LastName']."</td>
				        <td>".$row['bookingStatus']."</td>
				      </tr>";
				    }
					}
				    ?>
				    </tbody>
				  </table>
				</div>



			</div>
		</div>
	</div>
	<div class="col-md-3"></div>

	</body>
	</html>
