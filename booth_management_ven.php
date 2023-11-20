<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Booth Management</title>
        <link rel="stylesheet" href="includes/styles.css"/>
    </head>
<style>
    body {
        background: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ), url('assets/img/hero-carousel/2.jpg');
        background-size: 2500px;
        background-color: #333;
    }  
    .card {
        margin: auto;
        margin-top: 20px;
        padding: 10px;     
    }
    input[type='text']{
        width: 600px;
        border-radius: 2px;
        border: 1px solid #CCC;
        padding: 10px;
        color: #333;
        font-size: 14px;
        margin-top: 10px;
        }
    textarea {
        width: 600px;
        border-radius: 2px;
        border: 1px solid #CCC;
        padding: 10px;
        color: #333;
        font-size: 14px;
        margin-top: 10px;
    }
    
</style>
<?php
    ob_start();
    include ("auth.php");
    include('includes/vendor_header.html');
    require('mysqli_connect.php');

    $username = $_SESSION['username'];
            // Get id from url to know which user
            if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
                $id = $_GET['id'];
            }
            //elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            //    $id = $_POST['id'];
            //}
            else {
                echo '<p class="error">This page has been accessed in error.</p>';
                exit();
            }
?>
<body>


<div class="container">
    <div class="row mt-5">
        <div class="col">
            <?php
                $query = "SELECT * FROM event_booth INNER JOIN event_post 
                ON event_post.event_name = event_booth.event_name WHERE event_booth.booth_id='$id'";
                $result = mysqli_query ($dbc, $query);
                $num = mysqli_num_rows($result);
                
                if ($num == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card bg-white p-3" style="width: 500px;border-radius: 20px;">
                            <div class="card-body text-center">
                                <h4 class="card-title mb-4" style="text-align:center; font-weight:bold;">'. $row['event_name'] .'</h4>
                                <img src="event_post/poster/' . $row['poster'] . '" style="width:300px; height:300px;">
                                
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal'. $row['post_id'] .'">
                                View Floor Plan
                                </button>
                                <div class="modal fade" id="exampleModal'. $row['post_id'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-decoration-none" id="exampleModalLabel">' . $row['event_name'] . ' <span class="badge bg-info">Floor Plan</span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="event_post/floor_plan/' . $row['floor_plan'] . '" width="465" height="465">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>';
                    }
                    
                }
                else {
                    
                }                
            ?>
        </div> <!-- Close 1st Column -->

        <div class="col">
            <!-- Added a card from Bootstrap -->
            <div class="card bg-white p-3" style="width: 700px;border-radius: 20px;">
                <div class="card-body">
                    <h4 class="card-title" style="text-align:center; font-weight:bold;">Booth Management</h4>

                    <!-- Added form elements from Bootstrap (form-label, form-control) -->
                    <div class="container" style="margin-top:25px">
                                <!-- Booth Number -->
                                <div class="col-sm-12" style="margin-top:20px">
                                    <label for="booth_number" class="form-label fw-bold">Your booth number is: </label>
                                    <?php 
                                        $query = "SELECT * FROM event_booth INNER JOIN event_post 
                                        ON event_post.event_name = event_booth.event_name WHERE booth_id = $id";
                                        $result = mysqli_query($dbc, $query);
                                        $num = mysqli_num_rows($result);
                                        $row = mysqli_fetch_assoc($result);
                                        $booth_number = $row['booth_number'];
                                        echo '<input id="booth_number" type="text" name="booth_number" class="form-control" value="'.  $booth_number .'" disabled>';
                                    ?>
                                </div>
                                <!-- Booth Price -->
                                <div class="col-sm-12" style="margin-top:20px">
                                    <label for="booth_price" class="form-label fw-bold">Booth Price (RM):</label>
                                    <?php echo '<input id="booth_price" type="text" name="booth_price" class="form-control" value="'.  $row['booth_price'] .'" disabled>';?>
                                </div>
                                <!-- Status -->
                                <div class="col-sm-12" style="margin-top:20px">
                                    <label for="status" class="form-label fw-bold">Status:</label>
                                    <?php
                                    if ($row['status'] == 'Requested') {
                                        echo '<input id="status" type="text" name="status" class="form-control" value="Awaiting Approval" disabled>';
                                    }
                                    else if ($row['status'] == 'Approved') {
                                        echo '<input id="status" type="text" name="status" class="form-control" value="Awaiting Payment" disabled>';
                                    }
                                    else if ($row['status'] == 'PaymentSuccess') {
                                        echo '<input id="status" type="text" name="status" class="form-control" value="Awaiting Confirmation" disabled>';
                                    }
                                    else if ($row['status'] == 'Confirmed') {
                                        echo '<input id="status" type="text" name="status" class="form-control" value="Confirmed" disabled>';
                                    }
                                    ?>
                                </div>
                                <!-- Submit -->
                            <form class="row" action="" method="post" name="application_details" enctype="multipart/form-data">
                                <?php 
                                if ($row['status'] == 'Requested') {
                                    echo '<input name="submit_cancel" type="submit" value="Cancel Booking" style="margin-top:20px"/>';     
                                }
                                else if ($row['status'] == 'Approved') {
                                    echo '
                                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Make Payment</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Debit/Credit Card Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="" method="post" name="payment">
                                            <div class="mb-3">
                                            <label for="card_number" class="col-form-label">Debit/Credit Card No.:</label>
                                            <input type="text" class="form-control" autocomplete="tel-national" id="card_number" name="card_number" style="width: 450px;" placeholder="1234 1234 1234 1234">
                                            </div>
                                            <div class="mb-3">
                                            <label for="expiration_date" class="col-form-label">Expiration Date:</label>
                                            <input type="text" class="form-control" id="expiration_date" name="expiration_date" style="width: 450px;" placeholder="MM/YY">
                                            </div>
                                            <div class="mb-3">
                                            <label for="cvc" class="col-form-label">CVC:</label>
                                            <input type="text" class="form-control" id="cvc" name="cvc" style="width: 450px;" placeholder="098">
                                            </div>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                        <input name="submit" type="submit" value="Proceed Payment" class="btn btn-primary mx-auto"/>
                                        </div>
                                    </div>
                                    </div>
                                    </div>';     
                                }
                                else if ($row['status'] == 'PaymentSuccess') {
    
                                }
                                else if ($row['status'] == 'Confirmed') {
                                }
                                ?>
                            </form>
                            <!-- Back Button -->
                            <?php echo '<form action="vendor_dashboard.php" method="POST" style="text-align: center;">'?>
                                    <input type="submit" value="Back"/>
                            </form>
                    </div> <!-- Container -->
                    </div> <!-- Card Body -->
                </div> <!-- Card -->

        </div> <!-- Close 2nd Column -->
    </div> <!-- Row -->
