<?php
$id=$_GET['catid'];
require 'product.php';
$product = new product();

if($product->listbyid($id))
{
    $result = $product->listbyid($id);
    while ($res=$result->fetch_array()) {
                            var_dump($res);}
    
}
else
{
    echo "no product";
}
?>
<html>
<head>
</head>
<body>
	<?php 
	while ($res=$result->fetch_array()) {
	?>
	<img src="">
	<!-- <img src="../admin2/img/<?= $res['image'];?>"> -->
	<?php } ?>
</body>
</html>