<?php



$page_title = 'Login';
include ('includes/head.php');
require ('includes/mysqli_connect.php');
function redirect_user ($page = 'index.php') {

	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	$url = rtrim($url, '/\\'); 
	
	$url .= '/' . $page;
	
	header("Location: $url");
	exit();

}

function check_login($dbc, $username = '', $password = '') {
	$errors = array();

	if (empty($username)) {
		$errors[] = 'You forgot to enter your username address.';
	} else {
		$username = mysqli_real_escape_string($dbc, trim($username));
	}

	if (empty($password)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($password)); 
	}
	echo $p;
	if (empty($errors)) {

		echo $q = "SELECT * FROM user WHERE username = '$username' AND password=SHA1('$p')";		
		$r = @mysqli_query ($dbc, $q);
		
		if (mysqli_num_rows($r) == 1) {

			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

			return array(true, $row);
			
		} else {
			$errors[] = 'The username and password entered do not match those on file.';
		}
		
	}

	return array(false, $errors);

}

if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_REQUEST['action'] == 'login'){
        
        list ($check, $data) = check_login($dbc, $_REQUEST['username'], $_REQUEST['password']);
	
	if ($check) {

		session_start();
		$_SESSION['userId'] = $data['userId'];
		$_SESSION['firstName'] = $data['firstName'];
		$_SESSION['level'] = $data['level'];
		
		redirect_user('loggedin.php');
			
	} else {

		$errors = $data;

	}
		
	mysqli_close($dbc);
    }
    
}
?>
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
				<form action="login.php" method="post" id="request" class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <h3>Login Form</h3>
                        </div>
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Username" type="text" name="username" size="20" maxlength="60" > 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" type="password" placeholder="Password" name="password" size="20" maxlength="20"> 
                        </div>
    					<input type="hidden" name="action" value="login" size="20" maxlength="20" />
                        <div class="col-md-12">
                           <input type="submit" name="submit" value="Login" class="send_btn"/>
                           <a href="resetPassword.php"><button type="button" class="danger_btn"> Reset Password </button></a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact section -->
      
      
      <?php



include ('includes/foot.php');
?>