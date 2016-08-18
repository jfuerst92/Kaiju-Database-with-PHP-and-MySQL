<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
//insert user input power into powers
if(!($stmt = $mysqli->prepare("INSERT INTO gz_powers (type_of_power) VALUES (?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['type']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	
} else {
	echo "added " . $stmt->affected_rows . " rows to gz_powers.";
	echo '<a href="http://people.oregonstate.edu/~fuerstj/display.php">Find your newly entered data here!</a> ';
	echo '<a href="http://people.oregonstate.edu/~fuerstj/index.php">Add more to the Database!</a> ';
}
?>