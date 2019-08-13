<?php

session_start();
if($_SESSION['name'])
{
  $lowner=$_SESSION['owner'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
$t=$_GET['tour'];
$id=$_GET['tedn'];
$mno=$_GET['mno'];
$sql = "insert into lmatch (owner,tid,ted,matchno) values($lowner,$t,$id,$mno);";
try {
  if($t==0 || $id==0 || $mno==0)
  {
    $_SESSION['crerror']="Enter correct choice";
    header("location:crmatch.php");
  }
  else{

    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $aa=$conn->query("select * from lmatch where owner=$lowner and tid=$t and ted=$id and matchno=$mno limit 1");
    $aar=$aa->fetch();
    if($aar)
    {
      $_SESSION['crerror']="Match Already Created";
      header("location:crmatch.php");
    }

    $conn->query($sql);
    ?>
<html>
<head>
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
        <li><a href="crteam0.php">insert team</a></li>
        <li><a href="crp.php">insert player </a></li>
        <li><a href="crl0.php">insert location </a></li>
        <?php
        echo "<li><a href='mr/admin.php'><span style='color:pink'>".$_SESSION['name']."</span></a></li>";
         ?>
      </ul>
    </div>
  </nav>
  <?php
    echo "<br><br><br><center><h3>inserted successfully<?h3><br>";



    echo "<br> <a href='main.php' >Go to Select </a> ";
    echo "<br><a href='main.php'>click here to go select page </a>";
  }
  }

catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

}
else {
  $_SESSION['loginerror']="Need to sign in for insertion teams for edition";
  header("location:../login.php");
}
