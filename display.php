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
    <title>Kaiju Database</title>
  </head>
  <body>

  
   <a href="http://people.oregonstate.edu/~fuerstj/display.php">Display list of all kaiju, movies, powers and aliases!</a> <br>
   <a href="http://people.oregonstate.edu/~fuerstj/index.php">Add to the Database!</a> <br>
    <a href="http://people.oregonstate.edu/~fuerstj/dela.php">Delete an alias from the Database!</a> <br>
	<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">search the Database!</a> <br>
	<h1>List of Kaiju</h1>
  <table class="disp">
		<tr>
			<td>Name</td>
			<td>Height in meters</td>
			<td>weight in tons</td>
		</tr>
	<!--display kaiju rows dynamically -->
<?php
if(!($stmt = $mysqli->prepare("SELECT name, height_in_meters, weight_in_tons FROM gz_kaiju WHERE 1"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->execute())){
	echo "execute failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_result($name, $height, $weight))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>";
}
$stmt->close();

?>	
</table>	

<!--display movie rows dynamically -->
<h1>List of Movies</h1>
<table class="disp">
		<tr>
			<td>Name</td>
			<td>length</td>
			<td>Year Released</td>
		</tr>
			
<?php
if(!($stmt = $mysqli->prepare("SELECT name, length_in_minutes, year_released FROM gz_movies WHERE 1"))){
	echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->execute())){
	echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->bind_result($name, $length, $year))){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $length . "\n</td>\n<td>\n" . $year . "\n</td>\n</tr>";
}
$stmt->close();

?>
</table>

<!--display powers rows dynamically -->
<h1>List of Power Types</h1>
<table class="disp">
		<tr>
			<td>Type</td>
			
		</tr>
			
<?php
if(!($stmt = $mysqli->prepare("SELECT type_of_power FROM gz_powers WHERE 1"))){
	echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->execute())){
	echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->bind_result($type))){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $type . "\n</td>\n</tr>";
}
$stmt->close();

?>
</table>

<!--display alias rows dynamically -->
<h1>List of Aliases</h1>
<table class="disp">
		<tr>
			<td>Type</td>
			
		</tr>
			
<?php
if(!($stmt = $mysqli->prepare("SELECT name FROM gz_aliases WHERE 1"))){
	echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->execute())){
	echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt->bind_result($name))){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n</tr>";
}
$stmt->close();

?>
</table>

  </body>
  </html>