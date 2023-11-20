<?php

session_start();
require ('includes/mysqli_connect.php');

if (!isset($_SESSION['userId'])) {
    require 'includes/loginFunction.inc.php';
    redirect_user();
}

$target_dir = "uploads/";
$target_file = $target_dir .date("Ymdhis"). basename($_FILES["productImage"]["name"]??null);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


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
$action ='new';
$id =null;

$page_title = 'Product Details';
include 'includes/head.php';

if($_GET){
    $id =  $_GET['id'];
    
$sql = "SELECT * FROM `product` WHERE  `Id`=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $productCode =$row['productCode'];
        $productName =$row['productName'];
        $productPrice =$row['productPrice'];
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
  } else {
    echo "0 results";
  }
//   $conn->close();

}

if($_POST){

    
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["productImage"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["productImage"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
    $errors = array();
        
        if (empty($_POST['productCode'])) {
            $errors[] = 'You forgot to enter your PRODUCT CODE.';
        } else {
            $productCode = trim($_POST['productCode']);
        }
        if (empty($_POST['productName'])) {
            $errors[] = 'You forgot to enter your PRODUCT NAME';
        } else {
            $productName = trim($_POST['productName']);
        }

        if (empty($_POST['productPrice'])) {
            $errors[] = 'You forgot to enter your PRODUCT PRICE.';
        } else {
            $productPrice = trim($_POST['productPrice']);
        }

        if (empty($_POST['productModel'])) {
            $errors[] = 'You forgot to enter your PRODUCT MODEL.';
        } else {
            $productModel = trim($_POST['productModel']);
        }
        
        if (empty($_POST['productType'])) {
            $errors[] = 'You forgot to enter your PRODUCT TYPE';
        } else {
            $productType = $_POST['productType'];
        }
    
        
        if (empty($_POST['productDescription'])) {
            $errors[] = 'You forgot to enter your PRODUCT DESCRIPTION .';
        } else {
            $productDescription = trim($_POST['productDescription']);
        }

        // if (empty($_POST['productImage'])) {
        //     $errors[] = 'You forgot to enter your PRODUCT IMAGE .';
        // } else {
        //     $productImage = trim($_POST['productImage']);
        // }

        // $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        // if($check !== false) {
        //   echo "File is an image - " . $check["mime"] . ".";
        //   $uploadOk = 1;
        // } else {
        //   echo "File is not an image.";
        //   $uploadOk = 0;
        // }
        
        if (empty($_POST['cpu'])) {
            $errors[] = 'You forgot to enter your CPU .';
        } else {
            $cpu = trim($_POST['cpu']);
        }
        if (empty($_POST['gpu'])) {
            $errors[] = 'You forgot to enter your GPU .';
        } else {
            $gpu = trim($_POST['gpu']);
        }
        if (empty($_POST['ram'])) {
            $errors[] = 'You forgot to enter your RAM .';
        } else {
            $ram = trim($_POST['ram']);
        }
        if (empty($_POST['storage'])) {
            $errors[] = 'You forgot to enter your storage .';
        } else {
            $storage = trim($_POST['storage']);
        }
        if (empty($_POST['screen'])) {
            $errors[] = 'You forgot to enter your screen .';
        } else {
            $screen = trim($_POST['screen']);
        }
        if (empty($_POST['misc'])) {
            $errors[] = 'You forgot to enter your misc .';
        } else {
            $misc = trim($_POST['misc']);
        }
        $status = trim($_POST['status']);
        $action = trim($_POST['action']);
        $id = trim($_POST['id']);
        
            $chk="";

        if (empty($errors)) { 
        
            echo $action;
            
            $userId =  $_SESSION['userId'];
            $qCheck = "SELECT * FROM `product` WHERE `productCode` LIKE '$productCode'";
           
            $result = $conn->query($qCheck);
            if ($result) {
                if (mysqli_num_rows($result) > 3) {
                    
                    echo '<h1>Record Exist</h1>
                    <p class="error">Record already exist.We apologize for any inconvenience.</p>'; 
                } else {
                    

            //  $q1 = "INSERT INTO `product`
            // (`productCode`, `productName`, `productPrice`, `productModel`, `productType`, `productDescription`, `productImage`, `cpu`, `gpu`, `ram`, `storage`, `screen`, `misc`, `status`, `modifiedDate`, `modifiedBy`) VALUES 
            // ('$productCode','$productName','$productPrice','$productModel',$productType,'$productDescription','$productImage','$cpu','$gpu','$ram','$storage','$screen','$misc','1','$date','$userId')";	
            
            if($action =='new'){
                $q1 = "INSERT INTO `product`
            (`productCode`, `productName`, `productPrice`, `productModel`, `productType`, `productDescription`, `productImage`, `cpu`, `gpu`, `ram`, `storage`, `screen`, `misc`, `status`, `modifiedDate`, `modifiedBy`) VALUES 
            ('$productCode','$productName','$productPrice','$productModel',$productType,'$productDescription','$target_file','$cpu','$gpu','$ram','$storage','$screen','$misc','1','$date','$userId')";	

            $msg = "Thank You. New Product Has Been Registered";
            }else{
                $q1 = "UPDATE `product` SET
                `productCode`='$productCode',
                `productName`='$productName',
                `productPrice`='$productPrice',
                `productModel`='$productModel',
                `productType`=$productType,
                `productDescription`='$productDescription',
                `productImage`='$target_file',
                `cpu`='$cpu',
                `gpu`='$gpu',
                `ram`='$ram',
                `storage`='$storage',
                `screen`='$screen',
                `misc`='$misc',
                `status`='$status',
                `modifiedDate`='$date',
                `modifiedBy`='$userId' 
                WHERE `id` = $id";	

                $msg = "Thank You. New Product Has Been Update";

            }
            // echo $q1;
            $r1 = mysqli_query($dbc, $q1);
                    
                    if ($r1) {
                        
                        echo '<script type="text/javascript">
                        var answer = confirm("'.$msg.'")

                        if (answer){
                        
                            window.location = "productList.php";
                        
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
		<span>Product Detail<span>
	</h1>

    <form action="productDetail.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productCode">Product Code </label>
                    <input type="text"  class="form-control" id="productCode"  name="productCode" size="15" maxlength="20" value="<?php echo $productCode; ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productName">Product Name </label>
                    <input type="text"  class="form-control" id="productName"  name="productName" size="15" maxlength="20" value="<?php echo $productName ?>" /> 
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productPrice">Product Price </label>
                    <input type="text"  class="form-control" id="productPrice"  name="productPrice" size="15" maxlength="20" value="<?php echo $productPrice ?>" /> 
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productModel">Product Model </label>
                    <input type="text"  class="form-control" id="productModel"  name="productModel" size="15" maxlength="20" value="<?php echo $productModel ?>" /> 
                </div>
                
</div>
<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productName">Product Type </label>
                    <select name="productType" id="productType"  class="form-control">
                        <option value="" disabled>--- Choose a type ---</option>
                        <option value="1" <?php echo ($productType == 1)?"selected":"" ?>>Computer</option>
                        <option value="2" <?php echo ($productType == 2)?"selected":"" ?>>Laptop</option>
                        <option value="3" <?php echo ($productType == 3)?"selected":"" ?>>Mobile</option>
                    </select> 
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productDescription">Product Description </label>
                    <input type="text"  class="form-control" id="productDescription"  name="productDescription" size="15" maxlength="20" value="<?php echo $productDescription ?>" /> 
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="productImage">Product Image </label>
                    <?php 
                    if($productImage == null){
                        ?>

<input type="file"  class="form-control" id="productImage"  name="productImage" size="15" maxlength="20"  value="<?php echo $productImage ?>" /> 
                        <?php
                    }else{

                        echo $productImage ;
                    }
                    
                    
                    ?>
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="cpu">CPU</label>
                    <input type="text"  class="form-control" id="cpu"  name="cpu" size="15" maxlength="20"  value="<?php echo $cpu ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="gpu">GPU</label>
                    <input type="text"  class="form-control" id="gpu"  name="gpu" size="15" maxlength="20"  value="<?php echo $gpu ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="ram">RAM </label>
                    <input type="text"  class="form-control" id="ram"  name="ram" size="15" maxlength="20"  value="<?php echo $ram ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="storage">Storage</label>
                    <input type="text"  class="form-control" id="storage"  name="storage" size="15" maxlength="20" v value="<?php echo $storage ?>" /> 
                </div>
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="screen">Screen</label>
                    <input type="text"  class="form-control" id="screen"  name="screen" size="15" maxlength="20"  value="<?php echo $screen ?>" /> 
                </div>
</div>

<div class=" col-lg-12 ">
                <div class="form-group">
                    <label for="misc">MisC</label>
                    <input type="text"  class="form-control" id="misc"  name="misc" size="15" maxlength="20"  value="<?php echo $misc ?>" /> 
                </div>
                
</div>

<div class=" col-lg-6 ">
                <div class="form-group">
                    <input type="checkbox" id="status" name="status"checked> 
                    <label for="status">Active</label>
                </div>
                    <input type="hidden" id="action" name="action" value="<?php echo $action ?>"> 
                    <input type="hidden" id="id" name="id" value="<?php echo $id ?>"> 

                <?php if($action =='new'){

                }?>
                <button type="submit" class="btn btn-primary">
                    <?php if($action =='new'){ echo 'Add Product';}else{echo 'Update Product';}?>
                </button>
</div>
                
            </div>   
        
        </div>
   
</form>
</div>
		
<?php include 'includes/foot.php';
?>
