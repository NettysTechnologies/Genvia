<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php", true, 303);
}

$validation = 0;
if (isset($_POST['submit'])) {
    $countfiles = count($_FILES['file']['name']);

    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
    rrmdir("csvToPdf");

    mkdir("csvToPdf");

    for ($i = 0; $i < $countfiles; $i++) {
        $mimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
        if (in_array($_FILES['file']['type'][$i], $mimes)) {
            $filename = $_FILES['file']['name'][$i];
            move_uploaded_file($_FILES['file']['tmp_name'][$i], 'csvToPdf/' . $filename);
            $validation++;
        } else {
            echo "Nahrávejte pouze soubory s příponou .csv <br>";
        }
    }

    if ($countfiles == 3) {
        if ($validation == $countfiles) {
            header("Location: grafy.php", true, 303);
        } else {
            echo "Nahrávejte pouze soubory s příponou .csv <br>";
        }
    } else {
        echo "Nahrajte 3 soubory (souhrnne_vysledky.csv, XXXXFL.csv, literature.csv)";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Upload form</title>
</head>

<body>
    <a href="logAbort.php">Odhlásit</a>
    <div>
        <img id="logo" src="assets/logo.jpg" alt="logo společnosti gensport">
        <h2>Výsledek vyšetření genetických predispozic ke sportu</h2>
    </div>
    <form method='post' action='' enctype='multipart/form-data'>
        <input type="file" name="file[]" id="file" multiple>
        <input type='submit' name='submit' value='Nahrát'>
    </form>
</body>

</html>