<?php
session_start();
if($_SESSION['name'])
{
  if($_SESSION['r'])
  {
  $aa = $_SESSION['t'];
    $bb = $_SESSION['e'];
      $cc = $_SESSION['m'];
  $n = $_SESSION['n'];

?>
  <link href="css/bootstrap.css" rel="stylesheet" media="all">
  <?php
 echo "<html><head></head><body> <form action='matchplay1.php' method='post'> ".
 "<center><br><br><br><h2 style='color:green;'>select match to be score </h2><div style='margin-left:40%;margin-right:40%;text-align:center'><br><select class=\"form-control\" name='smno' id='smno'>";
 for ($i=0; $i < $n ; $i++) {
   // code...
 echo "<option value='".  $i . "'> ". $aa[$i] . " " . $bb[$i] . " " . $cc[$i] . "</option>";
}
echo "</select><br><br><input class=\"btn btn-danger\" type=submit value='start match' ></form></body></html>";
//  echo " ". $aa[1];

}
else {
  echo "match ended already";
}
}
else {
  $_SESSION['loginerror']="need to sign in for ms";
  header("location:login.php");
}
?>
