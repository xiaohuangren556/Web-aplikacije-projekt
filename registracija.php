<?php
include 'connect.php';
global $dbc;

$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    isadmin BOOLEAN
)";

$dbc->query("USE projekt");
$dbc->query($createTableQuery);
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = $_POST['password'];
    $password_ver = $_POST['password_ver'];
    $username = $_POST['username'];
    $isAdmin = isset($_POST['admin']) ? 1 : 0;  

    if ($pass == $password_ver && !empty($username)) {
       
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        
        $stmt = $dbc->prepare("INSERT INTO users (username, password, isadmin) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $hashed_password, $isAdmin);

        if ($stmt->execute()) {
            echo "Registration successful. You can now <a href='login.html'>login</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match or required fields are empty.";
    }
}

$dbc->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Registracija</title>
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
                <li><a href="#" class="navigacija">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <h2>Registracija</h2>
    <form action="registracija.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="password_ver">Repeat password:</label><br>
        <input type="password" id="password_ver" name="password_ver" required><br><br>
        <label for="admin">Admin:</label>
        <input type="checkbox" id="admin" name="admin" value="1"><br><br>
        <input type="submit" value="Register">
    </form>
    <footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>
