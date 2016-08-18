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
  <h1>Delete an Alias From the Database</h1>
  
  <form id = kaiju_alias_delete method="post" action="delete.php">
		<fieldset>
			<legend>Delete an existing alias:</legend>
				<label for="kAlias">Power: </label>
					 <select name="aid">
					  <?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_aliases WHERE 1"))){
								echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->execute())){
								echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->bind_result($aid, $name))){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							//print an option with the relevant info
							while ($stmt->fetch()){
								//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
								echo '<option value="'. $aid . '"> ' . $name . '</option>\n';
							}
							$stmt->close();

						?>	
					</select> 
					<!-- button to send delete request-->
					<label for="kpAdd"> Delete it: </label>
					<input type = "submit" value = "Delete" id = "kpdel"></input>
		</fieldset>
	</form>