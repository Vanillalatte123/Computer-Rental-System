<?php 

session_start();
require ('includes/mysqli_connect.php');


if (!isset($_SESSION['userId'])) {

	require ('includes/loginFunction.inc.php');
	redirect_user();	

}

$page_title = 'My Order!';
include ('includes/head.php');

$userId  =  $_SESSION['userId'];
// $sql = "SELECT * FROM `orderproduct` WHERE `userId`=$userId";

$sql = "SELECT op.Id,op.totalPrice,op.contractMonth,pr.productCode,pr.productName,pr.productPrice,pr.productModel, pr.productType, pr.productDescription, pr.productImage, pr.cpu, pr.gpu, pr.ram, pr.storage, pr.screen, pr.misc,op.status,deli.deliveryName,deli.deliveryCharges   FROM `orderproduct`as op LEFT JOIN `product`as pr ON op.productId = pr.Id LEFT JOIN `delivery` as deli ON deli.Id = op.deliveryId WHERE op.userId=$userId";
$result = $conn->query($sql);
?>
<p>
<table  class="table  table-striped">
		<tr>
			<th>Image</th>
			<th>Product Name</th>
			<th>Model</th>
			<th>Price</th>
			<th>Total Price</th>
			<th>Status</th>
			<th>Action</th>
		</tr>

		<?php
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
	
			?>

<tr >
			<td>
				<?php if($row["productImage"]){?>
					<img src = "<?= $row["productImage"]?>" width ="200px" height="150px">
				<?php }else{?>
					<img src = "asus.jpg" width ="200px">
					
				<?php } ?>
			</td>
			<td>
				<p>Cpu : <?= $row["cpu"]?></p>
				<p>Gpu : <?= $row["gpu"]?></p>
				<p>RAM : <?= $row["ram"]?></p>
				<p>Storage : <?= $row["storage"]?></p>	
				<p>Screen : <?= $row["screen"]?></p>
				<p>MISC : <?= $row["misc"]?></p>	
			</td>
			<td> <?= $row["productModel"]?></td>
			<td>RM<?= $row["productPrice"]?><br/>(RM <?= $row["totalPrice"]?> x <?= $row["contractMonth"]?> Month)<br/>Delivery Charges(<?= $row["deliveryName"]?> - <?= $row["deliveryCharges"]?>)</td>
			<td>RM<?= $row["productPrice"] + $row["deliveryCharges"]?></td>
			<td> <?php 
			if($row["status"] == 1){
				echo "Pending";
			}else if($row["status"] == 2){
				echo "<div style='color:green'>Approve</div>";
			}else{
				echo "<div style='color:red'>Reject</div>";
			}
				?></td>
			<td>
			<a href="payment.php?id=<?= $row["Id"] ?>" ><button type="button" class="btn btn-success">Make A Payment</button></a>
			<button type="button" onclick="payment.php">Make A payment</button>
			<button type="button" onclick="myFunction(<?= $row['Id'] ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>
			</td>
		</tr>

<?php
		}
	}

?>
	</table>
</p>


<script>
function myFunction(x) {
	console.log(x)
	var answer = confirm("Are you sure want to delete?")
	if (answer){

		var formData = {
			action: 'deleteOrder',
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
</script>
<?php

include ('includes/foot.php');
?>