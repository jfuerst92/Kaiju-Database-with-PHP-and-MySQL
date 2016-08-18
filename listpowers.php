
<h2>Here are the powers that the searched Kaiju has:</h2>
<table class="disp">
		<tr>
			<td><b>Type Of Power</b></td>
			
		</tr>
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//get the powers that each kaiju has through the tables
if(!($stmt = $mysqli->prepare("SELECT p.type_of_power FROM gz_powers p INNER JOIN gz_kaiju_powers kp ON kp.pid = p.id INNER JOIN gz_kaiju k ON k.id = kp.kid WHERE k.name = (?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

//bind the name that the user gives
if(!($stmt->bind_param("s",$_POST['name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	
}

if(!($stmt->bind_result($name))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
	
	//return the values
while ($stmt->fetch()){
	//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
	echo "<tr>\n<td>\n" . $name . "\n</td>\n</tr>";
} 

?>
</table>

<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">Go Back</a> 