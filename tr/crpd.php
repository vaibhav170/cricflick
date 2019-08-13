<?php
session_start();

$servername = "localhost:8889";
$username = "root";
$password = "root";

$lowner=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$result = $conn->query($sql);

  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

?>



<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!-- Main CSS-->

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="page-wrapper  p-t-100 p-b-100 font-robo">




                <div class="row row-space" style="width:100%; text-align:center;">
                  <h2 style="width:100%;">Add New Player</h2>
                </div>
                <br>
                <br>
  <form action="crps.php">
    <div style="width:100%; padding-left:40%;padding-right:40%;">

<div class="row">


              <div class="input-field col s12">
<input class="input--style-1" style="width:100%; text-align:center;" placeholder="MOBILE NUMBER" name="fid">


</div>
<div class="row">
  <div class="input-field col s12">
<input class="input--style-1" style="width:100%; text-align:center;" placeholder="ENTER NAME" name="fname">



<div class="input-field col s12">
<input type="text" class="datepicker" placeholder="DATE OF BIRTH" name="fdate">
                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>


    <br>
    <div >
    <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
        <div class="input-group" style="width:100%; text-align:center;">
<input class="input--style-1" style="width:100%; text-align:center;" placeholder="JERSY NUMBER" name="ffav">
</div>
</div>
</div>

    <br>
    <div style="width:100%; text-align:center;">

          <div class="input-field col s12">
            <select name="country">
      <option value="0" disabled="disabled" selected="selected">representing &nbsp&nbsp</option>
      <?php
      if($_SESSION['name'])
      {
      $conn->exec("USE new3");
    $getUsers = $conn->prepare("SELECT * FROM team where owner=$lowner;");
    $getUsers->execute();
    $users = $getUsers->fetchAll();

   foreach ($users as $user) {
  echo "<option value=\"";
            echo $user['teamid'];
            echo "\"";
            echo ">";
echo $user['teamname'];
echo "</option>";
//  echo "<option value=$user['t_id']>$user['t_name']</option>";
        }
      }
      else {
        //echo "<p style=\"color:maroon;\"> Need to login first </p>";

        $_SESSION['loginerror']="Need to sign in for insertion of player";
        header("location:../login.php");
      }

         //$conn=null;
         ?>

      </select>
    <label>Materialize Select</label>
      </div>

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
      <div class="p-t-20" style="margin-left:25%;margin-right:25%;">
       <input class="btn btn--radius btn--green" type='submit' value='ADD PLAYER'>
      </div>





  </form>
</BODY>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


    </html>
