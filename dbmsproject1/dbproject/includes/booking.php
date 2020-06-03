<?php

session_start();

if (isset($_POST['bookedSlot'])) {
    
    //require_once "connect.php";
    $con=mysqli_connect('127.0.0.1','root','','mybmd');

    $slot=$con->real_escape_string($_POST['slot']);


if($slot=="slot1" || $slot=="slot2" || $slot=="slot3" || $slot=="slot4" || $slot=="slot5" || $slot=="slot6" || $slot=="slot7" || $slot=="slot8")
	$appointmentdate = date("Y-m-d", strtotime("+1 days"));

if($slot=="slot9" || $slot=="slot10" || $slot=="slot11" || $slot=="slot12" || $slot=="slot13" || $slot=="slot14" || $slot=="slot15" || $slot=="slot16")
	$appointmentdate = date("Y-m-d", strtotime("+2 days"));

if($slot=="slot17" || $slot=="slot18" || $slot=="slot19" || $slot=="slot20" || $slot=="slot21" || $slot=="slot22" || $slot=="slot23" || $slot=="slot24")
	$appointmentdate = date("Y-m-d", strtotime("+3 days"));

if($slot=="slot1" || $slot=="slot9" || $slot=="slot17")
	$appointmenttime="09:00:00";

if($slot=="slot2" || $slot=="slot10" || $slot=="slot18")
	$appointmenttime="10:00:00";

if($slot=="slot3" || $slot=="slot11" || $slot=="slot19")
	$appointmenttime="11:00:00";

if($slot=="slot4" || $slot=="slot12" || $slot=="slot20")
	$appointmenttime="12:00:00";

if($slot=="slot5" || $slot=="slot13" || $slot=="slot21")
	$appointmenttime="17:00:00";

if($slot=="slot6" || $slot=="slot14" || $slot=="slot22")
	$appointmenttime="18:00:00";

if($slot=="slot7" || $slot=="slot15" || $slot=="slot23")
	$appointmenttime="19:00:00";

if($slot=="slot8" || $slot=="slot16" || $slot=="slot24")
	$appointmenttime="20:00:00";

    $personID = $_SESSION['PatientID'];
    $doctorID = $_SESSION['bookedDoctor'];

    //start transaction
	$con->autocommit(FALSE);


    $sql = "insert into booking(BookingDate, AppointmentDate, PatientID, DoctorID, Slot, BookingStatus)
            values(curdate(),'$appointmentdate','$personID','$doctorID','$appointmenttime','Booked');";
	
    if ($con->query($sql) !== TRUE) {
        
		$con->rollback();
		header("Location: ../index1.php?booking=error");
		exit();
	}

    //commit transaction
	$con->commit();

	//enable autocommit
	$con->autocommit(TRUE);

    //start transaction
	$con->autocommit(FALSE);

    $_SESSION['appointmentdate'] = $appointmentdate;
    $_SESSION['appointmenttime'] = $appointmenttime;    

    $sql2 = "select BookingID from booking where AppointmentDate = '$appointmentdate' and PatientID = 
             '$personID' and DoctorID = '$doctorID' and Slot = '$appointmenttime';";
   $result = $con->query($sql2);
    // if ($conn->query($sql2) !== TRUE)
   //  {
    // 	echo "mad" ;
    //	echo $personID; echo $doctorID; echo $appointmenttime; echo $appointmentdate;

    // }
	
    if ($row = $result->fetch_assoc()) {

		$_SESSION['bookingID'] = $row['BookingID'];
	}

    //commit transaction
	$con->commit();

	//enable autocommit
	$con->autocommit(TRUE);


    header("Location: ../index1.php?booking=success");
	exit();
    
}
else {
    header("Location: ../index1.php");
	exit();
}
?>
