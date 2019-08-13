<?php

session_start();
if($_SESSION['name'])
{
  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $vv = $_GET['q'];//tournament
  $vr = $_GET['p'];//ted
  $mno= $_GET['mno'];
  $countt=0;
  $ownerid=$_SESSION['owner'];

  try {
      $conn = new PDO("mysql:host=$servername", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->query("use new3");
      $total= $conn->query("select * from mbetween where owner=$ownerid and tid=$vv and ted=$vr and matchno=$mno;");
      $countt = $total->rowCount();

  //  $conn->query("use new1");
  //  $result = $conn->query($sql);
    $users = $total->fetchAll();
    //echo "";
   foreach ($users as $userr) {
     $uteam=$userr['teamid'];
    // $result1 = $conn->query("select * from team where teamid=$uteam and owner=$ownerid ;");
    // foreach ($result1 as $ree) {
       // code...
     }
if($countt)
     echo $uteam;
     else {
       echo "0";
     }
  }

//echo "<input type='button' value='add teams in match' onclick='fff()'><br>";


  catch(PDOException $e)
      {
        echo "fff";
      echo "<br>" . $e->getMessage();
      }
  $conn = null;
}



else {
  $_SESSION['loginerror']="Need to sign in for selecting team fpr playing";
  header("location:../login.php");
}
?>
