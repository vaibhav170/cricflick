<?php
session_start();
$servername = "localhost:8889";
$username = "root";
$password = "root";
$luser = $_POST["luser"];
$lpass = $_POST["lpass"];
$sql = "select id, name from admin_list where phoneno='$luser' and password='$lpass'";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3;");
    $result = $conn->query($sql);
    $count = $result->rowCount();

    if($count >= 1)
    {
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $nn=$result->fetchAll();
      $_SESSION['owner']=$nn[0]['id'];
     $_SESSION['name']=$nn[0]['name'];
    header("location:../index.php");
    }
    else
    {
  //  echo "invalid input";
    $_SESSION['loginerror']="*Enter Correct Information";
    header("location:../login.php");
    }
  }

catch(PDOException $e)
    {
      echo "mysql error";
    echo "<br>";
    }



$conn = null;
?>
