<?php
require_once 'user.php';
session_start();
require 'config.php';
$_SESSION['email'] = $_POST['email'];
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

$user = new users();
$user->name=        $_POST['name'];
$user->passwd=      $_POST['pass'];
$user->email=       $_POST['email'];
$user->job=         $_POST['job'];
$user->birthDay=    $_POST['birthday'];
$user->address=     $_POST['address'];
$user->creditLimit= $_POST['credit'];
if(isset($_POST['interests'])){
    
    $user->interests = $_POST['interests'];
}

$res = $user->insert();
$res2 = $user->insert_interests();


if($res == true)
    $result = "true";

else if($res == false)
    $result = "false";

echo json_encode($result);
?>