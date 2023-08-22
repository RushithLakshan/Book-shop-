<?php
session_start();	//need to pass user details through web pages
$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

$name="";
$number="";
$email="";
$textMessage="";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	
	$name=$_POST["name"];
	$number=$_POST["number"];
	$email=$_POST["email"];
	$textMessage=$_POST["message"];
	
	//$id = $_SESSION['user_id'];

	// Insert array into database
	$query = "INSERT INTO messages (name, email, number, message) VALUES ('$name', '$email', '$number', '$textMessage')";
	mysqli_query($connection, $query);


	header("location:home.php");
	exit;

}

?>

<!DOCTYPE html>
<html>
  <head>

    <title>Contact us</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
	
	<!--css file link-->
   <link rel="stylesheet" href="styles/contactUs_style.css">
   
    <script>
        function validateForm() {
            // Get form inputs
            var name = document.getElementsByName('name')[0].value;
            var email = document.getElementsByName('email')[0].value;
            var number = document.getElementsByName('number')[0].value;
			
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

            // Validate number like 1234567890
            var numberRegex = /^\d{10}$/;
            if (!number.match(numberRegex)) {
                alert('Please enter a valid phone number');
                return false;
            }

            // Form is valid
            return true;
        }
    </script> 
   
  </head>
  <body>
  
	<!--header-->
	<div class="home-head">
		<img class="img-head" src="img/book_icon.jpg">
		<h1 class="head-header">BOOKS.LK</h1>
	</div>
	
	<!--Navigation bar -->
	<div class="navi">
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="cart.php">Cart</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="about.php">About Us</a></li>
		</ul>
	</div>
	<!--Navigation bar end -->
	<!--header end -->

<div class="contact-form">
	<form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" class="contact-table" >

		<table class="reg-table" >
			<tr>
				<td><h2>Messages</h2></td>
			</tr>
			<tr>
				<td><input type="text" name="name" placeholder="Enter Your Name" required class="conForm-input" value="<?php echo $name; ?>" ></td>
			</tr>	
			<tr>
				<td><input type="text" name="email" placeholder="Enter Your Email" required class="conForm-input" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="number" placeholder="Enter Your Number" required  class="conForm-input" value="<?php echo $number; ?>"></td>
			</tr>	
			<tr>
				<td><textarea name="message" value="<?php echo $textMessage; ?>" class="conForm-textarea"></textarea></td>
			</tr>	
			<tr>
				<td><input type="submit" name="sendMessage" value="Send Message" class="conForm-btn"></td>
			</tr>

		</table>
		
	</form>

</div>

		<!--footer-->
		<div class="myfooter">
		<br>
			<table class="footTable">
				<tr>
					<th  class = "footTableTh">About Us</th>
					<th  class = "footTableTh">Head Office</th>
					<th  class = "footTableTh">Contact Info</th>				
				</tr>
				<tr>
					<td>
						<p>
								Books.lk is a website for an extensive collection of books, stationery and magazines.Not only a “one-stop shop” for book lovers but also 
								an interactive and innovative destination designed to make it fun and exciting to discover and shop for new books and gifts online.
						</p>
					</td>
					<td>
						130, S de S Jayasinghe Mawatha,<br>
						Kohuwala.<br>
						Sri Lanka.<br>
						Hot-line: +94 710 122 122
					</td>
					<td>
						Tel: +94 37 223 4446<br>
						Fax: +94 37 223 4447<br>
						Wholesale Inquiries: +94 703 355 355
						
					</td>					
				</tr>				
			</table>
		<br>

			<div class="mydivfootunder1">
				&copy;2023 <b>Books.lk</b> 11600. Designed By Team Books.lk
			</div>
		</div>
		<!--footer end-->	

  </body>
</html>