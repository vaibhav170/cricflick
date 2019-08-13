<center>
  <?php
  $result=$conn->query("select * from livescore where owner=$ownerid and tid=$t and ted=$id and mno=$mno ");
  $resultt=$result->fetchAll();
  echo "<span id='livescore'><--------------------------------------------><br>";
  foreach ($resultt as $keyy) {
    // code...
    if($keyy['done']==0  )
    {
      echo "<b>". $keyy['team']." :- ". $keyy['run']." / ".$keyy['wicket']. " ( ". (int)floor($keyy['over']/6) . " . ". ($keyy['over'])%6 ." )</b><br><br>";
      $result1=$conn->query("select * from livebat where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ");
      $resultt1=$result1->fetchAll();
      foreach ($resultt1 as $keyyy) {
        // code...
if($keyyy['status']==1)
{
      echo $keyyy['pname'] . "* - ". $keyyy['run']." ( ". $keyyy['ball']." ) - 6- ".$keyyy['six']."<br>";
    }
    //  echo "</span>";
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
  echo "<br><i>last wicket &nbsp&nbsp</i>".$keyyy['pname'] . " - ". $keyyy['run']." ( ".  (int)floor($keyyy['ball']/6) . " . ". ($keyyy['ball'])%6 ." ) - 6- ".$keyyy['six']."<br>";
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



  }

  //echo "</span>";
  ?>
  <br>

  <----------------------------------->
  <br>
  <br>
  <span id='inp1'>
    <?php
    $ab=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teamid=$bteam");
    $abr=$ab->fetchAll();

    $tot=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teambat=$bteam and bb=0 and outt=0 and onstrike=1 limit 1;");
    $totast=$tot->fetchAll();
    if($totast)
    {
    echo "onstrike=<span id='onstrike'>". $totast[0]['playeron']. "</span>-".$totast[0]['runs']."-".$totast[0]['balls']."<br>";
    }
    else {

      echo "<i>striker is not selected</i><br>";
    }

    $tot=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teambat=$bteam and bb=0 and outt=0 and onstrike=0 limit 1;");
    $totanst=$tot->fetchAll();
    if($totanst)
    {
    echo "nonstrike=<span id='nonstrike'>". $totanst[0]['playeron']. "</span>-".$totanst[0]['runs']."-".$totanst[0]['balls']."<br>";
    }
    else {
      echo "<i>non striker is not selected</i><br>";
    }
    $tot=$conn->query("select * from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno ".
    " and teambat=$bteam and bb=1 and outt=0 and onstrike=1 limit 1;");
    $tota=$tot->fetchAll();
    $vv1=$conn->query("select * from mbetween where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam");
    $vvr=$vv1->fetch();
    $overs=$vvr['overs'];
  if(($tota))/* only when new bowler is added or selected which is in changebowler*/
  /*bowler is not on onstrike after over completion*/
{
    echo "BOWLER=<span id='attack'>". $tota[0]['playeron']. "</span>-".$tota[0]['runs']."-".$tota[0]['balls']."-".$tota[0]['sixes']."<br>";
}
else {
  echo "<i><span id='attack'>bowler not select</span></i> ";
}


?>

<br><br>
  </span>
<span id='action'>
  <br><input type='button' value='refresh' onclick='updaterun(-1)'><br><br>
  <?php
  if(!($totanst) || !($totast) || !($tota))
  {


  if(!($totanst) || !($totast))
  {/*if striker or nonstriker is out please select new batsman and also choose who is on strike
    in matchplay1 with the help of function and ajax*/
    if($totast)
    {

      echo "<span id='notout'>".$totast[0]['playeron']."</span>";
    }
    elseif($totanst) {
      echo "<span id='notout'>".$totanst[0]['playeron']."</span>";
    }
  //  echo "<span id='notout'>".$notout."</span>";
    echo "select new batsman : <div style='margin-left:40%;margin-right:40%;text-align:center'><select class=\"form-control\" id='newbatsman'>";
    $rr1=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam and ".
  " pid not in (select playeron from scorecard where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$bteam)");
  $rrr1=$rr1->fetchAll();
  foreach ($rrr1 as $key) {
  $tt1=$key['pid'];
  $nr=$conn->query("select * from player where pid=$tt1 and owner=$ownerid limit 1");
  $nrr=$nr->fetch();
echo  "<option value='" . $key['pid']. "'> " . $nrr['pname'] . " ( " . $nrr['favno']. " ) Runs-" . $nrr['runs'];
  }
  echo "</div></select> <br>";
  echo "<input type='checkbox'  id='os' value='1'> is he on strike<br>".
  "<input type='button' onclick='newbatsman()' value='add batsman'><br> ";
}

   if(!($tota))
  {
/*    echo "<script> $(\".select-to-select2\").each(function() {".
    "initializeSelect2($(this));".
    "});</script>";*/

    echo " <div style='margin-left:40%;margin-right:40%;text-align:center'> <select class=\"form-control\" class='jj'   id='newbowler'>";
    $rr1=$conn->query("select * from playing11 where owner=$ownerid and tid=$t and ted=$id and matchno=$mno and teamid=$blteam ");
    $rrr1=$rr1->fetchAll();
    foreach ($rrr1 as $key) {
    $tt1=$key['pid'];
    $nr=$conn->query("select * from player where pid=$tt1 limit 1");
    $nrr=$nr->fetch();
  echo  "<option value='" . $key['pid']. "'> " . $nrr['pname'] . " ( " . $nrr['favno']. " ) Wickets-" . $nrr['wickets'];
  }
  echo "</div></select> <br><input type='button' onclick='newbowler()' value='add bowler'><br>";
}
}
else {

?>
    <input class="btn" type='button' value='0' onclick='updaterun(this.value)'> &nbsp &nbsp
      <input type='button' value='1' onclick='updaterun(this.value)'> &nbsp &nbsp
        <input type='button' value='2' onclick='updaterun(this.value)'> &nbsp &nbsp
          <input type='button' value='3' onclick='updaterun(this.value)'> &nbsp &nbsp
            <input type='button' value='4' onclick='updaterun(this.value)'> &nbsp &nbsp
              <input type='button' value='6' onclick='updaterun(this.value)'> &nbsp &nbsp
                <input type='button' value='wide' onclick='updaterun(this.value)'> &nbsp &nbsp
                  <input type='button' value='wicket' onclick='wicket()'> &nbsp &nbsp<br>
                  <!--input type='button' value='1'-->
</span>

<?php
}
 ?>

      </html>
