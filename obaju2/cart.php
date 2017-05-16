<?php
class cart
{
    private $id;
    private $user_id;
    private $product_id;
    function __get($attr)
    {
        return $this->$attr;
    }

    function __set($attr, $value)
    {
        $this->$attr=$value;
    }

    function insert()
    {
        require 'config.php';

        $result = false;
        $query = "insert into shoppingCart (user_id,product_id) values(?,?)";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "preparation failed " . $mysqli->errno . " : " . $mysqli->error . "<br>";
        } else {
            $result = true;
            //header("");
        }

        $stmt->bind_param('ii',$this->user_id,$this->product_id);

        $stmt->execute();



        return $result;
    }//insert function
    function itemNum()
    {
        require 'config.php';
        $query="select count(id) from shoppingCart where user_id=? ";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i',$this->user_id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    function selectprod(){
        require 'config.php';
        $query="select product_id from shoppingCart where id=? ";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i',$this->user_id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;


    }
    function listcart(){
        require 'config.php';
        $query="select * from shoppingCart where user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i',$this->user_id);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;

    }




    function delete()
    {
        require 'config.php';
        $query="delete from shoppingCart  where id=?";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('i',$this->id);
        $stmt->execute();

        return $stmt->id;
    }//fun delete

    function emptycart()
    {
        require 'config.php';
        $query="delete from shoppingCart  where user_id=?";
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param('i',$this->user_id);
        $stmt->execute();

        if($stmt->affected_rows>0){


            header("Location:basket.php");

        }else{
            echo "product not delete";
        }
    }
    
    
}
    ?>