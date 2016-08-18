<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","fuerstj-db","Gc9u3SDEXo8644ho","fuerstj-db");
if(!$mysqli || $msqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(!($stmt = $mysqli->prepare("DELETE FROM gz_aliases WHERE id = (?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['aid']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	
} else {
	echo "Deleted " . $stmt->affected_rows . " rows to gz_aliases.";
	echo '<a href="http://people.oregonstate.edu/~fuerstj/display.php">Find your newly entered data here!</a> ';
	echo '<a href="http://people.oregonstate.edu/~fuerstj/index.php">Add more to the Database!</a> ';
}
?>