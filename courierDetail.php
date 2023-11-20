<?php

session_start();
require ('includes/mysqli_connect.php');

if (!isset($_SESSION['userId'])) {
    require 'includes/loginFunction.inc.php';
    redirect_user();
}



$deliveryName ='';
$deliveryCharges ='';
$action ='new';
$id =null;

$page_title = 'Courier Details';
include 'includes/head.php';

if($_GET){
    $id =  $_GET['id'];
    
$sql = "SELECT * FROM `delivery` WHERE  `Id`=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $deliveryName =$row['deliveryName'];
        $deliveryCharges =$row['deliveryCharges'];
        $status =$row['status'];
        $id =$row['Id'];
        $action ='update';

    }
  } else {
    echo "0 results";
  }
//   $conn->close();

}

if($_POST){
    $errors = array();
        
        if (empty($_POST['deliveryName'])) {
            $errors[] = 'You forgot to enter your PRODUCT CODE.';
        } else {
            $deliveryName = trim($_POST['deliveryName']);
        }
        if (empty($_POST['deliveryCharges'])) {
            $errors[] = 'You forgot to enter your PRODUCT NAME';
        } else {
            $deliveryCharges = trim($_POST['deliveryCharges']);
        }
        $status = trim($_POST['status']);
        $action = trim($_POST['action']);
        $id = trim($_POST['id']);
        
            $chk="";

        if (empty($errors)) { 
        
            echo $action;
            
            $userId =  $_SESSION['userId'];
            $qCheck = "SELECT * FROM `delivery` WHERE `deliveryName` LIKE '$deliveryName'";
           
            $result = $conn->query($qCheck);
            if ($result) {
                if (mysqli_num_rows($result) > 3) {
                    
                    echo '<h1>Record Exist</h1>
                    <p class="error">Record already exist.We apologize for any inconvenience.</p>'; 
                } else {
                    

            if($action =='new'){
                $q1 = "INSERT INTO `delivery`(`deliveryName`, `deliveryCharges`, `status`, `modifiedDate` , `modifiedBy`) VALUES ('$deliveryName','$deliveryCharges','1','$date','$userId')";	

            $msg = "Thank You. New Courier Has Been Registered";
            }else{
                $q1 = "UPDATE `delivery` SET
                `deliveryName`='$deliveryName',
                `deliveryCharges`='$deliveryCharges',
                `status`='$status',
                `modifiedDate`='$date',
                `modifiedBy`='$userId' 
                WHERE `id` = $id";	

                $msg = "Thank You. New Courier Has Been Update";

            }
            // echo $q1;
            $r1 = mysqli_query($dbc, $q1);
                    
                    if ($r1) {
                        
                        echo '<script type="text/javascript">
                        var answer = confirm("'.$msg.'")

                        if (answer){
                        
                            window.location = "delivery.php";
                        
                        }
            
                        </script>';
                        // echo '<h1>Thank you!</h1>
                        // <p>Product has been registered</p><p><br /></p>';	
                        // header('Location: productDetail.php');
                    } else {

                        echo '<h1>System Error</h1>
                        <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                
                        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
                            
                    }
                    
                }
            } else {
                echo 'Error: ' . mysqli_error();
            }


            mysqli_close($dbc);
            
            // include ('includes/footer.php'); 
            // exit();
            
        } else {
        
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
            
        }




    }

?>
<p>
	<h1>
		<span>Courier Detail<span>
	</h1>

    <form action="courierDetail.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="deliveryName">Delivery Name </label>
                    <input type="text"  class="form-control" id="deliveryName"  name="deliveryName" size="15" maxlength="20" value="<?php echo $deliveryName; ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="deliveryCharges">Delivery Charges </label>
                    <input type="text"  class="form-control" id="deliveryCharges"  name="deliveryCharges" size="15" maxlength="20" value="<?php echo $deliveryCharges ?>" /> 
                </div>
                
</div>

<div class="form-group">
                    <input type="checkbox" id="status" name="status"checked> 
                    <label for="status">Active</label>
                </div>
                    <input type="hidden" id="action" name="action" value="<?php echo $action ?>"> 
                    <input type="hidden" id="id" name="id" value="<?php echo $id ?>"> 
                <button type="submit" class="btn btn-primary">
                    <?php if($action =='new'){ echo 'Add Courier';}else{echo 'Update Courier';}?>
                </button>
</div>
                
            </div>   
        
        </div>
   
</form>
</div>
		
<?php include 'includes/foot.php';
?>
