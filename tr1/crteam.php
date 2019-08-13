<?php
session_start();
if($_SESSION['name'])
{
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['ftid'];
$name=$_GET['ftname'];
$repre=$_GET['fcname'];
$sname=$_GET['sname'];
$owner=$_SESSION['owner'];
$sql = "insert into team(owner,teamid,teamname,representing,shortname) values($owner, $id,'$name','$repre','$sname');";
try {


    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->query("use new3");


        if($id==0  || !preg_match("/^[0-9]{1,8}$/",$id) || !preg_match("/^[a-zA-Z\-_\.()\[\]\\\\\/\/\s]{3,30}$/",$name) || !preg_match("/^[a-zA-Z\-_\.()\[\]\\\\\/\/\s]{3,30}$/",$repre) || !preg_match("/^[a-zA-Z]{1,4}$/",$sname))
        {
        $_SESSION['crerror']="* Enter correct Input";
        header("location:crteam0.php");
      }
        else
        {
          $adf=$conn->query("select * from team where  teamid=$id");
          $adfr=$adf->fetch();
          if($adfr)
          {
          $_SESSION['crerror']="* Team Already Exists";
          header("location:crteam0.php");
        }
        else {
    $result = $conn->query($sql);
    //$dbr = $result->num_rows
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
      <ul  class="nav navbar-nav navbar-right">
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
    echo "<center><br><br><br><h3>inserted successfully </h3><br><br>";
    echo "<a href=\"crteam0.php\">click here</a> to add more teams<br>";
    echo "<br><a href='main.php'>click here</a> to go select page<br>";
  }
}
}
catch(PDOException $e)
    {

    echo  "<br>" . $e->getMessage();
    }
$conn = null;
}//end if

else {
  $_SESSION['loginerror']="Need to sign in for insertion of team";
  header("location:../login.php");

}

?>
