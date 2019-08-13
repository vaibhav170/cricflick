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
$f=$_GET['f'];
$s=$_GET['s'];
$lowner=$_SESSION['owner'];
$sql = "select * from team where teamid=$f and owner=$lowner;";
$sql1 = "select * from team where teamid=$s and owner=$lowner;";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $tt=$conn->query("select * from lmatch where owner=$lowner and tid=$t and ted=$id and matchno=$mno; ");
    $ttr=$tt->fetch();
    if($ttr['toss'] === null)
    {

    $result = $conn->query($sql);
    $a1=$result->fetchAll();
    echo "<div style='margin-left:25%; text-align:left;'><label>toss win by : <select class=\"form-control\" id='toss1' name='toss1'><option value='0' > select one...";
    foreach ($a1 as $key ) {
      // code...
      echo "<option value='" . $key['teamid'] ."'> " . $key['teamname']. " ( ". $key['representing']. " )";
    }
    $result = $conn->query($sql1);
    $a1=$result->fetchAll();
    foreach ($a1 as $key ) {
      // code...
      echo "<option value='" . $key['teamid'] ."'> " . $key['teamname']. " ( ". $key['representing']. " )";
    }
    echo "</select>";
    echo "<br><label> select to:";
    echo "<select class=\"form-control\" id='toss2' name='toss2'> <option value='-1' > select one...<option value='0' > batting first<option value='1'>bowling firts<br></select>";
    echo "<br><input class=\"btn btn-warning\" type='button' value='submit toss' onclick='toss()'></label></div>";
  }

else
  {
    $abc=$ttr['toss'];

    $ppr=$conn->query("select * from team where teamid=$abc and owner=$lowner;");
    $pprr=$ppr->fetch();
    $ab=$ttr['choose'];
    if($ab)
    $doi='Bowling';
    else {
      $doi="Batting";
    }
    echo "<div style='margin-left:25%; text-align:left;'><label><p style='color:green;'> Already Selected </p>  Toss Win By - ". $doi . " - ".
    $pprr['teamname']." ( ". $pprr['representing'] . " )<br><br><input type='button' class=\"btn btn-success\" value='click to start match' onclick='mstart()'></label></div>";
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
  $_SESSION['loginerror']="Need to sign in for insertion of Tournaments";
  header("location:../login.php");
}
?>
