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
$sql = "select * from  team where owner=$ownerid and teamid not in (select teamid from partof where owner=$ownerid and ted=$vr and tid=$vv);";


    $result = $conn->query($sql);
    $count1=$result->rowCount();
    $users = $result->fetchAll();

   foreach ($users as $userr) {
     echo "<div class=\"checkbox\" > <label ><input type=\"checkbox\" name=\"seteam\" value=\"" . $userr['teamid'] . "\"> " . $userr['teamname'] . "  ( " . $userr['representing'] . " )</label></div>";
  }
  if(!$count1)
  {
    echo "<br><center><br> All teams are inserted<br>click <a href='main.php'> here </a> to go to select<br>";
  }
  else {
    echo"<br><input class=\"btn btn-primary\" value='add teams' onclick='addteams()'>";
  }
}
  catch(PDOException $e)
      {

      echo  "<br>" . $e->getMessage();
      }
  $conn = null;
}



else {
  $_SESSION['loginerror']="Need to sign in for selecting team";
  header("location:../login.php");
}
?>
