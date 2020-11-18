<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  $statement = $connection->prepare("
   INSERT INTO users (name, title, image) 
   VALUES (:name, :title, :image)
  ");
  $result = $statement->execute(
   array(
    ':name' => $_POST["name"],
    ':title' => $_POST["title"],
    ':image'  => $image
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  else
  {
   $image = $_POST["hidden_user_image"];
  }
  $statement = $connection->prepare(
   "UPDATE users 
   SET name = :name, title = :title, image = :image  
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':name' => $_POST["name"],
    ':title' => $_POST["title"],
    ':image'  => $image,
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>
   