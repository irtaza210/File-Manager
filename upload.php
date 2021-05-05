
<div>
    <!-- Form for submitting a chosen file to be uploaded to the server -->
        <form enctype="multipart/form-data" action='upload.php' method ='POST'> <!-- The following form was used from https://classes.engineering.wustl.edu/cse330/index.php?title=PHP -->
        <p>
            <input type='hidden' name='MAX_FILE_SIZE' value='20000000'/>
            <label for='uploadfile_input'>Choose a file to upload:</label> <input name='uploadedfile' type='file' id='uploadfile_input' />
        </p>
        <p><input type='submit' value="Upload File"/></p>
        </form> <!-- end citation -->
    </div>
<?php
//this code is all from https://classes.engineering.wustl.edu/cse330/index.php?title=PHP
session_start();
if(isset($_FILES['uploadedfile']['name'])){
    //Get filename and ensure it's valid
    $filename = (string)basename($_FILES['uploadedfile']['name']);
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo "Invalid filename<br><br>";
        echo "<a href='found.php'><button>Back to home</button></a>";
        exit;
    }

    // Get the username and make sure it is valid
    $username = (string)$_SESSION['userName'];
    if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo "Invalid username";
        exit;
    }

    $full_path = sprintf("/home/irtaza330/public_html/%s/%s", $username, $filename);
    // $full_path = '/home/irtaza330/public_html/gary/haha2.png';
    

    //Moves the file and redirects to the respective page depending on how the upload went
    if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
        header("found.php");
        exit;
    }else{
        header("Location: phpinfo.php");
        exit;
    }
} else {
    header("Location: phpdemo.php");
}
?>