<html>
<head>
    <title></title>
</head>
<body>


<?php
session_start();
$total=$_SESSION['total'];
$user_id=$_SESSION['user_id'];

$limit=0;
$newlimit=0;
require 'config.php';
require 'cart.php';
require 'order.php';
require 'ball.php';
$query = "select creditlimit from users where id=?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param('i',$user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row=$result->fetch_array()){
    $limit=$row['creditlimit'];
}
if ($limit>=$total){
    $cart=new cart();
    $cart->user_id=$user_id;
    $res=$cart->listcart();

    while($catr=$res->fetch_array()){
        $ball=new ball();
        $ball->user_id=$user_id;
        //echo "prrroducts".$catr['product_id'];
      if(  $order_id=$ball->insert()){
          
          echo "ball inserted";
      }
        else{
            echo "ball failed";
        }
        $order=new order();
        $order->order_id=$order_id;
        $order->prod_id=$catr['product_id'];
        echo "prodid".$catr['product_id'];
        $order->quentity=1;
      if(  $order->insert()){
          echo "order inserted";


      }
        else{
            echo "order failed";
        }

    }
    #_______________
    $newlimit=$limit-$total;
    $query="update users set creditlimit=? where id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii',$newlimit,$user_id);
    $stmt->execute();
    echo "correct buy";
    $newcart=new cart();
    $newcart->user_id=$user_id;
    $newcart->emptycart();
}
else{
    ?>
    <div>
   <p style="color:red;">you must charge your credit or update your basket</p></br>
   <a href="basket.php"><button>your basket</button></a>
</div>
   <?php
}

?>
<?php require "footer.php" ?>
</body>
</html>
 
