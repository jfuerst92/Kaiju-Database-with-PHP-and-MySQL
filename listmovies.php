
<h2>Here are the movies that the searched kaiju has appeared in:</h2>
<table class="disp">
		<tr>
			<td>Name</td>
			<td>Length in Minutes</td>
			<td>Year Released</td>
		</tr>
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//get the movie name, length and release 
if(!($stmt = $mysqli->prepare("SELECT m.name, m.length_in_minutes, m.year_released FROM gz_movies m INNER JOIN gz_kaiju_in_movies km ON km.movid = m.id INNER JOIN gz_kaiju k ON k.id = km.kid WHERE k.name = (?) ORDER BY m.year_released"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	
}
//bind the results to these 3 variables
if(!($stmt->bind_result($name, $length, $year))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
	
	
while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $length . "\n</td>\n<td>\n" . $year . "\n</td>\n</tr>";
} 

?>
</table>
<!-- Allow the user to return to the previous page-->
<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">Go Back</a> 