<?php
session_start();
require_once("php/component1.php");
require("php/database.php");
if (isset($_POST['add'])) {
  $quantity=$_POST['quantity'];
  //$_SESSION['quantity']=$quantity;
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
            mysqli_stmt_bind_result($stmt,$id,$name,$price,$img,$stored);
            (mysqli_stmt_fetch($stmt)); }
          
            $item_array = array(
            'item_id'     =>  $id,
            'item_name'     =>  $name,
            'item_price'    =>  $price,
            'item_quantity'   =>  $quantity,
            'item_img'      =>  $img,
            'item_storage'      => $stored
            );
            if (isset($_COOKIE['shoppingcart'])) {
            $cookie_data=stripslashes($_COOKIE['shoppingcart']);
            $cart_data=json_decode($cookie_data,true);
            $cart_data[]=$item_array;
            	# code...
            }
            else{
            $cart_data[]=$item_array;	
            }

            $item_data=json_encode($cart_data);
            setcookie('shoppingcart',$item_data,time()+(86400*30));
            header("location:Shopping.php?success=1");
        }}
            if (isset($_GET["success"])) {
            $message='<div class="alert alert-sucess"> Item Added successfully</div>';
      # code...
            }
            else{
            $message="";
             }

            //$cookie_data=stripslashes($_COOKIE['shoppingcart']);
            //$cart_data=json_decode($cookie_data,true);
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
  ?>
<!DOCTYPE html>
<html lang='en'>
 <head>
    <link rel="shortcut icon" href="img/Logo-tilte.png" type="image/x-icone">
	   <meta charset="utd-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Warriors Store</title>
	   <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
	   <link rel="stylesheet" href="style-shop.css">
	   <link rel="stylesheet" href="css/fixed.css">
 </head>
 <body>
  	<!--N A V B A R-->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#"><img src="img/Logo-tilte.png" width="110px";></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
     <ul class="navbar-nav ml-auto">

      <li class="nav-item active">
       <a class="nav-link" href="#home">Store</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="#Items">Items</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="#">Sign up</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="#">Login</a>
      </li>
     </ul>
    </div>
  </nav>
<!--endnav-->
  <!--Landing-->
	<div class="landing" id="home">
      <div class="home-wrap">
		<div class="home-inner">
		  </div>
	  </div>
	</div>
		<div class="caption text-center">
			<h1>Welcome to our store</h1>
			<h3>Lets go shopping</h3>
		</div>
		<!--End-Landing-->
<!--shop-->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Items</h1>
			<hr style="margin-bottom:5px !important; margin-top:5px !important;" />
		</div>
	</div>
</div>      
<div class="container" id="Items">     
    <div class="row text-center py-3">
        <?php
        component('Wrist Wrap',80,120,'','img/prod1.jpeg','wrist-01');
        component('Hoodie',350,400,'Out of Stock','img/prod2.jpg','hoodie-01');
        component('Cali Shirt',220,260,'','img/prod3.jpg','shirt-01');
        component('Freestyle Shirt',200,260,'','img/prod4.jpg','shirt-02');
        ?>
    </div>
</div>
<!--E N D- S H O P-->
<div class="container">
<div class="row">
  <p>     <?php echo $message; ?></p>
</div>
<div class="row text-center">
  <table>
      <form >
       <thead>
      <tr>
        <th class="th-sm" id="plans" >Name</th>
        <th class="th-sm" id="plans">Price</th>
        <th class="th-sm" id="plans">Quantity</th>
        <th class="th-sm" id="plans">Total</th> 
        <th class="th-sm" id="plans">Remaining</th>
        <th class="th-sm" id="plans">Product</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php 
          if(isset($_COOKIE['shoppingcart']))
          {
            $cookie_data=stripslashes($_COOKIE['shoppingcart']);
            $cart_data=json_decode($cookie_data,true);
          foreach($cart_data as $keys => $values)
            {
         ?>
        <td id=""><?php echo $values["item_name"]; ?></td>
        <td id=""><?php echo $values["item_price"]; ?></td>
        <td id=""> <?php echo $values["item_quantity"]; ?></td>
        <td id="">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
        <td id=""> <?php echo $values["item_storage"]; ?></td>
        <td id=""><img src="img/prod<?=$values['item_img']?>" style="width: 50px;"></td>
        <td class="th-sm" id="plans"><button type="submit" name="submit" value="ordered" class=" btn btn-warning">order</button></td>
      </tr>
    <?php 
}
}
 ?></tbody>
    </form>
  </table>
