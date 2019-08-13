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
$bteamb=$_GET['teamb'];
$ownerid=$_SESSION['owner'];

//$s=$_GET['s'];
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $result = $conn->query("insert into scorecard (owner,tid,ted,matchno,teambat,bb,wno,playeron,onstrike)".
  " values($ownerid,$t,$id,$mno,$bteam,0,0,$id0,1)");
    //$dbr = $result->num_rows
    $result = $conn->query("insert into scorecard (owner,tid,ted,matchno,teambat,bb,wno,playeron,onstrike)".
  " values($ownerid,$t,$id,$mno,$bteam,0,1,$id1,0)");
  $result = $conn->query("insert into scorecard (owner,tid,ted,matchno,teambat,bb,wno,playeron,onstrike)".
" values($ownerid,$t,$id,$mno,$bteam,1,0,$id2,1)");
$rr1=$conn->query("select shortname from team where teamid=$bteam limit 1;");
$rrr1=$rr1->fetchAll();/*inserting first team in livescore*/
$ttname=$rrr1[0]['shortname'];
$result = $conn->query("insert into livescore (owner,tid,ted,mno,done,team)".
" values($ownerid,$t,$id,$mno,0,'$ttname')");

$rr1=$conn->query("select shortname from team where teamid=$bteamb limit 1;");
$rrr1=$rr1->fetchAll();/*inserting first team in livescore*/
$ttname=$rrr1[0]['shortname'];
$result = $conn->query("insert into livescore (owner,tid,ted,mno,done,team)".
" values($ownerid,$t,$id,$mno,-1,'$ttname')");

$conn->query("update mbetween set start1=0 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam");

$rr1=$conn->query("select * from player where owner=$ownerid and pid=$id0  limit 1;");
$rrr1=$rr1->fetchAll();/*inserting first team in livescore*/
$ttname=$rrr1[0]['pname'];
$result = $conn->query("insert into livebat (owner,tid,ted,matchno,pid,pname,status)".
" values($ownerid,$t,$id,$mno,$id0,'$ttname',1)");

$rr1=$conn->query("select pname from player where owner=$ownerid and pid=$id1 limit 1;");
$rrr1=$rr1->fetchAll();/*inserting first team in livescore*/
$ttname=$rrr1[0]['pname'];
$result = $conn->query("insert into livebat (owner,tid,ted,matchno,pid,pname,status)".
" values($ownerid,$t,$id,$mno,$id1,'$ttname',0)");

$rr1=$conn->query("select pname from player where owner=$ownerid and pid=$id2 limit 1;");
$rrr1=$rr1->fetchAll();/*inserting first team in livescore*/
$ttname=$rrr1[0]['pname'];
$result = $conn->query("insert into livebat (owner,tid,ted,matchno,pid,pname,status)".
" values($ownerid,$t,$id,$mno,$id2,'$ttname',2)");



    include "showliceaction.php";
  }

catch(PDOException $e)
    {
      echo "fff";
    echo  "<br>" . $e->getMessage();
    }
    $conn = null;

}

else {


$_SESSION['loginerror']="Need to sign in for insertion of player sm";
header("location:../login.php");
}


?>
