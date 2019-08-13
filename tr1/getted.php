<?php
session_start();
if($_SESSION['name'])
{

$servername = "localhost:8889";
$username = "root";
$password = "root";
$vv = $_GET['q'];
$lowner=$_SESSION['owner'];
  $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->exec("USE new3");
  $getUsers = $conn->prepare("SELECT * FROM ted where tid=$vv and owner=$lowner;");
  $getUsers->execute();
  $users = $getUsers->fetchAll();
 foreach ($users as $userr) {
   echo "<option value=\"";
             echo $userr['ted'];
             echo "\"";
             echo ">";
 echo $userr['ted'];
 echo "</option>";
  }
$conn=null;
}

else {
  $_SESSION['loginerror']="Need to sign in for Selection of Edition";
  header("location:../login.php");
}
?>
