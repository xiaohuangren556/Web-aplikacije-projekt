<?php
include 'connect.php';
global $dbc;

$createTableQuery = "CREATE TABLE IF NOT EXISTS clanci (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        datum DATE,
                        naslov VARCHAR(255) NOT NULL,
                        sazetak TEXT,
                        sadrzaj TEXT,
                        slika VARCHAR(255),
                        kategorija VARCHAR(50),
                        arhiva BOOLEAN
                    )";

$dbc->query("USE projekt");
$dbc->query($createTableQuery);
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

$title = mysqli_real_escape_string($dbc, $_POST['naslov']);
$about = mysqli_real_escape_string($dbc, $_POST['sažetak']);
$content = mysqli_real_escape_string($dbc, $_POST['sadržaj']);
$category = mysqli_real_escape_string($dbc, $_POST['kategorija']);
$date = date('Y-m-d'); // Use the date format compatible with the DATE type in MySQL

if (isset($_POST['arhiva'])) {
    $archive = 1;
} else {
    $archive = 0;
}

$picture = $_FILES['image']['name'];
$target_dir = 'img/';
$target_file = $target_dir . basename($picture);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    $sql = "INSERT INTO clanci (datum, naslov, sazetak, sadrzaj, slika, kategorija, arhiva) 
            VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";
        
    if ($dbc->query($sql)) {
        echo "News article successfully submitted.";
    }
} else {
    echo "Error uploading the image.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Skripta</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php" class="navigacija">Home</a></li>
            <li><a href="unos.php" class="navigacija">Unos</a></li>
            <li><a href="kategorija.php" class="navigacija">Arhiva</a></li>
            <li><a href="administracija.php" class="navigacija">Administracija</a></li>
            <li><a href="login.php" class="navigacija">Login</a></li>
            <li><a href="registracija.php" class="navigacija">Registracija</a></li>
        </ul>
    </nav>
</header>

<?php
    if(isset($_POST['submit'])){
        $naslov = $_POST['naslov'];
        $sazetak = $_POST['sažetak'];
        $sadrzaj = $_POST['sadržaj'];
        $kategorija = $_POST['kategorija'];
        $slika = $_FILES['image']['name'];
        $tempname=$_FILES['image']['tmp_name'];
        $folder='img/'.$slika;
        move_uploaded_file($tempname, $folder);
    }
?>


<main class="cijeli_clanak">
    <?php
        echo "<h1>".$naslov."</h1>";
        echo "<p>".$sazetak."</p>";
        echo "<img src='img/" . $slika . "' class='velika_slika' />";
        echo "<p>".$sadrzaj."</p>";
    ?>
</main>

<footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>