
<html>
<head">
	<title><?php echo $page_title; ?></title>	
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src=
"https://code.jquery.com/jquery-3.5.0.js">
    </script></head>
<body>
	<div id="header">
		<h1>Computer Rental System (CRS)</h1>
		<!-- <h2>Welcome to my website</h2> -->
	</div>
	<div id="navigation">
		<ul>
			
    <?php 

        if (isset($_SESSION['userId'])) {
            if($_SESSION['level'] ==1){

                echo '
                <li><a href="productList.php">Product List</a></li>
                <li><a href="viewAllOrder.php">View All Order</a></li>
                <li><a href="delivery.php">Delivery</a></li>
                <li><a href="logout.php">Logout</a></li>';
            }else{

                echo '
                <li><a href="productList.php">Product List</a></li>
                <li><a href="myOrder.php">My Order</a></li>
                <li><a href="manageProfile.php">Manage Profile</a></li>
                <li><a href="logout.php">Logout</a></li>';
            }
        } else {
            echo '<li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>';
        }
    ?>
		</ul>
	</div>
	<div id="content">