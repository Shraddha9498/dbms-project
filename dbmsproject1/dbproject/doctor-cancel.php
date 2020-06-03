<?php

session_start();
require_once "connect.php";
$bookingID = $_GET['BookingID'];

$sql ="update booking set BookingStatus = 'Cancelled' where BookingID = $bookingID;";

if ($conn->query($sql) !== TRUE) {
        
		header("Location: doctor.php?cancel=error");
		exit();
}

header("Location: doctor.php?cancel=success");
exit();
?>


