<?php
require_once 'user.php';
session_start();
require 'config.php';
ob_start();
$user = new users();
$user->email =$_SESSION['email'];
$user->passwd=$_POST['newPasswd'];
$res=$user->update_passwd();
if($res == true){
    $result = "success";
}
else if ($res == false){
    
    $result = "failed";
}
echo json_encode($result);
?>