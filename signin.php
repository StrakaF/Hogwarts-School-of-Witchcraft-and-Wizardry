<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úvodná strana</title>
    <!-- Css links -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- Query links -->
    <link rel="stylesheet" href="./query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <?php require "assets/header.php"; ?>

    <main>
        <section class="form">
            <h1>Prihlásenie</h1>
            <form action="admin/login.php" method="POST">
                <input type="email" name="login-email" placeholder="Email používateľa"><br>
                <input type="password" name="login-password" placeholder="Heslo používateľa"><br>
                <input type="submit" value="Prihlásiť sa">
            </form>
        </section>
    </main>
        

    <?php require "assets/footer.php"; ?>

    <script src="./js/header.js"></script>
</body>
</html>