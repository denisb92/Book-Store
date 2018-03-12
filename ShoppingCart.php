<?php
session_start();
//Remembers the user that is logged in 
$newTotal = " ";
$newPriceTotal = " ";
$email = $_SESSION['name'];
$LastRemoved = " "; 
//Connects to the database
$conn = new mysqli('localhost','root','','bookstore');

		if($conn->connect_error) {
			
			die("Connection failed: " . $conn->connect_error);
			}
		
			
			
			try{
			
			//Selects  the books in the cart along with the prices for the books from the database for that user 
			
			$sql= "SELECT Cart, Price from users WHERE User ='".$email."' ";
		
			$result= $conn->query($sql);
			if (!$result){
				die('Invalid query: '.mysql_error());
					}
			
			while($row = $result ->fetch_assoc()){
				$total = $row['Cart'];
				$Pricetotal = $row['Price'];
			//Stores all the values in $total and $Pricetotal
			}
			//Splits the $total and $pricetotal into seperate arrays
			$books = explode("-", $total);
			$Prices = explode("-",$Pricetotal);
			//Pops off the blank array element on the back of each array
			array_pop($books);
			array_pop($Prices);
			//Saves the arrays in the SESSION
			$_SESSION['cart'] = $books;
			$_SESSION['price'] = $Prices;
			
			}
			catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}
			//If the remove button is clicked
			if(isset($_POST['remove']))
			{
			
			$item =  $_POST['remove'];
			//Saves the name of the last book removed
			$LastRemoved = $books[$item]; 
			//Removes the book selected from the array 
			unset($books[$item]);
			 
			unset($Prices[$item]);
			//Stores the new book array into a different array
			$books2 = array_values($books);
			//Stores the new prices array into a different array
			$Prices2 = array_values($Prices);
			$arrlength=count($books2);
			
			$_SESSION['cart'] = $books2;
			$_SESSION['price'] = $Prices2;
			
			for ($x = 0; $x < $arrlength; $x++)				
			{
				
					
				//For the length of the arrays, the new arrays are added back into a newtotal which will be updated in the database
				$newTotal = $newTotal . $books2[$x];
				$newPriceTotal = $newPriceTotal . $Prices2[$x];
				$newTotal = $newTotal . "-";
				$newPriceTotal = $newPriceTotal. "-";
				
				
			}
			 
			
			try{
				//Updates the database with the new arrays for books and prices 
				$sql2 = "UPDATE users SET Cart = '".$newTotal."' , Price = '".$newPriceTotal."' WHERE User ='".$email."' ";
				$stmt = $conn->prepare($sql2);
				$stmt->execute();
				$conn->close();
				//Database is closed 
				
			}
			catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}
			}
			
			 


			
			
?>


<form action="ShoppingCart.php" method = "POST">
<head>


<meta charset="UTF-8">
<title>My Web Page</title>
<link rel="stylesheet" type="text/css" href="css/background&navbar.css"></link>
<div id="navigation">
			<a href ="HomePage.php">Home Page</a>
			
			<a href ="index.php">Logout</a>
			  
			</div>
			
 
<link rel="stylesheet" type = "text/css" href="CSS/ShoppingCartCSS.css"></link>
</head>

<h1 style= "margin: 60px; text-align: center"> Shopping Cart </h1>

 <h3  style="background-color:#90EE90;"><?php if($LastRemoved != ' '){ echo  "You Removed " .  $LastRemoved . " From Your Shopping Cart" ;} ?> </h3>
<body>



<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #90EE90;
}
</style>
 
<?php

//Generates a table depending on the size of the arrays; 

$cartBook = $_SESSION['cart'];
$PriceBook = $_SESSION['price'];
$maxcols = sizeof($cartBook);

$item_count = 0;
$finalPrice = 0; 
echo "<form class=\"form-signin\" action=\"ShoppingCart.php\" method=\"POST\">";
echo "<table>";
echo "<tr>";
echo "<th>Book Name</th>";
echo "<th>Price</th>";
echo "<th>Remove From Cart</th>";
echo "</tr>";
echo "<tr>";
 
for ($x = 0; $x < $maxcols; $x++) 
{
	
	$finalPrice += $PriceBook[$x];
    if ($item_count == $maxcols)
    {
        echo "</tr><tr>";
        $item_count = 0;
    }
    echo "<td> $cartBook[$item_count]</td>";
	echo "<td> $$PriceBook[$item_count].00  </td>";
	echo "<td> <Button  style =\"background-color: #FF0000;\" type = \"submit\" name = \"remove\" value = \"$item_count\">Remove	</Button></td>";
	echo "<tr>";
	
    $item_count++;
}

echo "</tr>";
echo "</table>";
echo"</form>";
//var_dump($books);

if(isset($_POST['continue']))
{
	header('Location: HomePage.php');
}
?>
</form>

<form action="ShoppingCart.php" method = "POST">
<h3> <?php echo "Total Price: $" . $finalPrice . ".00"?></h3>
<button style = "margin: 40px; position: relative" id = "continue" type = "submit"  name = "continue"> Continue Shopping </button>




</body>
</form>
