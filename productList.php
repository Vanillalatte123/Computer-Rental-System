<?php 

session_start();
require ('includes/mysqli_connect.php');

if (!isset($_SESSION['userId'])) {

	require ('includes/loginFunction.inc.php');
	redirect_user();	

}

$page_title = 'Product List';
include ('includes/head.php');

$sql = "SELECT * FROM `product` WHERE  `productType`=1";
$result = $conn->query($sql); 

$sql2 = "SELECT * FROM `product` WHERE  `productType`=2";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM `product` WHERE  `productType`=3";
$result3 = $conn->query($sql3);



$sqlDelivery = "SELECT * FROM `delivery` ";
$resultDelivery = $conn->query($sqlDelivery); 



$level = $_SESSION['level'];
?>
<div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
	<h1>
		<span>Product List<span>
			<div class="row">
				<div class="col-lg-6">Select Courier
				<select name="delivery" id="delivery"  class="form-control">
                        <option value="" disabled>--- Choose a type ---</option>
						<?php
						
		while($row2 = $resultDelivery->fetch_assoc()) {

			?>
<option value="<?= $row2['Id']?>" ><?= $row2['deliveryName']?></option>
			<?php
		}
						?>
                    </select> 
				</div>
</div>
	</h1>
	<?php if($level ==1){?>

	<div class="btn-text-right">
	<a href="productDetail.php" class="button">Add Product</a>
</div>


<?php } ?>
	<br><br>
	<div>
	<h2>Computer<h2>
  <div class="row ">
  <?php
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
	
			?>
			<div>
				<div class=" col-lg-4 grid">

					<div><h3><?= $row["productModel"]?></h3> </div>
					<div>
						<?php if($row["productImage"]){?>
							<img src = "<?= $row["productImage"]?>" width ="200px" height="150px">
						<?php }else{?>
							<img src = "asus.jpg" width ="200px">
							
						<?php } ?>
						</div>
					<div>
					<table width="100%" border="1">
						<tr>
							<th>Price</th>
							<td>RM <?= $row["productPrice"]?></td>
						</tr>
						
						<tr>
							<th>CPU</th>
							<td><?= $row["cpu"]?></td>
						</tr>
							
						<tr>
							<th>GPU</th>
							<td><?= $row["gpu"]?></td>
						</tr>
						<tr>
							<th>RAM</th>
							<td><?= $row["ram"]?></td>
						</tr>
						<tr>
							<th>Storage</th>
							<td><?= $row["storage"]?></td>
						</tr>
						
						<tr>
							<th>MISC</th>
							<td><?= $row["misc"]?></td>
						</tr>
						<!-- <tr>
							<th>ID</th>
							<td><?= $row["Id"]?></td>
						</tr> -->
						</table>
							<?php if($level ==1){?>
		
								<!-- <button type="button" onclick="addToCart(<?= $row['Id'] ?>)"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button> -->
                <a href="productDetail.php?id=<?= $row["Id"] ?>" ><button type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>
                <button type="button" onclick="myFunction(<?= $row['Id'] ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>

<?php }else{ ?>
                  
	<button type="button" onclick="addToCart(<?= $row['Id'] ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button>

<?php } ?>
						
					</div>
				</div>
			</div>
			
		  <?php
		}
	  } else {
		echo "0 results";
	  }
	
	
	?>
    
	</div>
	</div>
	<div>
	<h2>Laptop<h2>
	<div class="row ">
  <?php
	
	if ($result2->num_rows > 0) {
		// output data of each row
		while($row = $result2->fetch_assoc()) {
	
			?>
			<div>
				<div class=" col-lg-4 grid">

					<div><h3><?= $row["productModel"]?></h3> </div>
					<div>
					<?php if($row["productImage"]){?>
							<img src = "<?= $row["productImage"]?>" width ="200px" height="150px">
						<?php }else{?>
							<img src = "asus.jpg" width ="200px">
							
						<?php } ?>
					</div>
					<div>
					<table width="100%" border="1">
						<tr>
							<th>Price</th>
							<td>RM <?= $row["productPrice"]?></td>
						</tr>
						
						<tr>
							<th>CPU</th>
							<td><?= $row["cpu"]?></td>
						</tr>
							
						<tr>
							<th>GPU</th>
							<td><?= $row["gpu"]?></td>
						</tr>
						<tr>
							<th>RAM</th>
							<td><?= $row["ram"]?></td>
						</tr>
						<tr>
							<th>Screen</th>
							<td><?= $row["screen"]?></td>
						</tr>
						<tr>
							<th>Storage</th>
							<td><?= $row["storage"]?></td>
						</tr>
						
						<tr>
							<th>MISC</th>
							<td><?= $row["misc"]?></td>
						</tr>
						</table>
						<?php if($level ==1){?>
		
		<!-- <button type="button" onclick="addToCart(<?= $row['Id'] ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button> -->
<a href="productDetail.php?id=<?= $row["Id"] ?>" ><button type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>
<button type="button" onclick="myFunction(<?= $row['Id'] ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>

<?php }else{ ?>
<button type="button" onclick="addToCart(<?= $row['Id'] ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button>

<?php } ?>

					</div>
				</div>
			</div>
			
		  <?php
		}
	  } else {
		echo "0 results";
	  }
	
	
	?>
    
	</div>
	</div>




	<div>
	<h2>Mobile<h2>
	<div class="row ">
  <?php
	
	if ($result3->num_rows > 0) {
		// output data of each row
		while($row = $result3->fetch_assoc()) {
	
			?>
			<div>
				<div class=" col-lg-4 grid">

					<div><h3><?= $row["productModel"]?></h3> </div>
					<div>
					<?php if($row["productImage"]){?>
							<img src = "<?= $row["productImage"]?>" width ="200px" height="150px">
						<?php }else{?>
							<img src = "asus.jpg" width ="200px">
							
						<?php } ?>
					</div>
					<div>
					<table width="100%" border="1">
						<tr>
							<th>Price</th>
							<td>RM <?= $row["productPrice"]?></td>
						</tr>
						
						<tr>
							<th>CPU</th>
							<td><?= $row["cpu"]?></td>
						</tr>
							
						<tr>
							<th>GPU</th>
							<td><?= $row["gpu"]?></td>
						</tr>
						<tr>
							<th>RAM</th>
							<td><?= $row["ram"]?></td>
						</tr>
						<tr>
							<th>Screen</th>
							<td><?= $row["screen"]?></td>
						</tr>
						<tr>
							<th>Storage</th>
							<td><?= $row["storage"]?></td>
						</tr>
						
						<tr>
							<th>MISC</th>
							<td><?= $row["misc"]?></td>
						</tr>
						</table>
						<?php if($level ==1){?>
		
		<!-- <button type="button" onclick="addToCart(<?= $row['Id'] ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button> -->
<a href="productDetail.php?id=<?= $row["Id"] ?>" ><button type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></a>
<button type="button" onclick="myFunction(<?= $row['Id'] ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>

<?php }else{ ?>
<button type="button" onclick="addToCart(<?= $row['Id'] ?>)" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></button>

<?php } ?>

					</div>
				</div>
			</div>
			
		  <?php
		}
	  } else {
		echo "0 results";
	  }
	
	
	?>
    
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</p>	

