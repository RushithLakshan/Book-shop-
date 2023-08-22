<?php
session_start();	//need to pass user details through web pages
$connection = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

$name="";
$number="";
$email="";
$method="";
$addrLine1="";
$addrLine2="";
$city="";
$province="";
$country="";
$postalCode="";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	
	$name=$_POST["name"];
	$number=$_POST["number"];
	$email=$_POST["email"];
	$method=$_POST["method"];
	$addrLine1=$_POST["flat"];
	$addrLine2=$_POST["street"];
	$city=$_POST["city"];
	$province=$_POST["province"];
	$country=$_POST["country"];
	$postalCode=$_POST["postalCode"];
	$date = date("y/m/d");
		
	$user_details = "Date: " .$date. "\nName: " . $name . "\nPhone Number: " . $number . "\nEmail: " . $email . "\nPayment Method : " . $method . "\nAddress: " . $addrLine1 ." ". $addrLine2." ".$city." ".$province." ".$country . "\nPostal Code :" . $postalCode;
	
	$total_price = $_SESSION['total_price'];	
	$id = $_SESSION['user_id'];

	// multidimensional array containg the shopping cart details
	$myArray = $_SESSION["shopping_cart"];
	
	// Convert array to string for storage in database
	function flattenArrayToString($array) {
		$flattened = array();

		foreach ($array as $element) {
			if (is_array($element)) {
				$flattened[] = flattenArrayToString($element);
			} else {
            $flattened[] = $element;
			}
		}

		return implode(', ', $flattened);
	}
	$item_details = flattenArrayToString($myArray);

	// Insert data into database
	$query = "INSERT INTO orders (id, item_details, total, user_data) VALUES ('$id', '$item_details', '$total_price', '$user_details')";
	mysqli_query($connection, $query);





	// Clear session variables
	unset($_SESSION['shopping_cart']);
	unset($_SESSION['total_price']);

	header("location:home.php");
	exit;


}

?>

<!DOCTYPE html>
<html>
<head>

   <title>Place order</title>
	<link rel="icon" type="image/x-icon" href="img/book_icon.jpg">
   <!--css file link-->
   <link rel="stylesheet" href="styles/place_order_style.css">

    <script>
        function validateForm() {
            // Get form inputs
            var name = document.getElementsByName('name')[0].value;
            var email = document.getElementsByName('email')[0].value;
            var number = document.getElementsByName('number')[0].value;
			var lane1 = document.getElementsByName('flat')[0].value;
			var lane2 = document.getElementsByName('street')[0].value;
			var city = document.getElementsByName('city')[0].value;
			var province = document.getElementsByName('province')[0].value;
			var country = document.getElementsByName('country')[0].value;
			var pcode = document.getElementsByName('postalCode')[0].value;
			
            // Validate name
            if (name.trim() === '') {
                alert('Please enter your name');
                return false;
            }

            // Validate email
            var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email.match(emailRegex)) {
                alert('Please enter a valid email address');
                return false;
            }

            // Validate number like 1234567890
            var numberRegex = /^\d{10}$/;
            if (!number.match(numberRegex)) {
                alert('Please enter a valid phone number');
                return false;
            }
			
			 // Validate address lane 1
            var lane1Regex = /^[a-zA-Z0-9\s/]+$/;
            if (!lane1.match(lane1Regex)) {
                alert('Please enter a valid Lane1');
                return false;
            }
			
			// Validate address lane 2
            var lane2Regex = /^[a-zA-Z0-9\s]+$/;
            if (!lane2.match(lane2Regex)) {
                alert('Please enter a valid Lane2');
                return false;
            }
			
			// Validate city
            var cityRegex = /^[a-zA-Z\s]+$/;
            if (!city.match(cityRegex)) {
                alert('Please enter a valid city');
                return false;
            }
			
			// Validate province
            var provinceRegex = /^[a-zA-Z\s]+$/;
            if (!province.match(provinceRegex)) {
                alert('Please enter a valid province');
                return false;
            }
			
			// Validate country
            var countryRegex = /^[a-zA-Z\s]+$/;
            if (!country.match(countryRegex)) {
                alert('Please enter a valid country');
                return false;
            }
			
			// Validate postal code
            var postalRegex = /^\d{5}$/;
            if (!pcode.match(postalRegex)) {
                alert('Please enter a valid Postal code');
                return false;
            }
			
            // Form is valid
            return true;
        }
    </script> 

</head>
<body>
   
<div class="order-form">
	<form method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >

		<table class="order-table">
			<tr colspan="2" >
				<td><h1>PLACE YOUR ORDER</h1></td>
			</tr>
			<tr>
				<td>Your Name :<br><input type="text" name="name" placeholder="e.g. Nimal" required class="orderForm-input" value="<?php echo $name; ?>" ></td>
				<td>Your Phone Number :<br><input type="text" name="number" placeholder="e.g. 0771232123" required class="orderForm-input" value="<?php echo $number; ?>"></td>
			</tr>	
			<tr>
				<td>Your Email :<br><input type="text" name="email" placeholder="e.g. Nimal@gmail.com" required class="orderForm-input" value="<?php echo $email; ?>"></td>
				<td>Payment Method :<br>            
					<select name="method" class="orderForm-input">
						<option value="cash on delivery">cash on delivery</option>
						<option value="credit card">credit card</option>
						<option value="paypal">paypal</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Address Line 1 :<br><input type="text" name="flat" placeholder="e.g. 270/1" required  class="orderForm-input" value="<?php echo $addrLine1; ?>"></td>
				<td>Address Line 2 :<br><input type="text" name="street" placeholder="e.g. Samagi Mawatha" required class="orderForm-input" value="<?php echo $addrLine2; ?>"></td>
			</tr>	
			<tr>
				<td>City :<br><input type="text" name="city" placeholder="e.g. Colombo" required class="orderForm-input" value="<?php echo $city; ?>"></td>
				<td>Province :<br><input type="text" name="province" placeholder="e.g. Western Province" required class="orderForm-input"value="<?php echo $province; ?>"></td>
			</tr>	
			<tr>
				<td>Country :<br><input type="text" name="country" placeholder="e.g. Sri Lanka" required class="orderForm-input" value="<?php echo $country; ?>"></td>
				<td>Postal Code :<br><input type="text" name="postalCode" placeholder="e.g. 00300" required class="orderForm-input" value="<?php echo $postalCode; ?>"></td>
			</tr>
			<tr colspan="2">
				<td><input type="submit" name="orderNow" value="Order Now" class="orderForm-btn"></td>
			</tr>

		</table>
		
	</form>

</div>

</body>
</html>