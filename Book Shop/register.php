<?php
//Create and check the connection
$conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);		//used to escape special characters in a string to make it safe for use in a MySQL query.
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));		//md5()-cryptographic hash function for security 
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
	   echo "<script type='text/javascript'>alert('user already exist!');</script>";
   }else{
      if($pass != $cpass){
		  echo "<script type='text/javascript'>alert('confirm password not matched!');</script>";
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>register</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">

   <!--css file link-->
   <link rel="stylesheet" href="styles/style.css">
   
    <script>
        function validateForm() {
            // Get form inputs
            var name = document.getElementsByName('name')[0].value;
            var email = document.getElementsByName('email')[0].value;
            var password = document.getElementsByName('password')[0].value;
            var cpassword = document.getElementsByName('cpassword')[0].value;
			
            // Validate name
            if (name.trim() === '') {
                alert('Please enter your name');
                return false;
            }

            // Validate email
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email.match(emailRegex)) {
                alert('Please enter a valid email address');
                return false;
            }

            // Validate password
            if (password.length < 4 || cpassword.length < 4) {
                alert('Password should be at least 4 characters long');
                return false;
            }

            // Form is valid
            return true;
        }
    </script>   

</head>
<body>
  
<div class="reg-form">

	<form onsubmit="return validateForm()" method="post">

		<table class="reg-table" >
			<tr>
				<td><h1>REGISTER NOW</h1></td>
			</tr>
			<tr>
				<td><input type="text" name="name" placeholder="Enter your name" required class="regForm-input"></td>
			</tr>	
			<tr>
				<td><input type="email" name="email" placeholder="Enter your email" required class="regForm-input"></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Enter your password" required class="regForm-input"></td>
			</tr>	
			<tr>
				<td><input type="password" name="cpassword" placeholder="Confirm your password" required class="regForm-input"></td>
			</tr>	
			<tr>
				<td>
					<select name="user_type" class="regForm-input">
						<option value="user">User</option>
						<option value="admin">Admin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Register Now" class="regForm-btn"></td>
			</tr>
			<tr>
				<td>already have an account? <a href="login.php">login now</a></td>
			</tr>	
		</table>
		
	</form>

</div>

</body>
</html>