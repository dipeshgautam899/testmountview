<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$checkinDate = $_POST['checkindate'];
	$checkoutDate = $_POST['checkoutdate'];
	$rooms = $_POST['rooms'];
	$numberofpeople = $_POST['number'];
	$contact = $_POST['contact'];


	// Database connection
	$conn = new mysqli('localhost','root','','mountviewpokhara');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		
		$stmt = $conn->prepare("insert into booking(name, email, checkinDate, checkoutDate, rooms, numberofpeople, contact) values(?, ?, ?, ?, ?, ?,?)");
		$stmt->bind_param("ssssssi", $name, $email, $checkinDate, $checkoutDate, $rooms, $numberofpeople, $contact);
		$execval = $stmt->execute();
		// echo $execval;

			ini_set('SMTP','smtp.gmail.com');
			ini_set('smtp_port','tls');


		
			$to = $email;
			$subject = 'Booking Confirmation';
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= 'From: Mount View Hotel <dipeshgautam899@gmail.com>' . "\r\n";

			$message = '<html><body>';
			$message .= '<h1>Booking Confirmation</h1>';
			$message .= '<p>Thank you for booking with us. Here are the details of your booking:</p>';
			$message .= "<ul>
							<li>Name: $name</li>
							<li>Email: $email</li>
							<li>Check-in Date: $checkinDate</li>
							<li>Check-out Date: $checkoutDate</li>
							<li>Rooms: $rooms</li>
							<li>Number of People: $numberofpeople</li>
							<li>Contact: $contact</li>
						</ul>";
			$message .= '<p>We look forward to welcoming you to Mount View Hotel.</p>';
			$message .= '</body></html>';


			if (mail($to, $subject, $message, $headers)) {
				echo "Registration completed successfully...<br>Our staff will connect with you shortly.<br>A confirmation email has been sent to $email.";
				header('location:thankyou.html');
			} else {
				echo "Error: Email could not be sent.";		

		}
		
		$stmt->close();
		$conn->close();
	}
	
	
?>
  

  
