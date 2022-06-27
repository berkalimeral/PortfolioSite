<?php

// require('db/dbConnect.php');
require('dependencies/head.php');
require('dependencies/layoutSidenav.php');

if (isset($_POST['name']) && isset($_POST['surname'])) {

    $parola = $_POST['password'];
    $confirmParola = $_POST['confirmPassword'];
    $ad = $_POST['name'];
    $soyad = $_POST['surname'];
    $kullanici_adi = $_POST['username'];


    //Girilen Şifreler Eşleşiyor Mu Kontrolü 
    if ($parola != $confirmParola) {
        Header("Location: updare.php?msg=1");
        exit;
    }

    //Böyle Bir Kullanıcı Var Mı Kontrolü
     require('db/dbConnect.php');
     $q = $db->prepare("SELECT * FROM users WHERE username=:kullanici_adi");
     $q->execute(array(
         'kullanici_adi' => $kullanici_adi
     ));

     if ($q->rowCount()) {
         Header("Location: update.php?msg=2");
         exit;
     }

    //Veri Tabanına Kullanıcı Güncelleme İşlemi
    $q = $db->prepare("UPDATE users SET username=:UserName, name=:Name, surname=:Surname, password=:Password WHERE id=:id");
    $update = $q->execute(array(
        'UserName' => $kullanici_adi,
        'Name' => $ad,
        'Surname' => $soyad,
        'Password' => $parola,
        'id'=>$_GET['id']
    ));

    if ($update) {
        Header("Location: update.php?msg=3");
        exit;
    } else {
        Header("Location: update.php?msg=4");
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
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/signstyle.css">
</head>

<body>
    <div class="all-container">
        <div class="register-container">
            <div class="title">
                Kullanıcı Güncelle
            </div>
            <form action="" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Kullanıcı Adınız</span>
                        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Adınız</span>
                        <input type="text" name="name" placeholder="Ad" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Soyadınız</span>
                        <input type="text" name="surname" placeholder="Soyad" required>
                    </div>
            
                    <div class="input-box">
                        <span class="details">Parolanız</span>
                        <input type="password" name="password" placeholder="Parola" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Parolayı Onaylayınız</span>
                        <input type="password" name="confirmPassword" placeholder="Parola" required>
                    </div>
                </div>

                <div class="button">

                    <input type="submit" value="Kullanıcı Güncelle">

                </div>
                <h6> <?php
                        if (isset($_GET['msg'])) {

                            if ($_GET['msg'] == 1) {
                                echo "<h6 style='color:green'> <b> Kullanıcı Başarılı Bir Şekilde Güncellendi! </b> </h6>";
                            } elseif ($_GET['msg'] == 2) {
                                echo "<h6 style='color:red'> <b> Kullanıcı Güncellenemedi! </b> </h6>";
                            } 
                        }  ?></h6>
            </form>
        </div>
    </div>

</body>

</html>