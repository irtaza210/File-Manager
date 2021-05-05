<!-- this was taken from the view part of https://classes.engineering.wustl.edu/cse330/index.php?title=PHP -->
<?php
    session_start();
    $filename = (string) $_GET['viewit'];
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo 
        "Invalid filename. Press Home to return to profile page.
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
        exit;
    }
    $userName = $_SESSION['userName'];
    if( !preg_match('/^[\w_\-]+$/', $userName) ){
        echo 
        "Invalid username. Press Home to return to profile page.
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
    }
    $full_path = sprintf("/home/irtaza330/userinfo/%s/%s", $userName, $filename);
    if(!file_exists($full_path)){
        echo 
        "File not found. Press Home to return to profile page.
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
        exit;
    }else{
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($full_path);
        header("Content-Type: ".$mime);
        readfile($full_path);
    }
    

?>