<?php
require_once 'user.php';
session_start();
require 'config.php';
ob_start();
$_SESSION['email'] = $_POST['email'];
$user = new users();
$user->passwd = $_POST['pass'];
$user->email= $_POST['email'];

 $res=$user->select();

if($res == 1)
    $result = "admin";

else if ($res == 0)
    $result = "user";

else if($res == false)
    $result = "false";

echo json_encode($result);
?>