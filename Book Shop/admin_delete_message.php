<?php

if(isset($_GET["id"])){
	$id = $_GET["id"];
	
	//Create and check the connection
	$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');
	
	$sql = "DELETE FROM messages WHERE id=$id";
	$connection->query($sql);
	}
	header("location:admin_message.php");
	exit;
		
?>