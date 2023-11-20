<?php

session_start();
require ('includes/mysqli_connect.php');

if (!isset($_SESSION['userId'])) {
    require 'includes/loginFunction.inc.php';
    redirect_user();
}

$page_title = 'Update Your Profile!';
include ('includes/head.php');

if($_SESSION['userId']){
    $id =  $_SESSION['userId'];
    
$sql = "SELECT * FROM `user` WHERE  `userId`=$id";
$result = $conn->query($sql);
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();
        
        if (empty($_POST['username'])) {
            $errors[] = 'You forgot to enter your username.';
        } else {
            $username = trim($_POST['username']);
        }
        if (empty($_POST['firstName'])) {
            $errors[] = 'You forgot to enter your first name.';
        } else {
            $firstName = trim($_POST['firstName']);
        }

        if (empty($_POST['lastName'])) {
            $errors[] = 'You forgot to enter your last name.';
        } else {
            $lastName = trim($_POST['lastName']);
        }

        
        if (empty($_POST['mobile'])) {
            $errors[] = 'You forgot to enter your mobile number';
        } else {
            $mobile = trim($_POST['mobile']);
        }
    
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter your email address.';
        } else {
            $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[]  = "Invalid email format";
    }
        }
        
        if (empty($_POST['address'])) {
            $errors[] = 'You forgot to enter your address .';
        } else {
            $address = trim($_POST['address']);
        }

        if (empty($_POST['postcode'])) {
            $errors[] = 'You forgot to enter your postcode .';
        } else {
            $postcode = trim($_POST['postcode']);
        }
        if (empty($_POST['state'])) {
            $errors[] = 'You forgot to enter your state .';
        } else {
            $state = trim($_POST['state']);
        }
            $chk="";

        if (empty($errors)) { 
        
            
    
            $q1 = "UPDATE `user` SET
                `username`='$username',
                `firstName`='$firstName',
                `lastName`='$lastName',
                `mobile`=$mobile,
                `email`='$email',
                `address`='$address',
                `postcode`='$postcode',
                `state`='$state'
                WHERE `userId` = $id";		
            // $r1 = @mysqli_query ($dbc, $q1);
            $r1 = mysqli_query($dbc, $q1);

            // $memberId = mysqli_insert_id($dbc);

            if ($r1) {
                
                echo '<h1>Thank you!</h1>
                <p>Your Profile Has Been Updated.</p><p><br /></p>';	
            } else {

                echo '<h1>System Error</h1>
                <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
        
                echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
                    
            }
            
            mysqli_close($dbc);
            
            include ('includes/footer.php'); 
            exit();
            
        } else {
        
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
            
        }
    
    }

    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    
    ?>
    <style>
table, th, td {
  border: 0;
  border-collapse: collapse;
}



</style>
    <h1>Manage Your Profile</h1>
<?php 
if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    
    $username =$row['username'];
    $firstName =$row['firstName'];
    $lastName =$row['lastName'];
    $password =$row['password'];
    $mobile =$row['mobile'];
    $email =$row['email'];
    $address =$row['address'];
    $postcode =$row['postcode'];
    $state =$row['state'];
?>
    <form action="manageProfile.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="username">Username </label>
                    <input type="text"  class="form-control" id="username"  name="username" size="15" maxlength="20" value="<?php echo $username; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="firstName">First Name </label>
                    <input type="text"  class="form-control" id="firstName"  name="firstName" size="15" maxlength="20" value="<?php echo $firstName; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="lastName">Last Name </label>
                    <input type="text"  class="form-control" id="lastName"  name="lastName" size="15" maxlength="20" value="<?php echo $lastName; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="mobile">Phone Number </label>
                    <input type="text"  class="form-control" id="mobile"  name="mobile" size="15" maxlength="20" value="<?php echo $mobile; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="email">Email Address </label>
                    <input type="text"  class="form-control" id="email"  name="email" size="15" maxlength="20" value="<?php echo $email; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="address">Address </label>
                    <input type="text"  class="form-control" id="address"  name="address" size="15" maxlength="20" value="<?php echo $address; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="postcode">Post Code </label>
                    <input type="text"  class="form-control" id="postcode"  name="postcode" size="15" maxlength="20" value="<?php echo $postcode; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
                <div class="form-group">
                    <label for="state">State </label>
                    <input type="text"  class="form-control" id="state"  name="state" size="15" maxlength="20" value="<?php echo $state; ?>" /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
               
        <button type="submit" class="btn btn-primary">
                    <?php { echo 'Update ';}?>
                </button>&nbsp;
	<a href="managePassword.php"><button type="button" class="btn btn-danger">
                    Manage Password
                </button></a>
                <p>
                
            </div>
</div>

<?php }?>
    </form>
<?php include ('includes/foot.php');
?>