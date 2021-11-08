<?php
if(isset($_POST['submit'])) {
    $user = ["admin", "kolo2101"];
    if($user[0] == $_POST["username"] && $user[1] == $_POST["password"]){
        session_start();
        $_SESSION["admin"] = "admin";
        header("Location: form.php", true, 303);
    } else {
        echo "Nelze přihlásit";
    }
}
session_start();
if(isset($_SESSION["admin"])){
    header("Location: form.php", true, 303);
}
if(!isset($_SESSION["admin"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <img id="logo" src="assets/logo.jpg" alt="logo společnosti gensport">
    <form method='post' action='' enctype='multipart/form-data'>
        <label for="username">Příhlašovací jméno</label>
        <input type="text" name="username" id="">
        <label for="password">Heslo</label>
        <input type="password" name="password" id="">
        <input type="submit" name="submit" value="Přihlásit">
    </form>
</body>
</html>
<?php
}
?>