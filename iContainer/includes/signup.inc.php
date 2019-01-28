<?php
if (isset($_POST['registreren'])){

    require 'dbh.inc.php';

    $gebruikersnaam = $_POST['uid'];
    $email = $_POST['mail'];
    $wachtwoord = $_POST['pws'];
    $herhaalWachtwoord = $_POST['pws-herhaling'];

    if (empty($gebruikersnaam) || empty($email) || empty($wachtwoord) || empty($herhaalWachtwoord)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$gebruikersnaam."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $gebruikersnaam)){
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$gebruikersnaam);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $gebruikersnaam)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    else if($wachtwoord !== $herhaalWachtwoord){
        header("Location: ../signup.php?error=wachtwoordcheck&uid=".$gebruikersnaam."&mail=".$email);
        exit();
    }
    else{

        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $gebruikersnaam);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else{

                $sql = "INSERT INTO users (uidUsers, emailUsers, pwsUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    $anderWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $gebruikersnaam, $email, $anderWachtwoord);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }

            }

        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../signup.php");
    exit();
}