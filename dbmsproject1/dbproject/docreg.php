<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Redirecting</title>
<style type="text/css" ></style>
</head>
<body>
<?php
$con=mysqli_connect('127.0.0.1','root','','mybmd');
if(!$con)
{
	header("refresh:10; url=fail.html");
}
$firstname=$_POST['firstName'];
$lastname=$_POST['lastName'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$phNO=$_POST['mobilenumber'];
$mail=$_POST['mail'];
$pswd=$_POST['psw'];
$qst=$_POST['question'];
$ans=$_POST['answer'];
$hpswd=md5($pswd);
$hans=md5($ans);
$qual=$_POST["qualification"];
$dep=$_POST["dep"];
$bid=$_POST["BuildingID"];
$exp=$_POST["exp"];
$fee=$_POST["fee"];
$stmt="insert into docreg(DoctorID,FirstName,LastName,Gender,DOB,PhoneNumber,Registerdate,Qualification,Department,Experience,Fee) values(NULL,'$firstname','$lastname','$gender','$dob','$phNO',curdate(),'$qual','$dep','$exp','$fee');";
if($con->query($stmt)!==TRUE)
{
	echo '1';
	header("refresh:10; url=fail.html");
}
else{
$stmt1="insert into doclog(DoctorID,Email,Password,Question,Answer,LastLogin) values(last_insert_id(),'$mail','$hpswd','$qst','$hans',now());";
if($con->query($stmt1)!==TRUE)
{
	$message="Already this email exist!";
	echo"<script type='text/javascript'>alert('$message');</script>";
	
	}
else{
header("refresh:0; url=doclog.html");
}
}
$con->commit();
?>
</body>
</html>