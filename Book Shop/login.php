<?php
//Create and check the connection
$conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html>
<head>

	<title>login</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
	
   <!--css file link-->
   <link rel="stylesheet" href="styles/style.css">

    <script>
        function validateForm() {
            // Get form inputs
            var email = document.getElementsByName('email')[0].value;
            var password = document.getElementsByName('password')[0].value;
	
            // Validate email
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email.match(emailRegex)) {
                alert('Please enter a valid email address');
                return false;
            }

            // Validate password
            if (password.length < 4) {
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
				<td><h1>LOGIN NOW</h1></td>
			</tr>	
			<tr>
				<td><input type="email" name="email" placeholder="Enter your email" required class="regForm-input"></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Enter your password" required class="regForm-input"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Login Now" class="regForm-btn"></td>
			</tr>	
			<tr>
				<td>don't have an account? <a href="register.php">register now</a></td>
			</tr>				
		</table>
		
	</form>
   
</div>

</body>
</html>