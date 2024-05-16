<?php

require "../classes/Auth.php";
require "../classes/Database.php";
require "../classes/Image.php";

session_start();

// Overenie či je užívateľ prihlásený 
if( !Auth::isLoggedIn() ){  // Ak skončí false (nieje prihlásený), prepneme na true
    die("Nepovolený prístup"); // a vykoná sa die, inak sa pokračuje v programe
}

$db = new Database();
$connection = $db->connectionDB();

$user_id = $_SESSION["logged_in_user_id"];

$allImages = Image::getImagesByUserId($connection, $user_id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css links -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin-photos.css">
    <!-- Query links -->
    <link rel="stylesheet" href="../query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Vkladanie súborov</title>
</head>
<body>
    <?php require "../assets/admin-header.php" ?>

    <main>
        <section class="upload-photos">
            <h1>Fotky</h1>
            <form action="upload-photos.php" method="POST" enctype="multipart/form-data">
                <label for="choose-file" id="choose-file-text">Vybrať obrázok</label>
                <input type="file" id="choose-file" name="image" require>

                <input type="submit" class="upload-file" value="Nahrať obrázok" name="submit">
            </form>
        </section>

        <section class="images">
            <article>
                <?php foreach($allImages as $one_image): ?>
                    <div>
                        <div>
                            <img src=<?= '../uploads/' . $user_id . '/' . $one_image['image_name'] ?> alt="image">
                        </div>
                        <div>
                            <a href=<?= '../uploads/' . $user_id . '/' . $one_image['image_name'] ?> download>Stiahnuť</a>
                            <a href="delete-photo.php?id=<?= $user_id ?>&image_name=<?= $one_image['image_name'] ?>">Zmazať</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>
        </section>
    </main>

    <?php require "../assets/footer.php" ?>
    <script src="../js/header.js"></script>
</body>
</html>

