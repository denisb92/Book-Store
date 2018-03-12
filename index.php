<?php

	session_start();
	
	$warning = "";
	$attempts = 0;
	$disabled = "false";
	
   $_SESSION['failedAttempts'] =0;
   $warning = "";
   
	$conn = new mysqli('localhost','root','','bookstore');
	//collect info from the form
	if(isset($_POST['Register']))
	{
		 header('location: Register.php');
	}
	
	if(isset($_POST['submit'])){
		$email= $_POST['uname'];
		$password= md5($_POST['psw']);
		
	
	
	  


		
	
	
	//connect to the database
	
	
	//check for connection
	
		if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		
			
			
			
			$sql= "SELECT  User, Password FROM users
			WHERE User='".$email."' AND Password='".$password."'";
			
			$result= $conn->query($sql);
		
			if($result->num_rows > 0){
				
			while($row=$result->fetch_assoc()){
				
			
				// $_SESSION['id']=$row["id"];
				 $_SESSION['User']=$row["User"];
				 
				$_SESSION['name'] = $email;
				
			
				header('location: HomePage.php');
		
				// $_SESSION['login']=$row["true"];
				
				
				
				
				// header('location: HomePage.html');
				
				}
				
			}
			
		 else{
				
			 $attempts = $_SESSION['failedAttempts'];
			 $attempts++;
		 }
			 if($attempts >=5)
			{
				$warning = "You are locked out due to too many incorrect attempts!";
				$attempts = 0;
				$_SESSION['failedAttempts'] = $attempts;
				$disabled = "disabled='disabled'"; 
				
			}
				
				
			
			else{
			
			
			$warning = "Wrong username or password";
			$_SESSION['failedAttempts'] = $attempts;
			}
			
			
		
		
				
				}
		$conn->close();
	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<div class="imgcontainer">
  <link rel="stylesheet" type = "text/css" href="CSS/LoginPageCSS.css"></link>
    <img src="img/raptorimage.png" alt="Avatar"  height = "300" width ="50" class="avatar">
  </div>

    <title>Sign in</title>
	
	<div class="alert">
  <span class="closebtn" id = "alert1" <?php if($warning ==""){echo  'style="display:none;"';}?> onclick="this.parentElement.style.display='none';">&times;</span> 
  <?php echo $warning?><link href="css/alert.css" rel="stylesheet">
</div>


	<?php 
		if(isset($msg)){  // Check if $msg is not empty
        echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
		} 
		?>
   
    


 
  </head>

  <body>
  <div id="navigation">
			<a></a>
		</div>

    <div class="container">

      <form class="form-signin" action="index.php" method="POST">
        <h2 class="form-signin-heading"> Sign In</h2>
       
        <input type="text" name="uname" id="inputEmail" class="form-control" placeholder="Email address" width ="500">
       
        <input type="password" id="inputPassword" name="psw" class="form-control" placeholder="Password">
       
		
        <button class="btn btn-lg btn-primary btn-block"  name="submit" <?php echo $disabled?> type="submit">Sign in</button>
		<button class ="btn btn-lg btn-primary btn-block" name="Register" type="submit">Register</button>
		
      </form>
    </div> <!-- /container -->
	

 

   
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
