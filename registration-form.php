<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
    <!-- Css links -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/registration-form.css">
    <!-- Query links -->
    <link rel="stylesheet" href="./query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <?php require "assets/header.php"; ?>

    <main>
        <section class="registration-form">
            <h1>Registrácia</h1>
            <form action="admin/after-registration.php" method="POST" >
                <input class="reg-input" type="text" name="first-name" placeholder="Krstné meno"><br>
                <input class="reg-input"  type="text" name="second-name" placeholder="Priezvisko"><br>
                <input class="reg-input"  type="email" name="email" placeholder="Email"><br>
                <input class="reg-input"  type="password" name="password" placeholder="Heslo"><br>
                <input class="reg-input"  type="password" name="password-again" placeholder="Zopakujte heslo"><br>
                <input class="btn" type="submit" value="Zaregistrovať">
            </form>
        </section>
    </main>    

    <?php require "assets/footer.php"; ?>

    <script src="./js/header.js"></script>
</body>
</html>