<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

</head>
<body>

        <div class="login-box">
                <h1>Registreren</h1>


        <?php
        if (isset($_GET["error"])){
            if ($_GET["error"] == "emptyfields"){
                echo '<p class="signuperror">Vul alle velden in!</p>';
            }
            else if($_GET["error"] == "invalidmailuid"){
                echo '<p class="signuperror">Niet geldige gebruikersnaam en e-mail!</p>';
            }
            else if($_GET["error"] == "invaliduid"){
                echo '<p class="signuperror">Geen geldige gebruikersnaam!</p>';
            }
            else if($_GET["error"] == "wachtwoordcheck"){
                echo '<p class="signuperror">Uw wachtwoorden zijn niet gelijk!</p>';
            }
            else if($_GET["error"] == "usertaken"){
                echo '<p class="signuperror">Gebruikersnaam al in gebruik!</p>';
            }
        }
            else if (isset($_GET["signup"])) {
                if ($_GET["signup"] == "success") {
                    echo '<p class="signupsuccess">Uw registratie is voltooid!</p>';
                }
            }

                ?>
                <form class="form-signup" action="includes/signup.inc.php" method="post">
                <?php
                if (!empty($_GET["uid"])) {
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET["uid"].'">';
                    }

                else {
                    echo '<div class="textbox">
                            <i class="fas fa-user"></i>
                            <input type="text" name="uid" placeholder="Gebruikersnaam">
                            </div>';

                }

                if (!empty($_GET["mail"])) {
                    echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
                }
                else {
                    echo '<div class="textbox">
                            <i class="fas fa-envelope-square"></i>
                            <input type="text" name="mail" placeholder="E-mail">
                            </div>';
                }
                ?>

                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pws" placeholder="Wachtwoord">
                    </div>

                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pws-herhaling" placeholder="Herhaal wachtwoord">
                    </div>

                <button class="btn" type="submit" name="registreren">Registreren</button>
                <a class="btn" type="submit" name="header" href="hoofdpagina.php">Home</a>
                </form>

        </div>

</body>
</html>