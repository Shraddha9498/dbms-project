<?php

session_start();

?>
<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>redirecting</title>
</head>
<body>
<?php
$con=mysqli_connect('127.0.0.1','root','','mybmd');
if(!$con)
{
	header("refresh:10; url=fail.html");
}
$mail=$_POST['mail'];
$pswd=$_POST['psw'];
$sql="select * from Patientlog where Email='$mail';";
$result=$con->query($sql);
if($result->num_rows < 1){
	$_SESSION['notLogged']=1;
	header("refresh:10; url=fail.html");
	exit();
}
if($row=$result->fetch_assoc())
{
	$hashedpassword=md5($pswd);
	if($hashedpassword !== $row['Password']){
		$_SESSION['notLogged'] = 1;
		header("refresh:10; url=fail.html");
		echo 'Password incorrect!!!!';
		exit ();
    }
 
    $pid = $row['PatientID'];  
    $sql= "UPDATE `patientlog` set `LastLogin` =now() where `PatientID`= '$pid';";
    $result=$con->query($sql);
    $_SESSION['PatientID']=$row['PatientID'];
    $_SESSION['Email']=$row['Email'];
    $_SESSION['LastLogin']=$row['LastLogin'];
    $_SESSION['login']= true;
    header("refresh:0;url=checkbefore.html");
    


}
?>
</body>
</html>