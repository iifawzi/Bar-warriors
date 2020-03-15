<?php
require("database.php");
session_start();
if (isset($_POST['add'])) {
	$quantity=$_POST['quantity'];
	$_SESSION['quantity']=$quantity;
	$code=$_POST['productcode'];
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
						mysqli_stmt_bind_result($stmt,$_SESSION['id'],$_SESSION['name'],$_SESSION['price'],$_SESSION['img'],$_SESSION['stored_quantity']);
						if (mysqli_stmt_fetch($stmt)) {
						$item_array = array(
						'item_id'			=>	$_SEISSION["id"],
						'item_name'			=>	$_SESSION["name"],
						'item_price'		=>	$_SESSION["price"],
						'item_quantity'		=>	$quantity,
						'item_img' 			=>  $_SESSION['img'],
						'item_storage'      => $_SESSION['stored_quantity']
						);
						$cart_data[]=$item_array;
						setcookie('shoppingcart',$item_data,time()+(86400*30));
						if(isset($_COOKIE['shoppingcart'])){
						$total = 0;
						//$cookie_data=stripslashes($_COOKIE['shoppingcart']);
						//$cart_data=json_decode($cookie_data,true);
						foreach($cart_data as $keys => $values)
						{

						if (isset($_POST['submit'])) {
		  	   			$quantity = $values['item_quantity'];
  						$name = $values['item_name'];
  						$price=$values['item_price'];
  						$total=$price*$quantity;
   						$sql = "INSERT INTO orders ( name, quantity, price,total) VALUES('$name','$quantity','$price','$total')";
   						mysqli_query($connect,$sql);
   						header("location:index.php?submit&$name&$price");
   						setcookie("shoppingcart", "", time() - 3600);
		  				}

						//$id=$_SESSION['id'];
						//$name=$_SESSION['name'];
						//$price=$_SESSION['price'];
						//$img=$_SESSION['img'];
						//$_SESSION['total']=$price*$quantity;
						//$total=$_SESSION['total'];
						//$_SESSION['stored_quantity']=$_SESSION['stored_quantity']-$quantity;
						//$stored_quantity=$_SESSION['stored_quantity'];
						//$sql="UPDATE `products` SET Quantity=? WHERE product_id=?";
						//$stmt=mysqli_stmt_init($conn);
							//if (!mysqli_stmt_prepare($stmt,$sql)) {
							//die('sql error');
							//}
							//elseif (mysqli_stmt_prepare($stmt,$sql)) {
							//mysqli_stmt_bind_param($stmt,"ss",$stored_quantity,$id);
							//mysqli_stmt_execute($stmt);
				}
			}


	# cod...
}
}
}
  ?>
