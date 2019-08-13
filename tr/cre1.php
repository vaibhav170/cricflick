<?php
session_start();
if($_SESSION['name'])
{
  $lowner=$_SESSION['owner'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['fedno'];
$ssdate=$_GET['fsdate'];
$loc=$_GET['sloc'];
$t=$_GET['tour'];
$sdate = date('Y-m-d', strtotime($ssdate));
$sql = "insert into ted (owner,tid,ted,sdate,at) values($lowner,$t,$id,'$sdate',$loc);";
try {
  if($t==0 || $id==0  || $loc==0 || !preg_match("/^[0-9]{1,5}$/",$id))
  {
    $_SESSION['crerror']="* Enter correct choice";
    header("location:cre.php");
  }
  else{

    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $aa=$conn->query("select * from ted where owner=$lowner and tid=$t and ted=$id  limit 1");
    $aar=$aa->fetch();
    if($aar)
    {
      $_SESSION['crerror']="* Edition Already Created";
      header("location:cre.php");
    }
  }

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

    echo "<br><br><br><center><h3>inserted successfully</h3>";
    echo "<br><br> <a href='seteam.php' > Select </a> teams for this edition<br>";
    echo "<br><a href='main.php'>click here </a>to go select page";
  }

catch(PDOException $e)
    {

    echo  "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  $_SESSION['loginerror']="Need to sign in for insertion edition";
  header("location:../login.php");
}
?>
