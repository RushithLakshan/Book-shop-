<?php

//Create and check the connection
$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

$id = "";
$name = "";
$price = "";
$fileName = "";
$type = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	//Get method: Show the data of the products
	
	if(!isset($_GET["id"])){
		header("location:admin_page.php");
		exit;
	}
	
	$id = $_GET["id"];
	
	//read the row of the seclected products from database table
	$sql = "SELECT * FROM products WHERE id=$id";
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	
	if(!$row){
		header("location:admin_page.php");
		exit;
	}
	
	$name = $row["name"];
	$price = $row["price"];
	$fileName = $row["image"];
	$type = $row["type"];
	
}else{
	//POST method: update the data of the products
	$id = $_POST["id"];
	$name = $_POST["name"];
	$price = $_POST["price"];
	$type = $_POST["type"];
	
	do{
		if(empty($id) || empty($name) || empty($price)){
			$errorMessage = "All the fields are required";
			break;
		}
		
		if($_FILES["image"]["error"] == 4){
			echo
			"<script> alert('Image Does Not Exist'); </script>"
			;
		}
		else{
			$fileName = $_FILES["image"]["name"];
			$fileSize = $_FILES["image"]["size"];
			$tmpName = $_FILES["image"]["tmp_name"];

			$validImageExtension = ['jpg', 'jpeg', 'png'];
			$imageExtension = explode('.', $fileName);
			$imageExtension = strtolower(end($imageExtension));
			if ( !in_array($imageExtension, $validImageExtension) ){
			echo
			"
			<script>
			alert('Invalid Image Extension');
			</script>
			";
			}
			else if($fileSize > 1000000){
			echo
			"
			<script>
			alert('Image Size Is Too Large');
			</script>
			";
			}
			else{
			move_uploaded_file($tmpName, 'img/'.$fileName);
			}
		}
		
		
		//add new Book to database
		$sql = "UPDATE products ".
				"SET name='$name', price = '$price', image = '$fileName', type = '$type'".
				"WHERE id = $id";
				
		$result = $connection->query($sql);
		
		if(!$result){
			$errorMessage = "Invalid quary: ".$connection->error;
			break;	
		}
		
		$successMessage = "Book added correctly";
		
		header("location:admin_page.php");
		exit;
		
	}while(false);	
	
}

?>

<!DOCTYPE html>
<html>
<head>

   <title>Edit product</title>

	<!--css file link-->
   <link rel="stylesheet" href="styles/edit_book_style.css">

</head>
<body>

	<div class="EditproductDiv">
		<h2>Edit a Book</h2>
		
		<?php
			if(!empty($errorMessage)){
				echo $errorMessage;
				
			}
		?>
		
			<form method="post" enctype="multipart/form-data">		<!--compulsury to put enctype-->
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				Name: <input type="text" name="name" value="<?php echo $name; ?>"><br>
				Price: <input type="text" name="price" value="<?php echo $price; ?>"><br>
				Image: <input type="file" name="image" value="<?php echo $fileName; ?>"><br>
				Type: <input type="text" name="type" value="<?php echo $type; ?>"><br>
		<?php
		
			if(!empty($successMessage)){
				echo $successMessage;
				
			}
		?>
				<input class="EditPro-btn" type="submit" name="" value="submit">&emsp;
				<a href="admin_page.php"><input class='EditPro-btn' type='button' value='Cancel'></a><br><br>
			</form>
   
	</div>

</body>
</html>