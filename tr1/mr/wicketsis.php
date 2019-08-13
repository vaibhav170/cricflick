<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$wicketof=$_GET['wicketof'];
$wicketrun=$_GET['wicketrun'];
$typeball=$_GET['typeball'];
$wickettype=$_GET['wickettype'];
$t=$_GET['q'];/*tournament*/
$id=$_GET['p'];
$mno=$_GET['mno'];
$bteam=$_GET['team'];/*team batting*/
$bteamb=$_GET['teamb'];
$byb=$_GET['by'];
$ownerid=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");


          $totr=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
          " and teamid=$bteam  limit 1;");
          $totar=$totr->fetch();
          $overs=$totar['overs'];
          $run=$totar['runs'];
          $wickets=$totar['wickets'];
          $tot=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
          " and teambat=$bteam and bb=0 and outt=0 and onstrike=1 limit 1;");
          $tota=$tot->fetch();
          $runs=$tota['runs'];
          $balls=$tota['balls'];

          $totb=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
          " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
          $totab=$totb->fetchAll();
          $runsb=$totab[0]['runs'];
          $ballsb=$totab[0]['balls'];
          $sixesb=$totab[0]['sixes'];


    //echo "Choose who is out :- <select name='outis id='outis'>";
    $conn->query("update mbetween set wickets= Wickets + 1 where owner=$ownerid and tid=$t and ted=$id and".
    " matchno=$mno and teamid=$bteam");
    $wno=$conn->query("select wickets from mbetween where owner=$ownerid and tid=$t and ted=$id and".
    " matchno=$mno and teamid=$bteam limit 1");
    $wnor=$wno->fetch();
    if($wnor['wickets']==10)
    {
      echo "one inning completed(10 wickets fell)..... ";
    }


      if($wickettype==1)
      {/*regular out with corresponding completed runs*/

      $sixesb++;
      $runsb+=$wicketrun;
      $runs+=$wicketrun;
      $run+=$wicketrun;
      $balls++;
      $overs++;
      $ballsb++;
      $conn->query("update scorecard set balls=$balls, runs=$runs, outby=$byb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and onstrike=1 limit 1;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb,sixes=$sixesb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livescore set over=$overs, run=$run ,wicket=wicket + 1 where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update livebat set ball=$ballsb, run=$runsb, six=$sixesb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$byb and status=2");
      $conn->query("update livebat set ball=$balls,run=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and status=1");
    /*  $newb=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 11 ");
      $newbr=$newb->fetchAll();/*it is later done by liceaction*/
    /*  echo "<select id='newb' >";
      foreach ($newbr as $key) {
        // code...
        $pidd=$newbr['pid'];
        $pn=$conn->query("select * from player where pid=$pidd and owner=$ownerid limit 1");
        $pnr=$pn->fetch();
        echo "<option value='" .$newbr['pid']. "'> ".$pnr['pname'];
      }
      echo "</select><br><input type='button' onclick='newbatis(this.value)'>";*/


    }
    $totr=$conn->query("update scorecard set outt=1,onstrike=0 where owner=$ownerid and tid=$t and ted=$id and".
    " matchno=$mno and bb=0 and outt=0 and teambat=$bteam and playeron=$wicketof limit 1");
    $conn->query(" DELETE  from livebat where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and status=-1;");
    $conn->query(" UPDATE livebat set status=-1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$wicketof;");

  include 'showliceaction.php';
  }
  catch(PDOException $e)
      {
      echo "<br>" . $e->getMessage();
      }



    }
    else {

      header("location:../../login.php");
    }
?>
