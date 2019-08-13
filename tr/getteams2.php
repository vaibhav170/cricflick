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
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->query("use new3");
$sql = "select * from partof where owner=$ownerid and  ted=$vv and tid=$vr and teamid not in (select teamid from mbetwen where owner=$ownerid and ted=$vv and tid=$vr and matchno=$mno);";

    $conn->query("use new3");
    $result = $conn->query($sql);
    $users = $result->fetchAll();
    //echo "";
   foreach ($users as $userr) {
     echo "<br> <input type=\"checkbox\" name=\"seteam[]\" value=\"" . $userr['teamid'] . "\"> " . $userr['teamname'] . "  ( " . $userr['representing'] . " )";
  }
}
  catch(PDOException $e)
      {
        echo "fff";
      echo $sql . "<br>" . $e->getMessage();
      }
  $conn = null;
}



else {
  $_SESSION['loginerror']="Need to sign in for selecting team";
  header("location:../login.php");
}
?>
