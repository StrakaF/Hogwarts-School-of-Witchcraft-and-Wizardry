<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/PHPMailer/src/Exception.php';
    require 'vendor/PHPMailer/src/PHPMailer.php';
    require 'vendor/PHPMailer/src/SMTP.php';

    $first_name ="";
    $second_name ="";
    $email ="";
    $message ="";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $errors = [];

    if($first_name === ""){
        $errors[] = "Prosím, vložte do formuláru vaše krstné meno.";
    }

    if($second_name === ""){
        $errors[] = "Prosím, vložte do formuláru vaše priezvisko.";
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "Neplatný formát emailu.";
    }

    if($message === ""){
        $errors[] = "Prosím, napíšte do formuláru správu.";
    }

    if(empty($errors)){
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "straka168@gmail.com"; // Sended from here
            $mail->Password = "jqzkianlbnlbseas"; // Hashed password 
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "base64";

            $mail->setFrom("straka168@gmail.com");  // Sender from (same as Username)
            $mail->addAddress("straka168@gmail.com");   // Recipient
            $mail->addAddress("figgo168@azet.sk");   // Recipient
            $mail->Subject = "Bradavice-projekt-form";
            $mail->Body = "Meno: {$first_name} {$second_name} \n Email: {$email} \n Správa: {$message}";
            $mail->send();

            echo "Správa odoslaná";
        } catch (Exception $e) {
            echo "Správa nebola odoslaná: ", $mail->ErrorInfo;
        }
    }
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
        <section class="errors">
            <?php if(!empty($errors)):?>
                <ul>
                    <?php foreach($errors as $one_error): ?>
                        <li><?= $one_error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif;?>
        </section>
        <section class="form">
            <form action="contact.php" method="POST">
                <input  type="text" 
                        name="first-name" 
                        placeholder="Krstné meno"
                        value="<?= $first_name; ?>"
                        required><br>

                <input  type="text" 
                        name="second-name" 
                        placeholder="Priezvisko"
                        value="<?= $second_name; ?>" 
                        required><br>

                <input  type="email" 
                        name="email" 
                        placeholder="Email"
                        value="<?= $email; ?>" 
                        required><br>

                <textarea name="message" placeholder="Vaša správa" required><?= htmlspecialchars($message); ?></textarea><br>

                <button>Odoslať</button>
            </form>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>
    <script src="./js/header.js"></script>
</body>
</html>