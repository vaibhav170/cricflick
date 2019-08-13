<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id0=$_GET['pid0'];/*striker*/
$id1=$_GET['pid1'];
$id2=$_GET['pid2'];/*baller*/
$t=$_GET['q'];/*tournament*/
$id=$_GET['p'];
$mno=$_GET['mno'];
$bteam=$_GET['team'];/*team batting*/
$blteam=$_GET['teamb'];
$vr=$_GET['vr'];
$ownerid=$_SESSION['owner'];

//$s=$_GET['s'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
if($vr!=-1)
{
    $totr=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teamid=$bteam  limit 1;");
    $totar=$totr->fetchAll();
    $overs=$totar[0]['overs'];
    $run=$totar[0]['runs'];
    $wickets=$totar[0]['wickets'];
    $tot=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teambat=$bteam and bb=0 and outt=0 and onstrike=1 limit 1;");
    $tota=$tot->fetchAll();
    $runs=$tota[0]['runs'];
    $balls=$tota[0]['balls'];
    $fours=$tota[0]['fours'];
    $sixes=$tota[0]['sixes'];

    $totb=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
    $totab=$totb->fetchAll();
    $runsb=$totab[0]['runs'];
    $ballsb=$totab[0]['balls'];
    $sixesb=$totab[0]['sixes'];

    $balls++;
    $overs++;
    $ballsb++;
    if($vr==='0')
    {

      $conn->query("insert into ballbyball (owner,tid,ted,matchno,teambat,ballno,onstrike,nonstrike,baller,whathappen,runs) values($ownerid, $t, $id, $mno, $bteam, $overs, $id0, $id1, $id2, 0, 0)");

      $conn->query("update scorecard set balls=$balls where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update scorecard set balls=$ballsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set overs=$overs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livescore set over=$overs where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update livebat set ball=$balls where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");
      $conn->query("update livebat set ball=$ballsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

    }
    elseif ($vr==='1') {
      // code...
      $runs++;

      $run++;
    //  $ballsb++;
      $runsb++;
      $conn->query("update scorecard set balls=$balls, runs=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=0 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update livescore set over=$overs, run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
        $conn->query("update livebat set ball=$balls,run=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");
          $conn->query("update livebat set ball=$ballsb,run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

        $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0 and outt=0 and playeron=$id0  limit 1;");
        $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0  and playeron=$id1 and outt=0  limit 1;");
          $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0");
            $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id1");

    }

    elseif ($vr==='2') {
      // code...
      $runs+=2;
      $run+=2;
      $runsb+=2;
      $conn->query("update scorecard set balls=$balls, runs=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update livescore set over=$overs, run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
        $conn->query("update livebat set ball=$balls,run=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");

      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livebat set ball=$ballsb,run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

    }
    elseif ($vr==='4') {
      // code...
      $runs+=4;
      $run+=4;
      $runsb+=4;
      $fours++;
      $conn->query("update scorecard set balls=$balls, runs=$runs, fours=$fours where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and outt=0 and onstrike=1 limit 1;");

      $conn->query("update livescore set over=$overs, run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
        $conn->query("update livebat set ball=$balls,run=$runs, four=$fours where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");

      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livebat set ball=$ballsb,run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

    }
    elseif ($vr==='6') {
      // code...
      $runs+=6;
      $run+=6;
      $runsb+=6;
      $sixes++;
      $conn->query("update scorecard set balls=$balls, runs=$runs, sixes=$sixes where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and outt=0 and onstrike=1 limit 1;");

      $conn->query("update livescore set over=$overs, run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
        $conn->query("update livebat set ball=$balls,run=$runs, six=$sixes where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");

      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livebat set ball=$ballsb,run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

    }

    elseif ($vr==3) {
      // code...
      $runs+=3;

      $run+=3;
    //  $ballsb++;
      $runsb+=3;
      $conn->query("update scorecard set balls=$balls, runs=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=0 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update livescore set over=$overs, run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set overs=$overs,runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
        $conn->query("update livebat set ball=$balls,run=$runs where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");
          $conn->query("update livebat set ball=$ballsb,run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

        $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0 and outt=0 and playeron=$id0  limit 1;");
        $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0  and playeron=$id1 and outt=0  limit 1;");
          $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0");
            $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id1");

    }
  /* elseif ($vr=='wicket') {
      // code...
      $sixesb++;
      $runsb+=2;
      $wickets++;
      $conn->query("update scorecard set balls=$balls, runs=$runs , outt=1 , onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam  and bb=0 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update scorecard set balls=$ballsb, runs=$runsb,sixes=$sixesb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set overs=$overs,runs=$run,wickets=$wickets where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");
      $conn->query("update livescore set over=$overs, run=$run ,wicket=$wickets where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update livebat set ball=$ballsb,run=$runsb, six=$sixesb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");
      $conn->query("update livebat set ball=$balls,run=$runs,status=-1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0 and status=1");

    }*/
    if ($vr==='wide') {
      // code...
    //  $runs++;

      $run++;
    //  $ballsb++;
      $runsb++;
      $balls--;/*actually no need as we are not updating balls still*/
      $overs--;
      $ballsb--;

      $conn->query("update livescore set  run=$run where owner=$ownerid and tid=$t and ted=$id and mno=$mno ".
      " and done=0;");
      $conn->query("update scorecard set runs=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
      $conn->query("update mbetween set runs=$run where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teamid=$bteam limit 1;");

          $conn->query("update livebat set run=$runsb where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id2 and status=2");

    }

    elseif(!($overs%6))
    {
      if($vr==='1' || $vr==='3')
      {
        $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0 and outt=0 and playeron=$id1 limit 1;");
        $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
        " and teambat=$bteam and bb=0 and outt=0 and playeron=$id0  limit 1;");
        $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id1");
          $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0");


      }
      else {
        // code...

      $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=0 and outt=0 and playeron=$id0 limit 1;");
      $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=0 and outt=0 and playeron=$id1  limit 1;");
      $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id0");
        $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and pid=$id1");

    }
      $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
      " and teambat=$bteam and bb=1 and outt=0 and playeron=$id2  limit 1;");


    }


}

    include "showliceaction.php";


  }

catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
    $conn = null;

}

else {


$_SESSION['loginerror']="Need to sign in for insertion of player sm";
header("location:../login.php");
}


?>