<script>
function myFunction(x) {
	console.log(x)
	var answer = confirm("Are you sure want to delete?")
	if (answer){

		var formData = {
			action: 'deleteProduct',
			id: x,
		};
		$.ajax({
                type: "POST",
                url: "includes/function.php",
                data: formData,
                success: function(data) {
                      console.log(data)
                    // Ajax call completed successfully
                    alert(data);
					
                },
                error: function(data) {
                      
                    // Some error in ajax call
                    alert("some Error");
                },
                complete: function(data) {
                      
					location.reload();
                }
            });
	}else{
		console.log(333);

	}
}


function addToCart(x) {
	console.log(x)
	var answer = confirm("Are you sure want to add product to cart?")
	
	var delivery=document.getElementById("delivery").value;
	if (answer){

		var formData = {
			action: 'addToCart',
			id: x,
			delivery: delivery,
			userId: <?= $_SESSION['userId']?>
		};
		$.ajax({
                type: "POST",
                url: "includes/function.php",
                data: formData,
                success: function(data) {
                      console.log(data)
                    // Ajax call completed successfully
                    alert(data);
					
                },
                error: function(data) {
                      
                    // Some error in ajax call
                    alert("some Error");
                },
                complete: function(data) {
                      
					location.reload();
                }
            });
	}else{
		console.log(333);

	}
}
</script>
<?php

include ('includes/foot.php');
?>