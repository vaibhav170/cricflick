<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$tid=$_GET['tid'];
$mno=$_GET['matchno'];
$ted=$_GET['ted'];
$ownerid=$_SESSION['owner'];
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->query("use new3");
$conn->query("delete from lmatch where owner=$ownerid and tid=$tid and ted=$ted and matchno=$mno");
  header("location:./admin.php");
}
catch(PDOException $e)
    {

    echo  "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  echo "nned to login";
}
/*
create trigger delete_lmatch_before before delete on lmatch for each row
begin
delete from scorecard where owner=old.owner and tid=old.tid and ted=old.ted and matchno=old.matchno;
delete from playing11 where  owner=old.owner and tid=old.tid and ted=old.ted and matchno=old.matchno;
delete from mbetween where  owner=old.owner and tid=old.tid and ted=old.ted and matchno=old.matchno;
delete from livescore where  owner=old.owner and tid=old.tid and ted=old.ted and matchno=old.matchno;
delete from livebat where  owner=old.owner and tid=old.tid and ted=old.ted and matchno=old.matchno;
end
$*/
?>
