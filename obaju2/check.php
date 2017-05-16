<?php
require "config.php";
require_once "user.php";
$user = new users();
if(isset($_POST['name'])){
    
    $user->name=$_POST['name'];
     $res=$user->selectByName();

    if($res == true)
        $result = "true";

    else if($res == false)
        $result = "false";

    echo json_encode($result);
}
elseif(isset($_POST['email'])){
    
    $user->email=$_POST['email'];
     $res=$user->selectByEmail();

    if($res == true)
        $result = "true";

    else if($res == false)
        $result = "false";

    echo json_encode($result);
}
?>