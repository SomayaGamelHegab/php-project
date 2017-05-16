<?php 

?>
<?php
class product{
    private $id;
    private $pName;
    private $price;
    private $image;
    private $fullImage;
    private $cat_id;

    
    function insert()
    {
        require 'config.php';
        $result=false;
        $query = "insert into users(pName,price,image,fullImage,cat_id) values(?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('sissi',$this->pName,$this->price, $this->image,$this->fullImage,$this->cat_id);

        $stmt->execute();

    // if($stmt->affected_rows>0){
        if(!$stmt)
        {
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

     
        else
        {
            $result=true;
            //header("");
        }
        return $result;
    }//insert function

  
    function listall()
    {
        require 'config.php';
   
        $query = "select * from products where status=0";

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listall
    function listbyid($id)
    {
        require 'config.php';
   
        $query = "select * from products where cat_id=".$id;

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listby id
    function list($id)
    {
        require 'config.php';
   
        $query = "select * from products where id=".$id;

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listby id
    function listiterested($id)
    {
        require 'config.php';
   
        $query = "select * from products where cat_id=".$id;

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listby id
  
    
    function listbyprice()
    {
        require 'config.php';
   
        $query = "select * from products where price=".$this->price;

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listbyid
    function update()
    {
        require 'config.php';
        $flag=false;
        $query = "update products set pName= ? , price= ? , image= ?,fullImage=?,cat_id=? where id= ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('sissi',$this->pName,$this->price,$this->image,$this->fullImage,$this->cat_id);


// 3- execute statement
    $stmt->execute();
if(!$stmt->execute())
{
     echo "failed ".$mysqli->errno." : ".$mysqli->error."<br>";;
}

// 4- check for fail or success
// if($stmt->affected_rows>0){
// //echo "success";
else{
    $flag=true;
} 
return $flag;
    }//update


function delete($id)
{
    require 'config.php';
$query="delete from products where id=?";
$stmt = $mysqli->prepare($query);

$stmt->bind_param('i',$id);
$stmt->execute();

if($stmt->affected_rows>0){
//echo "delete successfully";

    header("Location:table.php");

}else{
    echo "product not delete";
}
}//fun delete
}//class

 ?>
