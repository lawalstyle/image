<?php
require_once('db.php');
$upload_dir = 'uploads/';

if (isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$phone = $_POST['phone'];
	$year = $_POST['year'];


	$target = "image/" . basename($_FILES['image']['name']);
	$image = $_FILES['image']['name'];




	if (!isset($errorMsg)) {
		$sql = "insert into client(firstname, middlename, lastname, email, contact, phone, year, image)
					values('" . $firstname . "', '" . $middlename . "', '" . $lastname . "','" . $email . "', 
					'" . $contact . "','" . $phone . "' ,'" . $year . "', '" . $image . "')";
		$result = mysqli_query($conn, $sql);

		// Now let's move the uploaded image into the folder: image
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		} else {
			$msg = "Failed to upload image";
		}

		if ($result) {
			$successMsg = 'New record added successfully';
			header('Location: index.php');
		} else {
			$errorMsg = 'Error ' . mysqli_error($conn);
		}
	}

	echo "print";
}
