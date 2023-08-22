<?php

session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>

   <title>Orders</title>
   <link rel="icon" type="image/x-icon" href="img/book_icon.jpg">


   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styles/admin_order_style.css">

   <script type="text/javascript">
		function logout(){
			var ans = confirm("Are you want to Log Out?");
			if(ans){
				window.location = "login.php";
			}else{
				window.location = "admin_page.php";
			}
		}
   
   </script>  

</head>
<body>
   
	<div class="home-head">
		<img class="img-head" src="img/book_icon.jpg">
		<h1 class="head-header">BOOKS.LK</h1>
	</div>
	
	<div class="navi">
		<ul>
			<li><a href="admin_page.php">Home</a></li>
			<li><a href="admin_order.php">Orders</a></li>
			<li><a href="admin_message.php">Messages</a></li>
			<li><a href="admin_users.php">Users</a></li>
			<li><input class="logout-btn" onclick="logout()" type="button" name="logout" value="Log out"></li>
		</ul>
	</div>

	<div class="OrderDiv">
	
		<h2>ORDERS</h2>
		
		<table class="orderTab" >

			<?php
			
			//Create and check the connection
			$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
			
			//read all rows from the database table
			$sql = "SELECT * FROM orders";
			$result = $connection->query($sql);
			
			if(!$result){
				die("Invalid quary: ".$connection->error);
			}
			
			//read the data from the each rows
			while($row = $result->fetch_assoc()){
		
				echo "
				<tr>
					<td>User Id: $row[id]</td>
				</tr>
				<tr>
					<td>Item details: $row[item_details]</td>
				</tr>
				<tr>
					<td>Item details: $row[total]</td>
				</tr>
				<tr>
					<td>Item details: $row[user_data]</td>
				</tr>	
				<tr>
					<td><hr></td>
				</tr>				
				";	
			}
		
			?>
	
		</table>
			
	</div>

</body>
</html>