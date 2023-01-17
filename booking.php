<?php
include 'database.php';
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$checkinDate = $_POST['checkindate'];
	$checkoutDate = $_POST['checkoutdate'];
	$rooms = $_POST['rooms'];
	$numberofpeople = $_POST['number'];
	$contact = $_POST['contact'];


	
	
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		
		$insertquery ="insert into booking(name, email, checkinDate, checkoutDate, rooms, numberofpeople, contact) values($name, $email, $checkinDate, $checkoutDate, $rooms, $numberofpeople, $contact)";
		$query = mysqli_query($con, $insertquery);
		
		
		echo "Registration completed successfully...<br>Our staff will connect with you shortly.";
		header('location:thankyou.html');
		
	}
}	
?>