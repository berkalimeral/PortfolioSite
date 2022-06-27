<?php
require('dependencies/head.php');
require('dependencies/layoutSidenav.php');
require('db/dbConnect.php');

$q = $db->prepare("SELECT * FROM user ORDER BY id DESC");
$q->execute();

$messages = $q->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['sil'])){
 $silinecekİd = $_POST['sil'];

 $sorgu = $db->prepare("DELETE FROM user WHERE id=:id");
 $delete = $sorgu->execute(array(
     'id' => $silinecekİd
 ));

 if ($delete) {
     Header('Location: message.php?msg=1');
 } else {
     Header('Location: message.php?msg=2');
 }
}


// if (isset($_POST['sil'])) {
//     $silinecek_id = $_POST['silinecek_id'];

//     $q = $db->prepare("DELETE FROM messages WHERE id=:id");
//     $delete = $q->execute(array(
//         "id" => $silinecek_id
//     ));
//     if ($delete) {
//         header("Location: message.php?msg=1");
//         exit;
//     } else {
//         header("Location: message.php?msg=2");
//         exit;
//     }
// }

?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">MESAJLAR</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">MESAJLARIM</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Mesajlarım
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>

                            </tr>
                        </tfoot>
                        <tbody>

                            <?php

                            foreach ($messages as $message) {
                                echo "<tr>";
                                echo "<td>" . $message['id'] . "</td>";
                                echo "<td>" . $message['fullname'] . "</td>";
                                echo "<td>" . $message['email'] . "</td>";
                                echo "<td>" . $message['subject'] . "</td>";
                                echo "<td>" . $message['message'] . "</td>";
                                echo "</tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="message.php" method="POST">
            <label for="sil"><b>İd Numarasına Göre Mesaj Silin</b></label>
            <input type="text" name="sil" placeholder="İd Girin"><br>
            <button class="btn btn-primary mt-2">Sil</button>
             <h6> <?php
                        if (isset($_GET['msg'])) {

                            if ($_GET['msg'] == 1) {
                                echo "<h6 style='color:purple'> <b> Mesaj Başarılı Bir Şekilde Silindi </b> </h6>";
                            } elseif ($_GET['msg'] == 2) {
                                echo "<h6 style='color:red'> <b> Mesaj Silinemedi </b> </h6>";
                            }
                        }  ?></h6>
        </form>

        <!-- <input type="hidden" name="silinecek_id" value="<?php //echo $message["id"] ?>">
        <th><button name="sil" type="submit" class="btn btn-danger">Sil</button></th> -->

    </div>
</main>
<?php require('dependencies/footer.php'); ?>