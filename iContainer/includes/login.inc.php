<?php

if (isset($_POST['login-submit'])){
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $wachtwoord = $_POST['pws'];

    if (empty($mailuid) || empty($wachtwoord)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $resultaat = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($resultaat)) {
                $wwCheck = password_verify($wachtwoord, $row['pwsUsers']);
                if ($wwCheck == false) {
                    header("Location: ../index.php?error=verkeerdeww");
                    exit();
                } else if ($wwCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    $_SESSION['email'] = $row['emailUsers'];

                    header("Location: ../index.php?login=success");
                    exit();

                }
                else {
                    header("Location: ../index.php?error=wrongpwsuid");
                    exit();
                }
            }


        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else {
    header("Location: ../signup.php");
    exit();
}