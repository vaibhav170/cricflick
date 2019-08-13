<?php
/*
adding new match in edition
--input;
--selecct  tid, ted
--enter matchno
--output submiting to addmatch inserting data into lmatch
*/
session_start();
$servername = "localhost:8889";
$username = "root";
$password = "root";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$result = $conn->query($sql);
  }
catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Icons font CSS-->
  <!-- Icons font CSS-->
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <!-- Font special for pages-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

  <!-- Vendor CSS-->
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="css/main.css" rel="stylesheet" media="all">
  <script>
  function showted(pr)
  {
    if(pr == 0)
    {
    return;
  }
  else  {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById("tedid").innerHTML = "<option value='0'> Select One </option>" +  this.responseText;
      }
    };
    tedrequest.open("GET", "getted.php?q=" + pr, true);
    tedrequest.send(null);
  }
  }

/*  function showmatch(pr)
  {
    var xx=document.fname.tour.value;

    if(pr == 0)
    {

    return;
  }
  else {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById("matchid").innerHTML =this.responseText;
      }
    };
    tedrequest.open("GET", "getteams.php?q=" + pr + "&p=" + xx + "&", true);
    tedrequest.send(null);
  }
}*/
  </script>
  <title>
    select teams
  </title>
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
      <li><a href="crteam0.php">insert team</a></li>
      <li><a href="crp.php">insert player </a></li>
      <li><a href="crl0.php">insert location </a></li>
      <?php
      echo "<li><a href='mr/admin.php'><span style='color:pink'>".$_SESSION['name']."</span></a></li>";
       ?>
    </ul>
  </div>
  </nav>
  <div class="page-wrapper bg- p-t-100 p-b-100 font-robo" style='padding-top:50px'>
      <div class="wrapper wrapper--w680">
          <div class="card card-1">

              <div class="card-body" >

                <div class="row row-space" style="width:100%; text-align:center;">
                  <h2 style="width:100%;">Create New Match</h2>

</div>
<br>
<form method='get' action='addmatch0.php'>
<div style="width:100%; text-align:center;">
      <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
    <div class="input-group" style="width:100%;">
      <div class="rs-select2 js-select-simple select--no-search">
         <select name="tour" onchange="showted(this.value)">
      <option value="0" disabled="disabled" selected="selected">choose tournament &nbsp&nbsp</option>
      <?php
      if($_SESSION['name'])
      {
      $ownerid=$_SESSION['owner'];
      $conn->exec("USE new3");

    $getUsers = $conn->prepare("SELECT * FROM tname where owner=$ownerid;");
    $getUsers->execute();
    $users = $getUsers->fetchAll();

   foreach ($users as $user) {
  echo "<option value=\"";
            echo $user['tid'];
            echo "\"";
            echo ">";
  echo $user['tname'];
  echo "</option>";
        }
        $conn=null;
}
else {
  $_SESSION['loginerror']="Need to sign in for selection of team";
  header("location:../login.php");
}
   ?>

   </select>
     <div class="select-dropdown">
   </div>
 </div>
</div>
</div>
<div style="width:100%; text-align:center;">
      <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
    <div class="input-group" style="width:100%;">
      <div class="rs-select2 js-select-simple select--no-search">
   <select name="tedn" id="tedid" >

   <option value="0" disabled="disabled" selected="selected">   select one edition &nbsp&nbsp&nbsp&nbsp&nbsp</option>


   </select>
   <div class="select-dropdown">
 </div>
</div>
</div>
</div>



<div >
<div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
    <div class="input-group" style="width:100%; text-align:center;">
<input class="input--style-1" style="width:100%; text-align:center;" name='mno' placeholder=" Enter Match Number">


</div></div>

</div>
<div style="color:maroon; width:100%; text-align:center;">
<span id='error' >

  <?php
  if(isset($_SESSION['crerror']))
  {
  echo $_SESSION['crerror'];
  unset($_SESSION['crerror']);
}
   ?>
</span>
</div>
<div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
  <div class="input-group" style="width:100%; text-align:center;">
 <input class="btn btn--radius btn--green" type='submit' value='create match'>
</div>
</div>
<div style="width:100%; padding-left:25%;padding-right:25%;">

  or
  <br>
  <br>
    <a href="./main.php">> Go To Select</a>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <a href="../index.php">
    > Home</a>

</div>

</form>
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>
</body>
</html>
