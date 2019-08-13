
<!DOCTYPE html>

<?php
session_start();
if(isset($_GET['id']))
$id=$_GET['id'];
else {
  $id=0;
}

$servername = "localhost:8889";
$username = "root";
$password = "root";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
?>


 <html>
	<head>
	<meta charset="utf-8">


	<title>CricFlick</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css?family=Mali|Roboto+Condensed" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css ">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">



<script>
function livescore()
{
  var id=document.getElementById('adminid').getAttribute('data-id');
  var tedrequest2= new XMLHttpRequest();
  tedrequest2.onreadystatechange = function()
  {
    if (this.readyState==4 && this.status == 200)
    {
        document.getElementById('livescore').innerHTML= this.responseText ;
    }
  };
  tedrequest2.open("GET", "tr/mr/livescore.php?id="+id, true);
  tedrequest2.send(null);

}

</script>
	</head>
	<body>

		<div >
		<div >

		<header id="fh5co-header-section" class="sticky-banner">




					<nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header" style="padding-top:15px;">
                  <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>

                <span><img src="images/s1.png" style="width: 50px;"></span> <a href="index.html"><span style="font-size:22px">CricFlick</span></a>
                </div>

						<ul  class="nav navbar-nav navbar-right" style="padding-top:15px;">
							
							<li>
								<a href="tour.html" class="fh5co-sub-ddown"><b>START MATCH</b></a>
              </li>

							<li><a href= "gallery.html">Gallery</a></li>
							<li><a href="AB.HTML">About Us</a></li>
              <li>
              <?php
              echo "<span id='adminid' data-id=\"$id\"></span>";
              if( isset($_SESSION['name']) ){
                echo "<a href='tr/logout.php' style=\"color:maroon; text-transform: uppercase;\">".$_SESSION['name']." (Logout)</a>";
              }/*display user name*/
              else {
                echo 	"<a href='login.php'>Login</a>";
              } ?>

            </li>

						</ul>
          </div>
					</nav>


		</header>

		<!-- end:header-top -->
<div class="scroll-animations">
		<div class="fh5co-hero">

			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.9" style="">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">

								  <!-- Nav tabs -->
                  <div class="animated">
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" >
								      	<a>Live Score</a>
								      </li>

								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<span id='livescore' style='width:100%;'>

                            <script>
                            livescore();
                            setInterval(livescore,7000);
                          </script>
                           </span>


                      	<!--div class="tab-content">
                      	<div class="col-xxs-12 col-xs-6 mt"  >
                  		<div class="input-field">


                        <div class="col-xxs-12 col-xs-6 mt  ">
                         <div class="input-field">
											</div></div></div>		</div>
                    </div-->
  											</div>
                      </div>
                    </div>


										<!--div class="a">

											<div class="rca-ball-by" align="center">
											<li class="b6">6</li>
											<li class="b">1wd</li>
											<li class="w">w</li>
											<li class="b">1</li>
											<li class="b">2</li>
											<li class="b4">4</li>

											<div>
											</div>
											<div class="col-xs-12">
											<div class="rca-ball-by">

											</div>
											</div>
											<div class="col-xs-12">
												<input type="button" class="btn btn-primary btn-block" value="All Live Matches">
											</div>
										</div>
                  </div-->
									 <div class="col-xs-12"><div class="col-xs-12"><div class="col-xs-12"></div></div></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div><div class="col-xs-12"></div>
                                     </div>
									 <div role="tabpanel" class="tab-pane" id="hotels">
									 	<div class="row">

											<div class="col-xxs-12 col-xs-6 mt alternate">
											<b>IND  vs   AUS<br></b>
											<p></p>
											AUS 210-5(20.0)<br>
											<p></p>
											IND 211-8(19.5)<br>
											<p></p>
											<a>IND won by 2 wickets!!!</a>
											</div>

											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" value="Full Scorecard">
											</div>
										</div>
									 </div>
									</div>

								</div>
							</div>
            </div>
							<div class="tab-content">
											<div class="col-xxs-12 col-xs-6 mt" >

									<h2>All About <b>Cricket</b></h2><br>
									<h3 style="font-family: 'Mali', cursive;">Create Your Tournaments and Matches <br>
                    Bring your matches to the world with the CRICFLICK Live Score service.

