<?php
class ball
{
    private $order_id;

    private $user_id;
    private $date;

    function __get($attr)
    {
        return $this->$attr;
    }

    function __set($attr, $value)
    {
        $this->$attr = $value;
    }


        function insert()
    {
        require 'config.php';
        $result = false;
        $query = "insert into ball (user_id) values(?)";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "preparation failed " . $mysqli->errno . " : " . $mysqli->error . "<br>";
        } else {
            $result = true;
            //header("");
        }

        $stmt->bind_param('i',$this->user_id);

        $stmt->execute();

        if($stmt->affected_rows>0){
            echo "ball inserteeeeeeeeeeeeeeeed";
        }
        else{echo "faillllllllled";}

        return     $stmt->insert_id;
    }//insert function
    function balllist()
    {
        require 'config.php';

        $query = "select * from ball where user_id=?";

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i',$this->user_id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;


    }
    
   


    function delete($id)
    {
        require 'config.php';
        $query="delete from ball  where id=?";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('i',$id);
        $stmt->execute();

        if($stmt->affected_rows>0){
//echo "delete successfully";

            header("Location:basket.php");

        }else{
            echo "product not delete";
        }
    }//fun delete
    function getbyid()
    {

    }
}
?>