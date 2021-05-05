<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>File Manager</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div class = "pagetitle"><h1>FILE MANAGER </h1></div>

<div>
<div class = "username">
        <h2>User: <?php 
         session_start();
         $userName = $_SESSION['userName'];
        echo htmlentities($_SESSION['userName']);
        ?></h2>
</div>
<!-- allow the user to sign out -->
        <form class = "signoutform" action="homepage.php" method = "POST">
        <input class = "signoutbutton" type="submit" name = "signout" value="Sign Out" />
    </form>
    <?php
        if(isset($_POST['signout'])) {
        session_start();
        session_destroy();
        header("Location: loginpage.php");
        exit;
        }
     ?>
        
    </div>
    <br>
    <!-- this was taken from the upload part of https://classes.engineering.wustl.edu/cse330/index.php?title=PHP -->
    <div class = "functions">
    <div class = "uploadsection"> 
   
        <form class = "uploadform" enctype="multipart/form-data" action='upload.php' method ='POST'> 
        <p>
            <input class = "upload2" type='hidden' name='MAX_FILE_SIZE' value='20000000'/>
            <br>
            <label class = "uploadlabel" for='uploadfile_input'><h3 class = "uploadheader"> Upload Files </h3> </label> <input class = "upload1" name='uploadedfile' type='file' id='uploadfile_input' />
        </p>
        <p class = "upload4"><input class = "upload3" type='submit' value="Upload File"/></p>
        <br>
        </form> 
    </div>
    <!-- citation end -->
    <br>
    <div class = "viewsection">
        <br>
    <h3 class = "viewheader">View Files</h3>
<form class = "viewform" action="view.php" method="get">
      <label class = "viewlabel" for = "viewfile">Please enter full file name (e.g. myfile.pdf)</label><br>
      <input type = "text" name = "viewit" id = "viewit"/>
      <input type = "submit" name="viewsubmit" value = "View File"/>
  </form>
  <br>
    </div>
    <br>
    <!-- this was taken from the view part of https://classes.engineering.wustl.edu/cse330/index.php?title=PHP -->
  <?php
   if(isset($_GET['viewsubmit'])) {
    session_start();
    $filename = $_GET['viewit'];
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }
    $userName = $_SESSION['userName'];
    if( !preg_match('/^[\w_\-]+$/', $userName) ){
        echo "Invalid username";
        exit;
    }
    $full_path = sprintf("/home/irtaza330/userinfo/%s/%s", $userName, $filename);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($full_path);
    header("Content-Type: ".$mime);
    readfile($full_path);

   }
    

?>
<!-- citation end -->
<!-- creative feature: allow the user to download files -->
<div class = "downloadsection">
    <br>
<h3 class = "downloadheader">Download Files</h3>
<form class = "downloadform" action="download.php" method="get">
      <label class = "downloadlabel" for = "downloadfile">Please enter full file name (e.g. myfile.pdf) </label><br>
      <input type = "text" name = "downloadfile" id = "downloadfile"/>
      <input type = "submit" name="submit" value = "Download"/>
  </form>
  <br>
</div>
<br>
<div class = "deletesection">
    <br>
<h3 class = "deleteheader">Delete Files</h3>
<form class = "deleteform" action="homepage.php" method="POST">
      <label class = "deletelabel" for = "deletefile">Please enter full file name (e.g. myfile.pdf)</label><br>
      <input type = "text" name = "deletefile"/>
      <input type = "submit" name="deletesubmit" value = "Delete File"/>
</form>
<br>
</div>
</div>
<div class = "listoffiles">
    <h2> Files </h2>
    <?php
    // list all the files in the user's directory
    $listdir = chdir('/home/irtaza330/userinfo/'.$userName.'/');
    foreach (glob("*.*") as $list) {
        echo $list."<br />";
    }
?>
</div>
<!-- php method to delete files -->
<?php
    if(isset($_POST['deletesubmit'])) {
        session_start();
        $deletedfile= $_POST['deletefile'];
        if( !preg_match('/^[\w_\.\-]+$/', $deletedfile) ){
            echo "Invalid filename";
            exit;
        }
        echo $deletedfile;
        $userName = $_SESSION['userName'];
        echo $userName;
            if( !preg_match('/^[\w_\-]+$/', $userName) ){
            echo "Invalid username";
            exit;
        }
        $path = sprintf("/home/irtaza330/userinfo/%s/%s", $userName, $deletedfile);
        
        if (unlink($path)) {
            header("Location: sucdel.php");
        } 
        else {
            header("Location: faildel.php");
        }
                
        
    }

    


   
?>

</div>

</body>
</html>