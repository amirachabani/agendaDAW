<?php 

 session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["ID"]) ) {
        header("location: index.php");
        exit;
    }

if(isset($_POST['user']) ){    
 include 'includes/functions/functions.php' ;
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        
        $Login=login($username,$password);
        
 
        $row = mysqli_fetch_array($Login, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($Login);  
          
        if($count == 1){  
           $_SESSION['ID']=$row['id'];
           $_SESSION['UserName']=$row['username'];
           header('location:index.php');
        }  
        else{  ?>

<script type="text/javascript">alert("Login failed. Invalid username or password.")</script>
        <?php
            header('location:login.php');
        } 
}else{    
?>  

<html>  
<head>  
    <title> login </title>  
   
    <link rel = "stylesheet" type = "text/css" href = "css/style2.css">   
</head>  
<body>  
    <div id = "frm">  
        <h1>Login</h1>  
        <form name="f1"  onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> UserName: </label> <br> 
                <input type = "text" id ="user" name  = "user" />  
            </p>  
            <p>  
                <label> Password: </label><br>  
                <input type = "password" id ="pass" name  = "pass" />  
            </p>  
            <p>     
                <input type =  "submit" id = "btn" value = "Login" />  
            </p>  
        </form> 
        <p> <a href="sign up.php"Login here>didn't Register yet</a></p> 
    </div>  
    
    <script>  
        // validation for empty field   
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html>  
<?php

}?>