<?php
include 'connect.php';
global $dbc;

$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(50) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        isadmin BOOLEAN DEFAULT 0
                    )";

$dbc->query("USE projekt");
if (!$dbc->query($createTableQuery)) {
    die("Table creation failed: " . $dbc->error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $dbc->prepare("SELECT username, password, isadmin FROM users WHERE username=?");
    if (!$stmt) {
        die("Statement preparation failed: " . $dbc->error);
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        die("Statement execution failed: " . $stmt->error);
    }

    $stmt->bind_result($db_username, $db_password, $isadmin);
    if ($stmt->fetch()) {
        
        if (password_verify($password, $db_password)) {
            $_SESSION['username'] = $username;
            if ($isadmin) {
                header("Location: administracija.php");
            } else {
                echo htmlspecialchars($username) . ", nemate dovoljna prava za pristup ovoj stranici";
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        header("Location: registracija.php");
        exit();
    }

    $stmt->close();
}

$dbc->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php" class="navigacija">Home</a></li>
            <li><a href="unos.php" class="navigacija">Unos</a></li>
            <li><a href="kategorija.php" class="navigacija">Arhiva</a></li>
            <li><a href="administracija.php" class="navigacija">Administracija</a></li>
            <li><a href="#" class="navigacija">Login</a></li>
            <li><a href="registracija.php" class="navigacija">Registracija</a></li>
        </ul>
    </nav>
</header>
<h2>Login</h2>
<form action="login.php" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>
