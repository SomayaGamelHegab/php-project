<?php
require_once 'user.php';
session_start();
require 'config.php';
ob_start();
if(!isset($_SESSION['email'])){
    
    header("Location: register.php");
}
$email= $_SESSION['email'];
//echo $email;
$user = new users();
$user->email = $email;
$result = $user->selectAll();
$row = $result->fetch_array();

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
        Customer Account
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
    <script src="jquery-3.1.1.min.js"></script>
    <script>
        $(function(){
            
            
             $("#password_2").on("blur",function(){
                
                if($(this).val() != $("#password_1").val()){
                   
                   $("#lblTryPass").text("unmatched password");
                   $(this).val("");
                   $("#password_2").focus(); 
                }
                else
                   $("#lblTryPass").text(""); 
                
            });//retry_blur
        
            $("#passForm").on("submit",function(e){
                
                e.preventDefault();
                $.ajax({
                    
                    url: "update_pass.php",
                    method:"post",
                    data:"newPasswd="+$("#password_2").val(),
                    dataType: "text",
                    success:function(data){
                       
                    console.log(data);
                    var dataA = jQuery.parseJSON(data);
                    if(dataA == "success"){
                        
                       $("#savelbl").text("Successful update");
                       $("#savelbl").addClass("label label-success");
                    }
                        
                    else if(dataA=="failed"){
                        
                        $("#savelbl").text("Sorry failed to update");
                        $("#savelbl").addClass("label label-danger");
                    }
                        
                    },
                    error: function(error){
                        
                        console.log(error);
                    }
                });
                
            });//pass_submit
        
            $("#dataForm").on("submit",function(e){
                
                e.preventDefault();
                $.ajax({
                    
                    url: "update_data.php",
                    method:"post",
                    data:$("#dataForm").serialize(),
                    dataType: "text",
                    success:function(data){
                       
                    console.log(data);
                    var dataA = jQuery.parseJSON(data);
                    if(dataA == "success"){
                        
                       $("#saveDatalbl").text("Successful update");
                       $("#saveDatalbl").addClass("label label-success");
                    }
                        
                    else if(dataA=="failed"){
                        
                        $("#saveDatalbl").text("Sorry failed to update");
                        $("#saveDatalbl").addClass("label label-danger");
                    }
                        
                    },
                    error: function(error){
                        
                        console.log(error);
                    }
                });
                
            });//data_submit
        });//load
    </script>




</head>

<body>
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <?php require "header.php" ?>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>My account</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
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
                                    <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="session_destroy.php" id="logout"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>My account</h1>
                        <?php 
                        $user = new users();
                        $user->email = $email;
                        $result = $user->selectAll();
                        $row = $result->fetch_array();
                        ?>
                        <p class="lead">Change your personal details or your password here.</p>
                        

                        <h3>Change password</h3>

                        <form id="passForm" action="update_pass.php" method="post">
                       
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <br>
                                        <label for="password_1">New password</label>
                                        <input type="password" class="form-control" id="password_1" name="newPasswd" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <label id="lblTryPass" class="label label-danger"></label>
                                        <br>
                                        <label for="password_2">Retype new password</label>
                                        <input type="password" class="form-control" id="password_2" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-12 text-center">
                                <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                            </div>
                            <div class="col-sm-12 text-center">
                                <label id="savelbl" ></label>
                            </div>
                        </form>

                        <hr>

                        <h3>Personal details</h3>
                        <form id="dataForm" action="" method="post" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $row['username']?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= $row['address']?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            
                             <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Job</label>
                                                <input type="text" class="form-control" id="job" name="job" value="<?= $row['job']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>BirthDay</label>
                                                <input type="text" class="form-control" value="<?= $row['birthDate']?>" id="birth" name="birth">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Credit Limit</label>
                                                <input type="text" class="form-control" value="<?= $row['creditLimit']?>" id="credit" name="credit">
                                            </div>
                                        </div>
                                    </div>
                            <!-- /.row -->

                            <div class="row">
                                
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>

                                </div>
                                
                            </div>
                            <div class="col-sm-12 text-center">
                                <label id="saveDatalbl" ></label>
                            </div>
                        </form>
                    </div>
                </div>

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