<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$vv = $_GET['q'];
$vr = $_GET['p'];
$ownerid=$_SESSION['owner'];
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->exec("USE new3");
  $getUsers = $conn->prepare("SELECT * FROM lmatch where owner=$ownerid and ted=$vv and tid=$vr and running=1");
  $getUsers->execute();
  $users = $getUsers->fetchAll();


 foreach ($users as $userr) {
   echo "<option value=\"";
             echo $userr['matchno'];
             echo "\"";
             echo ">";
 echo $userr['matchno'];
 echo "</option>";
}
  }
  catch(PDOException $e)
      {
    
      echo  "<br>" . $e->getMessage();
      }
$conn=null;

}
else {
  $_SESSION['loginerror']="Need to sign in creating match";
  header("location:../login.php");
}

?>
