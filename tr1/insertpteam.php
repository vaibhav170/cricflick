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
$mno=$_GET['mno'];
$f=$_GET['f'];
$s=$_GET['s'];
$loc=0;
$i=0;
$sql = "insert into mbetween (owner,tid,ted,matchno,teamid) values($lowner,$t,$id,$loc);";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    //$selects=$_GET['seteam'];
  //  echo $selects;


    $conn->query("insert into mbetween (owner,tid,ted,matchno,teamid) values($lowner,$t,$id,$mno,$f);");
    echo "inserted successfully";
    $conn->query("insert into mbetween (owner,tid,ted,matchno,teamid) values($lowner,$t,$id,$mno,$s);");
    echo "inserted successfully";



    echo "<br> <a href='seteam.php' > Select </a> teams for this edition";
    echo "<br><a href='main.php'>click here to go select page </a>";
  }

catch(PDOException $e)
    {
      echo "fff";
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  $_SESSION['loginerror']="Need to sign in for insertion teams for edition";
  header("location:../login.php");
}
?>
