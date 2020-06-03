<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Redirecting</title>
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
$phNO=$_POST['phoneNumber'];
$mail=$_POST['mail'];
$pswd=$_POST['psw'];
$qst=$_POST['question'];
$ans=$_POST['answer'];
$hpswd=md5($pswd);
$hans=md5($ans);

$stmt="insert into patientreg(PatientID,FirstName,LastName,Gender,DOB,PhoneNumber,registerdate) values(NULL,'$firstname','$lastname','$gender','$dob','$phNO',curdate());";
if($con->query($stmt)!==TRUE)
{
	echo '1';
	header("refresh:10; url=fail.html");
}
else{
$stmt1="insert into patientlog(PatientID,Email,Password,Question,Answer,LastLogin) values(last_insert_id(),'$mail','$hpswd','$qst','$hans',now());";
if($con->query($stmt1)!==TRUE)
{
	$message="Already this email exist!";
	echo"<script type='text/javascript'>alert('$message');</script>";
	
	}
else{
header("refresh:0; url=trylogin.html");
}
}
$con->commit();
?>
</body>
</html>