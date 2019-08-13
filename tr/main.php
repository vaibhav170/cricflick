<?php
session_start();
$servername = "localhost:8889";
$username = "root";
$password = "root";
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$result = $conn->query($sql);
  }
catch(PDOException $e)
    {
    echo  "<br>" . $e->getMessage();
    }
    if(!$_SESSION['name'])
    {
    $_SESSION['loginerror']="need to sign in first";
    header("location:../login.php");
    }
?>


<html>
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Icons font CSS-->
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">


    <link href="css/bootstrap.css" rel="stylesheet" media="all">



  <script>
  function showted(pr)
  {
    if(pr == 0)
    {
    document.getElementById("tedid").innerHTML="<option value='0'> Select One... </option>";
    document.getElementById("sm").innerHTML="";
    document.getElementById("ds1").innerHTML="";
    document.getElementById("ds").innerHTML="";
    document.getElementById("smatch1").innerHTML="";
    document.getElementById("splayer").innerHTML="";
    document.getElementById("smatch").innerHTML="";
    document.getElementById("matchid").innerHTML ="<option value='0' > Select One... </option>";

    return;
  }
  else {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
        document.getElementById("matchid").innerHTML ="<option value='0' > Select One... </option>";
          document.getElementById("tedid").innerHTML = "<option value='0'> Select One... </option>" +  this.responseText;
          document.getElementById("sm").innerHTML="";
          document.getElementById("ds1").innerHTML="";
          document.getElementById("ds").innerHTML="";
          document.getElementById("smatch1").innerHTML="";
          document.getElementById("splayer").innerHTML="";
          document.getElementById("smatch").innerHTML="";
      }
    };
    tedrequest.open("GET", "getted.php?q=" + pr, true);
    tedrequest.send(null);
  }
  }

  function showmatch(pr)  /*pr for edition no to be selected
                          if not selected then 0*/
  {
    /*
    show match corresponding to selected tournament and Edition

    */
    var xx=document.fname.tour.value; /*selected tournament value if
    selected then tournament id else 0 to xx  */

    if(xx == 0 || pr == 0) /*if tournament or edition number is
                            not selected then ie value is 0 then
                            match will have value 0 and display 'select one'*/
    {
    //  document.getElementById("matchid").innerHTML ="<option value='0' > Select One... </option>";

    document.getElementById("matchid").innerHTML="<option value='0' > select one... ";
    document.getElementById("sm").innerHTML="";
    document.getElementById("ds1").innerHTML="";
    document.getElementById("ds").innerHTML="";
    document.getElementById("smatch1").innerHTML="";
    document.getElementById("splayer").innerHTML="";
    document.getElementById("smatch").innerHTML="";
    return;
  }
  else {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById("matchid").innerHTML ="<option value='0' > Select One </option>" + this.responseText;
          document.getElementById("sm").innerHTML="";
          document.getElementById("ds1").innerHTML="";
          document.getElementById("ds").innerHTML="";
          document.getElementById("smatch1").innerHTML="";
          document.getElementById("smatch").innerHTML="";
          document.getElementById("splayer").innerHTML="";
          document.getElementById("smatch").innerHTML="";
      }
    };
    tedrequest.open("GET", "getmatch.php?q=" + pr + "&p=" + xx, true);
    tedrequest.send(null);
  }
  }


  function mstart()
  {
    var xx=document.fname.tour.value;
    var yy=document.fname.tedn.value;
    var mno=document.getElementById('matchid').value;
  /*  var x1=document.getElementById('toss1').value;
    var x2=document.getElementById('toss2').value;*/

    if(xx!=0 && yy!=0 && mno!=0)
    {
      var tedrequest2= new XMLHttpRequest();
      tedrequest2.onreadystatechange = function()
      {
        if (this.readyState==4 && this.status == 200)
        {
            document.getElementById('sm').innerHTML="<p style='color:green;'> match start successfully </p>" + this.responseText;
        }
      };
      tedrequest2.open("GET", "matchstart.php?q=" + xx + "&p=" + yy + "&mno=" + mno , false);
      tedrequest2.send(null);

      window.location.href="matchplay.php";
    }
    else {
      document.getElementById("sm").innerHTML="";
      document.getElementById("ds1").innerHTML="";
      document.getElementById("ds").innerHTML="";
      document.getElementById("smatch1").innerHTML="";
      document.getElementById("splayer").innerHTML="";
      document.getElementById("smatch").innerHTML="";
    }
  }


  function addp()
  {
    var xx=document.fname.tour.value;
    var yy=document.fname.tedn.value;
    var mno=document.getElementById('matchid').value;
    var x1=document.getElementById('choose1').value;
    var x2=document.getElementById('choose2').value;
  //  var x3=document.getElementById('gg1').name;
  //  var x4=document.getElementById('gg2').name;

  /*  if(x1==0 )
    {
      {
      var tedrequest= new XMLHttpRequest();
      tedrequest.onreadystatechange = function()
      {
        if (this.readyState==4 && this.status == 200)
        {
            x1= this.responseText;
            document.getElementById('ds').innerHTML=this.responseText;
        }
      };
      tedrequest.open("GET", "which1team.php?q=" + xx + "&p=" + yy + "&mno=" + mno, false);
      tedrequest.send(null);
    }
  }
  if(x2==0)
  {
    var tedrequest1= new XMLHttpRequest();
    tedrequest1.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          x2=this.responseText;
          document.getElementById('ds').innerHTML=this.responseText;
      }
    };
    tedrequest1.open("GET", "which2team.php?q=" + xx + "&p=" + yy + "&mno=" + mno, false);
    tedrequest1.send(null);


  }*/

  if(x1==0 || x2==0)
  {
    document.getElementById('ds').innerHTML="<span style='color:maroon;'> <label>* team not selected for match</label></span>";

  }
  else {
    var tedrequest2= new XMLHttpRequest();
    tedrequest2.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById('ds').innerHTML=this.responseText;
      }
    };
    tedrequest2.open("GET", "whichpteam.php?q=" + xx + "&p=" + yy + "&mno=" + mno + "&f=" + x1 + "&s=" + x2, false);
    tedrequest2.send(null);
  }
  }

