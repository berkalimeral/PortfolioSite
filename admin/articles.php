<?php
require('dependencies/head.php');
require('dependencies/layoutSidenav.php');
require('db/dbConnect.php');

$q = $db->prepare("SELECT * FROM article ORDER BY id DESC");
$q->execute();

$yazilar = $q->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['sil'])){

 $silinecekİd = $_POST['sil'];

 $sorgu = $db->prepare("DELETE FROM article WHERE id=:id");
 $delete = $sorgu->execute(array(
     'id' => $silinecekİd
 ));

}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Yazılarım</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Yazılarım</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Yazılarım
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>İd</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>User İd</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>İd</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>User İd</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php

                            foreach ($yazilar as $yazi) {
                                echo "<tr>";
                                echo "<td>" . $yazi['id'] . "</td>";
                                echo "<td>" . $yazi['title'] . "</td>";
                                echo "<td>" . $yazi['description'] . "</td>";
                                echo "<td>" . $yazi['date'] . "</td>";
                                echo "<td>" . $yazi['user_id'] . "</td>";
                                echo "<td>" . "<form action='articles.php' method='POST'>

                                <button name='sil' class='btn btn-primary mt-2'>Sil</button>
                                 
                            </form>" . "</td>";
                            // echo "<td>" . "<form action='messageUpdate.php' method='POST'>
                             echo "<td><button class='btn btn-primary mt-2'><a style='color: white; text-decoration:none;' href='messageUpdate.php?id=".$yazi['id']."'>Güncelle</a></button></td>";

                            //     <button name='sil' class='btn btn-primary mt-2'>Güncelle</button>
                                 
                            // </form>" . "</td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require('dependencies/footer.php'); ?>