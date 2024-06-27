<?php
include('./include/config.php');
include('./actions/MySQLSessionHandler.php');

session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT kode_user, password, namauser FROM user WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($kodeUser, $hashedPassword, $nama);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['kode_user'] = $kodeUser;
            $_SESSION['nama'] = $nama;
                header('Location: ./dashboard/');
            exit;
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUSKESMAS SINDANGKASIH</title>
    <style>
    </style>
    <link rel="stylesheet" href="assets/css/style.css">
    </link>
</head>

<body id="login">
    <header>
        <nav>
            <a class="navbrand">
                <img src="./assets/img/puskesmas logo.png" alt="">
                <h2>PUSKESMAS SINDANGKASIH</h2>
            </a>
        </nav>
    </header>
    <div class="logo">
        <img src="./assets/img/iconlab.png" alt="iconlab">
    </div>

    <div class="kotak">
        <h1 class="title1"><b>WELCOME !</b></h1>
        <form method="POST">
            <label for="username" class="p1" require>Username</label>

            <input name="username" type="text">

            <label for="password" class="p1" require>Password</label>

            <input name="password" type="password">
            <input class="simpen" type="submit" name="submit" value="Log-In" require>

        </form>
    </div>

</body>

</html>