<?php
session_start();
if(!$_SESSION['name'])
{
  /*if sign  then entry else sign in first*/
  $_SESSION['loginerror']="need to sign for start match";
  header("location:../login.php");
}
 ?>

 <html>
 <head>
   <title>
     scorer
   </title>
<script type="text/javascript">

function updaterun(vr)
{

  var x1=document.getElementById('onstrike').innerHTML;
  var x2=document.getElementById('nonstrike').innerHTML;
   var x3=document.getElementById('attack').innerHTML;
   var mno=document.getElementById('mno').getAttribute('data-mno');
   var t=document.getElementById('tour').getAttribute('data-tour');
   var id=document.getElementById('ted').getAttribute('data-ted');
   var teambat=document.getElementById('teambat').innerHTML;
   var teambowl=document.getElementById('teambowl').innerHTML;
   if(vr==='wide')
   {
     var tedrequest2= new XMLHttpRequest();
     tedrequest2.onreadystatechange = function()
     {
       if (this.readyState==4 && this.status == 200)
       {
           document.getElementById('livescore').innerHTML=this.responseText;
       }
     };
     tedrequest2.open("GET", "mr/addruns.php?pid0=" + x1 + "&pid1=" + x2 + "&pid2=" + x3 + "&mno=" + mno +
     " &p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl + "&vr=" + vr, false);
     tedrequest2.send(null);

   }
  else if (1) {
    //increase balls of batsman baller and team
    var tedrequest2= new XMLHttpRequest();
    tedrequest2.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById('livescore').innerHTML=this.responseText;
      }
    };
    tedrequest2.open("GET", "mr/addruns.php?pid0=" + x1 + "&pid1=" + x2 + "&pid2=" + x3 + "&mno=" + mno +
    "&p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl + "&vr=" + vr, false);
    tedrequest2.send(null);

  }
}

