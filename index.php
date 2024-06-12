<?php
include 'connect.php';
global $dbc;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Početna</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#" class="navigacija">Home</a></li>
                <li><a href="unos.php" class="navigacija">Unos</a></li>
                <li><a href="kategorija.php" class="navigacija">Arhiva</a></li>
                <li><a href="administracija.php" class="navigacija">Administracija</a></li>
                <li><a href="login.php" class="navigacija">Login</a></li>
                <li><a href="registracija.php" class="navigacija">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <main class="indexmain">
        <section id="sport" class="indexsection">
                <?php
                    $sql_sport = "SELECT * FROM clanci WHERE arhiva = 0 AND kategorija LIKE 'sport' LIMIT 4";
                    $result_sport = $dbc->query($sql_sport);
                    $i = 0;
                    while($row = $result_sport->fetch_assoc()){
                        echo '<article class="indexclanak">';
                            echo "<img src='img/" . $row['slika'] . "' class='mala_slika' />";
                            echo "<a href='/projekt/clanak.php?id=" . $row['id'] . "' class='link_poveznica'><p>" . $row['sazetak'] . "</p></a>";
                        echo '</article>';
                        $i++;
                    }
                ?>
        </section>
        <section id="kultura" class="indexsection">
        <?php
                $sql_kultura = "SELECT * FROM clanci WHERE arhiva = 0 AND kategorija LIKE 'kultura' LIMIT 4";
                $result_kultura = $dbc->query($sql_kultura);
                $i = 0;
                    while($row = $result_kultura->fetch_assoc()){
                        echo '<article class="indexclanak">';
                            echo "<img src='img/" . $row['slika'] . "' class='mala_slika' />";
                            echo "<a href='/projekt/clanak.php?id=" . $row['id'] . "' class='link_poveznica'><p>" . $row['sazetak'] . "</p></a>";
                        echo '</article>';
                        $i++;
                    }
               
            ?>
        </section>
    </main>

    <footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>