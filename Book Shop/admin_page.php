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

   <title>admin panel</title>
   <link rel="icon" type="image/x-icon" href="img/book_icon.jpg">


   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="styles/admin_style.css">
   
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


	<div class="dashbord">
	
		<h2>DASHBOARD</h2>
		<a class="" href="create_book.php"><input class="dashbord-btn" type="button" value="Add Product"></a><br><br>
		<table class="dashbordTable" >
			<tr>
				<th width="10%">ID</th>
				<th width="20%">Name</th>
				<th width="10%">Price</th>
				<th width="20%">Image</th>	<!--im-->
				<th width="10%">Type</th>
				<th width="30%">Edit/Delete</th>
			</tr>
			<?php
			
			//Create and check the connection
			$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
			
			//read all rows from the database table
			$sql = "SELECT * FROM products";
			$result = $connection->query($sql);
			
			if(!$result){
				die("Invalid quary: ".$connection->error);
			}
			
			//read the data from the each rows
			while($row = $result->fetch_assoc()){
				//file name of the image
				$filename='img/'.$row['image'];
				
				echo "
				<tr>
					<td>$row[id]</td>
					<td>$row[name]</td>
					<td>$row[price]</td>
					<td><img src='$filename' width='100px'></td>
					<td>$row[type]</td>
					<td>
						<a  href='edit_book.php?id=$row[id]'><input class='dashbordTab-btn' type='button' value='Edit'></a>
						<a  href='delete_book.php?id=$row[id]'><input class='dashbordTab-btn' type='button' value='Delete'></a>
					 </td>
				</tr>
				";	
				
			}
			
			?>
		</table>
		 
	</div>

</body>
</html>