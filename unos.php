<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Unos članka</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php" class="navigacija">Home</a></li>
            <li><a href="#" class="navigacija">Unos</a></li>
            <li><a href="kategorija.php" class="navigacija">Arhiva</a></li>
            <li><a href="administracija.php" class="navigacija">Administracija</a></li>
            <li><a href="login.php" class="navigacija">Login</a></li>
            <li><a href="registracija.php" class="navigacija">Registracija</a></li>
        </ul>
    </nav>
</header>
<form id="newsForm" action="skripta.php" method="POST" enctype="multipart/form-data">
    <span id="porukaTitle" class="bojaPoruke"></span>
    <label for="naslov">Naslov vijesti</label><br>
    <input type="text" name="naslov" id="naslov"><br>
    <span id="porukaAbout" class="bojaPoruke"></span>
    <label for="sažetak">Kratki sadržaj vijesti (do 50 znakova)</label><br>
    <textarea name="sažetak" id="sažetak"></textarea><br>
    <span id="porukaContent" class="bojaPoruke"></span>
    <label for="sadržaj">Sadržaj vijesti</label><br>
    <textarea name="sadržaj" id="sadržaj"></textarea><br>
    <span id="porukaSlika" class="bojaPoruke"></span>
    <label for="image">Slika</label><br>
    <input type="file" name="image" id="image" accept="image/jpg,image/gif"><br>
    <label for="kategorija">Kategorija vijesti</label><br>
    <span id="porukaKategorija" class="bojaPoruke"></span>
    <select name="kategorija" id="kategorija">
        <option value="">Odaberi kategoriju</option>
        <option value="sport">Sport</option>
        <option value="kultura">Kultura</option>
    </select><br>
    <label for="arhiva">Spremiti u arhivu:</label><br>
    <input type="checkbox" name="arhiva" id="arhiva"><br>
    <input type="reset" value="Poništi">
    <input type="submit" name="submit" value="Prihvati" id="slanje">
</form>
<script type="text/javascript">
    document.getElementById("newsForm").addEventListener("submit", function(event) {
        var slanjeForme = true;

       
        var poljeTitle = document.getElementById("naslov");
        var title = poljeTitle.value;
        if (title.length < 5 || title.length > 30) {
            slanjeForme = false;
            poljeTitle.style.border = "1px dashed red";
            document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
        } else {
            poljeTitle.style.border = "";
            document.getElementById("porukaTitle").innerHTML = "";
        }

      
        var poljeAbout = document.getElementById("sažetak");
        var about = poljeAbout.value;
        if (about.length < 10 || about.length > 100) {
            slanjeForme = false;
            poljeAbout.style.border = "1px dashed red";
            document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
        } else {
            poljeAbout.style.border = "";
            document.getElementById("porukaAbout").innerHTML = "";
        }

        
        var poljeContent = document.getElementById("sadržaj");
        var content = poljeContent.value;
        if (content.length == 0) {
            slanjeForme = false;
            poljeContent.style.border = "1px dashed red";
            document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
        } else {
            poljeContent.style.border = "";
            document.getElementById("porukaContent").innerHTML = "";
        }

       
        var poljeSlika = document.getElementById("image");
        var pphoto = poljeSlika.value;
        if (pphoto.length == 0) {
            slanjeForme = false;
            poljeSlika.style.border = "1px dashed red";
            document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
        } else {
            poljeSlika.style.border = "";
            document.getElementById("porukaSlika").innerHTML = "";
        }

        
        var poljeCategory = document.getElementById("kategorija");
        var category = poljeCategory.value;
        if (category === "") {
            slanjeForme = false;
            poljeCategory.style.border = "1px dashed red";
            document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
        } else {
            poljeCategory.style.border = "";
            document.getElementById("porukaKategorija").innerHTML = "";
        }

        
        if (!slanjeForme) {
            event.preventDefault();
        }
    });
</script>
<footer>
    <p>Dino Žulić (dzulic@tvz.hr) 2024.</p>
</footer>
</body>
</html>
