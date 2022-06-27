<?php
require('dependencies/head.php');
require('dependencies/layoutSidenav.php');
require('db/dbConnect.php');

if (isset($_POST['title']) && isset($_POST['description'])) {

    //DOSYA YÜKLEME KISMI
    $title = $_POST['title'];
    $description = $_POST['description'];

    $tmp_name = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];
    $file_type = pathinfo($file_name)['extension'];

    $types = array("png", "jpeg", "jpg");

    if (! in_array(strtolower($file_type),$types) ) {
        Header("Location: articleAdd.php?msg=1");
        exit;
    }

    date_default_timezone_set('Europe/Istanbul');
    $saltKey = 'berk';

    $file_name = md5($saltKey . date('d.m.y H:i:s')) . "." . $file_type;

    $uploadFile = "../cdn/" . $file_name;
    $uploadDbUrl = "cdn/".$file_name;

    @move_uploaded_file($tmp_name, $uploadFile);

    //DATABASE KAYIT KISMI

    session_start();

    $img_url = $uploadDbUrl;
    $date = date('y.m.d');
    $user_id = $_SESSION['user_id'];

    $q = $db->prepare("INSERT INTO article SET title=:title, description=:description, date=:date, user_id=:user_id, img_url=:img_url");
    $insert = $q->execute(array(
        'title' => $title,
        'description' => $description,
        'date' => $date,
        'user_id' => $user_id,
        'img_url' => $img_url,
    ));

    if($insert){
        Header("Location: articleAdd.php?msg=2");
        exit;
    } else {
        Header("Location: articleAdd.php?msg=3");
    }
}


?>
<script src="ckeditor5-build-classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 250px;
    }
</style>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Yazı Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Yazı Ekle</li>
        </ol>


        <form action="articleAdd.php" method="POST" enctype="multipart/form-data">

            <label for="title"><b>Yazı Başlığı</b></label>
            <input class="form-control py-4" type="text" name="title" id="title">

            <label for="editor"><b>Yazı İçerik</b></label><br>
            <textarea name="description" id="editor" cols="30" rows="10"></textarea>

            <label for="image"><b>Yazı Resmi</b></label>
            <input type="file" name="image" id="image" class="form-control-file"><br>

            <h6> <?php
                    if (isset($_GET['msg'])) {

                        if ($_GET['msg'] == 1) {
                            echo "<h6 style='color:red'> <b> DOSYA UZANTISI HATALI! </b> </h6>";
                        } elseif ($_GET['msg'] == 2) {
                            echo "<h6 style='color:purple'> <b> YAZI KAYIT EDİLDİ VE YAYINLANDI! </b> </h6>";
                        } elseif ($_GET['msg'] == 3) {
                            echo "<h6 style='color:red'> <b> YAZI KAYIT EDİLEMEDİ! </b> </h6>";
                        }
                    }  ?></h6>

            <button class="btn btn-primary mt-2">Kayıt Et</button>

        </form>


    </div>
    </div>
    </div>
</main>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<?php
require('dependencies/footer.php');
?>