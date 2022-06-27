<?php

require('dependencies/head.php');
require('admin/db/dbConnect.php');

$q = $db->prepare("SELECT * FROM article");
$q->execute();

$articles = $q->fetchAll(PDO::FETCH_ASSOC);

?>

?>

<div class="blog-post-wrapper">
    <div class="container mt-4">
        <div class="blog-post-container">
            <div class="container">

                <div class="section-title">

                    <h2>Yazılarım</h2>

                </div>


            </div>
            <div class="blog-post-row">
                <div class="row">
                    
                    <?php foreach ($articles as $article) {    ?>

                        <div class="blog-post col-md-6">
                            <a href="yazı.php?article=<?php echo $article['id']  ?>">
                                <div class="blog-post-thumbnail">
                                    <img src="<?php echo $article['img_url']  ?>" alt="" srcset="">
                                </div>
                                <div class="blog-post-text">
                                    <div class="blog-post-title">
                                        <?php echo $article['title']  ?>
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

                </div>
            </div>
        </div>
    </div>
</div>

<?php

require('dependencies/footer.php')

?>