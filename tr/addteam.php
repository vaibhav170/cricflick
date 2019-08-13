<?php

session_start();
if($_SESSION['name'])
{
  $lowner=$_SESSION['owner'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
$t=$_GET['q'];
$id=$_GET['p'];
$loc=0;
$sql = "insert into partof (owner,tid,ted,teamid) values($lowner,$t,$id,$loc);";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");

    $selects=$_GET['seteam'];
    $fa=explode(",", $selects);

    foreach ($fa as $loc) {
    $conn->query("insert into partof (owner,tid,ted,teamid) values($lowner,$t,$id,$loc);");


  }

  echo "<h3>inserted successfully</h3>";
    echo "<br> <a href='seteam.php' > Select </a> teams for this edition";
    echo "<br><a href='main.php'>click here to go select page </a>";
  }

catch(PDOException $e)
    {

    echo  "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  $_SESSION['loginerror']="Need to sign in for insertion teams for edition";
  header("location:../login.php");
}
?>
