<?php
session_start();
$servername = "localhost:8889";
$username = "root";
$password = "root";
$lname=$_POST['name'];
$lphoneno=$_POST['phoneno'];
$lemail=$_POST['email'];
$lpassword=$_POST['pass'];
$sql = "select * from admin_list where phoneno='$lphoneno' or email='$lemail';";
$sql1 = "insert into admin_list (phoneno,email,name,password) values($lphoneno,'$lemail','$lname','$lpassword');";
try {
  $errorn="";
$errorl="";
$emailErr="";
$merror="";
$perror="";
$derror="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!preg_match("/^[a-zA-Z]+$/",($_POST['$name'])))
    {
        $errorn="  *Enter Correct Data";
    }
    include("location:../signin.php");
  /*  if(!preg_match("/^[a-zA-Z]+$/",($_POST['last'])))
    {
        $errorl="  *Enter Correct Data";
    }

    if (!filter_var(($_POST['femail']), FILTER_VALIDATE_EMAIL) )
    {
          $emailErr = "  *Invalid email format";
    }

    if (!preg_match('/^[6-9]{1}[0-9]{9}$/', $_POST['mno']) )
    {
        $merror="  *Enter correct mobile number";
    }

    if (!preg_match('/^[0-9]{6}$/', $_POST['pcode']))
    {
        $perror="  *Enter Correct Zip Code";
    }

    if (empty($_POST['date']))
    {
        $derror="  *Enter Correct date";
    }*/
}


  if()
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("use new3;");
    $result = $conn->query($sql);
    $count = $result->rowCount();


    if($count == 1)
    {
      $_SESSION['signuperror']="Phone Number or Email Already Present";
      header("location:../signin.php");
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
      echo "fff";
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
