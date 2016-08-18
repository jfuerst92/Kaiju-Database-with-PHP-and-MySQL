<h2>Here is  the weight and height of the kaiju you have searched</h2>
<table class="disp">
		<tr>
			<td>Name</td>
			<td>Height in meters</td>
			<td>weight in tons</td>
		</tr>
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//get the details of the requested kaiju
if(!($stmt = $mysqli->prepare("SELECT name, height_in_meters, weight_in_tons FROM gz_kaiju WHERE name = (?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	
}

if(!($stmt->bind_result($name, $height, $weight))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
	
	
while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>";
} 

?>
</table>

<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">Go Back</a> 