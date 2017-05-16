
<?php
$price=$_GET['price'];
require 'product.php';
$product = new product();

if($product->listbyprice())
{
    $product->price=$price;
    $result = $product->listbyprice();
    
}
else
{
    echo "no product";
}
?>
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
        Categories
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
<?php require "header.php" ?>
<!-- *** TOPBAR ***
 _________________________________________________________ -->
 

    <!-- *** NAVBAR END *** --> 

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Ladies</li>
                    </ul>

                   

                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <select id="searchType" class="form-control">
                                                    <option value="type"> Search by: </option>
                                                    <option value="price"> Price</option>
                                                    <option value="cat_name"> cat_name</option>
                                                </select>
                                                <input type="text" id="searchTxt" class="form-control" >
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     


                    <div class="row products">
                        <?php 
                        $product = new product();

                        if($product->listbyid($id))
                        {
                             $result = $product->listbyid($id);
    
                        }
                    else
                    {
                            echo "no product";
                    }
                        while ($r=$result->fetch_array()) {
                            
                          
                        
                        ?>

                        <div class='col-md-3 col-sm-4'>
                            <div class='product'>
                                <div class='flip-container'>
                                    <div class='flipper'>
                                        <div class='front'>
                                            <a href='detail.php?id=<?=$r['id']?>'>
                                                <img src='../admin2/img/<?=$r['image']?>' class='img-responsive'>
                                            </a>
                                        </div>
                                        <div class='back'>
                                            <a href='detail.php?id=<?=$r['id']?>'>
                                                <img src='../admin2/img/<?=$r['image']?>' class='img-responsive'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href='detail.php?id=<?=$r['id']?>' class='invisible'>
                                    <img src='../admin2/img/<?=$r['image']?>' class='img-responsive'>
                                </a>
                                <div class='text'>
                                    <h3><a href='detail.php?id=<?=$r['id']?>'>the best product</a></h3>
                                    <p class='price'>$<?= $r['price']?></p>
                                    <p class='buttons'>
                                        <a href='detail.php?id=<?=$r['id']?>' class='btn btn-default'>View detail</a>
                                        <a href='detail.php?id=<?=$r['id']?>' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>Add to cart</a>
                                    </p>
                                </div>
                              
                            </div>
                           
                        </div>
                        <?php } ?>
                    </div>
                       
                            

               


     

                    <!-- </div> -->
                    <!-- /.products -->


                </div>
                <!-- /.col-md-9 -->

            </div>
            <!-- /.container -->
        </div>
    </div>
        <!-- /#content -->


        <!-- *** FOOTER ***
 _________________________________________________________ -->
        
    <!-- /#all -->


    <?php  require "footer.php" ?>

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
