<?php
class order
{
    private $order_id;

    private $prod_id;
    private $quentity;

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
            $id = 0;
            $result = false;
            $query = "insert into orders (order_id,prod_id,quentity) values(?,?,?)";
            $stmt = $mysqli->prepare($query);

            $stmt->bind_param('iii', $this->order_id, $this->prod_id, $this->quentity);

            if ($stmt->execute())


                if ($stmt->affected_rows > 0) {
                    if (!$stmt) {
                        echo "preparation failed " . $mysqli->errno . " : " . $mysqli->error . "<br>";
                    } else {
                        $result = true;

                        //header("");
                    }
                    return $result;


                }//i//nsert function
        }
  



    function delete($id)
    {
        require 'config.php';
        $query="delete from orders  where id=?";
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
}
?>