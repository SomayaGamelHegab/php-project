<?php
require_once 'user.php';
session_start();
require 'config.php';
ob_start();
$user = new users();
$user->email =$_SESSION['email'];
$user->name=$_POST['name'];
$user->address=$_POST['address'];
$user->birthDay=$_POST['birth'];
$user->job=$_POST['job'];
$user->creditLimit=$_POST['credit'];

$res=$user->update_data();
if($res == true){
    $result = "success";
}
else if ($res == false){
    
    $result = "failed";
}
echo json_encode($result);
?>