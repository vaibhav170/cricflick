<?php
/* select two teams for playing match
called from main
retruning in main using ajax
need to go to submit to save it to  table
--input tournament id ted and match no
--session require ie login required
--output checkboxes consisting value=teamid and team name and representing in display
*/
session_start();
if($_SESSION['name'])
{
  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $vv = $_GET['q'];//tournament
  $vr = $_GET['p'];//ted
  $mno= $_GET['mno'];
  $f=$_GET['f'];
  $s=$_GET['s'];

  $countt=0;
  $ownerid=$_SESSION['owner'];

  try {
      $conn = new PDO("mysql:host=$servername", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->query("use new3");//selecting from player and not already in playing 11
      $total= $conn->query("select * from player where owner=$ownerid and representing=$f and pid not in (select pid from playing11 where owner=$ownerid and tid=$vv and ted=$vr and matchno=$mno) ;");
      $countt = $total->rowCount();
        $users = $total->fetchAll();

        $tnamee=$conn->query("select * from team where teamid=$f and owner=$ownerid ;");
        $tnamerr=$tnamee->fetchAll();
        foreach ($tnamerr as $lll) {
          // code...

    echo "<br><div style='margin-left:25%; text-align:left;'><label >*for team - " . $lll['teamname'] . " ( " . $lll['representing'] . " )</label><br></div>";
  }
   foreach ($users as $userr) {


     echo " <div class=\"checkbox\" style='margin-left:30%;text-align:left;'><input type='checkbox' name='playing111' value=\"" . $userr['pid'] . "\"> " . $userr['pname'] . "  ( " . $userr['favno'] . " )</div>";
  }
  if(!$countt)
  {
    echo "<div style='margin-left:25%; text-align:left;'><label> <p style='color:maroon;'> No more players are available for selecting playing 11 of corresponding team<br></p>" .
    " click <a href='crp.php'>here </a> for insertion of player</label></div>";
  }



//echo "<br><input type='button' value='add player  in playing11' onclick='ff1()'><br>";


  $total= $conn->query("select * from player where owner=$ownerid and representing=$s and pid not in (select pid from playing11 where owner=$ownerid and tid=$vv and ted=$vr and matchno=$mno) ;");
  $countt = $total->rowCount();

$users = $total->fetchAll();

$tnamee=$conn->query("select * from team where teamid=$s and owner=$ownerid ;");
$tnamerr=$tnamee->fetchAll();
foreach ($tnamerr as $lll) {
echo "<br><div style='margin-left:25%; text-align:left;'><label>*for team - ". $lll['teamname'] . " ( " . $lll['representing'] . " )</label><br></div>";
}


foreach ($users as $userr) {


 echo "<div class=\"checkbox\" style='margin-left:30%;text-align:left;'><input type='checkbox' name='playing112' value=\"" . $userr['pid'] . "\"> " . $userr['pname'] . "  ( " . $userr['favno'] . " )</div>";
}
if(!$countt)
{
  echo "<div style='margin-left:25%; text-align:left;'><label><p style='color:maroon;'> No more players are available for selecting playing 11 of corresponding team<br></p>" .
  " click <a href='crp.php'>here </a> for insertion of player</label></div>";
}


echo "<br><input class=\"btn btn-warning\" type='button' value='add player  in playing11' onclick='ff2()'><br>";
}

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
