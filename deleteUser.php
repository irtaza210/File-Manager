<?php
    if(isset($_POST['submits'])) {
        $deleted_user = $_POST['deleted_user'];
    // /home/irtaza330/public_html/$username
        $dir = sprintf("/home/irtaza330/userinfo/%s",$deleted_user);
        if(is_dir($dir)) {
            //directory deletion algorithm found at https://paulund.co.uk/php-delete-directory-and-files-in-directory
            $open=opendir($dir);
            while($file=readdir($open)){
                if ($file != "." && $file != "..") {
                    if (!is_dir($dir."/".$file)){
                        unlink($dir."/".$file);
                    }else{
                        delete_directory($dir.'/'.$file);
                    }
                }
            }
            closedir($dir);
            rmdir($dir);
            //end of directory deletion algorithm
            $path = "/home/irtaza330/userinfo/users.txt";
            $contents = file_get_contents($path);
            $contents = str_replace($deleted_user, '', $contents);
            file_put_contents($path, $contents);
            echo 
                "Account successfully deleted. Press back to navigate to login screen.
                <form action='loginpage.php'>
                <input type='submit' name='submit' value='Back'>
                </form>";
        }else {
            echo  
                "No account with that name. Press back to navigate to login screen.
                <form action='loginpage.php'>
                <input type='submit' name='submit' value='Back'>
                </form>";
        }
    }
      
?>