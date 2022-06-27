<?php
 require('dependencies/head.php');
 require('dependencies/layoutSidenav.php');

if (isset($_POST['name']) && isset($_POST['surname'])) {

    $parola = $_POST['password'];
    $confirmParola = $_POST['confirmPassword'];
    $ad = $_POST['name'];
    $soyad = $_POST['surname'];
    $kullanici_adi = $_POST['username'];
    $email = $_POST['email'];
    $telno = $_POST['number'];
    $hobi = $_POST['hobiler'];
    $cinsiyet = $_POST['gender'];


    //Girilen Şifreler Eşleşiyor Mu Kontrolü 
    if ($parola != $confirmParola) {
        Header("Location: register.php?msg=1");
        exit;
    }

    //Böyle Bir Kullanıcı Var Mı Kontrolü
    require('db/dbConnect.php');
    $q = $db->prepare("SELECT * FROM users WHERE username=:kullanici_adi");
    $q->execute(array(
        'kullanici_adi' => $kullanici_adi
    ));

    if($q->rowCount()){
        Header("Location: register.php?msg=2");
        exit;
    }

    //Veri Tabanına Yeni Kullanıcı Ekleme İşlemi
    $q = $db->prepare("INSERT INTO users SET username=:UserName, name=:Name, surname=:Surname, password=:Password, email=:Email, tel_no=:Telno, hobi=:Hobi, cinsiyet=:Cinsiyet");
    $insert = $q->execute(array(
        'UserName' => $kullanici_adi,
        'Name' => $ad,
        'Surname' => $soyad,
        'Password' => $parola,
        'Email' => $email,
        'Telno' => $telno,
        'Hobi' => $hobi,
        'Cinsiyet' => $cinsiyet
    ));

    if($insert){
        Header("Location: register.php?msg=3");
        exit;
    } else {
        Header("Location: register.php?msg=4");
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
                Kullanıcı Ekle
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
                        <span class="details">E-mail Adresiniz</span>
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                     <!-- <div class="input-box">
                        <span class="details">Öğrenci Numaranız</span>
                        <input type="text" placeholder="Numara" required>
                    </div> -->
                    <div class="input-box">
                        <span class="details">Telefon Numaranız</span>
                        <input type="number" name="number" placeholder="Telefon" required>
                    </div>
                    <!-- <div class="input-box">
                        <span class="details">Yaşadığınız Şehir</span>
                        <select name="sehir" required>
                            <option value="">Bir Şehir Seçiniz...</option>
                            <option value="Adana">Adana</option>
                            <option value="Adıyaman">Adıyaman</option>
                            <option value="Afyonkarahisar">Afyonkarahisar</option>
                            <option value="Ağrı">Ağrı</option>
                            <option value="Amasya">Amasya</option>
                            <option value="Ankara">Ankara</option>
                            <option value="Antalya">Antalya</option>
                            <option value="Artvin">Artvin</option>
                            <option value="Aydın">Aydın</option>
                            <option value="Balıkesir">Balıkesir</option>
                            <option value="Bilecik">Bilecik</option>
                            <option value="Bingöl">Bingöl</option>
                            <option value="Bitlis">Bitlis</option>
                            <option value="Bolu">Bolu</option>
                            <option value="Burdur">Burdur</option>
                            <option value="Bursa">Bursa</option>
                            <option value="Çanakkale">Çanakkale</option>
                            <option value="Çankırı">Çankırı</option>
                            <option value="Çorum">Çorum</option>
                            <option value="Denizli">Denizli</option>
                            <option value="Diyarbakır">Diyarbakır</option>
                            <option value="Edirne">Edirne</option>
                            <option value="Elazığ">Elazığ</option>
                            <option value="Erzincan">Erzincan</option>
                            <option value="Erzurum">Erzurum</option>
                            <option value="Eskişehir">Eskişehir</option>
                            <option value="Gaziantep">Gaziantep</option>
                            <option value="Giresun">Giresun</option>
                            <option value="Gümüşhane">Gümüşhane</option>
                            <option value="Hakkâri">Hakkâri</option>
                            <option value="Hatay">Hatay</option>
                            <option value="Isparta">Isparta</option>
                            <option value="Mersin">Mersin</option>
                            <option value="İstanbul">İstanbul</option>
                            <option value="İzmir">İzmir</option>
                            <option value="Kars">Kars</option>
                            <option value="Kastamonu">Kastamonu</option>
                            <option value="Kayseri">Kayseri</option>
                            <option value="Kırklareli">Kırklareli</option>
                            <option value="Kırşehir">Kırşehir</option>
                            <option value="Kocaeli">Kocaeli</option>
                            <option value="Konya">Konya</option>
                            <option value="Kütahya">Kütahya</option>
                            <option value="Malatya">Malatya</option>
                            <option value="Manisa">Manisa</option>
                            <option value="Kahramanmaraş">Kahramanmaraş</option>
                            <option value="Mardin">Mardin</option>
                            <option value="Muğla">Muğla</option>
                            <option value="Muş">Muş</option>
                            <option value="Nevşehir">Nevşehir</option>
                            <option value="Niğde">Niğde</option>
                            <option value="Ordu">Ordu</option>
                            <option value="Rize">Rize</option>
                            <option value="Sakarya">Sakarya</option>
                            <option value="Samsun">Samsun</option>
                            <option value="Siirt">Siirt</option>
                            <option value="Sinop">Sinop</option>
                            <option value="Sivas">Sivas</option>
                            <option value="Tekirdağ">Tekirdağ</option>
                            <option value="Tokat">Tokat</option>
                            <option value="Trabzon">Trabzon</option>
                            <option value="Tunceli">Tunceli</option>
                            <option value="Şanlıurfa">Şanlıurfa</option>
                            <option value="Uşak">Uşak</option>
                            <option value="Van">Van</option>
                            <option value="Yozgat">Yozgat</option>
                            <option value="Zonguldak">Zonguldak</option>
                            <option value="Aksaray">Aksaray</option>
                            <option value="Bayburt">Bayburt</option>
                            <option value="Karaman">Karaman</option>
                            <option value="Kırıkkale">Kırıkkale</option>
                            <option value="Batman">Batman</option>
                            <option value="Şırnak">Şırnak</option>
                            <option value="Bartın">Bartın</option>
                            <option value="Ardahan">Ardahan</option>
                            <option value="Iğdır">Iğdır</option>
                            <option value="Yalova">Yalova</option>
                            <option value="Karabük">Karabük</option>
                            <option value="Kilis">Kilis</option>
                            <option value="Osmaniye">Osmaniye</option>
                            <option value="Düzce">Düzce</option>
                        </select>
                    </div> -->
                    <div class="input-box">
                        <span class="details">Parolanız</span>
                        <input type="password" name="password" placeholder="Parola" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Parolayı Onaylayınız</span>
                        <input type="password" name="confirmPassword" placeholder="Parola" required>
                    </div>
                </div>
                <div class="input-box-hobi">
                    <table>
                        <tr>
                            <td>Hobileriniz : </td>
                            <td>
                                <input type="checkbox" name="hobiler" value="Kitap"> Kitap
                                <input type="checkbox" name="hobiler" value="Spor"> Spor
                                <input type="checkbox" name="hobiler" value="Fotoğraf"> Fotoğrafçılık
                                <input type="checkbox" name="hobiler" value="Tiyatro"> Tiyatro
                                <input type="checkbox" name="hobiler" value="Müzik"> Müzik
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1">
                    <input type="radio" name="gender" id="dot-2">
                    <span class="gender-title">Cinsiyet</span>
                    <div class="kategori">
                        <label for="dot-1">
                            <span class="gender">Erkek</span>
                            <span class="dot one"></span>
                        </label>
                        <label for="dot-2">
                            <span class="gender">Kadın</span>
                            <span class="dot two"></span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    
                        <input type="submit" value="Kullanıcı Oluştur">

                </div>
                <!-- <a href="login.php" id="go-login">Giriş Yap</a> -->
                <h6> <?php
                                    if (isset($_GET['msg'])) {

                                        if ($_GET['msg'] == 1) {
                                            echo "<h6 style='color:red'> <b> Girilen Parolalar Eşlenşmiyor! </b> </h6>";
                                        } elseif ($_GET['msg'] == 2) {
                                            echo "<h6 style='color:red'> <b> Zaten Böyle Bir Kullanıcı Var! </b> </h6>";
                                        }
                                        elseif ($_GET['msg'] == 3) {
                                            echo "<h6 style='color:blue'> <b> Kayıt Başarılı! </b> </h6>";
                                        }
                                        elseif ($_GET['msg'] == 4) {
                                            echo "<h6 style='color:red'> <b> Kayıt Başarısız! </b> </h6>";
                                        }
                                    }  ?></h6>
            </form>
        </div>
    </div>

</body>

</html>