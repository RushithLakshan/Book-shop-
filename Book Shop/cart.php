<?php 
session_start();	//need to pass user details through web pages


if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");	//extract a single column of values from multi-dimensional array
		if(!in_array($_GET["id"], $item_array_id))		//checks if a value exists in an array
		{
			$count = count($_SESSION["shopping_cart"]);		//count the number of elements in an array
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);		// remove the elements(/araay) from the array(/MD)
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

?>


<html>

<head>

    <title>Cart</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
	
	<!--css file link-->
   <link rel="stylesheet" href="styles/cart_style.css">
   
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
	
			<div>
				<table class="cartTabale">
					<tr class="cartTabTr">
						<th width="30%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="20%">Action</th>
					</tr>
					<?php
					$total = 0;
					if(!empty($_SESSION["shopping_cart"]))
					{
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><input class="CartTableRemove-btn" type="button" value="Remove"></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr class="cartTabTr1">
						<td colspan="3" align="right">Total</td>
						<td>$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<tr>
						<td><a href="place_order.php"><input class="CartTable-btn" type="button" name="checkOut" value="Check Out"></a></td>
					</tr>
					<?php
					}
						$_SESSION['total_price'] = $total;	
					?>
						
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