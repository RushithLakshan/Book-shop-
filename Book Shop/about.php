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
	
	$id = $_SESSION['user_id'];

	// Insert array into database
	$query = "INSERT INTO messages (id, name, email, number, message) VALUES ('$id', '$email', '$name', '$number', '$textMessage')";
	mysqli_query($connection, $query);


	header("location:home.php");
	exit;




}

?>

<!DOCTYPE html>
<html>
  <head>

    <title>About</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
	
	<!--css file link-->
   <link rel="stylesheet" href="styles/about_style.css">
   
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

	<div class="aboutDiv">
		<table class="AbutusTable">
			<tr>
				<td class="AbutusTableTd">
					<img class="aboutImg" src="img/books1.jpg">
				</td>
				<td class="AbutusTableTdAlign">
					
					<h1 class="aboutHeader1">About Us</h1>
					<hr>			
					<section>
						<h2>Our Story</h2>
							<p>Welcome to our online book shop! We are passionate about books and believe in the power of reading to transform lives. Our journey started several years ago when a group of avid readers came together with a shared vision: to create an accessible platform where book lovers from all around the world could explore, discover, and indulge in their love for reading.</p>
							<p>Since then, we have grown into a thriving community of book enthusiasts who are dedicated to curating an extensive collection of books across various genres and interests. We strive to offer a diverse selection that caters to different tastes and preferences, ensuring that there's something for everyone.</p>
					</section>
					<section>
						<h2>Our Mission</h2>
						<p>At our online book shop, our mission is simple: to connect readers with their next great read. We are committed to providing a seamless and enjoyable book browsing and shopping experience. Our user-friendly website allows you to easily search for books, read reviews, and make purchases with just a few clicks.</p>
						<p>We also aim to foster a vibrant reading community by organizing virtual book clubs, author events, and sharing book recommendations through our blog and social media channels. We believe in the joy of sharing stories and ideas, and we are dedicated to creating a space where readers can engage, connect, and explore together.</p>
					</section>
					<section>
						<h2>Contact Us</h2>
						<span title="Facebook"><a href="https://www.facebook.com"><img class="contImg" src="img/facebook.png" ></a></span>	
						<span title="Instagram"><a href="https://www.instagram.com"><img class="contImg" src="img/instagram.png" ></a></span>
						<span title="Youtube"><a href="https://www.youtube.com"><img class="contImg" src="img/youtube.png" ></a></span>
						<span title="Whatsapp"><a href="https://www.whatsapp.com"><img class="contImg" src="img/whatsapp.png" ></a></span>
					</section>
				</td>
			</tr>

		</table>
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