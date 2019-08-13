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
//$vr=$_GET['vr'];
$ownerid=$_SESSION['owner'];

//$s=$_GET['s'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");

    $totr=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and bb=0 and outt=0 and teambat=$bteam ".
    " order by onstrike DESC limit 2;");
    $totar=$totr->fetchAll();
    echo "Choose who is out :- <select name='outis' id='outis'>";
    foreach ($totar as $keye) {
      $pid=$keye['playeron'];
      $pname=$conn->query("select * from player where owner=$ownerid and pid=$pid limit 1");
      $pnamee=$pname->fetchAll();
      $pnamer=$pnamee[0]['pname'];
      echo "<option value='".$pid."'>".$pnamer." ( ".$pnamee[0]['favno']." )";
}
      // code...
      echo "</select><br> <select name='outtypeis' id='outtypeis'>".
      "<option value='1' > runout <option value='2'> bowled</select>".
      "runs completed :- <select id='wicketrun'><option value='0' selected> 0 ".
      "<option value='1'> 1 <option value='2'> 2<option value='3'> 3 </select>".
      "it was <select id='typeball'><option value='1' selected> regular ".
      "<option value='2'>leg by <option value='3'>wide<br>>br> <input type='button' onclick='wicketis()' value='wicket'>";
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
