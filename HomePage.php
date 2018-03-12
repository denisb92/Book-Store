<?php
	session_start();
	
	$email = $_SESSION['name'];
	
	
	
	


?>



<form action="action_page.php">
<head>
<link rel="stylesheet" type = "text/css" href="CSS/HomePageCSS.css"></link>
<meta charset="UTF-8">
<title>My Web Page</title>
<link rel="stylesheet" type="text/css" href="css/background&navbar.css"></link>
<div id="navigation">
			<a href ="ShoppingCart.php">Shopping Cart</a>
			
			<a href ="index.php">Logout</a>
			
			
</head>
<body>
 <p  style="background-color:White;"><?php echo "Welcome " , $email; ?> </p>
<h1> Raptors Sci FI Book Store</h1>


<h2>A place to buy used Science fiction books at a cheap and affordable price</h2>
<h3>Choose Your Favorite Author</h3>
<h4 id = "time" ><script src = "js/Test.js"> </script> </h4>

<button  id = "Asimov" type = "button"  > Isaac Asimov </button>

<script type="text/javascript">
    document.getElementById("Asimov").onclick = function () {
        location.href = "AsimovBooks.php";
    };
</script>
<button id = "Martin" type="button" class ="button"> George RR Martin</button>
<script type="text/javascript">
    document.getElementById("Martin").onclick = function () {
        location.href = "MartinBooks.php";
    };
</script>

<p id="demo"></p>
</body>


