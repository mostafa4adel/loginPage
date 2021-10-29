<?php

 function error($msg)
 {
  $response = array("success" =>false,"message" =>$msg);
  return json_encode($response);
 }

 $email = $_POST['email'];
 $password = $_POST['password'];
 $name = $_POST['name'];
  
  $conn = new mysqli('localhost','root','','registration');

if ($conn -> connect_error){
 die('Connection Failed : '.$conn->connect_error);
}
else{
 $sql = "SELECT  email FROM user WHERE email ='".$email."'";
 $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      echo 'Used Email';
  }
  else {
     $stmt = $conn -> prepare("insert into user(email, name, password) values(?,?,?)");
     $stmt -> bind_param("sss",$email,$name,$password);
     $stmt -> execute();
     echo "Registration Successful";
     $stmt -> close();
   }
  
  $conn -> close();
}
?>

