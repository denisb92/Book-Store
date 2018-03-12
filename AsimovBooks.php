<?php
session_start();
//Remembers the user that logged in for this session
$email = $_SESSION['name'];

//Opens the Issac Asimov text file with the information for the books and splits the info into an array to display for the user 
$f = fopen('BookInfos/BookInfoIA.txt', 'r');
$array = file('BookInfos/BookInfoIA.txt');

//When the user clicks the add button the 'AddBook.php' file is opened which handles the add to cart features
if(isset($_POST['add'])){
		include ('AddBook.php');
}

?>
<!doctype html>
<html>
<head>



<meta charset="UTF-8">
<title>My Web Page</title>
<link rel="stylesheet" type="text/css" href="css/background&navbar.css"></link>
<div id="navigation">
			<a href ="ShoppingCart.php">Shopping Cart</a>
			<a href = "HomePage.php"> Home</a>
			<a href ="index.php">Logout</a>
			</div>
<link rel="stylesheet" type = "text/css" href="CSS/AsimovBooksCSS.css"></link>
			
<h1 style= "margin: 40px;"> Isaac Asimov Books</h1>
<form class="form-signin" action="AsimovBooks.php" method="POST">

<table cellspacing = "40">
<tr>
<th><span class = "titles">Book </span></th>
<th><span class = "titles">Description </span></th>
<th><span class = "titles">Price </span></th>
<th><span class = "titles">Buy </span></th>
</tr>
<tr>
<td><img src = "img/cavesofsteelIA.jpg" height ="300" width = "200" ></img></td>
<td> <?php echo $array[0]; ?> </td> 
<td><span class = "prices">$5.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "Caves Of Steel by Issac Asimov$5"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/nakedsunIA.jpg" height = "300" width = "200"></img></td>
<td><?php echo $array[1]; ?>  </td>
<td><span class = "prices">$6.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "The Naked Sun by Issac Asimov$6"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/robotsofdawnIA.jpg" height = "300" width = "200"></img></td>
<td><?php echo $array[2]; ?> </td>
<td><span class = "prices">$7.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "The Robots Of Dawn by Issac Asimov$7"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/robotsandempireIA.png" height = "300" width = "200"></img></td>
<td><?php echo $array[3]; ?> </td>
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "Robots And Empire by Issac Asimov$8"  > Add to cart </button></td>
</tr>
</table>


	
</form>

</head>