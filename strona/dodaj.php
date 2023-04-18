<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazadanychaplikacje";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$tytul = $_POST["tytul"];
	$tresc = $_POST["tresc"];
	$kategoria = $_POST["kategoria"];

	$sql = "INSERT INTO formularze (Tytuł, Treść, Kategoria) VALUES ('$tytul', '$tresc', '$kategoria')";

	if ($conn->query($sql) === TRUE) {
		echo "Wpis został dodany.";
	} else {
		echo "Nie udało się dodać wpisu: " . $conn->error;
	}
}

if (isset($_GET["sortowanie"])) {
	$id = $_GET["sortowanie"];

	$sql = "SELECT * FROM formularze GROUP BY $id";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$kategoria = "";
			switch ($row["Kategoria"]) {
				case 1:
					$kategoria = "Kategoria 1";
					break;
				case 2:
					$kategoria = "Kategoria 2";
					break;
				case 3:
					$kategoria = "Kategoria 3";
					break;
			}
			echo "<li>";
			echo "<h3>" . $row["Tytuł"] . "</h3>";
			echo "<p>" . $row["Treść"] . "</p>";
			echo "<p>Kategoria: " . $kategoria . "</p>";
			echo "</li>";
		}
	} else {
		echo "Brak wpisów.";
	}

}



$conn->close();

?>



<!-- formularz sortowania -->
<form method="get">
	<label for="sortowanie">Sortuj wg:</label>
	<select name="sortowanie" id="sortowanie">
		<option value="ID" selected>Data dodania</option>
		<option value="Tytuł">Tytuł</option>
		<option value="Kategoria">Kategoria</option>
	</select>
	<input type="submit" value="Sortuj">
</form>

