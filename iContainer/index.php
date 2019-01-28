<?php
    require "hoofdpagina.php";
?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
        <?php
        if (isset($_SESSION['userId'])){
            echo '<p>Your are logged in!</p>';
        }
        else{
            echo '<p>Your are logged out!</p>';
        }
        ?>
            </section>
        </div>

    </main>