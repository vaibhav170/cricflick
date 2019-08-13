<?php
session_start();
$servername = "localhost:8889";
$username = "root";
$password = "root";
$id=$_GET['id'];
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
/*  $start1=1;
  $conn->exec("USE new0;");
$getUsers = $conn->prepare("SELECT DISTINCT no FROM liveteam;");
$getUsers->execute();
  $results= $getUsers->fetchAll();
  foreach ($results as $result) {
  $start1=$result['no'];
$getUsers = $conn->prepare("SELECT * FROM liveteam where no=$start1 and done=1;");
$getUsers->execute();
$users = $getUsers->fetchAll();
$rr1=0;
foreach ($users as $user) {
     echo "<b>" . $user['team'].":   <a>";
         echo $user['runs'] . "/" . $user['wickets'] . "   </a></b>";
         echo "(" . $user['co'] . "/" . $user['over'] . ")<br>";
         echo "rr: " . $user['rr'] . "<br>";
    $rr1=1;
  }
  $getUsers0 = $conn->prepare("SELECT * FROM liveteam where no=$start1 and done=0;");
  $getUsers0->execute();
  $users0 = $getUsers0->fetchAll();
  foreach ($users0 as $user0) {
           echo "<b>" . $user0['team'].":   <a>";
           echo $user0['runs'] . "/" . $user0['wickets'] . "   </a></b>";
           echo "<a>(" . $user0['co'] . "/" . $user0['over'] . ")<br>";
           echo "rr: " . $user0['rr'] . "  ";
           if($rr1)
           {
             echo "rrr: " . $user0['rrr'] . "<br>";
           }
         }
     $getUsers1 = $conn->prepare("SELECT * FROM liveteam where no=$start1 and done=-1;");
             $getUsers1->execute();
             $users1 = $getUsers1->fetchAll();
             foreach ($users1 as $user1) {
               echo "<b>" . $user1['team'] . "</b>:  <i> Yet To Bat </i><br>";
             }
             echo "<br>";
             $rr1=0;
                 //php code for showing live batsman
$conn->exec("USE new0;");
$getUsers2 = $conn->prepare("SELECT * FROM livescore where no=$start1;");
$getUsers2->execute();
$users2 = $getUsers2->fetchAll();
foreach ($users2 as $user2) {
echo "<label for='from'>";
echo $user2['batsman'];
if($user2['onstrike']==1)
{
echo "*";
}
echo "   <a>";
echo $user2['runs'] . "</a> ";
echo "(";
echo $user2['balls'];
echo ")";
echo "</label><br>";
}
$getUsers3 = $conn->prepare("SELECT * FROM livebowl where no=$start1;");
$getUsers3->execute();
$users3 = $getUsers3->fetchAll();
foreach ($users3 as $user3) {
echo "<b><label>" . $user3['bowler'].":  ";
echo $user3['overs'] . "-" . $user3['maiden'] . "-";
echo "<a>" . $user3['runs'] . "-" . $user3['wicket'] . "</a></label></b><br>";
}
}
 ?>
 </span>*/
 if($id==0)
 {
   if(isset($_SESSION['name']))
   {
     $ownerid=$_SESSION['owner'];
   }
   else {
     echo "<center>login or use id<center>";
     exit;
   }

 }
 else {
   $ownerid=$id;
 }
 $conn->query("use new3;");
 $result=$conn->query("select * from livescore where owner=$ownerid");
 $resultt=$result->fetchAll();
 foreach ($resultt as $keyy) {
   // code...
   if($keyy['done']==0  )
   {

   echo "<a><br><b>". $keyy['team']." :- ". $keyy['run']." / ".$keyy['wicket']. " ( ". (int)floor($keyy['over']/6) . " . ". ($keyy['over'])%6 ." )</b><br><br> </a></b>";
   $mno=$keyy['mno'];
   $result1=$conn->query("select * from livebat where owner=$ownerid and  matchno=$mno");
   $resultt1=$result1->fetchAll();

   foreach ($resultt1 as $keyyy) {
   // code...
   if($keyyy['status']==1)
   {
   echo $keyyy['pname'] . "* - ". $keyyy['run']." ( ". $keyyy['ball']." ) - 6- ".$keyyy['six']."<br>";

   //  echo "</span>";
   }
 }
   foreach ($resultt1 as $keyyy) {
     // code...
if($keyyy['status']==0)
{
echo $keyyy['pname'] . " - ". $keyyy['run']." ( ". $keyyy['ball']." ) - 6- ".$keyyy['six']."<br>";
}
//  echo "</span>";
}
foreach ($resultt1 as $keyyy) {
// code...
if($keyyy['status']==2)
{
echo "<br>".$keyyy['pname'] . " - ". $keyyy['run']." ( ".  (int)floor($keyyy['ball']/6) . " . ". ($keyyy['ball'])%6 ." ) - wickets- ".$keyyy['six']."<br>";
}

//  echo "</span>";
}
foreach ($resultt1 as $keyyy) {
// code...
if($keyyy['status']==-1)
{
echo "<br><i>last wicket &nbsp&nbsp</i>".$keyyy['pname'] . " - ". $keyyy['run']." ( ".  $keyyy['ball'] . " ) - 6- ".$keyyy['six']."<br>";
}

//  echo "</span>";
}



}

elseif($keyy['done']==1)
{
echo "<b><br>". $keyy['team']." :- ". $keyy['run']." / ".$keyy['wicket']. " ( ". $keyy['over']." ) completed inning<br></b>";
}

else {
echo "<b><br>". $keyy['team']." :- "." yet to come </b><br>";
}
echo "------------------------";
}


?>
