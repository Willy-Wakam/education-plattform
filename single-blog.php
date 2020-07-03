<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';
require_once '../utils/api.php';

$title = "Artefact | SINGLE BLOG";
$lang = 'en';

if (empty($_GET['id'])) {
    if (empty($_POST['id'])) {
        redirect('blog.php');
        exit();
    }
}

if (!empty($_POST['message'])) {
    postBlogComment($db);
    redirect('single-blog.php?id=' . $_POST['id']);
    exit();
}

if (empty($_GET['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_GET['id'];
}

$blogs = getBlogById($db, $id);

if ($blogs->rowCount() == 0) {
    redirect('blog.php');
    exit();
}

$blog = $blogs->fetch();
$tags = explode(",", $blog['tags']);

$user = getUserById($db, $blog['autorId'])->fetch();

$comments = getBlogCommentById($db, $blog['id']);
$commentsCount = $comments->rowCount();

$replies = $db->prepare('SELECT * FROM comments WHERE replie=1 AND courseId=? AND repliedId=?');


//----------------- Handle Previous and Next Blog ------------------------------
$previous = getBlogById($db, $id - 1)->fetch();

$next = getBlogById($db, $id + 1)->fetch();

require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>The News</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area mt-50 section-padding-100">

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area p_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="../img/blog/<?= $blog['image1'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="#"><?= $tag ?>,</a>
                                    <?php endforeach ?>
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="#"><?= $user['name'] ?><i class="lnr lnr-user"></i></a></li>
                                    <li><a href="#"><?= $blog['date'] ?><i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#"><?= $blog['view'] ?> Views<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#"><?= $commentsCount ?> Comments<i class="lnr lnr-bubble"></i></a></li>
                                </ul>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2><?= $blog['title'] ?></h2>
                            <?= $blog['article'] ?>
                        </div>
                        <div class="col-lg-12">
                            <div class="quotes">
                                <?= $blog['information'] ?>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img class="img-fluid" src="../img/blog/<?= $blog['image2'] ?>" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-fluid" src="../img/blog/<?= $blog['image3'] ?>" alt="">
                                </div>
                                <div class="col-lg-12 mt-25">
                                    <?= $blog['conclusion'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-area">
                        <div class="row">
                            <?php if ($previous) : ?>
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="blog.php?id=<?= $id - 1 ?>"><img class="img-fluid" src="../img/blog/<?= $previous['image1'] ?>" alt=""></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="blog.php?id=<?= $id - 1 ?>"><span class="lnr text-white lnr-arrow-left"></span></a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="blog.php?id=<?= $id - 1 ?>">
                                            <h4><?= $previous['title'] ?></h4>
                                        </a>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php if ($next) : ?>
                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="blog.php?id=<?= $id + 1 ?>">
                                            <h4><?= $next['title'] ?></h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="blog.php?id=<?= $id + 1 ?>"><span class="lnr text-white lnr-arrow-right"></span></a>
                                    </div>
                                    <div class="thumb">
                                        <a href="blog.php?id=<?= $id + 1 ?>"><img class="img-fluid" src="../img/blog/<?= $next['image1'] ?>" alt=""></a>
                                    </div>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="comments-area">
                        <h4><?= $comments->rowCount() ?> Comments</h4>

                        <?php foreach ($comments as $comment) : ?>
                            <?php
                            $sendUser = getUserById($db, $comment['userId'])->fetch();
                            $replies->execute([$blog['id'], $comment['id']]);
                            ?>
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb col-4 col-md-2">
                                            <img src="../img/profile/<?= $sendUser['profileImage'] ?>" alt="">
                                        </div>
                                        <div class="desc col-8 col-md-10">
                                            <h5><a href="#"><?= $sendUser['name'] ?></a></h5>
                                            <p class="date"><?= $comment['postedDate'] ?></p>
                                            <p class="comment">
                                                <?= $comment['comment'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                    </div>
                                </div>
                            </div>

                            <?php foreach ($replies as $replie) : ?>
                                <?php
                                $replieUser = getUserById($db, $replie['userId'])->fetch();
                                ?>
                                <div class="comment-list left-padding">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb col-4 col-md-2">
                                                <img src="../img/profile/<?= $replieUser['profileImage'] ?>" alt="">
                                            </div>
                                            <div class="desc col-8 col-md-10">
                                                <h5><a href="#"><?= $replieUser['name'] ?></a></h5>
                                                <p class="date"><?= $replie['postedDate'] ?></p>
                                                <p class="comment">
                                                    <?= $replie['comment'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endforeach ?>

                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form action="single-blog.php" method="POST">
                            <div class="form-group form-inline">
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required></textarea>
                            </div>
                            <input type="submit" class="btn academy-btn btn-3" value="Post Comment">
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <form action="blog.php" method="POST" class="w-100">
                                    <input name="search" type="text" class="form-control" placeholder="Search Posts">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                    </span>
                                </form>
                            </div><!-- /input-group -->
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget author_widget">
                            <?php
                            $user = getUserById($db, $blog['autorId'])->fetch();

                            ?>
                            <img class="author_img rounded-circle" src="../img/profile/<?= $user['profileImage'] ?>" alt="">
                            <h4><?= $user['name'] ?></h4>
                            <p><?= $user['status'] ?></p>
                            <div class="social_icon">
                                <?php if (!empty($user['facebookLink'])) : ?>
                                    <a href="<?= $user['facebookLink'] ?>"><i class="fa fa-facebook"></i></a>
                                <?php endif ?>

                                <?php if (!empty($user['twitterLink'])) : ?>
                                    <a href="<?= $user['twitterLink'] ?>"><i class="fa fa-twitter"></i></a>
                                <?php endif ?>

                                <?php if (!empty($user['githubLink'])) : ?>
                                    <a href="<?= $user['githubLink'] ?>"><i class="fa fa-github"></i></a>
                                <?php endif ?>
                                <!-- <a href="#"><i class="fa fa-behance"></i></a> -->
                            </div>

                            <?php if (!empty($user['description'])) : ?>
                                <p><?= $user['description'] ?></p>
                            <?php endif ?>

                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>

                            <div class="row">
                                <?php foreach (getPopularBlog($db, 4) as $popular) : ?>
                                    <div class="media post_item row col-12 col-sm-6 col-lg-12">
                                        <img class="col-6" src="../img/blog/<?= $popular['image1'] ?>" alt="post">
                                        <div class="media-body col-6">
                                            <a href="blog-details.html">
                                                <h3><?= $popular['title'] ?></h3>
                                            </a>
                                            <p><?= $popular['date'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>

                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#"><img class="img-fluid" src="../img/blog/add.jpg" alt=""></a>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Post Catgories</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Technology</p>
                                        <p>37</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Lifestyle</p>
                                        <p>24</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Fashion</p>
                                        <p>59</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Art</p>
                                        <p>29</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Food</p>
                                        <p>15</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Architecture</p>
                                        <p>09</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Adventure</p>
                                        <p>44</p>
                                    </a>
                                </li>
                            </ul>
                            <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <p>
                                Artefact is constantly evolving and continues to receive improvements.
                                Subscribe to our newsletter and stay informed of all the news.
                            </p>
                            <div class="form-group d-flex flex-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                </div>
                                <a href="#" class="bbtns">Subcribe</a>
                            </div>
                            <p class="text-bottom">You can unsubscribe at any time</p>
                            <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Architecture</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Adventure</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

</div>
<!-- ##### Blog Area End ##### -->

<!-- ##### CTA Area Start ##### -->
<div class="call-to-action-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-content d-flex align-items-center justify-content-between flex-wrap">
                    <h3>Do you want to enrole at our Academy? Get in touch!</h3>
                    <a href="#" class="btn academy-btn">See More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### CTA Area End ##### -->

<?php require 'elements/footer.php' ?>