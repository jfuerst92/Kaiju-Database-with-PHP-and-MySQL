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
	 <script src='getLoc.js'></script>
  </head>
  <body>
  <h2> Add to the Kaiju Database</h2>
  <a href="http://people.oregonstate.edu/~fuerstj/display.php">Display list of all kaiju, movies, powers and aliases!</a> <br>
   <a href="http://people.oregonstate.edu/~fuerstj/index.php">Add to the Database!</a> <br>
    <a href="http://people.oregonstate.edu/~fuerstj/dela.php">Delete an alias from the Database!</a> <br>
	<a href="http://people.oregonstate.edu/~fuerstj/searchsort.php">search the Database!</a> <br>
  <!--add kaiju information -->
	<form id = kaiju_add method="post" action="addkaiju.php">
		<fieldset>
			<legend>Add a Kaiju:</legend>
					<label for="name"> Name: </label>
					<input type = "text" name = "name" id = "name"></input>
					<label for="height"> Height in Meters: </label>
					<input type = "number" name = "height" id = "height"></input>
					<label for="weight"> Weight in Tons: </label>
					<input type = "text" name = "weight" id = "weight"></input>
					<label for="kAdd"> Add Kaiju: </label>
					<input type = "submit" value = "Add" id = "kAdd"></input>
		</fieldset>
	</form>
	 <!--add movie information -->
	<form id = movie_add method="post" action="addmovie.php">
		<fieldset>
			<legend>Add a Movie:</legend>
					<label for="mName"> Name: </label>
					<input type = "text" name = "name" id = "mName"></input>
					<label for="length"> Length in Minutes: </label>
					<input type = "number" name = "length" id = "length"></input>
					<label for="year"> Year Released: </label>
					<input type = "text" name = "year" id = "year"></input>
					<label for="mAdd"> AddMovie: </label>
					<input type = "submit" value = "Add" id = "mAdd"></input>
		</fieldset>
	</form>
	 <!--add kaiju-movie relationship -->
	<form id = kaiju_movie_add method="post" action="addkm.php">
		<fieldset>
			<legend>Add an existing Kaiju to an existing movie:</legend>
					<label for="kselect"> Kaiju: </label>
					 <select name="kselect">
					  <!--dynamically generate drop down list from database content -->
					  <?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_kaiju WHERE 1"))){
							echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->execute())){
							echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($kid, $name))){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
							echo '<option value="'. $kid . '"> ' . $name . '</option>\n';
						}
						$stmt->close();

						?>	
					  
					</select> 
					
					<label for="mselect"> Movie: </label>
					 <select name="mselect">
					 <!--dynamically generate drop down list from database content -->
					   <?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_movies WHERE 1"))){
								echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->execute())){
								echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->bind_result($movid, $name))){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							while ($stmt->fetch()){
								//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
								echo '<option value=" '. $movid . ' "> ' . $name . '</option>\n';
							}
							$stmt->close();

						?>	
					  
					 
					</select> 
					
					<label for="kmAdd"> Add Featured Kaiju: </label>
					<input type = "submit" value = "Add" id = "kmAdd"></input>
		</fieldset>
	</form>
	
	<!--add powers information -->
	<form id = powers_add  method="post" action="addpower.php">
		<fieldset>
			<legend>Add a Power:</legend>
					<label for="type"> Type of Power: </label>
					<input type = "text" name = "type" id = "type"></input>
					<label for="pAdd"> Add Type: </label>
					<input type = "submit" value = "Add" id = "pAdd"></input>
		</fieldset>
	</form>
	 <!--add kaiju-power relationship -->
	<form id = kaiju_powers_add method="post" action="addkp.php">
		<fieldset>
			<legend>Add an existing power to an existing Kaiju:</legend>
				<label for="kName">Kaiju: </label>
					<select name="kpselect">
					<!--dynamically generate drop down list from database content -->
					 <?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_kaiju WHERE 1"))){
							echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->execute())){
							echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($kid, $name))){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
							echo '<option value="'. $kid . '"> ' . $name . '</option>\n';
						}
						$stmt->close();

						?>	
					</select> 
					
					<label for="kPower">Power: </label>
					 <select name="pselect">
					 <!--dynamically generate drop down list from database content -->
					  <?php
							if(!($stmt = $mysqli->prepare("SELECT id, type_of_power FROM gz_powers WHERE 1"))){
								echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->execute())){
								echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if(!($stmt->bind_result($pid, $type))){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							while ($stmt->fetch()){
								//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
								echo '<option value="'. $pid . '"> ' . $type . '</option>\n';
							}
							$stmt->close();

						?>	
					</select> 
					
					<label for="kpAdd"> Add Kaiju Powers: </label>
					<input type = "submit" value = "Add" id = "kpAdd"></input>
		</fieldset>
	</form>
	<!--add alias information -->
	<form id = alias_add  method="post" action="addalias.php">
		<fieldset>
			<legend>Add an Alias:</legend>
					<label for="aName"> Alias: </label>
					<input type = "text" name = "aName" id = "aName"></input>
					<label for="aAdd"> Add Alias: </label>
					<input type = "submit" value = "Add" id = "aAdd"></input>
		</fieldset>
	</form>
	 <!--add kaiju-alias relationship -->
	<form id = kaiju_alias_add method="post" action="addka.php">
		<fieldset>
			<legend>Add an existing alias to an existing Kaiju:</legend>
				<label for="kName">Kaiju: </label>
					<select name="kaselect">
					<!--dynamically generate drop down list from database content -->
					  <?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_kaiju WHERE 1"))){
							echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->execute())){
							echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($kid, $name))){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
							echo '<option value="'. $kid . '"> ' . $name . '</option>\n';
						}
						$stmt->close();

						?>	
					</select> 
					
					<label for="kAlias">Alias: </label>
					 <select name="aselect">
					 <!--dynamically generate drop down list from database content -->
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

							while ($stmt->fetch()){
								//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
								echo '<option value="'. $aid . '"> ' . $name . '</option>\n';
							}
							$stmt->close();

						?>	
					</select> 
					
					<label for="kpAdd"> Add Kaiju Alias: </label>
					<input type = "submit" value = "Add" id = "kpAdd"></input>
		</fieldset>
	</form>
	 <!--add kaiju-kaiju relationship -->
	<form id = kaiju_enemy_add method="post" action="addke.php">
		<fieldset>
			<legend>Indicate which Kaiju have fought eachother:</legend>
				<label for="kName">Kaiju: </label>
					<select name="keselect">
					<!--dynamically generate drop down list from database content -->
					  <?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_kaiju WHERE 1"))){
							echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->execute())){
							echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($kid, $name))){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
							echo '<option value="'. $kid . '"> ' . $name . '</option>\n';
						}
						$stmt->close();

						?>	
					</select> 
					
					<label for="kEnemy">Enemy: </label>
					 <select name="eselect">
					 <!--dynamically generate drop down list from database content -->
					  <?php
						if(!($stmt = $mysqli->prepare("SELECT id, name FROM gz_kaiju WHERE 1"))){
							echo "Prepare failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->execute())){
							echo "execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!($stmt->bind_result($eid, $name))){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()){
							//echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $weight . "\n</td>\n</tr>\n";
							echo '<option value="'. $eid . '"> ' . $name . '</option>\n';
						}
						$stmt->close();

						?>	
					</select> 
					
					<label for="kpAdd"> Add Kaiju Rivalries: </label>
					<input type = "submit" value = "Add" id = "kpAdd"></input>
		</fieldset>
	</form>
	
  </body>
</html>