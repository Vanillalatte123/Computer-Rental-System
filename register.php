<?php
$page_title = 'Welcome to this Site!';
include ('includes/head.php');

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

        if (empty($_POST['password'])) {
            $errors[] = 'You forgot to enter your password.';
        } else {
            $password = trim($_POST['password']);
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
        
            
            require ('includes/mysqli_connect.php');
    
            $q1 = "INSERT INTO user (username,firstName, lastName,password,mobile,email,address,postcode,state,modifiedDate) VALUES ('$username', '$firstName', '$lastName', SHA1('$password'), '$mobile','$email', '$address', '$postcode', '$state','$date')";		
            // $r1 = @mysqli_query ($dbc, $q1);
            $r1 = mysqli_query($dbc, $q1);

            // $memberId = mysqli_insert_id($dbc);

            if ($r1) {
                
                echo '<h1>Thank you!</h1>
                <p>You are now registered.</p><p><br /></p>';	
            } else {

                echo '<h1>System Error</h1>
                <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
        
                echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
                    
            }
            
            mysqli_close($dbc);
            
            include ('includes/foot.php'); 
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


<div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
				<form action="register.php" method="post" id="request" class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <h3>Register Form</h3>
                        </div>
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Username" id="username"  name="username" size="15" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" > 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="First name" id="firstName"  name="firstName" size="15" maxlength="30" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" > 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Last name" id="lastName"  name="lastName" size="15" maxlength="30" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>" > 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Password" id="password"  name="password" size="15" maxlength="30" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" > 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number (without dash(-))" id="mobile" name="mobile" size="15" maxlength="13" value="60<?php if (isset($_POST['mobile'])) echo $_POST['mobile']; ?>" /> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" id="email" name="email" size="15" maxlength="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Address" id="address" name="address" size="15" maxlength="200" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" />
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Postcode id="postcode" name="postcode" size="15" maxlength="5" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>" />
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="State" id="state" name="state" size="15" maxlength="20" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" />
                        </div>
    					<input type="hidden" name="action" value="login" size="20" maxlength="20" />
                        <div class="col-md-12">
                           <input type="submit" name="submit" value="Register" class="send_btn"/>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
    
<?php include ('includes/foot.php');
?>