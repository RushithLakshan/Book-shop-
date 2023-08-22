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

   <title>Messages</title>
   <link rel="icon" type="image/x-icon" href="img/book_icon.jpg">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styles/admin_message_style.css">
   
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

	<div class="messageDiv">
	
		<h2>MESSAGES</h2>
		
		<table class="messageTab" >

			<?php
			
			//Create and check the connection
			$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
			
			//read all rows from the database table
			$sql = "SELECT * FROM messages";
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
					<td>User Name: $row[name]</td>
				</tr>
				<tr>
					<td>Email: $row[email]</td>
				</tr>
				<tr>
					<td>Number: $row[number]</td>
				</tr>	
				<tr>
					<td>Message: $row[message]</td>
				</tr>
				<tr>
					<td><a  href='admin_delete_message.php?id=$row[id]'><input class='delete-btn' type='button' value='Delete Message'></a></td>
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