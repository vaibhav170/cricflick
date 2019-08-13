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
    document.getElementById("matchid").innerHTML="ff";
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
    tedrequest.open("GET", "getteams.php?q=" + pr + "&p=" + xx, true);
    tedrequest.send(null);
  }
  }
  </script>
  <title>
    select teams
  </title>
</head>
<body>
  <form action="addteam.php" method="get" name="fname">
    choose tournament : <select name="tour" onchange="showted(this.value)">
      <option value="0" selected>Select One...</option>
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

   <br>
   select one edition

   <select name="tedn" id="tedid" onchange="showmatch(this.value)">

   <option value="0" selected>Select One...</option>


   </select>
<span id="matchid">
</span>



 <input type='submit'>
</form>
</html>