</div> <!-- Container -->

 
    <?php
    
    if (isset($_POST['submit'])) {
        
        $card_number = stripslashes($_REQUEST['card_number']);
        $card_number = mysqli_real_escape_string($dbc, $card_number);
        $exp_date = stripslashes($_REQUEST['expiration_date']);
        $exp_date = mysqli_real_escape_string($dbc, $exp_date);
        $cvc = stripslashes($_REQUEST['cvc']);
        $cvc = mysqli_real_escape_string($dbc, $cvc);

        $query = "SELECT * FROM bankcard WHERE card_number='$card_number' AND expiration_date='$exp_date'
        AND cvc='$cvc'";
        $result = mysqli_query($dbc,$query);
        $num = mysqli_num_rows($result);
        if ($num ==1) {
            echo '<script type="text/javascript">
                    window.onload = function () { alert("Payment successful! RM'. $row['booth_price'] .' had been deducted from your card! You will be redirected back to your dashboard!"); } 
                </script>
            ';

            $booth_price = $row['booth_price'];
            $event_name = $row['event_name'];
            $post_id = $row['post_id'];
            $organizer_id = $row['organizer_id'];

            $query = "SELECT * FROM event_booth WHERE booth_id='$id'";
            $result = mysqli_query($dbc,$query);

            $query = "UPDATE event_booth SET status='Confirmed' WHERE booth_id='$id'";
            $result = mysqli_query($dbc,$query);

            $query = "SELECT * FROM vendor WHERE username='$username'";
            $result = mysqli_query($dbc,$query);
            $row = mysqli_fetch_assoc($result);
            $vendor_id = $row['vendor_id'];

            $query = "INSERT into inbox (notification_date, status, event_name, vendor_id, organizer_id, post_id) 
            VALUES (now(), 'Payment', '$event_name', '$vendor_id', '$organizer_id', '$post_id')";
            $result = mysqli_query($dbc,$query);

            header( "refresh:3;url=vendor_dashboard.php?id=' . $id . '" );
        }
       
        else {
            echo '<script type="text/javascript">
                    window.onload = function () { alert("Payment unsuccessful! Please try again!"); } 
                </script>
            ';
        }

        }
    
        if (isset($_POST['submit_cancel'])) {
            $query = "SELECT * FROM vendor WHERE username='$username'";
            $result = mysqli_query($dbc,$query);
            $row = mysqli_fetch_assoc($result);
            $vendor_id = $row['vendor_id'];

            $query = "SELECT * FROM event_booth INNER JOIN event_post WHERE booth_id='$id'";
            $result = mysqli_query($dbc,$query);
            $row = mysqli_fetch_assoc($result);
            $booth_quantity = $row['booth_quantity'];
            $event_name = $row['event_name'];

            $query = "UPDATE event_booth SET username='None', status='Available', vendor_id='0' WHERE booth_id='$id'";
            $result = mysqli_query($dbc,$query);
            $booth_quantity = $booth_quantity + 1;

            $query = "UPDATE event_post SET booth_quantity='$booth_quantity' WHERE event_name='$event_name'";
            $result = mysqli_query($dbc,$query);
          
            echo '<script type="text/javascript">
                    window.onload = function () { alert("Booth request has been canceled, redirecting to dashboard.."); } 
                </script>
            ';
            header( "refresh:3;url=vendor_dashboard.php?id=' . $id . '" );

        }

                
        ?> 



    </body>
</html>