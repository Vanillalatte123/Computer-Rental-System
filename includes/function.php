<?php

require ('loginFunction.inc.php');
require ('mysqli_connect.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_REQUEST['action'] == 'login'){
        
        list ($check, $data) = check_login($dbc, $_REQUEST['username'], $_REQUEST['password']);
	
	if ($check) {

		session_start();
		$_SESSION['userId'] = $data['userId'];
		$_SESSION['firstName'] = $data['firstName'];
		
		redirect_user('loggedin.php');
			
	} else {

		$errors = $data;

	}
		
	mysqli_close($dbc);
    }

	
if($_POST['action'] == 'deleteProduct'){
	$id = $_POST['id'];

	$sql = "DELETE FROM `product` WHERE `Id`=$id";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	  } else {
		echo "Error deleting record: " . $conn->error;
	  }
	  

	// echo $id;

}


if($_POST['action'] == 'addToCart'){
	$id = $_POST['id'];
	$userId = $_POST['userId'] ;
	$delivery = $_POST['delivery'] ;

	$sql = "SELECT * FROM `product` WHERE  `Id`=$id";
	$result = $conn->query($sql);

	$productCode ='';
	$productName ='';
	$productPrice ='';
	$productModel ='';
	$productType ='';
	$productDescription ='';
	$productImage ='';
	$cpu ='';
	$gpu ='';
	$ram ='';
	$storage ='';
	$screen ='';
	$misc ='';
	$status ='';
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
	
			$productCode =$row['productCode'];
			$productName =$row['productName'];
			$productPrice =$row['productPrice']/24;
			$productModel =$row['productModel'];
			$productType =$row['productType'];
			$productDescription =$row['productDescription'];
			$productImage =$row['productImage'];
			$cpu =$row['cpu'];
			$gpu =$row['gpu'];
			$ram =$row['ram'];
			$storage =$row['storage'];
			$screen =$row['screen'];
			$misc =$row['misc'];
			$status =$row['status'];
			$id =$row['Id'];
			$action ='update';
	
		}

		$sqlInsert = "INSERT INTO `orderproduct`( `userId`, `productId`, `deliveryId`, `totalPrice`, `status`, `modifiedDate`, `modifiedBy`, `contractMonth`) VALUES ('$userId','$id',$delivery,'$productPrice','1','$date','$userId','24')";
		
		$r1 = mysqli_query($dbc, $sqlInsert);
                    
		if ($r1) {
			
			echo 'Thank you!.Product add to cart';	
			// header('Location: productDetail.php');
		} else {

			echo '<h1>System Error</h1>'; 
	
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $sqlInsert . '</p>';
				
		}
	  } else {
		echo "0 results";
	  }

	  

	// echo $id;

}
    

if($_POST['action'] == 'deleteOrder'){
	$id = $_POST['id'];

	$sql = "DELETE FROM `orderproduct` WHERE `Id`=$id";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	  } else {
		echo "Error deleting record: " . $conn->error;
	  }
	  

	// echo $id;

}


if($_POST['action'] == 'approveOrder'){
	$id = $_POST['id'];
	$userId =  $_POST['userId'];


	$sql = "UPDATE `orderproduct` SET
                `status`=2,
                `modifiedDate`='$date',
                `modifiedBy`='$userId' 
                WHERE `id` = $id";	
	if ($conn->query($sql) === TRUE) {
		echo "Record Update successfully";
	  } else {
		echo "Error updating record: " . $conn->error;
	  }
	  

	// echo $id;

}


if($_POST['action'] == 'deleteDelivery'){
	$id = $_POST['id'];

	$sql = "DELETE FROM `delivery` WHERE `Id`=$id";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	  } else {
		echo "Error deleting record: " . $conn->error;
	  }
	  

	// echo $id;

}
    
}

?>