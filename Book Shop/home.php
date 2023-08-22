<?php 
session_start();

//Create and check the connection
$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

?>

<!DOCTYPE html>
<html>
  <head>

    <title>Home</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
	
	<!--css file link-->
   <link rel="stylesheet" href="styles/home_style.css">
   
   <script type="text/javascript">
		function logout(){
			var ans = confirm("Are you want to Log Out?");
			if(ans){
				window.location = "login.php";
			}else{
				window.location = "home.php";
			}
		}
   
   </script>
   
   
  </head>
  <body>
  
  <!--header-->
  
	<div class="home-head">
		<img class="img-head" src="img/book_icon.jpg">
		<!--Search bar-->
		<div class="head-search">
			<form method="post">
				<input class="search-box search-hover" type="text" name="search">
				<input class="search-btn" type="submit" name="Search_submit" value="SEARCH">
			</form>
		</div>
		<!--Search bar end-->
		<h1 class="head-header">BOOKS.LK</h1>
	</div>
	
	<!--Navigation bar -->
	<div class="navi">
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="cart.php">Cart</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="about.php">About Us</a></li>
			<li><input class="logout-btn" onclick="logout()" type="button" name="logout" value="Log out"></li>
		</ul>
	</div>
	
	<!--Navigation bar end -->
	
	<!--header end-->
	
			
			<?php
			
			if(!isset($_POST['Search_submit'])){

			//read all rows where type is 'new' from the database table
			$sql1 = "SELECT * FROM products WHERE type = 'new'";
			$result1 = $connection->query($sql1);
			
			//read all rows where type is 'featured' from the database table
			$sql2 = "SELECT * FROM products WHERE type = 'featured'";
			$result2 = $connection->query($sql2);
			
			if(!$result1 || !$result2){
				die("Invalid quary: ".$connection->error);
			}
			
			$cssClass = "catHeader";		//using css class inside php code
			echo '<h2 class="' . $cssClass . '">New Products</h2>';
			
			//read the data from the each rows
			while($row = $result1->fetch_assoc()){

			?>
				<div class="bookBox">
				<form method="post" action="cart.php?id=<?php echo $row["id"]; ?>">
					<div>
						<img src="img/<?php echo $row["image"]; ?>" class="bookBoxImg" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="" /><br>

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" class="btn-cart" value="Add to Cart" />

					</div>
				</form>
				</div>
				
			<?php	
			}
			$cssClass = "catHeader";		//using css class inside php code
			echo '<h2 class="' . $cssClass . '">Featured Products</h2>';
			//read the data from the each rows
			while($row = $result2->fetch_assoc()){

			?>
				<div class="bookBox">
				<form method="post" action="cart.php?id=<?php echo $row["id"]; ?>">
					<div>
						<img src="img/<?php echo $row["image"]; ?>" class="bookBoxImg" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" class="btn-cart" value="Add to Cart" />

					</div>
				</form>
				</div>
				
			<?php	
			}			
			?>
			<?php	
			}else{
			
			$book_name = $_POST['search'];

			//read all rows from the database table where name is equals to user entered name
			$sql = "SELECT * FROM products WHERE name = '$book_name'";
			$result = $connection->query($sql);
		
			//if the book not in database
			if(mysqli_num_rows($result) == 0){
				echo "No results found";
			}
		
			if(!$result){
				die("Invalid quary: ".$connection->error);
			}

			//read the data from the each rows
			while($row = $result->fetch_assoc()){
				//file name of the image
				//$filename='img/'.$row['image'];
					
			?>	
				<div class="bookBox">
				<form  method="post" action="cart.php?id=<?php echo $row["id"]; ?>">
					<div>
						<img src="img/<?php echo $row["image"]; ?>" class="bookBoxImg" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" class="btn-cart" value="Add to Cart" />

					</div>
				</form>
				</div>	
			<?php	
			}
			?>
			<?php
			}
			?>
		
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