<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>signupdoctor</title>
	<link rel="stylesheet" href="docstyle.css">

</head>
<body>
   <div class="signup-page">
   <div class="form">
   	<h2>Register</h2>
      <form class="login-form" action="docreg.php" method="POST">
     <label for="personID"><b>Doctor-id</b></label>
	<input  name="personID" readonly="personID">
	 <label for="firstName"><b>First Name</b></label>
	<input type="name" placeholder="Enter First Name" name="firstName" required>
	<label for="lastName"><b>Last Name</b></label>
	<input type="name" placeholder="Enter Last Name" name="lastName">
	<label for="gender"><b>Gender</b></label>
	<select required="1" name="gender">
		<option value="male">Male</option>
		<option value="female">Female</option>
	</select>
	<label for="dob"><b>DOB</b></label>
	<input type="date" placeholder="Enter your date of birth" name="dob">
	<label for="phoneNumber"><b>Phone Number</b></label>
	<input type="tel" placeholder="Enter your Phone Number" name="mobilenumber" pattern="[0-9]{10}" required>
	<label for="mail"><b>Email-id</b></label>
	<input type="email" placeholder= " Enter Email" name="mail" required>
	<label for="psw"><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="psw" required>
	<label for="Qualification"><b>Qualification</b></label>
	<input type="qualification" placeholder=" Enter qualification" name="qualification" required>
	<label for="dept"><b>Department</b></label>
	<select required="1" name="dep">
	<option value="pediatrician">Pediatrician</option>
	<option value="gynecologist">Gynecologist</option>
	<option value="dermatologist">Dermatologist</option>
	<option value="cardiologist">Cardiologist</option>
	<option value="veterinary">Veterinary</option>
</select>
<label for="BuildingID"><b>BuildingID</b></label>
<select required="1" name="BuildingID">
	<option value="hosp1" title="Apollo BGS Hospital">12</option>
	<option value="hosp2"title="Bharath Hospital and Institute Of Oncology">13</option>
	<option value="hosp3"title="JSS Hospital">14</option>
	<option value="hosp4"title="Columbia Asia Hospital">15</option>
	<option value="hosp5"title="Karuna Hospital">16</option>
	<option value="hosp6"title="Vikram Hospital and Heart Care">17</option>
	<option value="hosp7"title="Krishna Rajendra Hospital (KR Hospital)">18</option>
	<option value="hosp8"title="New Adarsha Hospital">19</option>
	<option value="hosp9"title="Leela Veterinary Hospital">20</option>
	<option value="hosp10"title="City Veterinary Hospital & Polyclinic">21</option>
</select>
<label for="experiance"><b>Experiance</b></label>
<input type="exp" placeholder="Enter Experiance" name="exp">
<label for="fee"><b>Fee</b></label>
<input type="fee" placeholder="Enter your consultation Fee" name="fee" pattern="[1-5][0-9][0-9]" required>



    <label for="question"><b>Security Question</b></label>
      <select required="1" name="question">
		<option value="1">Which is your favorite game?</option>
		<option value="2">Who is your role model?</option>
	  </select>
	 <label for="answer"><b>Security Answer</b></label>
	<input type="text" placeholder="Enter Answer" name="answer" required>
   

	<button>Create</button>
	<p class="message">Already Registered? <a href="http:doclog.html">Login</a></p>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js">
	
</script>
<script>
	$('.message a') .click(function(){
		$('form') .animate({height:"toggle",opacity:"toggle"},"slow");
	});
</script>
</body>
</html>