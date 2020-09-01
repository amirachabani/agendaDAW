<?php 

 session_start();

extract($_GET);
if(isset($user)){
    ?>
<script type="text/javascript">alert("user and/or mail already exit");</script>
    <?php
}
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["ID"]) ) {
        header("location: index.php");
        exit;
    }

if(isset($_POST['username']) ){    
 include 'includes/functions/functions.php' ;
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $passwordConf = $_POST['cpass']; //email 
      $email = $_POST['email'];
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $passwordConf = stripcslashes($passwordConf); //email 
        $email =stripcslashes( $email);
        if ($password==$passwordConf){
            if(insert($username,$password,$email)){
                header("location: login.php");
            }else{
               
                 header("location: sign up.php?user=1");
            }
            
        }
        
        else{  ?>

<script type="text/javascript">alert("Login failed. Invalid username or password.")</script>
        <?php
            header('location:login.php');
        } 
}else{ 
    ?>



<!DOCTYPE HTML>
<html>
<head>
<title>New user signup </title>
<script language="javascript">
function check()
{


 
 if(document.form1.password.value=="")
  {
    alert("Plese Enter Your Password");
    document.form1.password.focus();
    return false;
  } 
  if(document.form1.cpass.value=="")
  {
    alert("Plese Enter Confirm Password");
    document.form1.cpass.focus();
    return false;
  }
  if(document.form1.password.value!=document.form1.cpass.value)
  {
    alert("Confirm Password does not matched");
    document.form1.cpass.focus();
    return false;
  }
  if(document.form1.username.value=="")
  {
    alert("Plese Enter Your Name");
    document.form1.username.focus();
    return false;
  }
 
  
 
  if(document.form1.email.value=="")
  {
    alert("Plese Enter your Email Address");
    document.form1.email.focus();
    return false;
  }
 
  return true;
  }
  
</script>
<link href="css/style2.css" rel="stylesheet" type="text/css">
</head>

<body>

<div  id = "frm">
<form   name="form1" method="post"  onSubmit="return check();" >


   <label > User Id</label><br>
   <input type="text" id="username" name="username"><br><br>
   <label for=""pwd">Password</label><br>
   <input type="password" id="password" name="password"><br><br>
     
   <label for=""pwd"> Confirm   </label><br>
   <input type="password" id="cpass" name="cpass"><br><br>
      
   
   <label for="uname">Email id</label><br>
   <input type="email" id="email" name="email"><br><br>
    
   <input type="submit" name="submit" value="Signup">
    <p> <a href="login.php"Login here>Already Register</a></p>
                              

</form>
</div>
 
 
</body>
</html>

<?php

}?>