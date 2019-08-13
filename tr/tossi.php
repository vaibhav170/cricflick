<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$t=$_GET['q'];
$id=$_GET['p'];
$mno=$_GET['mno'];
$f=$_GET['f'];
$s=$_GET['s'];
$lowner=$_SESSION['owner'];
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    //$s=0;
    $result = $conn->query("update lmatch set toss=$f, choose=$s where owner=$lowner and tid=$t and ted=$id and matchno=$mno; ");

  }

catch(PDOException $e)
    {
    
    echo  "<br>" . $e->getMessage();
    }
$conn = null;
}
else {
  $_SESSION['loginerror']="Need to sign in for insertion of Tournaments";
  header("location:../login.php");
}
?>
