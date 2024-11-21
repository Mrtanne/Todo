<?php

session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] =="POST")
{
    $email= $_POST['email'];
    $password = $_POST['pass'];



    if(!empty($email) && !empty($password))
    {
        $query = "select * from tbltodo where pass ='$password' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data =mysqli_fetch_assoc($result);
                
                if ($user_data['pass'] == $password)
                {
                    header("location:mainpage.php");
                    die;
                }
            }
        }
        echo "<script type='text/javascript'> alert('Wrong username or password!');</script>";

    }
    else{
        echo "<script type='text/javascript'> alert('Please enter valid email and password!');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form" method="POST" >
        <h2>Log in</h2>
        <div id="login-form">

        <div class="input-box">
        <input type="text" name="email" id="email" placeholder="Email" required>
    </div>

        <div class="input-box">
        <input type="text" name="pass" id="pass" placeholder="Password" required>
    </div>

    <div class="login">
     <input type="Submit" onclick="window.location.href='mainpage.php';" value="Submit">
        </div>
        </div>

        <div class="register">
            <h4>Dont have an account? <a href="register.php">Click here to register</a></h4>
        </div>

</div>
</body>

</html>