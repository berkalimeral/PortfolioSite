<?php

require('dependencies/head.php');

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['konu']) && isset($_POST['mesaj'])){
    require('admin/db/dbConnect.php');

    $fullname = $_POST['name'];
    $mail = $_POST['email'];
    $subject = $_POST['konu'];
    $message = $_POST['mesaj'];

    $q = $db->prepare("INSERT INTO user SET fullname=:fullName, email=:Email, subject=:Subject, message=:Message");
    $insert = $q->execute(array(
        'fullName' => $fullname,
        'Email' => $mail,
        'Subject' => $subject,
        'Message' => $message,
    ));

    if($insert){
        Header("Location: iletişim.php?msg=1");
        exit;
    } else {
        Header("Location: iletişim.php?msg=2");
        exit;
    }
}

?>
    <section id="iletisim" class="iletisim">

        <div class="container">

            <div class="section-title">

                <h2>İletişim</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione fugiat, quidem odit ipsum quam qui exercitationem id beatae blanditiis voluptatibus maiores consequuntur vero. Nisi facere mollitia itaque quasi veritatis deleniti, accusamus alias iure. Assumenda, similique.</p>

            </div>

            <div class="row">

                <div class="col-md-5 d-flex align-items-stretch">

                    <div class="bilgi">

                        <div class="adres">

                            <h4>Konum : </h4>
                            <p>Ademyavuz Mah. Necip Fazıl cad. No:63/6 Gebze, Kocaeli </p>

                        </div>

                        <div class="email">

                            <h4>Email : </h4>
                            <p>sherlock221B@hotmail.com</p>

                        </div>

                        <div class="telefon">

                            <h4>Telefon : </h4>
                            <p>+90 545 221 5454</p>

                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3019.614285799792!2d29.374265315731723!3d40.81446903927678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cadf015a3b9111%3A0x49b9e1bfd68a6316!2sAdem%20Yavuz%2C%20Necip%20Faz%C4%B1l%20Cd.%20No%3A11%2C%2041400%20Gebze%2FKocaeli!5e0!3m2!1str!2str!4v1621596888347!5m2!1str!2str" loading="lazy" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>

                    </div>

                </div>

                <div class="col-md-7 mt-5 mt-lg-0 d-flex align-items-stretch">

                    <form method="POST" action="iletişim.php" class="iletisim-form">

                        <div class="row">

                            <div class="from-group col-md-6">
                                <label for="isim">İsminiz</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="from-group col-md-6">
                                <label for="email">E-mail Adresiniz</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="isim">Konu</label>
                            <input type="text" class="form-control" name="konu" id="konu" required>
                        </div>
                        <div class="form-group">
                            <label for="isim">Mesajınız</label>
                            <textarea rows="10" class="form-control" name="mesaj" id="konu" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit">Mesaj Gönder</button>
                        </div>
                        <h6> <?php
                                    if (isset($_GET['msg'])) {

                                        if ($_GET['msg'] == 1) {
                                            echo "<h6 style='color:blue'> <b> Mesajınız Gönderildi! </b> </h6>";
                                        } elseif ($_GET['msg'] == 2) {
                                            echo "<h6 style='color:red'> <b> Mesajınız Gönderilirken Bir Hata Oluştu! </b> </h6>";
                                        }

                                    }  ?></h6>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <?php

require('dependencies/footer.php');

?>