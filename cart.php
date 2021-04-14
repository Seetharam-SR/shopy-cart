<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'shoppingcart';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

if(! $conn ) {
   die('Could not connect: ' . mysql_error());
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $product_color = $_POST['product_color'];
    $product_size = $_POST['product_size'];
	
	
$sql = "INSERT INTO customer_details ".
               "(product_id, customer_name, customer_email,customer_phone,product_color,product_size) "."VALUES ".
               "('$product_id','$customer_name','$customer_email','$customer_phone','$product_color','$product_size')";
            $retval = mysqli_query($conn,$sql);
         
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
         
            echo "\n <h1>Data Stored successfully in table: customer_details </h1>\n";
			
			//mail(" manager@xyz.com","My subject",$msg);
			
			$to = "manager@xyz.com"; 
			$from = $customer_email; 
			$customer_name = $customer_name;
			$subject = "Customer Product Details";
			$message = "Name:$customer_name,Email:$customer_email,Phone:$customer_phone,Product color:$product_color,,Product size:$product_size";

			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			echo "Mail Sent. Thank you " . $customer_name . ", we will contact you shortly.";
            mysqli_close($conn);
			
			header('Refresh:5; url=index.php');
			exit;
}
?>
