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
$sql="select * from doclog where Email='$mail';";
$result=$con->query($sql);
if($result->num_rows < 1){
	$_SESSION['invalid_login']=1;
	header("refresh:10; url=fail.html");
	exit();
}
if($row=$result->fetch_assoc())
{
	$hashedpassword=md5($pswd);
	if($hashedpassword !== $row['Password']){
		$_SESSION['invalid_login'] = 1;
		header("refresh:10; url=fail.html");
		echo 'Password incorrect!!!!';
		exit ();
    }
    $pid = $row['DoctorID'];  
    $sql= "update `doclog` set `LastLogin` =now() where `DoctorID`= '$pid';";
    $result=$con->query($sql);
    $_SESSION['DoctorID']=$row['DoctorID'];
    $_SESSION['Email']=$row['Email'];
    $_SESSION['LastLogin']=$row['LastLogin'];
    $_SESSION['login']= 1;
    echo 'login succesfull';
 if($_SESSION['login']==1)
 header("refresh:3; url=profile.php");

}   
?>

</body>
</html>