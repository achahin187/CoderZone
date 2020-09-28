<?php
ob_start();

include "classes\connectDB.php ";

class dashboard extends DB{

public function insertCategory($name){
$sql="INSERT INTO category (name) VALUES(?) ";
$result=$this->connect()->prepare($sql);
$result->execute(array($name));
return $result;

}
/////////////////////////////
public function selectCategory(){
$sql="SELECT * FROM category ORDER BY id DESC";
$result=$this->connect()->query($sql);
if($result->rowCount() >0){
    while($row=$result->fetch()){
        $data[]=$row;

    }
    return $data;
}
}
////////////////////////
public function deleteCategory($id){
$sql="DELETE  FROM category WHERE id='$id' ";
$result=$this->connect()->query($sql);
return $result;

}
///////////////////////

public function selectPost(){
    $sql="SELECT users.username, users.image, posts.discussion, posts.post_image, posts.time,posts.id,category.name
     AS category FROM users
    INNER JOIN posts ON users.id=posts.user_id
    INNER JOIN category ON category.id=posts.category ORDER BY posts.id DESC";
     $result=$this->connect()->query($sql);
     if($result->rowCount() >0){
         while($row=$result->fetch()){
             $data[]=$row;
     
         }
         return $data;
     }
    
    
    }
/////////////////////////////////////
public function deletePosts($id){
$sql="DELETE FROM posts WHERE id='$id'";
$result=$this->connect()->query($sql);
return$result;



}





/////////////////////////////////////////////
public function selectUsers(){
    $sql="SELECT * FROM users ORDER BY id DESC";
    $result=$this->connect()->query($sql);
    if($result->rowCount()>0){
while($row=$result->fetch()){
    $data[]=$row;

}
return$data;
    }
    
    }
    ////////////////////////////

    public function deleteUsers($id){
        $sql="DELETE FROM users WHERE id='$id'";
        $result=$this->connect()->query($sql);
        return$result;
        
        
        
        }



}