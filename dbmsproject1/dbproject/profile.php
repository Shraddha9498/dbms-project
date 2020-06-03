<?php

session_start();

//require_once "connect.php";
$con=mysqli_connect('127.0.0.1','root','','mybmd');
if(!$con)
{
	header("refresh:10; url=fail.html");
}

if (!isset($_SESSION['DoctorID'])) {

	header("Location: doclog.html");
	exit();
}

$sql_doctor = $_SESSION['DoctorID'];
$sql = "select * from docreg where DoctorID = '$sql_doctor';";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$first = $row['FirstName'];
$last = $row['LastName'];
$phone = $row['PhoneNumber'];

$sql2 = "select * from today where DoctorID = '$sql_doctor';";
$result2 = $con->query($sql2);

$sql3="select * from history where doctorID = '$sql_doctor';";
$result3 = $con->query($sql3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BOOK MY DOCTOR - DOCTOR PROFILE</title>
	<link rel="stylesheet" type="text/css" href="docstyle.css">
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
</head>
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
				<a class="navbar-brand" href="../index.php">Book my Doctor</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="dochome.html">Home</a></li>

					<?php

					if (isset($_SESSION['DoctorID'])) {

						//logged in
						echo '
							<li class="active"><a href="profile.php">My Profile</a></li>
							<li><a href="../includes/doctor-logout.php">Log Out</a></li>';
					}
					else {
						echo '
						<li><a href="../index.php">Patients</a></li> ';
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
		<div class="panel panel-danger" style="border-color: #cccccc;">
			<div class="panel-heading" style="color: #ffffff; border-color: #cccccc; background-color: black;">
				<h4 style="text-align: center;">Your Profile</h4>
			</div>
			<div class="panel-body">

				<p align="right"><?php echo "Last Login: ".$_SESSION['LastLogin'] ?></p>

				<h2><?php echo "Welcome Dr. ".$first." ".$last ?></h2>
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

						echo "<h2>No Upcoming Appointments!</h2>";
					}
					else {
						echo '
				  <h2>Your Upcoming Appointments</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Patient Name</th>
				        <th>Status</th>
				        <th>Manage</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result2->fetch_assoc()) {
				    	$sql_person = $row['PatientID'];
				    	$sql4 = "select FirstName, LastName from patientreg where PatientID = '$sql_person';";
						$result4 = $con->query($sql4);
						$row2 = $result4->fetch_assoc();

				    echo "<tr>
				        <td>".$row['BookingID']."</td>
				        <td>".$row['AppointmentDate']."</td>
				        <td>".$row['Slot']."</td>
				        <td>".$row2['FirstName']." ".$row2['LastName']."</td>
				        <td>".$row['BookingStatus']."</td>
				        <td>";
				    if ($row['BookingStatus'] === 'Booked') {

				    echo "<a href='doctor-cancel.php?BookingID=".$row['BookingID']."'>
				    	<span>Cancel</span></a>";
				    }
				    else if ($row['BookingStatus'] === 'Cancelled') {

				    echo "<a>
				    	<span class='disabled'>Cancel</span></a>";
				    }
				    echo "</td>
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

						echo "<h2>No Past Appointments!</h2>";
					}
					else {
						echo '
				  <h2>Your Past Appointments</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Patient Name</th>
				        <th>Status</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result3->fetch_assoc()) {
				    	$sql_person = $row['PatientID'];
				    	$sql5 = "select FirstName, LastName from patientreg where PatientID = '$sql_person';";
						$result5 = $conn->query($sql5);
						$row2 = $result5->fetch_assoc();

				    echo "<tr>
				        <td>".$row['BookingID']."</td>
				        <td>".$row['AppointmentDate']."</td>
				        <td>".$row['Slot']."</td>
				        <td>".$row2['FirstName']." ".$row2['LastName']."</td>
				        <td>".$row['BookingStatus']."</td>
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
