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
    

    $imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		}elseif(empty($email)){
			$errorMsg = 'Please input email';
		}else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into client(firstname, middlename, lastname, email, contact, phone, year, image)
					values('".$firstname."', '".$middlename."', '".$lastname."','".$email."', '".$contact."','".$phone."' ,'".$year."', '".$userPic."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('Location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  }
  echo "print"; 
?>
