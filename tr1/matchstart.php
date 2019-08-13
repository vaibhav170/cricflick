<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$t=$_GET['q'];
$id=$_GET['p'];
$mno=$_GET['mno'];
$ownerid=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $result=$conn->query("select * from lmatch where owner=$ownerid and tid=$t and ted=$id and matchno=$mno limit 1");
    $totalt=$result->fetchAll();

    $count=$result->rowCount();
    /* toss happens only when teams are added in the match
    so no need to check here for teams inserted for match  if toss is present then teams are
    inserted into mbetween for given match number (matchno) */
    if($totalt[0]['toss'] === null)
    {
      echo "<p style='color:maroon;'>toss not selected</p>";

    }

    if(!$totalt[0]['running'])
    {
      $_SESSION['r']=0;
    }

else {
  // code...
  $_SESSION['r']=1;
  if($_SESSION['n'])
  {
    $n=$_SESSION['n'];

    $aa = ($_SESSION['t']);
    $bb =( $_SESSION['e']);
    $cc =( $_SESSION['m']);
    $dd=$_SESSION['b'];
    $aa[$n]=$t;
    $bb[$n]=$id;
    $cc[$n]=$mno;
    $dd[$n]=$totalt[0]['toss'];

    /*$_SESSION["t[$n]"]=$t;
    $_SESSION["e[$n]"]=$id;
    $_SESSION["m[$n]"]=$mno;*/
    $n++;
    $_SESSION['n']=$n;

    $_SESSION['t']=$aa;
    $_SESSION['e']=$bb;
    $_SESSION['m']=$cc;
    $_SESSION['b']=$dd;
  }
  else {
    // code...
    $aa = $t;
    $bb = $id;
    $cc = $mno;
    $dd=$totalt[0]['toss'];
  $_SESSION['n']=1;
  $_SESSION['t']=array($aa);
  $_SESSION['e']=array($bb);
  $_SESSION['m']=array($cc);
  $_SESSION['b']=array($dd);
}
  //header("location:matchplay.php");
  //echo "<script type=\"text/javascript\">location.replace(\"matchplay.php\");</script>";
}
  }
catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
}
else {
  $_SESSION['loginerror']="need to login for scoring match";
  header("location:login.php");
}
