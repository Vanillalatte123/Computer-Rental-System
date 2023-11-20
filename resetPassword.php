<?php


require ('includes/mysqli_connect.php');
$page_title = 'Reset Your Password';
include ('includes/head.php');


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();
        
        if (empty($_POST['username'])) {
            $errors[] = 'You forgot to enter your username.';
        } else {
            $username = trim($_POST['username']);
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
        if (empty($_POST['newPassword'])) {
            $errors[] = 'You forgot to enter your New Password';
        } else {
            $newPassword = trim($_POST['newPassword']);
        }

        if (empty($_POST['newPasswordConfirm'])) {
            $errors[] = 'You forgot to enter your New Password';
        } else {
            $newPasswordConfirm = trim($_POST['newPasswordConfirm']);
        }

        if($_POST['newPassword'] != $_POST['newPasswordConfirm']){

            $errors[] = 'Password Mismatch.';
        }

            $chk="";
        if (empty($errors)) { 
        
            
            $sql = "SELECT * FROM `user` WHERE  `username`='$username' AND `email`='$email'";
            $result = $conn->query($sql);
            
            if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            
                
                $id =$row['userId'];

                    $q1 = "UPDATE `user` SET
                    `password`= SHA1('$newPasswordConfirm')
                    WHERE `userId` = $id";		
                    // $r1 = @mysqli_query ($dbc, $q1);
                    $r1 = mysqli_query($dbc, $q1);
        
        
                    if ($r1) {
                        
                        echo '<h1>Thank you!</h1>
                        <p>Your Password Has Been Updated.</p><p><br /></p>';	
                    } else {
        
                        echo '<h1>System Error</h1>
                        <p class="error">Your password cannot be update due to a system error. We apologize for any inconvenience.</p>'; 
                
                        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
                            
                    }
                }else{
                
                    echo '<h1>System Error</h1>
                    <p class="error">Record Not Exist1</p>'; 
                }
            }else{
                
                echo '<h1>System Error</h1>
                <p class="error">Record Not Exist</p>'; 
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
    <form action="resetPassword.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class=" col-lg-12 ">
                <div class="form-group">
                    <label for="username">Username </label>
                    <input type="text"  class="form-control" id="username"  name="username" size="15" maxlength="20"  /> 
                </div>
            </div>
            <div class=" col-lg-12 ">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text"  class="form-control" id="email"  name="email" size="15" maxlength="50"  /> 
                </div>
            </div>
            <div class=" col-lg-12 ">
                <div class="form-group">
                    <label for="firstName">New Password</label>
                    <input type="text"  class="form-control" id="newPassword"  name="newPassword" size="15" maxlength="20" /> 
                </div>
            </div>
            <div class=" col-lg-12 ">
                <div class="form-group">
                    <label for="lastName">Confirm New Password</label>
                    <input type="text"  class="form-control" id="newPasswordConfirm"  name="newPasswordConfirm" size="15" maxlength="20"  /> 
                </div>
            </div>
            <div class=" col-lg-6 ">
               
        <button type="submit" class="btn btn-primary">
                    <?php { echo 'Update ';}?>
                </button>
                <a href="login.php"><button type="button" class="btn btn-primary">
                    Back To Login
                </button></a></p>
            </div>

    </form>
<?php include ('includes/foot.php');
?>