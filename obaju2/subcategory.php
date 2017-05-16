<?php


/*
require_once "user.php";
require "config.php";

// http_response_code(404);

$option = $_POST['category'];

if ($option=="ladies"){
    
    $query="select title  from categories where subCategory=4 ";
    $stmt = $mysqli->prepare($query);

    if(!$stmt){
        echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
    }

    $stmt->execute();   
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
     $res =array();
    if( $row){
        $res []=$row['title'];
    }
   

echo json_encode($res);
*/
$dbhost= 'localhost';
$dbuser= 'root';
$dbpass='iti';
$dbname='ecommerce';
// open connection
$mysqli = new mysqli($dbhost, $dbuser,$dbpass);
$mysqli->select_db($dbname);

if($_POST['category'] == "ladies"){
    
    $category_id = 4;
    
}
else if($_POST['category'] == "men"){
    
    $category_id = 5;
    
}
$query="select title  from categories where subCategory=?";
$stmt = $mysqli->prepare($query);

if(!$stmt){
    echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
}

$stmt->bind_param('i',$category_id );
$stmt->execute();   
$result = $stmt->get_result();
$res =array();
while($row = $result->fetch_array()){
    
     $res[] = [$row['title']];
}

if($res){
  
   
   echo json_encode($res);
}
else
    return false;





    
?>