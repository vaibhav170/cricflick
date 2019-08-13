<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";

$id1=$_GET['pid1'];//here not out batsman
$vr=$_GET['vr'];
$t=$_GET['q'];/*tournament*/
$id=$_GET['p'];
$mno=$_GET['mno'];
$newbatsman=$_GET['newbatsman'];
$bteam=$_GET['team'];
$blteam=$_GET['teamb'];
$ownerid=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $wno=$conn->query("select wickets from mbetween where owner=$ownerid and tid=$t and ted=$id and".
    " matchno=$mno and teamid=$bteam limit 1");
    $wnor=$wno->fetch();/*fetching wicket number from mbetween and adding 1 in it because we use
    0 index in scorecard   and inserting it in
    scorecard it does not work for opners for them it is made in matchplay1
    play start only after selecting opener batsmans and bowlers*/
    $df=$wnor['wickets'];
    $df+=1;
    $conn->query("INSERT into scorecard (owner,tid,ted,matchno,teambat,bb,wno,playeron)".
  " values($ownerid,$t,$id,$mno,$bteam,0,$df,$newbatsman)");
  $xc=$conn->query("select * from player where pid=$newbatsman and owner=$ownerid limit 1");
  $xcr=$xc->fetch();
  $ppnn=$xcr['pname'];
  $conn->query("INSERT into livebat (owner,tid,ted,matchno,pid,pname)".
" values($ownerid,$t,$id,$mno,$newbatsman,'$ppnn')");

  if($vr==1)
  {
      $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=0 ".
      " and teambat=$bteam and playeron=$newbatsman");

          $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=0".
          " and teambat=$bteam and playeron=$id1");
          $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
          "  and pid=$newbatsman");
          $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
          " and pid=$id1");
    }
    else {

          $conn->query("update scorecard set onstrike=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=0".
          " and teambat=$bteam and playeron=$newbatsman");

              $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=0".
              " and teambat=$bteam and playeron=$id1");
              $conn->query("update livebat set status=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
              " and pid=$newbatsman");
              $conn->query("update livebat set status=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
              "  and pid=$id1");
    }


  /*  $re=$conn->query("select * from player where pid=$newbatsman");//wrong not belongs to here
    $rer=$re->fetch();
    $nb=$rer['pname'];
    $conn->query("insert into livebat(owner,tid,ted,matchno,pid,pname,status) values($ownerid,$t,$id,$mno,$newbowler,'$nb',2) ");*/

    include 'showliceaction.php';
}
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }


  }
  else {
    $_SESSION['loginerror']="need to login for scoring match";
    header("location:../../login.php");
  }

  ?>
