<?php
session_start();
if(!$_SESSION['name'])
{
$_SESSION['loginerror']="need to sign in first";
header("location:../login.php");
}
else {
  $ownerid=$_SESSION['owner'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$result = $conn->query($sql);
    $conn->query("use new3");


    $az=$conn->query("select name,phoneno,id,email from admin_list where id=$ownerid");
    $azr=$az->fetch();


?>
<html><head>
  <style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  color: #333;
}

table {
  padding-left:50px;
  text-align: left;
  line-height: 40px;
  border-collapse: separate;
  border-spacing: 10px;
  border: 2px solid #ed1c40;
  width: 400px;
  margin: 50px auto;
  margin-left: 50px;
  border-radius: .25rem;
}

thead tr:first-child {
  background: #ed1c40;
  color: #fff;
  border: none;
}

th:first-child,
td:first-child {
  padding: 0 15px 0 20px;
}

th {
  font-weight: 500;
}

thead tr:last-child th {
  border-bottom: 3px solid #ddd;
}

tbody tr:hover {
  background-color: #f2f2f2;
  cursor: default;
}

tbody tr:last-child td {
  border: none;
}

tbody td {
  border-bottom: 1px solid #ddd;
}

td:last-child {
  text-align: right;
  padding-right: 10px;
}

.button {
  color: #aaa;
  cursor: pointer;
  vertical-align: middle;
  margin-top: -4px;
}

.edit:hover {
  color: #0a79df;
}

.delete:hover {
  color: #dc2a2a;
}

.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: auto;
    text-align: center;
}

.title {
    color: grey;
    font-size: 18px;
}

button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

a {
    text-decoration: none;
    font-size: 15px;
    color: black;
}

button:hover {
    opacity: 0.7;
}

.twoo{
  display: inline-block;
  width: 100%;

}
.firstt {
  float: left;
}
.secondd {
  position : absolute;
  margin-left:530px;

}
</style>
  <link href="css/bootstrap.css" rel="stylesheet" media="all">
<script>
updatep(vr)
{
  var mno=document.getElementById(vr).innerHTML;


}
</script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../../index.php">CRICFLICK</a>
      </div>
      <ul  class="nav navbar-nav navbar-right">
        <li ><a href="../main.php">Select</a></li>
        <li ><a href='../crteam0.php' >insert team</a></li>
        <li ><a href="../crp.php">insert player </a></li>
        <li ><a href="../crl0.php">insert location </a></li>
        <?php
        echo "<li class='active'><a href='../logout.php'><span style='color:pink'>Log Out</span></a></li>";
         ?>
      </ul>
    </div>
  </nav>
  <div class="card">
  <img src="img.jpg" alt="John" style="width:100%">
  <h4>
  <?php
  echo $azr['name'];
  ?>

</h4>
  <p class="title">
  <?php
echo "Ph No - ".$azr['phoneno'];
echo "<br>Email- ".$azr['email'];
?>
  </p>
  <p>my link</p>
  <p>
  <?php echo "localhost:8888/pr/index.php?id=".$azr['id'];
  ?>
<br><br></p>
  <!--a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a-->
  <p></p>
</div>
<div class='twoo'>
  <div class='firstt'>
<table>
  <thead>
    <tr>
      <th colspan="3">Players</th>
    </tr>
    <tr>
      <th>#</th>
      <?php
      $df=$conn->query("select pname,pid,phoneno   from player where owner=$ownerid ");
      $dfr=$df->fetchAll();

        // code...
      ?>
      <th colspan="2">Representing</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $cc=1;
      foreach ($dfr as $key) {
         ?>
      <td>
      <?php echo $cc ;
       ?>
      </td>
      <td>
      <?php
      echo $key['pname'] . " ( <span id=\"$cc\">" . $key['phoneno']."</span> )";
      ?>
      </td>
      <td>
        <i class="material-icons button edit" onclick=window.location.href=<?php echo "'../upp.php?id=".$key['pid']."'>";
        $cc++;
        ?>
          edit</i>

      </td>
    </tr>
  <?php } ?>

  </tbody>
</table>
</div>
<div class='secondd'>
  <table>
    <thead>
      <tr>
        <th colspan="3">Matches</th>
      </tr>
      <tr>
        <th>#</th>
        <?php
        $df=$conn->query("select *   from lmatch where owner=$ownerid ");
        $dfr=$df->fetchAll();

          // code...
        ?>
        <th colspan="2">tour-ed-matchno-</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        $cc1=1;
        foreach ($dfr as $key) {
          echo "  <td>".$cc1."</td><td>";
          $cc1++;
           ?>

        <?php echo $key['tid']." ( ".$key['matchno']." )";
         ?>
         </td>
         <td>
           <i class="material-icons button edit" onclick=window.location.href=<?php echo "'deletm.php?tid=".$key['tid']."&ted=".$key['ted']."&matchno=".$key['matchno']."'>";
           $cc++;
           ?>
           delet </i> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
           <i class="material-icons button edit" onclick=window.location.href=<?php echo "'../../scorecard/index.php?tid=".$key['tid']."&ted=".$key['ted']."&matchno=".$key['matchno']."'>";
           $cc++;
           ?>
             scorecard</i>

         </td>
      </tr>

    <?php
  }
   ?>

    </tbody>
  </table>
</div>

<?php
}
catch(PDOException $e)
  {
  echo  "<br>" . $e->getMessage();
  }
}
   ?>
   </body>
   </html>
