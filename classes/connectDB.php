<?php



class DB {
 

  public function connect(){
      try{
        $conn=new PDO('mysql:host=localhost;dbname=coder zone','root','');
$conn->setAttribute(pdo::ATTR_ERRMODE,pdo::ERRMODE_EXCEPTION);
return $conn;
      }catch(PDOException $ex){
echo"Error!".$ex->getMessage();

      }



  }




}