function ftoss()
{
  var xx=document.fname.tour.value;
  var yy=document.fname.tedn.value;
  var mno=document.getElementById('matchid').value;
  var x1=document.getElementById('choose1').value;
  var x2=document.getElementById('choose2').value;

  if(x1==0 || x2==0)
  {
    document.getElementById('ds').innerHTML="<span style='color:maroon;'><label> * team not selected to toss</label></span>";

  }
  else {

      var tedrequest2= new XMLHttpRequest();
      tedrequest2.onreadystatechange = function()
      {
        if (this.readyState==4 && this.status == 200)
        {
            document.getElementById('smatch1').innerHTML=this.responseText;
        }
      };
      tedrequest2.open("GET", "toss.php?q="+ xx + "&p=" + yy + "&mno=" + mno + "&f=" + x1 + "&s=" + x2, false);
      tedrequest2.send(null);
    }

}
function toss()
{
  var xx=document.fname.tour.value;
  var yy=document.fname.tedn.value;
  var mno=document.getElementById('matchid').value;
  var x1=document.getElementById('toss1').value;
  var x2=document.getElementById('toss2').value;

  if(x1==0 || x2==-1)
  {
    document.getElementById('ds').innerHTML="<span style='color:maroon;'> * team not selected for match to toss</span>";

  }
  else {
    var tedrequest2= new XMLHttpRequest();
    tedrequest2.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById('smatch1').innerHTML="<p style='color:green;'><label> updated successfully </label></p>" + this.responseText +
          "<br><label>want to check toss selection click <buttononclick='ftoss()'> here </button>" +
          "<br><br><input type='button' class=\"btn btn-warning\" value='click to start match' onclick='mstart()'></label>";
      }
    };
    tedrequest2.open("GET", "tossi.php?q=" + xx + "&p=" + yy + "&mno=" + mno + "&f=" + x1 + "&s=" + x2, false);
    tedrequest2.send(null);
  }

}



  function addpteam(pt)
  {
    var xx=document.fname.tour.value;
    var yy=document.fname.tedn.value;
    var c1=0,c2=0;

    if(pt == 0)
    {
  //  document.getElementById("matchid").innerHTML="<option value='0' > select one...";
  document.getElementById("smatch1").innerHTML="";
  document.getElementById("ds").innerHTML="";
  document.getElementById("ds1").innerHTML="";
  document.getElementById("smatch").innerHTML="";
  document.getElementById("sm").innerHTML="";
    return;
  }
  else {

    var tedrequest0= new XMLHttpRequest();
    tedrequest0.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          c1 = this.responseText;

      }
    };
    tedrequest0.open("GET", "which1team.php?q=" + xx + "&p=" + yy + "&mno=" + pt, false);
    tedrequest0.send(null);


    var tedrequest00= new XMLHttpRequest();
    tedrequest00.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          c2 = this.responseText ;

      }
    };
    tedrequest00.open("GET", "which2team.php?q=" + xx + "&p=" + yy + "&mno=" + pt, false);
    tedrequest00.send(null);

    if(c1==0 && c2==0)
    {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
          document.getElementById("smatch").innerHTML ="<br><br><label>add teams for match</label>"+
          "<select class=\"form-control\" name='choose1' id='choose1' > <option value=\"0\" disabled=\"disabled\" selected=\"selected\">Select First Team &nbsp&nbsp</option>" +
          this.responseText +
           "</select>"+

           " <br>    <select class=\"form-control\" name='choose2' id='choose2'> <option value='0'> Select Second Team </option>"+
             this.responseText + "</select><br><input class=\"btn btn-info\" type='button' value='add teams in match' onclick='fff()'><br>" +
            "<br><label>add player for above teams</label>  <br><input class=\"btn btn-info\" type='button' value='click here to add' onclick='addp()'><br><br><label> select toss </label><br> " +
            "<input type='button' class=\"btn btn-info\" value='click to toss' onclick='ftoss()'> "+
            "" ;
            document.getElementById('ds').innerHTML="";
            document.getElementById('ds1').innerHTML="";
            document.getElementById("sm").innerHTML="";
            document.getElementById("smatch1").innerHTML="";


      }
    };

    tedrequest.open("GET", "addmatchteam.php?q=" + xx + "&p=" + yy + "&mno=" + pt + "&c1=" + c1 + "&c2=" + c2, false);
    tedrequest.send(null);
  }

   if (c1>0 && c2>0) {
    var tedrequest22= new XMLHttpRequest();
    tedrequest22.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
        document.getElementById('smatch').innerHTML="" + this.responseText  +
        ""+
"  "+
        "<br><br><label>add player for above teams</label> <br><input type='button' class=\"btn btn-warning\" value='click here to add' onclick='addp()'>" +
         "<br><br> <label>select toss </label><br><input class=\"btn btn-warning\"  type='button' value='click to toss' onclick='ftoss()'>" +
          " </div>";
         document.getElementById('ds').innerHTML="";
         document.getElementById('ds1').innerHTML="";
         document.getElementById("sm").innerHTML="";
         document.getElementById("smatch1").innerHTML="";

  }
};
tedrequest22.open("GET", "addmatchteam.php?q=" + xx + "&p=" + yy + "&mno=" + pt + "&c1=" + c1 + "&c2=" + c2, false);
tedrequest22.send(null);
}
}
}



  function fff()
  {
    var xx=document.fname.tour.value;
    var yy=document.fname.tedn.value;
    var mno=document.getElementById('matchid').value;
    var x1=document.getElementById('choose1').value;
    var x2=document.getElementById('choose2').value;

    //document.getElementById('ds').innerHTML=x1;
    if(x1==0 || x2==0)
    {
    document.getElementById("ds").innerHTML="<span style='color:maroon;'> * select teams properly<span>";
    return;
  }
  else {
    var tedrequest= new XMLHttpRequest();
    tedrequest.onreadystatechange = function()
    {
      if (this.readyState==4 && this.status == 200)
      {
        document.getElementById("smatch").innerHTML="<span style='color:green;'>team selected successfully  <input type='button' value='click' onclick='addpteam(" + mno + ")'> to see it</span>  ";

      }
    };
    tedrequest.open("GET", "insertpteam.php?q=" + xx + "&p=" + yy + "&mno=" + mno + "&f=" + x1 + "&s=" + x2 , true);
    tedrequest.send(null);
  }

  }

  function ff2()
  {
    //evt.preventDefault();

      var mininterest = document.querySelectorAll("[name=playing112]");
      var mininterest1 = document.querySelectorAll("[name=playing111]");

      var count = 0, count1 = 0,
          interests = [],   interests1 = [];

          for (var i = 0; i < mininterest1.length; i++) {

              if (mininterest1[i].checked) {
                  count1++;
                  interests1.push(mininterest1[i].value);
              }
    //document.getElementById('ds1').innerHTML=interests;
          }

      for (var i = 0; i < mininterest.length; i++) {

          if (mininterest[i].checked) {
              count++;
              interests.push(mininterest[i].value);
          }
//document.getElementById('ds1').innerHTML=interests;
      }

      var xx=document.fname.tour.value;
      var yy=document.fname.tedn.value;
      var mno=document.getElementById('matchid').value;
      var x1=document.getElementById('choose1').value;
      var x2=document.getElementById('choose2').value;

    /*  if(x1==0 )
      {
        {
        var tedrequest= new XMLHttpRequest();
        tedrequest.onreadystatechange = function()
        {
          if (this.readyState==4 && this.status == 200)
          {
              x1= this.responseText;
              document.getElementById('ds').innerHTML=this.responseText;
          }
        };
        tedrequest.open("GET", "which1team.php?q=" + xx + "&p=" + yy + "&mno=" + mno, false);
        tedrequest.send(null);
      }
    }*/
  /*  if(x2==0)
    {
      var tedrequest1= new XMLHttpRequest();
      tedrequest1.onreadystatechange = function()
      {
        if (this.readyState==4 && this.status == 200)
        {
            x2=this.responseText;
            document.getElementById('ds').innerHTML=this.responseText;
        }
      };
      tedrequest1.open("GET", "which2team.php?q=" + xx + "&p=" + yy + "&mno=" + mno, false);
      tedrequest1.send(null);


    }*/
    if(count1 || count)
    {
    if(x1==0 || x2==0)
    {
      document.getElementById('ds').innerHTML='select teams properly';

    }
    else {
      var tedrequest2= new XMLHttpRequest();
      tedrequest2.onreadystatechange = function()
      {
        if (this.readyState==4 && this.status == 200)
        {
            document.getElementById('ds').innerHTML= this.responseText;
        }
      };
      tedrequest2.open("GET", "insertp11.php?q=" + xx + "&p=" + yy + "&mno=" + mno + "&f=" + x1 + "&s=" + x2 + "&sa=" + interests + "&fa=" + interests1, false);
      tedrequest2.send(null);
    }
  }
  else {
    document.getElementById('ds1').innerHTML="<p style='color:maroon;' >select at least 1 player</p>";

  }



}



  </script>
  <title>
    main
  </title>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../index.php">CRICFLICK</a>
      </div>
      <ul  class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Select</a></li>
        <li><a href="crteam0.php">insert team</a></li>
        <li><a href="crp.php">insert player </a></li>
        <li><a href="crl0.php">insert location </a></li>
        <?php
        echo "<li><a href='mr/admin.php'><span style='color:pink'>".$_SESSION['name']."</span></a></li>";
         ?>
      </ul>
    </div>
  </nav>

  <br>
  <div class="row row-space" style="width:100%; text-align:center;">
    <h2 style="width:100%;"></h2>
