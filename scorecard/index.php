<!DOCTYPE html>
<html lang="en">
<head>
	<title>Scorecard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	  <link href="css/bootstrap.css" rel="stylesheet" media="all">
<!--===============================================================================================-->
</head>
<body>  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../index.php">CRICFLICK</a>
      </div>

    </div>
  </nav>
	<div class="h1">
	<center><b><h1> Scorecard</h1></b></center>
	</div>


	<center><!--div class="h3">
  <h2>Total:</h2>
	</div>
	<br>
	<div class="h4">
  <h2>Target:</h2>
</div--></center>



		<div class="container-table100" style="padding-bottom:0px">
			<div class="wrap-table100"  style="padding-bottom:0px">
			<div class="limiter">
	<div class="h2">
	<center><b>
	<?php
	$servername = "localhost:8889";
	$username = "root";
	$password = "root";
	$tid=$_GET['tid'];
	$mno=$_GET['matchno'];
	$ted=$_GET['ted'];
	$ownerid=1;
	try {
			$conn = new PDO("mysql:host=$servername", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->query("use new3");
$az=$conn->query("select * from mbetween where owner=$ownerid and tid=$tid and ted=$ted and matchno=$mno");
$azr=$az->fetchAll();
foreach ($azr as $kk) {
	$tmb=$kk['teamid'];
	$cc=$conn->query("select * from team where owner=$ownerid and teamid=$tmb");
	$ccr=$cc->fetch();
	if($kk['start1'] == 0)
	{
		$bb=$kk['teamid'];
	echo "<h3>" .$ccr['teamname'] . " - ". $kk['runs']." / ".$kk['wickets']." ( ". (int)floor($kk['overs']/6) . " . ". ($kk['overs'])%6 ." )  </h3><br>";
}
	if($kk['start1']==-1)
	{
		$nbb=$kk['teamid'];
	echo "<h3> ".$ccr['teamname'] . " - <i>yet to bat</i></h3>";
}
}
}
catch(PDOException $e)
		{

		echo  "<br>" . $e->getMessage();
		}
?>
	</h2></b></center>
	</div>
	</div>
					<div class="table" style="padding-top:0px">

						<div class="row header">
							<div class="cell">
								Batsmen
							</div>
							<div class="cell">
								Runs
							</div>
							<div class="cell">
								Balls
							</div>
							<div class="cell">
								4S
							</div>
							<div class="cell" style="padding-right:50px">
								6S
							</div>
						</div>


<?php
$conn = new PDO("mysql:host=$servername", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->query("use new3");
$az=$conn->query("select * from scorecard where owner=$ownerid and tid=$tid and ted=$ted and matchno=$mno  ");
$azr=$az->fetchAll();
foreach ($azr as $kk) {
	echo "<div class=\"row\">";
	$tmb=$kk['playeron'];
	$cc=$conn->query("select * from player where  pid=$tmb");
	$ccr=$cc->fetch();
	if($kk['bb']==0)
	echo "<div class='cell'>" .$ccr['pname'] . "</div><div class='cell'>". $kk['runs']." </div><div class='cell'> ".$kk['balls']." </div><div class='cell'>  ".
	 $kk['fours']." </div><div class='cell'>".$kk['sixes']."</div> </div>";
	/*if($kk['']==-1)
	echo "<h3> ".$ccr['teamname'] . " - <i>yet to bat</i></h3>";*/
}
 ?>
</div>




					</div>
			</div>
		</div>



		<div class="container-table100" style="padding-top:0px">
			<div class="wrap-table100" style="padding-top:0px">
			<div class="limiter">
	<div class="h2">
	<center><b><h2> BOWLING</h2></b></center>

	</div>
</div>
					<div class="table">

						<div class="row header">
							<div class="cell">
								bowler
							</div>
							<div class="cell">
								Runs
							</div>
							<div class="cell">
								over
							</div>
							<div class="cell">
								Wickets
							</div>
							<div class="cell">
								Economy
							</div>
						</div>



						<?php

						$az=$conn->query("select * from scorecard where owner=$ownerid and tid=$tid and ted=$ted and matchno=$mno");
						$azr=$az->fetchAll();
						foreach ($azr as $kk) {

							$tmb=$kk['playeron'];
							$cc=$conn->query("select * from player where  pid=$tmb");
							$ccr=$cc->fetch();
							if($kk['bb']==1 && $kk['balls']!=0){
								echo "<div class=\"row\">";
							echo "<div class='cell'>" .$ccr['pname'] . "</div><div class='cell'>". $kk['runs']. " </div><div class='cell'> " . (int)($kk['balls']/6) . ".". $kk['balls']%6 ."</div><div class='cell'>  ".
							 $kk['sixes'] . " </div><div class='cell'>" . round($kk['runs']/$kk['balls']*6 ,2) . "</div> </div>";
							/*if($kk['']==-1)
							echo "<h3> ".$ccr['teamname'] . " - <i>yet to bat</i></h3>";*/
						}
					}
						 ?>
						</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
