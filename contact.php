<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'shoppingcart';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if(! $conn ) {
   die('Could not connect: ' . mysql_error());
}

if(isset( $_POST['customer_name'])){
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_phone = $_POST['customer_phone'];
$about = $_POST['about'];
$message = $_POST['message'];

$sql = "INSERT INTO contactus_details ".
               "(customer_name, customer_email,customer_phone,about,message) "."VALUES ".
               "('$customer_name','$customer_email','$customer_phone','$about','$message')";
            $retval = mysqli_query($conn,$sql);
         
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
         
            echo "\n <h1>Data Stored successfully in table: contactus_details </h1>\n";
			
			$to = "support@xyz.com"; // this is your Email address
			$from = $customer_email; // this is the sender's Email address
			$customer_name = $customer_name;
			$subject = "Customer Product Details";
			$message = "Name:$customer_name,Email:$customer_email,Phone:$customer_phone, About:$about,,Message:$message";

			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
            mysqli_close($conn);
			
			header('Refresh:5; url=index.php');
			exit;

}

?>