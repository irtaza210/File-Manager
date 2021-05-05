<?php
      if(isset($_POST['submits'])) {
		$newuserName = $_POST['newuserName'];
		if( !preg_match('/^[\w_\-]+$/', $newuserName) ){
			echo 
			"<h4>Invalid username. Press Home to return to profile page.</h4>
			<form action='loginpage.php'>
			<input type='submit' name='submit' value='Home'>
			</form>";
		}
      // /home/irtaza330/public_html/$username
      else if(is_dir("/home/irtaza330/userinfo/".$newuserName)) {
          echo "<h4>Username taken. Press back to navigate to login screen.</h4>
          <form action='loginpage.php'>
          <input type='submit' name='submit' value='Back'>
          </form>";
      }else {
          file_put_contents ("/home/irtaza330/userinfo/users.txt", "\n".$newuserName, FILE_APPEND);
          echo  
            "<h4>Account created. Press back to navigate to login screen.</h4>
            <form action='loginpage.php'>
            <input type='submit' name='submit' value='Back'>
            </form>";
      }
      }
      
    ?>