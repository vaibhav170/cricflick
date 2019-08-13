<?php
session_start();

if($_SESSION['name'])
{
  $lowner=$_SESSION['owner'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
$t=$_GET['q'];
$id=$_GET['p'];
$mno=$_GET['mno'];
$f=$_GET['f'];
$s=$_GET['s'];
$faa=$_GET['fa'];
$saa=$_GET['sa'];
$fa=explode(",", $faa);
$sa=explode(",", $saa);
$loc=0;
$i=0;
$sql = "insert into playing11 (owner,tid,ted,matchno,teamid,pid) values($lowner,$t,$id,$mno,$f,$s);";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    //$selects=$_GET['seteam'];
  //  echo $selects;

  //for ($i = 0 ;$i < sizeof($fa) ; $i++)
  foreach ($fa as $va) {
    // code...

    $i=$va;
    if($va != null)
    {
  $conn->query("insert into playing11 (owner,tid,ted,matchno,teamid,pid) values($lowner,$t,$id,$mno,$f,$va);");
}
  else {
    echo "<br>";
  }
  }
  foreach ($sa as  $vaa) {
  $loc=$vaa;
    if($vaa != null)
    {
$conn->query("insert into playing11 (owner,tid,ted,matchno,teamid,pid) values($lowner,$t,$id,$mno,$s,$vaa);");
}
else {
  echo "br>";
}
}

if($va && $vaa)
{
//  echo "select at least player";
}
  //  echo "looped ".$loc. " " . $i."<br>";
  //echo $fa[0].$sa[0].'';
  echo "<label>Players Added Successfully</label><br>";



  /*  echo "<br> <a href='seteam.php' > Select </a> teams for this edition";
    echo "<br><a href='main.php'>click here to go select page </a>";*/
  }

catch(PDOException $e)
    {
      echo "fff";
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  $_SESSION['loginerror']="Need to sign in for insertion teams for edition";
  header("location:../login.php");
}
?>
