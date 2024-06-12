<?php
    include 'connect.php';
    global $dbc;
    $article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Članak</title>
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
    <main class="clanakmain">
    <?php
    $sql = "SELECT * FROM clanci WHERE id = ".$article_id;
    $result = $dbc->query($sql);
    if($row = $result->fetch_assoc()) {
        echo "<h1>".$row['naslov']."</h1>";
        echo "<p>".$row['datum']."</p>";
        echo "<p>".$row['sazetak']."</p>";
        echo "<div class='okvir_slike'>";
        echo "<img src='img/" . $row['slika'] . "' class='velika_slika' />";
        echo "</div>";
        echo "<p>".$row['sadrzaj']."</p>";
    }
?>
    </main>

    <footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>