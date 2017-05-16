<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Obaju : e-commerce template
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">



</head>

<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <?php
    session_start();
    


    require "header.php" ?>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->
    <?php
    #$item=$_GET['item'];


    $user_id=$_SESSION['user_id'];
    require 'config.php';
    #$query = "select shoppingCart.user_id,shoppingCart.id,products.image,products.pName,products.price,orders.quentity from  products,orders,shoppingCart where shoppingCart.user_id=$user_id and shoppingCart.product_id=orders.prod_id and products.id=orders.prod_id;";
    require_once 'cart.php';
    $query="select products.image,products.pName,products.price,shoppingCart.id  from shoppingCart,products where shoppingCart.product_id=products.id and shoppingCart.user_id=? ";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i',$user_id);

    $stmt->execute();
    $result = $stmt->get_result();





    ?>
    <?php

    $cart=new cart();
    $cart->user_id=$user_id;
    $res=$cart->itemNum();
    while ($count=$res->fetch_array()){}
    $items=$count['count(id)'];
    ?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="checkout.php">

                            <h1>Shopping cart</h1>
                            <p class="text-muted">You currently have <?php echo $items;?>item(s) in your cart.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th >Product</th>
                                            <th>Product Name</th>
                                            <th> Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     $total=0;
                                    while ($row = $result->fetch_array()){
                                       echo" <tr><td><img src='".$row['image']."' alt='White Blouse Armani'></td><td>".$row['pName']."
                                        </td><td>".$row['price']."</td><td><a href='deletecart.php?cart_id=".$row['id']."'><i class=\"fa fa-trash-o\"></i></a>
                                            </td></tr>";
                                        $total+=$row['price'];

                                       }


                                  echo"  </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan='2'>Total</th>
                                        <th >$total</th>
                                          
                                    </tr>
                                    </tfoot>"



                                     ?>


                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="index.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">

                                    <button type="submit" class="btn btn-primary">Checkout</button>

                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->
                    <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                   
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>


                  


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th><?php echo"$total"?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th><?php echo$total + 10.00?></th>
                                        <?php $_SESSION['total']=$total+10.00;?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="box">
                         <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="customer-orders.php"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                <li>
                                    <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="index.html"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <?php require "footer.php" ?>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>



</body>

</html>