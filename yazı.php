<?php

require('dependencies/head.php');
require('admin/db/dbConnect.php');

$id = $_GET['article'];

$q = $db->prepare("SELECT * FROM article WHERE id=:id");
$q->execute(array(
    'id' => $id
));

$articles = $q->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="resume">

    <div class="container">

        <div class="section-title">

            <h2>Yazı Detayı</h2>
            <table border="1"><?php foreach ($articles as $article) {    ?>

                    <div class="blog-post col-md-6">

                        <div class="blog-post-text">
                            <div class="blog-post-thumbnail">
                                <img src="<?php echo $article['img_url']  ?>" alt="" srcset="">
                            </div>
                            <div class="blog-post-title">
                                <?php echo '<h1>' . $article["title"] . '</h1>'  ?>
                            </div>
                            <div class="blog-post-description">
                                <?php echo $article['description']  ?>
                            </div>
                            <div class="blog-post-meta-info">
                                <ul>
                                    <li>
                                        <div class="blog-post-date">
                                            <?php echo $article['date']  ?>
                                        </div>
                                        <div class="blog-post-meta-dot">
                                            ·
                                        </div>
                                        <div class="blog-post-meta-dot">
                                            ·
                                        </div>
                                        <div class="blog-post-author">
                                            <?php

                                            $q = $db->prepare("SELECT * FROM users WHERE id=:id");
                                            $q->execute(array('id' => $article['user_id']));
                                            $user = $q->fetch();
                                            echo $user['name'] . " " . $user['surname'];

                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </a>
                    </div>
                <?php  }    ?>
            </table>

        </div>


    </div>

</section>





















<?php

require('dependencies/footer.php');

?>