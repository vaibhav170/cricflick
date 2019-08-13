<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$mno=$_GET['fid'];
$name=$_GET['fname'];
$fav=$_GET['ffav'];
$ddate=$_GET['fdate'];
$repre=$_GET['country'];
$id=$_GET['id'];
$date = date('Y-m-d', strtotime($ddate));
$lowner=$_SESSION['owner'];
$sql = "update player set phoneno=$mno,favno=$fav,representing=$repre,pname='$name',birthdate='$date' where pid=$id";
try {
  if(!preg_match("/^[6-9]{1}[0-9]{9}$/",$mno)  || !preg_match("/^[a-zA-Z\s]{2,20}$/",$name) || !preg_match("/^[0-9]{1,3}$/",$fav)   )
  {
    $_SESSION['crerror']="*Enter correct Information";
    header("location:upp.php");
  }
  else{

    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
  /*  $aa=$conn->query("select * from player where owner=$lowner and phoneno=$mno  limit 1");
    $aar=$aa->fetch();
    if($aar)
    {
      $_SESSION['crerror']="* Player Already Exists";
      header("location:crp.php");
    }*/



    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $result = $conn->query($sql);

    ?>
<html><head>
    <link href="css/bootstrap.css" rel="stylesheet" media="all">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="../index.php">CRICFLICK</a>
        </div>
        <ul style="padding-left:50%" class="nav navbar-nav">
          <li ><a href="main.php">Select</a></li>
          <li ><a href='crteam0.php' >insert team</a></li>
          <li ><a href="crp.php">insert player </a></li>
          <li ><a href="crl0.php">insert location </a></li>
          <?php
          echo "<li class='active'><a href='mr/admin.php'><span style='color:pink'>".$_SESSION['name']."</span></a></li>";
           ?>
        </ul>
      </div>
    </nav>

    <?php
    //$dbr = $result->num_rows
    //echo $date;
    echo "<center><br><br><br><h3>player update successfully</h3><br><br>";
    echo "<a href=\"crp.php\">click here</a> to add more<br>";
      echo "<br><a href='main.php'>click here</a> to go select page <br>";

}
}

catch(PDOException $e)
    {

    echo  "<br>";
    }
    $conn = null;

}
else {


$_SESSION['loginerror']="Need to sign in for insertion of player";
header("location:../login.php");
}


?>