function wicketis()
{
  var mno=document.getElementById('mno').getAttribute('data-mno');
  var t=document.getElementById('tour').getAttribute('data-tour');
  var id=document.getElementById('ted').getAttribute('data-ted');
  var teambat=document.getElementById('teambat').innerHTML;
  var teambowl=document.getElementById('teambowl').innerHTML;
  var wicketof=document.getElementById('outis').value;
  var wicketrun=document.getElementById('wicketrun').value;
  var wickettype=document.getElementById('outtypeis').value;
  var typeball=document.getElementById('typeball').value;
   var x3=document.getElementById('attack').innerHTML;
  var tedrequest2= new XMLHttpRequest();
  tedrequest2.onreadystatechange = function()
  {
    if (this.readyState==4 && this.status == 200)
    {
        document.getElementById('livescore').innerHTML=this.responseText;
    }
  };
  tedrequest2.open("GET", "mr/wicketsis.php?wicketof=" + wicketof + "&wicketrun=" + wicketrun + "&by=" + x3 + "&mno=" + mno +
  "&p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl +"&typeball=" + typeball +"&wickettype=" + wickettype, false);
  tedrequest2.send(null);

}
function wicket()
{
  var x1=document.getElementById('onstrike').innerHTML;
  var x2=document.getElementById('nonstrike').innerHTML;
   var x3=document.getElementById('attack').innerHTML;
   var mno=document.getElementById('mno').getAttribute('data-mno');
   var t=document.getElementById('tour').getAttribute('data-tour');
   var id=document.getElementById('ted').getAttribute('data-ted');
   var teambat=document.getElementById('teambat').innerHTML;
   var teambowl=document.getElementById('teambowl').innerHTML;

   var tedrequest2= new XMLHttpRequest();
   tedrequest2.onreadystatechange = function()
   {
     if (this.readyState==4 && this.status == 200)
     {
         document.getElementById('action').innerHTML=this.responseText;
     }
   };
   tedrequest2.open("GET", "mr/wicket.php?pid0=" + x1 + "&pid1=" + x2 + "&pid2=" + x3 + "&mno=" + mno +
   "&p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl, false);
   tedrequest2.send(null);

}
   function addd2()
   {
     var x1=document.getElementById('sb1').value;
     var x2=document.getElementById('sb2').value;
      var x3=document.getElementById('sbl1').value;
      var mno=document.getElementById('mno').getAttribute('data-mno');
      var t=document.getElementById('tour').getAttribute('data-tour');
      var id=document.getElementById('ted').getAttribute('data-ted');
      var teambat=document.getElementById('teambat').innerHTML;
      var teambowl=document.getElementById('teambowl').innerHTML;
     if(x1==0 || x2==0 || x3==0)
     {

       return 0;

     }
     else
     {
       var tedrequest2= new XMLHttpRequest();
       tedrequest2.onreadystatechange = function()
       {
         if (this.readyState==4 && this.status == 200)
         {
             document.getElementById('sm1').innerHTML="<p style='color:green;'> " + this.responseText + "</p>";
         }
       };
       tedrequest2.open("GET", "mr/add2.php?pid0=" + x1 + "&pid1=" + x2 + "&pid2=" + x3 + "&mno=" + mno +
       " &p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl, false);
       tedrequest2.send(null);

     }
   }

   function newbowler()
   {
     var x1=document.getElementById('onstrike').innerHTML;
     var x2=document.getElementById('nonstrike').innerHTML;
      //var x3=document.getElementById('sbl1').value;
      var mno=document.getElementById('mno').getAttribute('data-mno');
      var t=document.getElementById('tour').getAttribute('data-tour');
      var id=document.getElementById('ted').getAttribute('data-ted');
      var teambat=document.getElementById('teambat').innerHTML;
      var teambowl=document.getElementById('teambowl').innerHTML;
      var newbowler=document.getElementById('newbowler').value;

      if(newbowler)
      {
        var tedrequest2= new XMLHttpRequest();
        tedrequest2.onreadystatechange = function()
        {
          if (this.readyState==4 && this.status == 200)
          {
              document.getElementById('livescore').innerHTML="<p style='color:green;'> " + this.responseText + "</p>";
          }
        };
        tedrequest2.open("GET", "mr/changebowler.php?pid0=" + x1 + "&pid1=" + x2 + "&mno=" + mno +
        "&p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl + "&newbowler=" + newbowler, false);
        tedrequest2.send(null);

      }
   }

   function newbatsman()
   {
     var on=document.getElementById('notout').innerHTML;
      //var x3=document.getElementById('sbl1').value;
      var mno=document.getElementById('mno').getAttribute('data-mno');
      var t=document.getElementById('tour').getAttribute('data-tour');
      var id=document.getElementById('ted').getAttribute('data-ted');
      var teambat=document.getElementById('teambat').innerHTML;
      var teambowl=document.getElementById('teambowl').innerHTML;
      var newbatsman=document.getElementById('newbatsman').value;
      var vr=0;
      if(document.getElementById('os').checked)
      {
        vr=1;
      }

      if(newbatsman)
      {
        var tedrequest2= new XMLHttpRequest();
        tedrequest2.onreadystatechange = function()
        {
          if (this.readyState==4 && this.status == 200)
          {
              document.getElementById('livescore').innerHTML="<p style='color:green;'> " + this.responseText + "</p>";
          }
        };
        tedrequest2.open("GET", "mr/newbatsman.php?" + "&pid1=" + on + "&mno=" + mno +
        "&p=" + id + "&q=" + t + "&team=" + teambat + "&teamb=" + teambowl + "&newbatsman=" + newbatsman + "&vr="+vr, false);
        tedrequest2.send(null);

      }
      else {
        /*not giving option like 0 already one is selected*/
      }
   }
   </script>

     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
     <title>Starter Template - Materialize</title>


 </head>
 <body style="background: linear-gradient(to top left, #ffcc66 27%, #ff66cc 100%); font-family:monospace;color:white">

   <center>
   <?php
$servername = "localhost:8889";
$i=$_POST['smno'];
$username = "root";
$password = "root";/*as we saving which match ted and tid in session to get it below code is for*/
$tt=$_SESSION['t'];
$idd=$_SESSION['e'];
$mnoo=$_SESSION['m'];
$i;
$t=$tt[$i];
$id=$idd[$i];
$mno=$mnoo[$i];
$ownerid=$_SESSION['owner'];
try{
  /*$cd=$conn->query("select * from tname where owner=$ownerid and tid=$t;");
  $cdr=$cd->fetchAll();
$tname=$cd[0]['tname'];

echo "<span id='tour' value='" . $t ."'>".$tname."<br></span>";*/
$conn = new PDO("mysql:host=$servername", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->query("use new3");
$tour=$conn->query("select * from tname where tid=$t");
$tourr=$tour->fetch();

echo "<h1 style='font-family: cursive;'><span id='tour' data-tour='" . $t ."'>".$tourr['tname']."</span></h1>";
echo "<h2 style='font-family: cursive;'><span id='ted' data-ted='" . $id ."'>Edition - ".$id."</span>&nbsp&nbsp &nbsp&nbsp";
echo "<span id='mno' data-mno='" . $mno ."'>Match Number - ".$mno."</span>&nbsp&nbsp&nbsp&nbsp</h2>";

$result=$conn->query("select * from lmatch where owner=$ownerid and tid=$t and ted=$id and matchno=$mno limit 1");
$totalt=$result->fetchAll();
/*extra check as toss is selected all things are correct prior to this
but we are adding value to session if match is running and toss is done
then if session present all things are correct*/
$count=$result->rowCount();
$result=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno limit 1;");
$total=$result->fetchAll();
$fteam=$total[0]['teamid'];/*always represent first team and steam for second*/
$result=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno limit 1, 1 ;");
$total=$result->fetchAll();
$steam=$total[0]['teamid'];/*always represent first team and steam for second*/
$result=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$fteam;");
$countab=$result->rowCount();
if(!$countab)
{/*at least one player is needed*/
echo "toss not selected";
header("location:main.php");
}

$result=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$steam;");
$countab=$result->rowCount();
if(!$countab)
{/*at least one player is needed*/
echo "errorisno player selected";
header("location:main.php");
}

$result=$conn->query("select * from team where owner=$ownerid and teamid=$fteam limit 1;");
$resultf=$result->fetchAll();
$tn=$resultf[0]['teamname'];    /*showing team info of corresponding match*/
$tr=$resultf[0]['representing'];
echo "<h1 style='font-family: fantasy;'>". $tn . " ( ". $tr . " )    &nbsp vs  &nbsp   ";
$result=$conn->query("select * from team where owner=$ownerid and teamid=$steam limit 1;");
$resultf=$result->fetchAll();
$tn1=$resultf[0]['teamname'];
$tr1=$resultf[0]['representing'];
echo "  ". $tn1 . " ( ". $tr1 . " ) </h1> ";
$jk=$conn->query("select succ from lmatch where owner=$ownerid and tid=$t and ted=$id and matchno=$mno limit 1 ");
$jkr=$jk->fetch();
$ghh=$jkr['succ']
if($totalt[0]['toss'] == $fteam)
{
if (!$totalt[0]['choose']) {
echo "toss win by - ". $fteam . " - ". $tn ." ( ". $tr ." ) <br> * Choose to - <u>Batting</u> <br>";

if($ghh==1)
{
  $bteam=$steam;
  $blteam=$fteam;
}
else {
  // code...

$bteam=$fteam;
$blteam=$steam;
}
}
else {
  if($ghh==1)
  {
    $bteam=$fteam;
    $blteam=$steam;
  }
  else {
    $bteam=$steam;
    $blteam=$fteam;
  }
  echo "toss win by - ". $fteam . " - ". $tn ." ( ". $tr ." ) <br> * Choose to - <u>Fielding</u> <br>";
}
}
elseif ($totalt[0]['toss'] == $steam) {
if (!$totalt[0]['choose']) {
  $bteam=$steam;
  $blteam=$fteam;
echo "toss win by -  ". $steam . " - ". $tn1 ." ( ". $tr1 ." ) <br> * Choose to - <u>Batting</u> <br>";
}
else {

  $bteam=$fteam;
  $blteam=$steam;
echo "toss win by -  ". $steam . " -  ". $tn1 ." ( ". $tr1 ." ) <br> * Choose to - Fielding <br>";
}

}
else {
echo "error line no near 312 can be changed matchplay1:- team winning toss is not playing team ";
}
/*$sd = array("$i" => $bteam );
$sd1 = array("$i" => $blteam );
$_SESSION['bl']=$sd1;*/
echo "<------------------------------------------>";
if($blteam==$steam)
{/*no need all*/
  echo "<br><span id='teambowl'>". $steam. "</span>";
  echo "<span id='teambat'> $fteam </span>";
}
if($blteam==$fteam)
{
  echo "<br><span id='teambowl'>". $fteam. " </span>";
  echo "<span id='teambat'> $steam </span>";
}


$so1=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam limit 1; ");
$so1r=$so1->fetchAll();
if($so1r[0]['start1']==-1)
{

  $sbt1=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam and ".
  " pid not in (select playeron from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teambat=$bteam and bb=0); ");
  echo "<span id='sm1'>select two player for batting <br>";
  $sbt1r=$sbt1->fetchAll();
    echo "select first batsman on strike <br><select name='sb1' id='sb1' ><option value='0'  >select one...";
  foreach ($sbt1r as $pid) {
    $key1=$pid['pid'];

    $sp1=$conn->query("select pid, pname, favno, runs from player where ".
    " owner=$ownerid and pid=$key1 and representing=$bteam limit 1;");
    $sp1r=$sp1->fetchAll();
  echo "<option value='". $sp1r[0]['pid'] .
  "'> " . $sp1r[0]['pname']  . " ( " . $sp1r[0]['favno'] . " ) ( " . $sp1r[0]['runs'] . " ) ";
}
echo "</select><br>select second non striker <br><select name='sb2' id='sb2'><option value='0' >select one...</option>";
foreach ($sbt1r as $pid) {
    $key1=$pid['pid'];

  $sp1=$conn->query("select pid, pname, favno,runs from player where ".
  " owner=$ownerid and pid=$key1 and representing=$bteam limit 1;");
  $sp1r=$sp1->fetchAll();
echo "<option value='". $sp1r[0]['pid'] .
"'> ". $sp1r[0]['pname'] . " ( ". $sp1r[0]['favno']." ) ( ". $sp1r[0]['runs']." ) ";
}
echo "</select><br>select bowler <br><Select id='sbl1'><option value='0'>select one...</option>";



$sblt1=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$blteam and ".
" pid not in (select playeron from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teambat=$bteam and bb=1); ");
$sblt1r=$sblt1->fetchAll();
foreach ($sblt1r as $pid) {
    $key1=$pid['pid'];

  $sp1=$conn->query("select pid, pname, favno,runs,wickets from player where ".
  " owner=$ownerid and pid=$key1 and representing=$blteam limit 1;");
  $sp1r=$sp1->fetchAll();
echo "<option value='". $sp1r[0]['pid'] .
"'> ". $sp1r[0]['pname'] . " ( ". $sp1r[0]['favno']." ) ( ". $sp1r[0]['wickets']." ) ";
}

echo "<br></select><br><input type='button' value='add' onclick='addd2()'><br></span>";

}
elseif ($so1r[0]['start1']==0) {
  echo "<br><br><div style='color:black;'>";
  include 'mr\showliceaction.php';
}
}
catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
    ?>
<span id='sm11'>
</span>
<span id='inp0'>
</span>
</body>

<!--script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script-->
</html>
