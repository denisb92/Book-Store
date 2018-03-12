<?php
  session_start();
  
  
	
	if(isset($_POST['submit'])) {
		$name = $_POST['email'];
		
		$passwordLen = ($_POST['psw']);
		$password = md5($_POST['psw']);
		
		$confirmPassword = md5($_POST['psw-repeat']);
	

		// Create a database connection
		$conn = new mysqli('localhost','root','','bookstore');
		// Check for that connection
		if($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		
		
		//Insert new user
		$sql="INSERT INTO users (User, Password)
		VALUES('$name', '$password')";
			
		//Check if user exists
		$sql_user = "SELECT User FROM users WHERE User='$name'"; 
		$result = $conn->query($sql_user);
	
		if(strlen($passwordLen) < 8){
				echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">\n"; 
				echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n"; 
				echo "  <strong>Error: </strong> Password must be atleast 8 characters\n"; 
				echo "</div>\n";
		}elseif((!$containsLetter  = preg_match('/[a-zA-Z]/', $passwordLen)) || (!$containsDigit   = preg_match('/\d/', $passwordLen)) || (!$containsSpecial = preg_match('/[^a-zA-Z\d]/', $passwordLen))){
			echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">\n"; 
				echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n"; 
				echo "  <strong>Error: </strong> Password must contain atleast one uppercase letter, lowercase letter, number and special symbol \n"; 
				echo "</div>\n";
		}else{
		//creates new user if username is unique and passwords match
			if ($result->num_rows < 1) {
		// check if login is valid
			
				if($password == $confirmPassword) 
					{		
					if($conn->query($sql)==TRUE){
							echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">\n"; 
							echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n"; 
							echo "  <strong>Congratulations!</strong> New Record Successfully Created.\n"; 
							echo "</div>\n";
						    header('location: index.php');
					}
				
				
						else{echo "Error: " . $sql ."<br>". $conn->error;}}			
						else{
							echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">\n"; 
							echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n"; 
							echo "  <strong>Error: </strong> Passwords Don't Match.\n"; 
							echo "</div>\n";}
						}else{
							echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">\n"; 
							echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n"; 
							echo "  <strong>Error: </strong> User Name Already Exists.\n"; 
							echo "</div>\n";}
						
			}
	}
	
?>




<!DOCTYPE html>
<html lang="en">
<form  class = "form-register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="post" style="border:1px solid #ccc">


  <div class="container">
   <link rel="stylesheet" type = "text/css" href="CSS/RegisterCSS.css"></link>
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input id = "Email" type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input  id = "Pass" type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input  id= "PassConfirm" type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button id="cancel" name = "cancel" type="button" class="cancelbtn">Cancel</button>
	  <script type = "text/javascript">
	document.getElementById("cancel").onclick = function () {
        location.href = "index.php";
    };
	</script>
	 
	  <button id = "Register" name = "submit" type="submit" class="signupbtn">Sign Up</button>
	  
     
	  
	
	
    

	  

    </div>
  </div>
   
</form>
</html>