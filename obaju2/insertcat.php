<?php
require_once 'user.php';
session_start();
require 'config.php';
if(!isset($_SESSION['email'])){

    header("Location: register.php");
}
else {
    require 'cart.php';

    $prod_id = $_GET['prod_id'];
    $user_id = 0;
    $user_email = $_SESSION['email'];
    $user = new users();
    $user->email = $user_email;
    $result = $user->selectAll();
    while ($row = $result->fetch_array()) {
        $user_id = $row['id'];
        $_SESSION['user_id'] = $user_id;
    }


    $cart = new cart();
    $cart->user_id = $user_id;
    $cart->product_id = $prod_id;


    if ($cart->insert()) {


        header("Location:basket.php");

    } else
        echo "insert failed";
}
?>