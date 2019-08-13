<?php
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


  <!-- Main CSS-->
  <link href="css/main.css" rel="stylesheet" media="all">
    <link href="css/bootstrap.css" rel="stylesheet" media="all">
  <script>
  function showted(pr)
  {
    if(pr == 0)
    {
    document.getElementById("tedid").innerHTML="ff";
    return;
  }
  else {
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

  function showmatch(pr)
  {
    var xx=document.fname.tour.value;

    if(pr == 0)
    {
    document.getElementById("matchid").innerHTML="select correctly";
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
    tedrequest.open("GET", "getteams.php?p=" + pr + "&q=" + xx, true);
    tedrequest.send(null);
  }
  }

  function addteams()
  {
    var xx=document.fname.tour.value;
    var yy=document.getElementById('tedid').value;

    var mininterest1 = document.querySelectorAll("[name=seteam]");

    var count = 0, count1 = 0,
        interests = [],   interests1 = [];

        for (var i = 0; i < mininterest1.length; i++) {

            if (mininterest1[i].checked) {
                count1++;
                interests1.push(mininterest1[i].value);
            }
  //document.getElementById('ds1').innerHTML=interests;
        }
        var tedrequest2= new XMLHttpRequest();
        tedrequest2.onreadystatechange = function()
        {
          if (this.readyState==4 && this.status == 200)
          {
              document.getElementById('matchid').innerHTML=this.responseText;
          }
        };
        tedrequest2.open("GET", "addteam.php?q=" + xx + "&p=" + yy +  "&seteam=" + interests1, false);
        tedrequest2.send(null);
      }



  </script>
  <title>
    select teams
  </title>
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
  <div style="padding-top:50px">

      <div class="wrapper wrapper--w680">
          <div class="card card-1">

              <div class="card-body" >


<br>
  <div class="row row-space" style="width:100%; text-align:center;">
    <h2 style="width:100%;">select teams for edition </h2></div>
  <form action="addteam.php" method="get" name="fname">

  <br>
  <div style="width:100%; text-align:center;">
        <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
      <div class="input-group" style="width:100%;">
        <div class="rs-select2 js-select-simple select--no-search ">
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

<div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
<div class="input-group" style="width:100%;">
<div class="rs-select2 js-select-simple select--no-search ">
   <select name="tedn" id="tedid" onchange="showmatch(this.value)">

   <option value="0" selected>Select One...</option>


   </select>
   <div class="select-dropdown">
 </div>
</div>

</div>

</div>
<br>



</div>
<div class="p-t-20" style="text-align:center;">


  <br>
    <a href="./main.php">> Go To Select</a>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp
      <a href="../index.php">
    > Home</a><br>
</div>
</div>
</div>
</div>
</div>
<div class="page-wrapper font-robo" style="margin-top:100px;margin-left:25%;margin-right:20%">

        <div class="card card-1">


<div id="matchid" style="position:relative">

</div>


</div></div>
</form>

<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="js/global.js"></script>
</html>
