<!DOCTYPE html>
<?php
session_start();
$errorn="";

$emailErr="";
$merror="";
$pswerr="0";
$psw1err="";



$done=-1;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $done=1;
    if(!preg_match("/^[a-zA-Z\s]{3,30}$/",($_POST['fname'])))
    {
        $errorn="*Enter Correct First Name";
        $done=0;
    }


    if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL) )
    {
          $emailErr = "*Invalid Email Format";
          $done=0;
    }

    if (!preg_match('/^[6-9]{1}[0-9]{9}$/', $_POST['mno']) )
    {
        $merror="*Enter Valid mobile number";
        $done=0;
    }

    if (!preg_match('/^[a-zA-Z0-9?!@#$%&*]{8,20}$/', $_POST['psw']))
    {
      $done=0;
        $pswerr="*Password Must Be 8 character long";
    }
    if($_POST['psw']!==$_POST['psw1'])
    {
      $done=0;
      $psw1err="*Password do not Match";
    }

    if($done==1)
    {
      $servername = "localhost:8889";
      $username = "root";
      $password = "root";
      $lname=$_POST['fname'];
      $lphoneno=$_POST['mno'];
      $lemail=$_POST['email'];
      $lpassword=$_POST['psw'];
      $sql = "select * from admin_list where phoneno='$lphoneno' or email='$lemail';";
      $sql1 = "insert into admin_list (phoneno,email,name,password) values($lphoneno,'$lemail','$lname','$lpassword');";
        try{
          $conn = new PDO("mysql:host=$servername", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->query("use new3;");
          $result = $conn->query($sql);
          $count = $result->rowCount();


          if($count == 1)
          {
            $_SESSION['signuperror']="* Phone Number or Email Already Present";
          }
          else
          {
            $result = $conn->query($sql1);
              $_SESSION['signupsucc']="signup successful now login";
              header("location:../login.php");
          }

}
      catch(PDOException $e)
          {

          echo   "<br>" . $e->getMessage();
          }

      $conn = null;
    }


}
?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Registration Form</title>

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
</head>

<body style="background-color:#d5dae2;">
    <div class="page-wrapper bg- p-t-100 p-b-100 font-robo" >
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align:center;">Registration Form</h2>
                    <div style="width:100%;text-align:center;">
                    <span style="text-align:center;color:maroon;"><?php if($done == 1)
                    {
                      if($_SESSION['signuperror'])
                      {
                        echo $_SESSION['signuperror'];
                        unset($_SESSION['signuperror']);
                    }
                  }
                  
                    ?>
                    <br><br>
                  </span>
                </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name='myform'>
                    <div class="row row-space" >



                          <div class="input-group" style="width:70%;">
                              <span id='fnameerror' style='color:maroon;'><?php echo $errorn; ?></span>


                            <input class="input--style-1" type="text" placeholder="ENTER YOUR NAME" name="fname">

                        </div>





                    </div>
                    <div class="row row-space">

                    <div class="input-group" style="width:50%;">
                      <span style='color:maroon;'><?php echo $merror; ?></span>
                        <input class="input--style-1" type="text" placeholder="PHONE NUMBER" name="mno">
                      </div>

                    </div>
                      <span style='color:maroon;'><?php echo $emailErr; ?></span>
                    <div class="input-group">

                        <input class="input--style-1" type="text" placeholder="EMAIL ADDRESS" name="email">
                    </div>
                    <?php /*
                        <!--div class="row row-space">
                            <div class="col-2">
                              <span style='color:maroon;'><?php echo $dateerr; ?></span>
                                <div class="input-group">

                                    <input class="input--style-1 js-datepicker" type="text" placeholder="BIRTHDATE" name="date">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <span style='color:maroon;'><?php if($dateerr!='') echo "<br>"; ?></span>
                                <div class="input-group">

                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="Gender">

                                            <option value='male' selected="selected">Male</option>
                                            <option value='female'>Female</option>
                                            <option value='other'>Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div-->
                        */?>


                                <div class="input-group">
                                  <?php
                                  if($pswerr === '0')
                                  {
                                    echo "<span style='color:green;'>".
                                    "*Password Must be 8 Character Long</span>";
                                  }
                                  else {
                                    echo "<span style='color:maroon;'>";
                                  echo $pswerr."</span>";
                                }
                                ?>
                                    <input class="input--style-1" type="password" placeholder="PASSWORD" name="psw">
                                  </div>

                                <div class="input-group">
                                  <span style='color:maroon;'><?php echo $psw1err; ?></span>
                                    <input class="input--style-1" type="password" placeholder="CONFIRM PASSWORD" name="psw1">

                        </div>
                        <div class="p-t-20" style="text-align:center;">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button><br>
                        </div>
                        <div class="p-t-20" style="text-align:center;">
                          or
                          <br>
                          <br>
                            <a href="../login.php">> Login</a>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                              <a href="../index.php">
                            > Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
