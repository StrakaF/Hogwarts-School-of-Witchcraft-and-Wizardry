<?php 

    $first_name ="";
    $second_name ="";
    $email ="";
    $message ="";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $message = $_POST["message"]; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css links -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- Query links -->
    <link rel="stylesheet" href="./query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <main>
        <section class="form">
            <form action="contact.php" method="POST">
                <input  type="text" 
                        name="first-name" 
                        placeholder="Krstné meno"
                        value=$first_name 
                        required><br>

                <input  type="text" 
                        name="second-name" 
                        placeholder="Priezvisko" 
                        required><br>

                <input  type="email" 
                        name="email" 
                        placeholder="Email" 
                        required><br>

                <textarea   name="message" 
                            placeholder="Vaša správa" 
                            required>
                </textarea><br>

                <button>Odoslať</button>
            </form>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>
    <script src="./js/header.js"></script>
</body>
</html>