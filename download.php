<?php
    session_start();
    $filename = (string) $_GET['downloadfile'];
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo 
        "<h4>Invalid filename. Press Home to return to profile page.</h4>
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
        exit;
    }
    $userName = $_SESSION['userName'];
    if( !preg_match('/^[\w_\-]+$/', $userName) ){
        echo 
        "<h4>Invalid username. Press Home to return to profile page.</h4>
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
    }
    $file_path = sprintf("/home/irtaza330/userinfo/%s/%s", $userName, $filename);
    if(!file_exists($file_path)){
        echo 
        "<h4>File not found. Press Home to return to profile page.</h4>
        <form action='homepage.php'>
        <input type='submit' name='submit' value='Home'>
        </form>";
        exit;
    }else{
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        // read the file from disk
        readfile($file_path);
    }
    
    

?>