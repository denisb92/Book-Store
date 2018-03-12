<?php
//If the add button is clicked, the database is opened and the users shopping cart is updated with the newest book added
//and the user is brought to the shopping cart 
$email = $_SESSION['name'];
$conn = new mysqli('localhost','root','','bookstore');
		if($conn->connect_error) {
			
			die("Connection failed: " . $conn->connect_error);
			}
		
			
			
			try {
			
			$Bookname = $_REQUEST['add'];
			$SplitBook = explode("$", $Bookname);
			
			$sql= "UPDATE users SET Cart = CONCAT(Cart, '".$SplitBook[0]."-') WHERE User ='".$email."' ";
			
			$stmt = $conn->prepare($sql);
			 $stmt->execute();
			 $sql2 = "UPDATE users SET Price = CONCAT(Price, '".$SplitBook[1]."-') WHERE User ='".$email."' ";
			 $stmt = $conn->prepare($sql2);
			 $stmt->execute();
			 header('Location: ShoppingCart.php');
			
			}
			catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}
			$conn->close();
	?>