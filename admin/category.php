<?php 

?>
<?php
class category{
    private $id;
    private $title;
    private $subCategory;
    

    
    function insert()
    {
        require 'config.php';
        $result=false;
        $query = "insert into categories(title,subCategory) values(?,?,)";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('si',$this->title,$this->subCategory);

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
   
        $query = "select * from categories";

        $stmt = $mysqli->prepare($query);

// 3- execute statement
        $stmt->execute();
        $result = $stmt->get_result();
       
        return $result;
      

    }//listall
    function update($id)
    {
        require 'config.php';
        $flag=false;
        $query = "update categories set title= ? , subCategory= ? where id= ?";

        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('sii',$this->title,$this->subCategory,$id);


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
$query="delete from categories where id=?";
$stmt = $mysqli->prepare($query);

$stmt->bind_param('i',$id);
$stmt->execute();

if($stmt->affected_rows>0){
//echo "delete successfully";

    header("Location:categoryList.php");

}else{
    echo "category not delete";
}
}//fun delete
}//class

 ?>
