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
    <title>Administracija</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php" class="navigacija">Home</a></li>
                <li><a href="unos.php" class="navigacija">Unos</a></li>
                <li><a href="kategorija.php" class="navigacija">Arhiva</a></li>
                <li><a href="#" class="navigacija">Administracija</a></li>
                <li><a href="login.php" class="navigacija">Login</a></li>
                <li><a href="registracija.php" class="navigacija">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php
    $sql = "SELECT * FROM clanci";
    $result = mysqli_query($dbc, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($dbc));
    }

    while ($row = mysqli_fetch_array($result)) {
        echo '
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="form-item">
                <label for="title">Naslov vjesti:</label>
                <div class="form-field">
                    <input type="text" name="title" class="form-field-textual" value="' . $row['naslov'] . '">
                </div>
            </div>
            
            <div class="form-item">
                <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
                <div class="form-field">
                    <textarea name="about" cols="30" rows="10" class="form-field-textual">' . $row['sazetak'] . '</textarea>
                </div>
            </div>
            
            <div class="form-item">
                <label for="content">Sadržaj vijesti:</label>
                <div class="form-field">
                    <textarea name="content" cols="30" rows="10" class="form-field-textual">' . $row['sadrzaj'] . '</textarea>
                </div>
            </div>
            
            <div class="form-item">
                <label for="pphoto">Slika:</label>
                <div class="form-field">
                    <input type="file" class="input-text" id="pphoto" name="pphoto" value="' . $row['slika'] . '"/>
                    <br>
                    <img src="img/' . $row['slika'] . '" width="100px" alt="Slika vijesti">
                </div>
            </div>
            
            <div class="form-item">
                <label for="category">Kategorija vijesti:</label>
                <div class="form-field">
                    <select name="category" class="form-field-textual">
                        <option value="sport" ' . ($row['kategorija'] == 'sport' ? 'selected' : '') . '>Sport</option>
                        <option value="kultura" ' . ($row['kategorija'] == 'kultura' ? 'selected' : '') . '>Kultura</option>
                    </select>
                </div>
            </div>
            
            <div class="form-item">
                <label>Spremiti u arhivu:</label>
                <div class="form-field">
                    <input type="checkbox" name="archive" id="archive" ' . ($row['arhiva'] == 1 ? 'checked' : '') . '/> Arhiviraj?
                </div>
            </div>
            
            <div class="form-item">
                <input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">
                <button type="reset" value="Poništi">Poništi</button>
                <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                <button type="submit" name="delete" value="Izbriši">Izbriši</button>
            </div>
        </form>';

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $delete_sql = "DELETE FROM clanci WHERE id=$id";
            $delete_result = mysqli_query($dbc, $delete_sql);
            if (!$delete_result) {
                die("Delete query failed: " . mysqli_error($dbc));
            }
        }

        if (isset($_POST['update'])) {
            $picture = $_FILES['pphoto']['name'];
            $title = $_POST['title'];
            $about = $_POST['about'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $archive = isset($_POST['archive']) ? 1 : 0;
            $target_dir = 'img/' . $picture;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
            $id = $_POST['id'];
            $update_sql = "UPDATE clanci SET naslov='$title', sazetak='$about', sadrzaj='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
            $update_result = mysqli_query($dbc, $update_sql);
            if (!$update_result) {
                die("Update query failed: " . mysqli_error($dbc));
            }
        }
    }
    ?>

    </main>

    <footer><p>Dino Žulić (dzulic@tvz.hr) 2024.</p></footer>
</body>
</html>
