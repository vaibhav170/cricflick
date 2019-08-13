<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['ftid'];
$name=$_GET['ftname'];
$lowner=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");


    if($id==0  || !preg_match("/^[a-zA-Z\-_.()\[\]\\\\\/\/\s]{3,35}$/",$name) || !preg_match("/^[0-9]{1,5}$/",$id))
    {
    $_SESSION['crerror']="* Enter correct choice";
    header("location:crt0.php");
  }
    else
    {
      $adf=$conn->query("select tid from tname where owner=$lowner and tid=$id");
      $adfr=$adf->fetch();
      if($adfr)
      {
      $_SESSION['crerror']="* Tournament Already Exists";
      header("location:crt0.php");
    }
    else {
      // code...
      $sql = "insert into tname values($lowner,$id,'$name')";
    $result = $conn->query($sql);
    echo "<br><br><br><center><h3>Tournament inserted successfully </h3><br><br>";
    echo "<br> create new <a href='cre.php' >edition</a>";
    echo "<br><br><a href='main.php'>click here </a>to go select page";
  }
  }
}

catch(PDOException $e)
    {

    echo  "<br>";
    }
$conn = null;
}
else {
  $_SESSION['loginerror']="Need to sign in for insertion of Tournaments";
  header("location:../login.php");
}
?>
