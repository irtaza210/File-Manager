<!DOCTYPE html>

<html>
<head>

        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    
    <h1>File Manager</h1>    
    <!-- this is the part where we ask users to log in -->
    <form class = "loginform" action="loginpage.php" method="POST">
        <br>
    <h3 class = "loginheader">Enter your username to log in: </h3>
    <input type="text" name="userName"><br>
    <input type="submit" name="submit" value="Log In"><br>
    </form>
    <br>
<!-- this is the part where we ask users to sign up -->
    <form class = "signupform" action="signup.php" method="POST">
        <br>
    <h3 class = "signupheader">Enter your username to sign up: </h3>
    <input type="text" name="newuserName"><br>
    <input type="submit" name="submits" value="Sign Up"><br>
    </form>
    <br>
<!-- this is the creative feature part where we ask users to delete their account if they want -->
    <form class = "deleteuserform" action="deleteUser.php" method="POST">
        <br>
    <h3 class = "deleteuserheader">Enter your username to delete your account: </h3>
    <input type="text" name="deleted_user"><br>
    <input type="submit" name="submits" value="Delete Account"><br>
    <br>

</body>
</html>
<?php 
// this is php code to check if the username entered exists in users.txt if it does user is directed
// to home page if not they are told to try again
    if(isset($_POST['submit'])) {
        $userName = $_POST['userName'];
        
        $userFile = fopen("/home/irtaza330/userinfo/users.txt","r");
        while(!feof($userFile)) {
            $name = trim(fgets($userFile));
                if(strcmp($userName, $name) == 0) {
                    if ($userName == "") {
                        header("Location: invaliduser.php");
                        exit;
                    }
                    session_start();
                    $_SESSION['userName'] = $userName;
                    mkdir("/home/irtaza330/userinfo/$userName", 0777);
                    header("Location: homepage.php");
                    exit();
                } 
                else {
                    header("Location: invaliduser.php");
                }   
        }
         
    }
    // the above code has been modified to the code below to now allow users to sign up, this is part of our creative feature
    if(isset($_POST['submits'])) {
        $newusername= $_POST['newuserName'];
        $userFile = fopen("/home/irtaza330/userinfo/users.txt","r");
        while(!feof($userFile)) {
            $name = trim(fgets($userFile));
            if($newusername != $name || (strcmp($newusername, $name) != 0)) {
                if ($new_user == "") {
                    echo "error";
                    exit;
                }
                if(is_dir("/home/irtaza330/userinfo/".$newusername)) {
                    header("Location: usernametaken.php");
                    exit;
                }
                file_put_contents ("/home/irtaza330/userinfo/users.txt", "\n".$newusername, FILE_APPEND);
                session_start();
                $_SESSION['userName'] = $nnewusername;
                mkdir("/home/irtaza330/userinfo/$newusername", 0777);
                header("Location: homepage.php");
                exit();
            }
            else {
                header("Location: invaliduser.php");
            }
        }

    }
    ?>