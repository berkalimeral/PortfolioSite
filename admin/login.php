<?php

session_start();
if (isset($_SESSION['username'])) {

    Header("Location: index.php");
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {

    require('db/dbConnect.php');

    $q = $db->prepare("SELECT * FROM users WHERE username=:kullanici_adi AND password=:parola");
    $q->execute(array(
        'kullanici_adi' => $_POST['username'],
        'parola' => $_POST['password']
    ));

    $control = $q->rowCount();

    if ($control) {

        $user = $q->fetch();

        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];

        Header("Location: index.php");
        exit;
    } else {
        Header("Location: login.php?msg=2");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/signstyle.css">
</head>

<body>

    <div class="all-container">
        <div class="login-container">
            <h1>Login</h1>
            <form action="" method="POST">
                <div class="txt_field">
                    
                    <input type="text" name="username" id="inputEmailAddress" required>
                    <span></span>
                    <label>Kullanıcı Adınız</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" id="inputPassword" required>
                    <span></span>
                    <label>Parolanız</label>
                </div>
                <h6> <?php
                            if (isset($_GET['msg'])) {

                                 if ($_GET['msg'] == 2) {
                                    echo "<h6 style='color:red'> <b> KULLANICI ADI VEYA PAROLA HATALI! </b> </h6>";
                                }
                            }  ?></h6><br>
                
                    <input type="submit" value="Login"><br><br>
                
                <!-- <div class="signup_link">
                    Hesabınız Yok mu?
                    <a href="register.php">Kayıt Ol</a>
                </div> -->
            </form>
        </div>
    </div>

    <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

</body>

</html>