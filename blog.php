<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';
require_once '../utils/api.php';

$title = "Artefact | BLOG";
$lang = 'en';
$total_pages = 1;
$limit = 12;

$page = getFilterAttribut_Get('page', 1);
$starting_limit = ($page - 1) * $limit;

if (!empty($_GET['search'])) {
    $result = searchBlog($db, $starting_limit, $limit);

    $search = $result['result'];

    $count = $result['count'];
} else {
    $result = getBlogs($db, $starting_limit, $limit);

    $search = $result['result'];

    $count = $result['count'];
}

$total_results = $count->rowCount();
$total_pages = ceil($total_results / $limit);

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
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <?php foreach ($search as $blog) :
                            $tags = explode(",", $blog['tags']);

                            $commentsCount = getBlogCommentById($db, $blog['id'])->rowCount();

                            $user = getUserById($db, $blog['autorId'])->fetch();
                        ?>
                            <article class="row blog_item">
                                <div class="col-md-3">
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
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img class="w-100" src="../img/blog/<?= $blog['image1'] ?>" alt="">
                                        <div class="blog_details">
                                            <a href="single-blog.php?id=<?= $blog['id'] ?>">
                                                <h2><?= $blog['title'] ?></h2>
                                            </a>
                                            <p><?= $blog['article'] ?></p>
                                            <a href="single-blog.php?id=<?= $blog['id'] ?>" class="white_bg_btn">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach ?>

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="blog.php?page=<?= $page - 1 ?>" aria-disabled="<?= $page == 1 ?>">
                                        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= paginationLeftCount($total_pages, $page); $i++) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor ?>
                                <?php if (paginationLeftDot($total_pages, $page)) : ?>
                                    <li class="page-item blank">...</li>
                                <?php endif ?>
                                <li class="page-item active">
                                    <a class="page-link" href="#"><?= $page ?></a>
                                </li>
                                <?php if (paginationRightDot($total_pages, $page)) : ?>
                                    <li class="page-item blank">...</li>
                                <?php endif ?>
                                <?php for ($i = paginationRightCount($total_pages, $page); $i <= $total_pages; $i++) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor ?>
                                <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="blog.php?page=<?= $page + 1 ?>" aria-disabled="<?= $page == $total_pages ?>">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
                            $search->execute();
                            $blog = $search->fetch();

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

<?php require 'elements/footer.php' ?>