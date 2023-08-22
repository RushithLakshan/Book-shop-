<?php

//Create and check the connection
$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

$name = "";
$price = "";
$fileName = "";
$type = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$name = $_POST["name"];
	$price = $_POST["price"];
	$type = $_POST["type"];
	do{
		if(empty($name) || empty($price) || empty($type)){
			$errorMessage = "All the fields are required";
			break;
		}
		
		if($_FILES["image"]["error"] == 4){
			echo
			"<script> alert('Image Does Not Exist'); </script>";
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
		
		//add new book to database
		$sql = "INSERT INTO products (name, price, image, type)".
				"VALUES('$name', '$price', '$fileName', '$type')";
				
		$result = $connection->query($sql);
		
		if(!$result){
			$errorMessage = "Invalid quary: ".$connection->error;
			break;	
		}
		
		$name = "";
		$price = "";
		$fileName = "";
		$type = "";
		
		$successMessage = "Book added correctly";
		
		header("location:admin_page.php");
		exit;
		
	}while(false);

}

?>

<!DOCTYPE html>
<html>
<head>

   <title>Create new product</title>

	<!--css file link-->
   <link rel="stylesheet" href="styles/create_book_style.css">

</head>
<body>

	<div class="NewproductDiv">
		<h2>New Product</h2>
		
		<?php
			if(!empty($errorMessage)){
				echo $errorMessage;
				
			}
		?>
		
			<form method="post" enctype="multipart/form-data">		<!--compulsury to put enctype-->
				Name: <input type="text" name="name" value="<?php echo $name; ?>"><br>
				Price: <input type="text" name="price" value="<?php echo $price; ?>"><br>
				Image: <input type="file" name="image" value="<?php echo $fileName; ?>"><br>
				Type: <input type="text" name="type" value="<?php echo $type; ?>"><br>
		<?php
		
			if(!empty($successMessage)){
				echo $successMessage;
				
			}
		?>
				<input class='NewPro-btn' type="submit" name="" value="submit">&emsp;
				<a href="admin_page.php"><input class='NewPro-btn' type='button' value='Cancel'></a><br><br>
			</form>
   
	</div>

</body>
</html>