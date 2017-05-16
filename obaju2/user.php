<?php
require 'config.php';
class users{
    
    private $id;
    private $name;
    private $birthDay;
    private $job;
    private $email;
    private $address;
    private $passwd;
    private $creditLimit;
    private $role;
    private $interests=array();
   
    
    function __get($varName){
        return $this->$varName;
    }

    function __set($varName,$value){
        $this->$varName = $value;
    }
    
    function insert(){
        
        global $mysqli;
        $query = "insert into users values(NULL,?,?,?,?,?,?,?,0)";
        $stmt = $mysqli -> prepare($query);
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $username = $this->name;
        $pass = sha1($this->passwd);
        $email = $this->email;
        $address = $this->address;
        $job = $this->job;
        $birtd = $this->birthDay;
        $credit = intval($this->creditLimit);
        
        
        $stmt->bind_param('ssssssi',$username,$pass,$email,$job,$birtd,$address,$credit);
        $stmt->execute();
        
        if($stmt->affected_rows>0){
            
            return true;
        }else{
                return false;
            
        }
        
    }
    
    function selectById(){
        
        global $mysqli;
        $query="select id from users where email=? ";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email= $this->email;
        
        $stmt->bind_param('s',$email);
        $stmt->execute();   
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        if( $row){
            return $row['id']; 
        }
        else
           return false;
    }
    
    function selectByName(){
        
        global $mysqli;
        $query="select username from users where username=? ";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $name= $this->name;
        
        $stmt->bind_param('s',$name);
        $stmt->execute();   
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        if( $row){
            return true; 
        }
        else
           return false;
    }
    
    function selectByEmail(){
        
        global $mysqli;
        $query="select email from users where email=? ";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email= $this->email;
        
        $stmt->bind_param('s',$email);
        $stmt->execute();   
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        if( $row){
            return true; 
        }
        else
           return false;
    }
    
    function insert_interests(){
        
        
        global $mysqli;
        $current_id = $this-> selectById();
        $query = "insert into userInterested values(NULL,?,?)";
        $stmt = $mysqli -> prepare($query);
        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $interests = $this->interests;
         if(!empty($interests)){
             foreach($interests as $interest){
                $stmt->bind_param('is',$current_id,$interest);
                $stmt->execute();
             }
           }
        
        if($stmt->affected_rows>0){
            
            return true;
        }else{
                return false;
            
        }
        
    }
    
    function select(){
        
        global $mysqli;
        $query="select role from users where email=? and password=?";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email= $this->email;
        $pass = sha1($this->passwd);
        
        $stmt->bind_param('ss',$email,$pass );
        $stmt->execute();   
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        if( $row){
            return $row['role']; 
        }
        else
           return false;

    }
    
    function update_credit(){
        
        global $mysqli;
        $query="update users set creditLimit=? where username=?";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $username = $this->name;
        $credit = $this->creditLimit;
        echo "<br>".is_int($credit)."<br>";
        echo "<br>"."name: ".$this->name."<br>";
        
        $stmt->bind_param('is',$credit,$this->name );
        $stmt->execute();
        
        if($stmt->affected_rows>0 ){
            echo "done";
        }else{
            echo "failed to update ";
            
        }
    }
    
    function selectAll(){
        
        global $mysqli;
        $query="select * from users where email=? ";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email= $this->email;
        
        
        $stmt->bind_param('s',$this->email);
        $stmt->execute();   
        $result = $stmt->get_result();
        return $result;
        

    }
    
    function update_passwd(){
        
        global $mysqli;
        $query="update users set password=? where email=?";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $email = $this->email;
        $passwd = sha1($this->passwd);
       
        
        $stmt->bind_param('ss',$passwd,$email );
        $stmt->execute();
        
        if($stmt->affected_rows>0 ){
            return true;
        }else{
            return false;
            
        }
    }
    
    function update_data(){
        
        global $mysqli;
        $query="update users set username=?,job=?,birthDate=?,address=?,creditLimit=? where email=?";
        $stmt = $mysqli->prepare($query);

        if(!$stmt){
            echo "preparation failed ".$mysqli->errno." : ".$mysqli->error."<br>";
        }

        $username = $this->name;
        $email=$this->email;
        $address = $this->address;
        $job = $this->job;
        $birtd = $this->birthDay;
        $credit = intval($this->creditLimit);
        
        $stmt->bind_param('ssssis',$username,$job,$birtd,$address,$credit ,$email);
        $stmt->execute();
        
        if($stmt->affected_rows>0 ){
            return true;
        }else{
            return false;
            
        }
    }
    
    
}
?>