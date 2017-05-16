<?php
require 'cart.php';
#require 'ball.php';
#require 'order.php';


$cart_id = $_GET['cart_id'];

$cart = new cart();
$cart->id=$cart_id;
#$cart2=new cart();
#$cart2->id=$cart_id;
#$result=$cart2->selectprod();
#while ($row = $result->fetch_array()){
 #   $prod_id=$row['product_id'];
    #echo "prod_id".$prod_id;

#}

$cart->delete();
header("Location:basket.php");
#echo "cart_id".$cart_id;



?>
