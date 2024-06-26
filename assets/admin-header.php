<?php

$roleForHeader = $_SESSION["role"];

?>


<header>
    <div class="logo">
        <a href="students.php">
            <img src="../img/hogwarts-logo.png" alt="Hogwarts-logo">
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="students.php">Zoznam žiakov</a></li>
            <li><a href="add-student.php">Pridať žiaka</a></li>
            <li><a href="log-out.php">Odhlásiť sa</a></li>
            <?php if($roleForHeader === "admin"): ?>
                <li><a href="photos.php">Fotky</a></li>
            <?php endif; ?>
            
        </ul>
    </nav>

    <div class="menu-icon">
        <i class="fa-solid fa-bars"></i>
    </div>
</header>