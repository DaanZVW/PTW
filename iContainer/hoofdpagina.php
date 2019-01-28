<?php
session_start();
require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="This is an example of a meta description. This will often show up in search results.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>

<!-- Here is the header where I decided to include the login form for this tutorial. -->
<div class="login-box">
    <h1>Home</h1>



        <?php
        if (!isset($_SESSION['userId'])) {
            echo '<form action="includes/login.inc.php" method="post">
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="mailuid" placeholder="E-mail/Gebruikersnaam">
                </div>
            
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pws" placeholder="Wachtwoord">
                </div>
                
                
            <button class="btn" type="submit" name="login-submit">Login</button>
            <a href="signup.php" class="btn">Registreren</a>
          </form>';

        }
        else if (isset($_SESSION['userId'])) {
            echo '<form action="includes/logout.inc.php" method="post">
            <button class="btn" type="submit" name="login-submit">Logout</button>
          </form>';
        }
        ?>
    </div>
</body>
</html>
