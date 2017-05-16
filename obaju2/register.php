<?php
session_start();
require "config.php";

$query="select * from categories ";
$stmt = $mysqli->prepare($query);

if(!$stmt){
    echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
}

$stmt->execute();   
$result = $stmt->get_result();

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
    <script src="jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <!--Ajax Register validation -->
   
    <script>
                
        $(function(){
            
            
            //name check ... 
            $("#nameReg").on("blur",function(){
                
               $.ajax({
                    url:"check.php",
                    method:"post",
                    data:"name="+$(this).val(),
                    dataType:"json",
                    success:function(data){
                                        
                        console.log(data);
                      if(data == "true")
                         {
                            $("#lblNameReg").text(" Used Name !!");
                            $("#nameReg").val(" ");
                            $("#nameReg").focus();
                             
                        }

                    },
                    error: function(error){

                    }
                });// end ajax
                
            });//name blur end
            
            
            //email check ... 
            $("#emailReg").on("blur",function(){
                
               $.ajax({
                    url:"check.php",
                    method:"post",
                    data:"email="+$(this).val(),
                    dataType:"json",
                    success:function(data){
                                        
                        console.log(data);
                      if(data == "true")
                         {
                            $("#lblemailReg").text(" Used email !!");
                            $("#emailReg").val("");
                            $("#emailReg").focus();
                             
                        }

                    },
                    error: function(error){

                    }
                });// end ajax
                
            });//name blur end
            
            //register ... 
            
            $("#registerForm").on("submit",function(e){
                
                e.preventDefault();
                $.ajax({
                    url:"insert_user.php",
                    method:"post",
                    data:$("#registerForm").serialize(),
                    dataType:"json",
                    success:function(data){
                        
                        console.log("data"+data);
                    
                        if(data == "true"){
                            
                            window.location.href = "customer-orders.php";
                        }
                         else if(data == "false")
                         {
                            $("#lblNameReg").text(" Used Name !!");
                            $("#nameReg").val(" ");
                            $("#emailReg").val("");
                            $("#nameReg").focus();
                             
                        }

                    },
                    error: function(error){

                    }
                });// end ajax
                
            });//register end
            
            // login ... 
            $("#logForm").on("submit",function(event){
                
                event.stopPropagation();
                event.preventDefault();
                console.log("submit");
                
                $.ajax({
                    url:"select_user.php",
                    method:"post",
                    data:$("#logForm").serialize(),
                    dataType:"json",
                    success:function(data){
                        
                        console.log("data: "+data);
                        if(data == "user"){
                            
                            window.location.href = "customer-orders.php";
                        }
                        else if(data == "admin"){
                            
                            window.location.href = "../admin2/dashboard.php";
                        }

                         else if(data == "false")
                         {
                            $("#lblNameLog").text("Wrong Entered data !!");
                            $("#emailLog").val(" ");
                            $("#passwordLog").val("");
                            $("#emailLog").focus();
                            
                        }

                    },
                    error: function(error){

                    }
                });// end ajax
            });//end btnLog click
            
            // interested ------------------------------
            
            $("#categoryList").on("change",function(){
                
                
                $("#checkList").empty();
                $.ajax({
                    
                    url: "subcategory.php",
                    method:"post",
                    data:"category="+$(this).val(),
                    dataType:"text",
                    success:function(data){
                        
                        console.log(data);
                        
                        var dataArr = jQuery.parseJSON(data);
                        for( var i = 0 ; i< dataArr.length ; i++){
                            var txt= dataArr[i];
                            $("#checkList").append('<input type="checkbox" class="check" name="interests[]" value="'+txt+'"/> '+ txt +'<br />');

                        }
                          
                    },
                    error: function(error){
                        
                        console.log("error");
                    }
                    
                    
                });//ajaxend
                
            });//check end
            
            // email .. 
            function validateEmail(email) {
              var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(email);
            }
            $("#emailReg").on("blur",function(){
                
                
              $("#lblemailReg").text("");
              var email = $("#emailReg").val();
              if (!validateEmail(email)) {
                $("#lblemailReg").text(email + " is not valid email");
                $("#emailReg").focus();
              }
              return false;
            });//blur
            
     
        });
    </script>


    <title>
         Register
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
                        <li>New account / Sign in</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>

                        <hr>
                        <!--customer-orders.html-->
                        <form id="registerForm" action="insert_user.php" method="post">
                           
                           <div class="form-group">
                                <label id="lblNameReg" name="lblName" class="label label-warning"></label>
                                
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="nameReg" required>
                            </div>
                            
                            <label id="lblemailReg" name="lblName" class="label label-warning"></label>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="emailReg" required>
                            </div>
                            <!-- re enter-->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="pass" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="job">Job</label>
                                <input type="text" name="job" class="form-control" id="job" required>
                            </div>
                                <!--value-->
                            <div class="form-group">
                                <label for="Birthday">Birth Date</label>
                                <input type="date" name="birthday" class="form-control" id="Birthday" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text"  name="address"class="form-control" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="credit">Credit Limit</label>
                                <input type="number" min="1" name="credit" class="form-control" id="credit" required>
                            </div>
                            <div class="row">
                            <div class="col-md-5">
                             <div class="form-group">
                                <label>Interested</label>
                                <select id="categoryList" class="form-control" >
                                    <option value="choose user">choose category
                                    </option>
                                    <?php
                                    $query="select * from categories ";
                                    $stmt = $mysqli->prepare($query);

                                    if(!$stmt){
                                        echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
                                        }

                                        $stmt->execute();   
                                        $result = $stmt->get_result();

        
                                        while($row = $result->fetch_array()) {

                                             if($row['subCategory']==null)
                                             {
                                                  echo "<option>"
                                                .$row['title']."</option>";
                                           }

                                            

                                        }   

                                    ?>

                                </select>
                            </div>
                            </div>
                            <div class="col-md-5">
                             <div id="checkList" class="form-group">
                               
                            </div>
                            </div>
                            </div>         
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>

                        <hr>
                        <!--customer-orders.html-->
                        <form action="select_user.php" method="post"  enctype="application/x-www-form-urlencoded" id="logForm">
                           <div class="form-group">
                                <label id="lblNameLog" name="lblName" class="label label-danger" ></label>
                                
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="emailLog">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="pass" class="form-control" id="passwordLog">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Login</button> 
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