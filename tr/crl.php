<?php
session_start();
    if($_SESSION['name'])
    {
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['flid'];
$name=$_GET['flname'];

$lowner=$_SESSION['owner'];
$sql = "insert into location(name,lid,owner) values('$name',$id,$lowner)";
try {
  if(!preg_match("/^[a-zA-Z0-9\-]{1,17}$/",$name) || $id==0  || !preg_match("/^[0-9]{1,4}$/",$id))
  {
    $_SESSION['crerror']="* Enter correct choice";
    header("location:cre.php");
  }
  else{

    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3");
    $aa=$conn->query("select lid from location where lid=$id  limit 1");
    $aar=$aa->fetch();
    if($aar)
    {
      $_SESSION['crerror']="* Location id Already Created";
      header("location:crl0.php");
    }

else {
  // code...

    $conn = new PDO("mysql:host=$servername", $username, $password);
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
    echo "<br><a href=\"crl0.php\">click here</a> to add more location<br>";
    echo "<br><a href='main.php'>click here </a> to go select page ";
  }
}
}

catch(PDOException $e)
    {

    echo "<br>" . $e->getMessage();
    }
$conn = null;
}//endif

else {
  $_SESSION['loginerror']="Need to sign in for insertion of Location";
  header("location:../login.php");
}
?>
