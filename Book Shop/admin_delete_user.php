<?php
session_start();
$admin_id = $_SESSION['admin_id'];

if(isset($_GET["id"])){
	$id = $_GET["id"];
	
	if($id == $admin_id){
			$websiteUrl = 'admin_users.php';
			$linkText = 'Go to previous page.';
			echo "<script> alert('You are the admin now.'); </script>";
			echo 'Click <a href="' . $websiteUrl . '">' . $linkText . '</a>';
	}else{
	//Create and check the connection
	$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
	
	$sql = "DELETE FROM users WHERE id=$id";
	$connection->query($sql);
	header("location:admin_users.php");
	exit;
	}
}
	
		
?>