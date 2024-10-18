<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['userLogin'])) : ?>
        <?php echo '<h1 style="text-align: center;">ERFOLGREICHER LOGIN</h1>'; ?>
        <form action="./logout.php" method="POST">
            <button type="submit">LOG OUT</button>
        </form>
    <?php endif ?>