<?php
require_once(LIB_PATH_INC.DS."config.php");

class MySqli_DB {

    public $con;
    public $query_id;

    function __construct() {
      $this->db_connect();
    }

    
public function db_connect()
{
  $this->con = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
  if(!$this->con)
         {
           die(" Database connection failed:". mysqli_connect_error());
         } else {
           $select_db = $this->con->select_db(DB_NAME);
             if(!$select_db)
             {
               die("Failed to Select Database". mysqli_connect_error());
             }
         }
}


public function db_disconnect()
{
  if(isset($this->con))
  {
    mysqli_close($this->con);
    unset($this->con);
  }
}

public function query($sql)
   {

      if (trim($sql != "")) {
          $this->query_id = $this->con->query($sql);
      }
      if (!$this->query_id)
      
              die("Error on this Query :<pre> " . $sql ."</pre>");
              

       return $this->query_id;

   }

   
 public function escape($str){
   return $this->con->real_escape_string($str);
 }
 
public function while_loop($loop){
 global $db;
   $results = array();
   while ($result = $this->fetch_array($loop)) {
      $results[] = $result;
   }
 return $results;
}

}

$db = new MySqli_DB();

?>
