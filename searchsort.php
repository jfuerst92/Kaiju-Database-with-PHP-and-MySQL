
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");

if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Search for specifc data by name</title>
	 <script src='getLoc.js'></script>
  </head>
  <body>
  <h2> Search for data by name</h2>
  <a href="http://people.oregonstate.edu/~fuerstj/display.php">Display list of all kaiju, movies, powers and aliases!</a> <br>
   <a href="http://people.oregonstate.edu/~fuerstj/index.php">Add to the Database!</a> <br>
    <a href="http://people.oregonstate.edu/~fuerstj/dela.php">Delete an alias from the Database!</a> <br>
	<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">search the Database!</a> <br>
	<!--search for kaiju information -->
	<form id = ksearch method="post" action="searchk.php">
		<fieldset>
			<legend>Search by Kaiju name or alias:</legend>
					<label for="name"> Name: </label>
					<input type = "text" name = "name" id = "name"></input>
					<label for="ksearch"> Search by name: </label>
					<input type = "submit" value = "Search Name" id = "ksearch"></input>
					
		</fieldset>
	</form>
	<!--Search for kaiju info from alias -->
	<form id = asearch method="post" action="searcha.php">
		<fieldset>
			<legend>Search by Kaiju name or alias:</legend>
					<label for="alias"> Alias: </label>
					<input type = "text" name = "alias" id = "alias"></input>
					<label for="asearch"> Search by alias: </label>
					<input type = "submit" value = "Search Alias" id = "asearch"></input>
		</fieldset>
	</form>
	<!--get the movies that kaiju is featured in -->
	<form id = msearch method="post" action="listmovies.php">
		<fieldset>
			<legend>Get the movies that a kaiju is featured in:</legend>
					<label for="name"> Kaiju Name: </label>
					<input type = "text" name = "name" id = "name"></input>
					<label for="mget"> Get movies: </label>
					<input type = "submit" value = "Search Name" id = "mget"></input>
					
		</fieldset>
	</form>
	<!--get the powers that kaiju has -->
	<form id = psearch method="post" action="listpowers.php">
		<fieldset>
			<legend>Get the powers that a kaiju has:</legend>
					<label for="name"> Kaiju Name: </label>
					<input type = "text" name = "name" id = "name"></input>
					<label for="mget"> Get powers: </label>
					<input type = "submit" value = "Search Name" id = "mget"></input>
					
		</fieldset>
	</form>