Your club, school or Local Matches can have their match data available on the CRICFLICK website.</h3>

									<!-- <p><a class="btn btn-primary btn-lg" href="#">Get Started</a></p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<br><br>
		</div>
  </div>

		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box" style="padding-bottom:0px">
						<h3>All About Indian Cricket</h3>

					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src=" images/a1.jpg"   alt="Free HTML5 Website Template by FreeHTML5.co" width="400" height="300" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Indian Cricket Team</h3>
								<span>Player Info</span>

								<a class="btn btn-primary btn-outline" href="#">See Here <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/a2.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" width="400" height="300" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Womens Cricket Team</h3>
								<span>Player Info</span>

								<a class="btn btn-primary btn-outline" href="#">See Here <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/a3.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" width="400" height="300" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Upcoming Series </h3>
								<span>Series Info</span>

								<a class="btn btn-primary btn-outline" href="#">See Here <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center animate-box">
						<p><a class="btn btn-primary btn-outline btn-lg" href="#">Indian Cricket History <i class="icon-arrow-right22"></i></a></p>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-destination">
			<div class="tour-fluid">
				<div class="row">
					<div class="col-md-12">
						<ul id="fh5co-destination-list" class="animate-box">
							<li class="one-forth text-center" style="background-image: url(images/w1.jpg); ">
								<a href="1983.html">
									<div class="case-studies-summary">
										<h2>1983 Worldcup</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w11.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>The fall of Azaruddin</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w12.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2> India in its first ever One Day International (ODI) </h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w4.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Six unforgettable Tests for India on English soil</h2>
									</div>
								</a>
							</li>

							<li class="one-forth text-center" style="background-image: url(images/w5.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Indian Cricket: Corruption Runs Deep</h2>
									</div>
								</a>
							</li>
							<li class="one-half text-center" >
								<div class="title-bg">
									<div class="case-studies-summary" >
										<h2>Indian Cricket History</h2>
										<span><a href="#">View All  </a></span>
									</div>
								</div>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w6.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Biggest match-winning batsmen in Indian Test cricket history</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w8.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Champions trophy</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w10.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>The Wall</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w3.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>2011 Worldcup</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(images/w2.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>2007 World Cup</h2>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-blog-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Recent News</h3>
						 <img src="images/s1.png" height="55" width="55">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="a0.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">India vs England: Skipper Joe Root Announces Unchanged Team For The Final Test</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>England skipper Joe Root on Thursday evening announced the playing XI for the fifth and final Test against India beginning September 7 at the Oval in London. </p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="a1.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">India vs England: Shikhar Dhawan Shuts Down Trolls Who Criticised Team India</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>India's opening batsman Shikhar Dhawan on Thursday gave a perfect riposte to team India critics. Several fans were up in arms in criticising the Indian cricket team after Shikhar Dhawan had posted a photo on his official Instagram account</p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="a2.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">India vs England: Virat Kohli's Team India Knows How To Learn From Mistakes, Says Ravi Shastri</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>Team India head coach Ravi Shastri on Wednesday expressed his disappointment after his team conceded a 3-1 lead to England in the ongoing five-match series, losing the Southampton Test by 60 runs. Speaking at a press conference ahead of the fifth and final Test starting in London on Friday, </p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix visible-md-block"></div>
				</div>

				<div class="col-md-12 text-center animate-box">
					<p><a class="btn btn-primary btn-outline btn-lg" href="#">See All Post <i class="icon-arrow-right22"></i></a></p>
				</div>

			</div>
		</div>
		<!-- fh5co-blog-section -->
		<div id="fh5co-testimonial" style="background-image:url(images/img_bg_1.jpg);">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2> Cricket Thoughts</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p> &rdquo;&rdquo;To me, it doesn't matter how good you are. Sport is all about playing and competing. Whatever you do in cricket and in sport, enjoy it, be positive and try to win.
  </p>
						</blockquote>
						<p class="author">Ian Botham, england <a href="http://freehtml5.co/" target="_blank">1989-1998</a> <span class="subtext">batsmen</span></p>
					</div>

				</div>
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p>&ldquo;I hate losing and cricket being my first love, once I enter the ground it's a different zone altogether and that hunger for winning is always there.
&rdquo;</p>
						</blockquote>
						<p class="author">Sachin Tendulkar,India <a href="http://freehtml5.co/" target="_blank">1989-2013</a> <span class="subtext">batsmen</span></p>
					</div>


				</div>
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p>&ldquo;I don't study cricket too much. Whatever I have learned or experienced is through cricket I've played on the field, and whatever little I have watched.
&rdquo;</p>
						</blockquote>
						<p class="author">MS Dhoni,India <a href="#">2004-present</a> <span class="subtext">c</span></p>
					</div>

				</div>
			</div>
		</div>
	</div>
		<footer>
			<div id="footer">
				<div class="container">
					<div class="row row-bottom-padded-md">
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							 </div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">


						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">


						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">

						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">

						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">

							<ul>

							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">

							<p>Copyright 2018 CricFlick. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a  target="_blank">crickFlick</a> / Demo Images: <a target="_blank">Project dbms</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>



	</div>


	</div>

	<script src="js/jquery.min.js"></script>

	<script src="js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	</body>
</html>
