<!DOCTYPE html>
<html>
<head>
	<title>Dodawanie wpisów do formularza</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>DODAWANIE WPISÓW DO FORMULARZA</h1>
		<nav>
			<ul>
				<li><a href="#">Strona główna</a></li>
				<li><a href="#">Kategorie</a></li>
				<li><a href="#">Dodaj wpis</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<h2>Kategorie</h2>
		<ul>
			<li><a href="#">Kategoria 1</a></li>
			<li><a href="#">Kategoria 2</a></li>
			<li><a href="#">Kategoria 3</a></li>
		</ul>

		<h2>Dodaj wpis</h2>
		<form method="post" action="dodaj.php">
			<label for="tytul">Tytuł:</label>
			<input type="text" id="tytul" name="tytul">

			<label for="tresc">Treść:</label>
			<textarea id="tresc" name="tresc"></textarea>

			<label for="kategoria">Kategoria:</label>
			<select id="kategoria" name="kategoria">
				<option value="1">Kategoria 1</option>
				<option value="2">Kategoria 2</option>
				<option value="3">Kategoria 3</option>
			</select>

			<input type="submit" value="Dodaj wpis">
		</form>

		<h2>Wpisy</h2>
		<ul>
			<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazadanychaplikacje";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
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
						
						echo	"<li>";
						echo	"<h3>Tytuł wpisu " . $row["Tytuł"] . " </h3>";
						echo	"<p>Treść wpisu " . $row["Treść"] . "</p>";
						echo	"<p>Kategoria " . $kategoria . " </p>";
						echo	"</li>"	;

					}
				} else {
					echo "Brak wpisów.";
				}
			
			}
			
			
			
			$conn->close();
			
			?>
			<li>
				<h3>Tytuł wpisu 1</h3>
				<p>Treść wpisu 1</p>
				<p>Kategoria: Kategoria 1</p>
				<button>Usuń wpis</button>
			</li>

		</ul>
	</main>

	<footer>
		<p>Moja strona internetowa &copy; 2023</p>
	</footer>
</body>
</html>
