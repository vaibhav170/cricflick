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
  $c1=$_GET['c1'];
    $c2=$_GET['c2'];
  $countt=0;
  $ownerid=$_SESSION['owner'];

  try {
      $conn = new PDO("mysql:host=$servername", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->query("use new3");
    //  $total= $conn->query("select * from mbetween where owner=$ownerid and tid=$vv and ted=$vr and matchno=$mno;");
    //  $countt = $total->rowCount();

$sql = "select * from  partof where owner=$ownerid and tid=$vv and ted=$vr;";
  if($c1)
  {
    /*$cc=$total->fetchAll();
    $cc0=$cc[0];
    $cc1=$cc[1];
    $cc00=$cc0['teamid'];
    $cc11=$cc1['teamid'] ;*/

    $result2=$conn->query("select * from team where teamid=$c1 limit 1;");
    $result3=$conn->query("select * from team where teamid=$c2 limit 1;");

    $cc2=$result2->fetchAll();
    $cc3=$result3->fetchAll();

    foreach ($cc2 as $cc22) {
      $cc222=$cc22['teamname'];
      $rcc222=$cc22['representing'];
    }
    foreach ($cc3 as $cc33) {
      $cc333=$cc33['teamname'];
      $rcc333=$cc33['representing'];
    }

     echo "<br><label> <p style='color:green;'>Teams already added <br></p></label><select class=\"form-control\" name='choose1' id='choose1'> <option value='" . $c1 ."' > " . "1.  " . $cc333  . " ( " . $rcc333 . " )" .
     "</option></select><br><select class=\"form-control\" name='choose2' id='choose2'><option value='". $c2 . "'>2  " . $cc222  . " ( " . $rcc222 . " )</option></select><br>"  ;
  }
else {


    $conn->query("use new3");
    $result = $conn->query($sql);
    $users = $result->fetchAll();
    //echo "";
   foreach ($users as $userr) {
     $uteam=$userr['teamid'];
     $result1 = $conn->query("select * from team where teamid=$uteam and owner=$ownerid ;");
     foreach ($result1 as $ree) {
       // code...

     echo " <option value=\"" . $userr['teamid'] . "\"> " . $ree['teamname'] . "  ( " . $ree['representing'] . " )";
  }
}
//echo "";
}
}
  catch(PDOException $e)
      {

      echo "<br>" . $e->getMessage();
      }
  $conn = null;
}



else {
  $_SESSION['loginerror']="Need to sign in for selecting team fpr playing";
  header("location:../login.php");
}
?>
