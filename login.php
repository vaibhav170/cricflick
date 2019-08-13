<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login  </title>
	<script>
function vform()
{
var mnot=/^[6-9]{1}[0-9]{9}$/;
var pcodet=/[a-zA-Z0-9?!@#$%&*]{8,20}$/;


if(!document.myform.luser.value.match(mnot))
{
document.getElementById("error").innerHTML="  *Please Specify Correct Mobile Number";
document.myform.luser.focus();
return false;
}

/*if(!(document.myform.lpass.value.match(pcodet)))
{
document.getElementById("error").innerHTML="  *Please Enter Correct Password";
document.myform.lpass.focus();
return false;
}*/

return true;
}
</script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="shortcut icon" href="favicon.ico">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="css/bootstrap.css">
<!--===============================================================================================-->
</head>



<body>
	<div id="fh5co-wrapper">
	<div id="fh5co-page">
		<header id="fh5co-header-section" class="sticky-banner">




					<nav class="navbar">
						<div class="container-fluid">
								<div class="navbar-header" style="padding-top:15px;">
									<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>

								<span><img src="images/s1.png" style="width: 50px;"></span> <a href="index.html"><span style="font-size:22px">CricFlick</span></a>
								</div>

						<ul  class="nav navbar-nav navbar-right" style="padding-top:15px;">
							<li class="active"><a href="index.html">Home</a></li>
							<li>
								<a href="tour.html" class="fh5co-sub-ddown">Tournaments</a>
							</li>

							<li><a href= "gallery.html">Gallery</a></li>
							<li><a href="AB.HTML">About Us</a></li>
							<li>


						</li>

						</ul>
					</div>
					</nav>


		</header>
</div>
</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="tr/chekk.php" name='myform' onsubmit="return vform();" method="POST">
					<span class="login100-form-title p-b-24">
						Account Login

					</span>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-25">
						<input id="first-name" class="input100" type="text" name="luser" placeholder="Phone Number">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-25">
						<input class="input100" type="password" name="lpass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<div id= 'error' style="color:maroon; font-size:20px; padding-bottom:7px; padding-top:5px; text-align:center; width:100%;">
					<?php
					if(isset($_SESSION['loginerror']))
					{
						echo "<span>" . $_SESSION['loginerror'] . "</span>";
						unset($_SESSION['loginerror']);

					}
					if(isset($_SESSION['signupsucc']))
					{
						echo "<span>". $_SESSION['signupsucc'] . "</span>";
					unset($_SESSION['signupsucc']);

					}
					?>
				</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
						<br>
						</span>

						<br>
								Or
							<a href="signup/newsignup.php" class="txt2">
							 SignUp
						</a>


						</a>
						</a>
					</div>


					<div class="w-full text-center">

					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/t1.jpg');"></div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>


</body>
</html>