</div>
</div>
<div class="container">
 <hr>
 <div class="row">
        <div class="col-md-4">
          <div class="block">
           <i class="fas fa-shopping-cart " style="    width: 60px;
    height: 70px;"></i>
            <h3 class="block__heading heading--4">Shoping Lowest Price🔥 </h3>
            <p class="block__content py-3">Find Our Lowest Possible Price ✓<br> Cheapest Shoping For Sale ✓<br> Special Discounts ✓</p>
</div>        </div>
        <br>
        <div class="col-md-4">
          <div class="block">
           <i class="fas fa-tshirt" style="    width: 60px;
    height: 70px;"></i>
            <h3 class="block__heading heading--4">High Quality T-Shirts from Bar Warriors 🤙</h3>
            <p class="block__content">Unique designs ✓ <br>Shop High QualityT-Shirts now!✓</p>
</div>        </div>
        <br>
        <div class="col-md-4">
          <div class="block">
           <i class="fas fa-truck" style="    width: 60px;
    height: 70px;"></i>
            <h3 class="block__heading heading--4">Delivery </h3><br>
            <p class="block__content">Delivery is available anywhere in Egypt 💯</p>
</div>        </div>
        </div>
    </div>
<!-- F O O T E R-->
<footer class="page-footer font-small unique-color-light" style="
    padding-top: 10px;"id="about">

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-1">

    <!-- Grid row -->
    <div class="row mt-2 ">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 ">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">Bar Warriors 🔥</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 150px; background-color:#6B1717; ">
        <p>A series of unique and up-to- date training, Specially designed and Implemented for SWA members<br><br>
				- Small group workouts, Private classes or one-to- one training, All at very competitive prices.<br><br>
				- Life coaching and Motivation training by top Highly Qualified trainers</p>

      </div>
      <!-- Grid column -->

      
      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Useful links</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color:#6B1717;">
        <p>
          <a href="#!" style="color:#6B7177;">Your Account</a>
        </p>
        <p>
          <a href="#!" style="color:#6B7177;">Become an Affiliate</a>
        </p>
        <p>
          <a href="#!" style="color:#6B7177;">Help</a>
        </p>

      </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color:#6B1717;">
        <p>
          <i class="fas fa-home mr-3"></i> Egypt, PortSaid, Almudinuh Alriyadiuh</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> Bar-Warriors@gmail.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> +20 102 008 0896</p>
        <p>
          <i class="fas fa-phone mr-3"></i> +20 0155 093 2670</p>
				<br>
          <a class="fb-ic" href="https://www.facebook.com/BarWarriorsTeam/" target="_blank">
            <i class="fab fa-facebook-f white-text mr-4"></i>
          </a>
          <!-- Google +-->
          <a class="gplus-ic" href="#"target="_blank">
            <i class="fab fa-google-plus-g white-text mr-4"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic" href="https://instagram.com/bar.warriors?igshid=1roouxhlbq5bj" target="_blank">
            <i class="fab fa-instagram white-text"> </i>
          </a>
          
      </div>

    </div>

  </div>
         <!-- Copyright -->
  <div class="footer-copyright text-center py-2" style="background-color:#050404 ;">Powered and developed by
    <i class="fas fa-code"></i><a href="https://www.facebook.com/profile.php?id=100009994175396"
    target="_blank" style="color: #542525;"> Fares M.Soltan</a> ,
    <a href="https://www.facebook.com/ahmed.aboemira.10" target="_blank" style="color: #542525;">
     Ahmed Aboemira</a>
  </div>
  <!-- Copyright -->
</footer>
<!--E N D Footer -->


 <!--- Script Source Files -->
 <script src="../home/js/jquery-3.3.1.min.js"></script>
 <script src="../home/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
 <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
 <!--- End of Script Source Files -->
 </body>