</div>
<br>


  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" name="fname">
<div class="container">
    <div style="width:100%; text-align:center;">
          <div  style="width:100%; padding-left:30%;padding-right:30%;">
      <div class="form-group">
        <label for="sel1">Select Tournament:</label>
                 <select class="form-control" name="tour" onchange="showted(this.value)">
          <option value="0" disabled="disabled" selected="selected">choose tournament &nbsp&nbsp</option>
      <?php
      $ownerid=$_SESSION['owner'];
      $conn->exec("USE new3");

    $getUsers = $conn->prepare("SELECT * FROM tname where owner=$ownerid;");
    $getUsers->execute();
    $users = $getUsers->fetchAll();

   foreach ($users as $user) {
  echo "<option value=\"";
            echo $user['tid'];
            echo "\"";
            echo ">";
echo $user['tname'];
echo "</option>";
        }

   ?>
</select>
<br>
<label for="sel1">or<a href="crt0.php"> create tournament </a></label>





<br>


<br>
    <label for="sel1">choose Edition </label><br>
<select  class="form-control" name="tedn" id="tedid" onchange="showmatch(this.value)">




</select>

<br>
 <label for="sel1">or <a href="cre.php"> create edition </a><br>
  <a href="seteam.php">*add teams for this edition from all entered teams </a></label>

<br>
<br>


<label for="sel1">Select Match Number </label><br>
<select class="form-control" name="mm" id="matchid"  onchange="addpteam(this.value)">
<option value="0" disabled="disabled" selected="selected">choose Match  &nbsp&nbsp</option>
</select>

<label for="sel1">
or <a href="crmatch.php">
  create
  new match
  </a>
<br>
<br>
</label>


  <div id="smatch">

  </div>
  <br>
  <br>
  <span id="smatch1">
  </span>
  <br>
<span id="splayer">
</span>
<span id='ds'>
</span>
<span id='ds1'>
</span>
<span id='sm'>
</span>



</center>
</body>
<script src="vendor/jquery/jquery.min.js"></script>


<!-- Main JS-->
<script src="js/global.js"></script>
     </html>
