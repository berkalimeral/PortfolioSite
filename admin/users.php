<?php

require('dependencies/layoutSidenav.php');
require('dependencies/head.php');
require('db/dbConnect.php');

if(isset($_POST['userName']) && isset($_POST['surname']) && isset($_POST['password'])){

    $kullanici_adi = $_POST['userName'];
    $kullanici_soyadi = $_POST['surname'];
    // $kullanici_sifre = $_POST['password'];

    $q = $db->prepare("INSERT INTO users SET ad=:name, soyad=:surname, password=:pass");
    $deger = $q->execute(array(
        'name'=>$kullanici_adi,
        'surname'=>$kullanici_soyadi,
        // 'pass'=>$kullanici_sifre,
    ));

    if($deger){
        echo "<h4>Başarıyla Eklendi.</h4>";
    } else{
        echo "<h4>Eklenemedi</h4>";
    }

}

$q = $db->prepare("SELECT * FROM users");
$q->execute();
$user = $q->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($user);
// echo "</pre>";

if(isset($_POST['id'])){

    $q = $db->prepare("SELECT * FROM users WHERE id=:id");
    $q->execute(array(
        'id'=>$_POST['id']
    ));
    $user = $q->fetch();

}

if(isset($_POST['sil'])){
    $silinecekİd = $_POST['sil'];
   
    $sorgu = $db->prepare("DELETE FROM users WHERE id=:id");
    $delete = $sorgu->execute(array(
        'id' => $silinecekİd
    ));
   
    if ($delete) {
        Header('Location: users.php?msg=1');
    } else {
        Header('Location: users.php?msg=2');
    }
   }



?>


<table border="1">

    <thead>
        <tr>
            <th>ID</th>
            <th>USERNAME</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>PASSWORD</th>
        </tr>
    </thead>

    <tbody>
        
        <?php

            foreach($user as $u){
                echo "<tr>";
                    echo "<td>".$u['id']."</td>";
                    echo "<td>".$u['username']."</td>";
                    echo "<td>".$u['name']."</td>";
                    echo "<td>".$u['surname']."</td>";
                    echo "<td>".$u['password']."</td>";
                    echo "<td><a href='update.php?id=".$u['id']."'>EDIT</a></td>";
                echo "</tr>";
            }

        ?>

    </tbody>

</table>

<form action="users.php" method="POST">
            <label for="sil"><b>İd Numarasına Göre Kullanıcı Sil</b></label>
            <input type="text" name="sil" placeholder="İd Girin"><br>
            <button class="btn btn-primary mt-2">Sil</button>
             <h6> <?php
                        if (isset($_GET['msg'])) {

                            if ($_GET['msg'] == 1) {
                                echo "<h6 style='color:purple'> <b> Kullanıcı Başarılı Bir Şekilde Silindi </b> </h6>";
                            } elseif ($_GET['msg'] == 2) {
                                echo "<h6 style='color:red'> <b> Kullanıcı Silinemedi </b> </h6>";
                            }
                        }  ?></h6>
        </form>

</form>