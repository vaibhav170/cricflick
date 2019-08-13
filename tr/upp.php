<?php
session_start();

$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['id'];
$lowner=$_SESSION['owner'];

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$result = $conn->query($sql);
    $conn->query("use new3");
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
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
        <li class='active'><a href="crp.php">insert player </a></li>
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
                  <h2 style="width:100%;">Add New Player</h2>
                </div>
                <br>
                <br>
  <form action="crps0.php">


        <div style="width:100%; text-align:center;">
              <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
            <div class="input-group" style="width:100%;">
              <div class="rs-select2 js-select-simple select--no-search">
                  <select name="id">
                    <option value=
<?php
echo "\"".$id."\"> ".$id;
?>


</select>
<div class="select-dropdown">
</div>
</div>
</div>
</div>
</div>
    <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
        <div class="input-group" style="width:100%; text-align:center;">
          <input class="input--style-1" style="width:100%; text-align:center;" placeholder=
        <?php $gh=$conn->query("select * from player where pid=$id limit 1");
        $ghr=$gh->fetch();
        echo "\"".$ghr['phoneno']." (enter phoneno )\" ";
        ?>
         name="fid">
       </div>
       </div>
       </div>


    <br>
    <div >
    <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
        <div class="input-group" style="width:100%; text-align:center;">
<input class="input--style-1" style="width:100%; text-align:center;" placeholder=
<?php $gh=$conn->query("select * from player where pid=$id limit 1");
$ghr=$gh->fetch();
echo "\"".$ghr['pname']." ( Enter Name )\" ";
?>
 name="fname">
</div>
</div>
</div>

    <br>
    <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
            <div class="input-group" style="width:100%; text-align:center;">
                <input class="input--style-1 js-datepicker" style="width:100%; text-align:center;" type="text" placeholder="ENTER DATE OF BIRTH" name="fdate">
                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
            </div>
        </div>

    <br>
    <div >
    <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
        <div class="input-group" style="width:100%; text-align:center;">
<input class="input--style-1" style="width:100%; text-align:center;" placeholder=
<?php $gh=$conn->query("select * from player where pid=$id limit 1");
$ghr=$gh->fetch();
echo "\"".$ghr['favno']." (Enter Fav No) \"";
?>
 name="ffav">
</div>
</div>
</div>

    <br>
    <div style="width:100%; text-align:center;">
          <div class="row row-space" style="width:100%; padding-left:25%;padding-right:25%;">
        <div class="input-group" style="width:100%;">
          <div class="rs-select2 js-select-simple select--no-search">
            <select name="country">
      <option value="0" disabled="disabled" selected="selected">representing &nbsp&nbsp</option>
      <?php
      if($_SESSION['name'])
      {
      $conn->exec("USE new3");
    $getUsers = $conn->prepare("SELECT teamid,teamname FROM team where owner=$lowner;");
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
      <div class="select-dropdown">
      </div>
      </div>
      </div>
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
      <div class="p-t-20" style="text-align:center;">
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
</BODY>
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>
    </html>
