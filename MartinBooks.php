<?php
session_start();
//Remembers the user that logged in for this session
$email = $_SESSION['name'];

//Opens the George RR Martin text file with the information for the books and splits the info into an array to display for the user 
$f = fopen('BookInfos/BookInfoGM.txt', 'r');
$array = file('BookInfos/BookInfoGM.txt');



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
			
<h1 style= "margin: 40px;"> George RR Martin Books</h1>
<form class="form-signin" action="MartinBooks.php" method="POST">

<table cellspacing = "40">
<tr>
<th><span class = "titles">Book </span></th>
<th><span class = "titles">Description </span></th>
<th><span class = "titles">Price </span></th>
<th><span class = "titles">Buy </span></th>
</tr>
<tr>
<td><img src = "img/GoT1GM.jpg" height ="300" width = "200" ></img></td>
<td><?php echo $array[0]; ?> </td> 
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "Game Of Thrones by George RR Martin$8"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/Got2GM.jpg" height = "300" width = "200"></img></td>
<td><?php echo $array[1]; ?> </td>
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "A Clash Of Kings by George RR Martin$8"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/Got3GM.jpg" height = "300" width = "200"></img></td>
<td><?php echo $array[2]; ?></td>
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "A Storm Of Swords by George RR Martin$8"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/Got4GM.jpg" height = "300" width = "200"></img></td>
<td><?php echo $array[3]; ?> </td>
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "A Feast For Crows by George RR Martin$8"  > Add to cart </button></td>
</tr>
<tr>
<td><img src = "img/Got5GM.jpg" height = "300" width = "200"></img></td>
<td> <?php echo $array[4]; ?></td>
<td><span class = "prices">$8.00 </span></td>
<td><button id= "add" type = "submit" name = "add" value = "A Dance With Dragons by George RR Martin$8"  > Add to cart </button></td>
</tr>
</table>


	
</form>

</head>