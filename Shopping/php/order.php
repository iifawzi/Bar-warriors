<?php  
//session_start();
//$id=$_SESSION['id'];
//$name=$_SESSION['name'];
//$price=$_SESSION['price'];
//$stored_quantity=$_SESSION['quantity'];
//$total=$_SESSION['total'];
//echo "We have sucessfully recived your order"
$code=$_GET['code'];
require("database.php");
$sql="SELECT product_id,name,price,img,Quantity FROM products WHERE code=?";
	$stmt=mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			die('sql error');
					# code...
			}
			elseif (mysqli_stmt_prepare($stmt,$sql)) {
					mysqli_stmt_bind_param($stmt,"s",$code);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$result=mysqli_stmt_num_rows($stmt);
					if ($result>0) {
					mysqli_stmt_bind_result($stmt,$id,$name,$price,$img,$quantity);
					mysqli_stmt_fetch($stmt);
					$row=array(
						'id' =>$id , 
						'name'=>$name,
						'price'=>$price,
						'img'=>$img,
						'quantity'=>$quantity
				);
					echo $row['id'];
					}
				}
						?>
