<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id0=$_GET['pid0'];/*striker*/
$id1=$_GET['pid1'];

$t=$_GET['q'];/*tournament*/
$id=$_GET['p'];
$mno=$_GET['mno'];
$newbowler=$_GET['newbowler'];
$bteam=$_GET['team'];
$blteam=$_GET['teamb'];
$ownerid=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");

   $conn->query(" DELETE  from livebat where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and status=2;");
    $re=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=1 and playeron=$newbowler");
    $rer=$re->fetch();
    if($rer)
    {
      $conn->query("update scorecard set onstrike=1 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=1 and playeron=$newbowler");
    }
    else {$rr=$conn->query("select max(wno) as wno from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=1 ");
      $rre=$rr->fetch();
      $ree=$rre['wno']+1;
      $conn->query("insert into scorecard(owner,tid,ted,matchno,teambat , bb, wno,playeron,onstrike) values($ownerid,$t,$id,$mno,$bteam,1,$ree,$newbowler,1) ");
    }
    $re=$conn->query("select * from player where pid=$newbowler");
    $rer=$re->fetch();
    $nb=$rer['pname'];
    $conn->query("insert into livebat(owner,tid,ted,matchno,pid,pname,status) values($ownerid,$t,$id,$mno,$newbowler,'$nb',2) ");

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
