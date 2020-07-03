<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | COURSE";
$user = null;
$lang = 'en';
$total_pages = 1;

$page = getFilterAttribut_Get('page', 1);
$sortingMode = getFilterAttribut_Get('sortingMode', 'recent');
$limit = getFilterAttribut_Get('limit', 1);
$cath = getFilterAttribut_Get('cath', 'all');
$system = getFilterAttribut_Get('system', 'all');
$level = getFilterAttribut_Get('level', 'all');
$cLang = getFilterAttribut_Get('cLang', 'all');

if ($connected) {
    $user = $_SESSION['edu-artefact']['user'];
    $lang = $_SESSION['edu-artefact']['user']['language'];
}

switch ($limit) {
    case 1:
        $limit = 8;
        break;
    case 1:
        $limit = 10;
        break;
    case 1:
        $limit = 12;
        break;
    default:
        $limit = 8;
        break;
};

$starting_limit = ($page - 1) * $limit;

$query = 'SELECT COUNT(*) FROM courses WHERE language = :lang ';
$query2 = 'SELECT * FROM courses WHERE language = :lang ';

if ($cath != 'all') {
    $query = $query . ' outline LIKE :cat';
    $query2 = $query2 . ' outline LIKE :cat';
}
if ($level != 'all') {
    $query = $query . ' level LIKE :lev';
    $query2 = $query2 . ' level LIKE :lev';
}
if ($system != 'all') {
    $query = $query . ' system LIKE :sys';
    $query2 = $query2 . ' system LIKE :sys';
}

$query = $query . 'ORDER BY popularity LIMIT :sl,:l';
$query2 = $query2 . 'ORDER BY popularity LIMIT :sl,:l';

$count = $db->prepare($query);
$courses = $db->prepare($query2);

if ($cLang == 'all') {
    $count->bindValue(':lang', 'en', PDO::PARAM_STR);
    $courses->bindValue(':lang', 'en', PDO::PARAM_STR);
} else {
    $count->bindValue(':lang', $cLang, PDO::PARAM_STR);
    $courses->bindValue(':lang', $cLang, PDO::PARAM_STR);
}

if ($cath != 'all') {
    $count->bindValue(':cat', '%' . $cath . '%', PDO::PARAM_STR);
    $courses->bindValue(':cat', '%' . $cath . '%', PDO::PARAM_STR);
}
if ($level != 'all') {
    $count->bindValue(':lev', '%' . $level . '%', PDO::PARAM_STR);
    $courses->bindValue(':lev', '%' . $level . '%', PDO::PARAM_STR);
}
if ($system != 'all') {
    $count->bindValue(':sys', '%' . $system . '%', PDO::PARAM_STR);
    $courses->bindValue(':sys', '%' . $system . '%', PDO::PARAM_STR);
}

$count->bindValue(':sl', $starting_limit, PDO::PARAM_INT);
$count->bindValue(':l', $limit, PDO::PARAM_INT);
$count->execute();
$courses->bindValue(':sl', $starting_limit, PDO::PARAM_INT);
$courses->bindValue(':l', $limit, PDO::PARAM_INT);
$courses->execute();

$total_results = $count->fetchColumn();
$total_pages = ceil($courses->rowCount() / $limit);

$teachers = $db->prepare('SELECT * FROM users WHERE status="teacher" AND id=?');

require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>Our Courses</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Top Popular Courses Area Start ##### -->
<div class="top-popular-courses-area mt-50 section-padding-100-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                    <span>The Best</span>
                    <h3>Courses</h3>
                </div>
            </div>
        </div>

        <!--================Category Product Area =================-->
        <section class="cat_product_area section_gap">
            <div class="container-fluid">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="product_top_bar">
                            <div class="left_dorp">
                                <select class="form-control sorting">
                                    <option value="1">Default sorting</option>
                                    <option value="2">Most recent</option>
                                    <option value="4">Least recent</option>
                                </select>
                                <select class="form-control show">
                                    <option value="1">Show 8</option>
                                    <option value="2">Show 10</option>
                                    <option value="4">Show 12</option>
                                </select>
                            </div>
                            <div class="right_page ml-auto">
                                <nav class="cat_page" aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href="course.php?page=<?= $page - 1 ?>" aria-disabled="<?= $page == 1 ?>">
                                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= paginationLeftCount($total_pages, $page); $i++) : ?>
                                            <li class="page-item">
                                                <a class="page-link" href="course.php?page=<?= $i ?>"><?= $i ?></a>
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
                                                <a class="page-link" href="course.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor ?>
                                        <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
                                            <a class="page-link" href="course.php?page=<?= $page + 1 ?>" aria-disabled="<?= $page == $total_pages ?>">
                                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="latest_product_inner row">

                            <?php foreach ($courses as $cours) :
                                $teachers->execute(array($cours['teacherId']));
                                $teacher = $teachers->fetch(); ?>

                                <!-- Single Top Popular Course -->
                                <div class="col-12 col-lg-6">
                                    <div class="single-top-popular-course d-flex align-items-center flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">
                                        <div class="popular-course-content">
                                            <h5><?= $cours['title'] ?></h5>
                                            <span>By <?= $teacher['name'] ?> | <?= $cours['createDate'] ?></span>
                                            <div class="course-ratings">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <p><?= $cours['objectives'] ?></p>
                                            <a href="course-details.php?id=<?= $cours['id'] ?>" class="btn academy-btn btn-sm">See More</a>
                                        </div>
                                        <div class="popular-course-thumb bg-img" style="background-image: url(img/courses/<?= $cours['descriptionImage'] ?>);"></div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="left_sidebar_area">
                            <aside class="left_widgets cat_widgets">
                                <div class="l_w_title">
                                    <h3>Browse Categories</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        <li class="<?= $cath === 'all' ? 'active' : '' ?>"><a href="course.php?cath=all">All</a></li>
                                        <li class="<?= $cath === 'software' ? 'active' : '' ?>"><a href="course.php?cath=software">Software</a></li>
                                        <li class="<?= $cath === 'webpage' ? 'active' : '' ?>"><a href="course.php?cath=webpage">Web Page</a></li>
                                        <li class="<?= $cath === 'webapp' ? 'active' : '' ?>"><a href="course.php?cath=webapp">Web Application</a></li>
                                        <li class="<?= $cath === 'application' ? 'active' : '' ?>"><a href="course.php?cath=application">Application</a></li>
                                        <li class="<?= $cath === 'game' ? 'active' : '' ?>"><a href="course.php?cath=game">Game</a></li>
                                    </ul>
                                </div>
                            </aside>
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Courses Filters</h3>
                                </div>
                                <div class="widgets_inner">
                                    <h4>Language</h4>
                                    <ul class="list">
                                        <li class="<?= $cLang === 'all' ? 'active' : '' ?>"><a href="course.php?cLang=all">All</a></li>
                                        <li class="<?= $cLang === 'en' ? 'active' : '' ?>"><a href="course.php?cLang=en">En</a></li>
                                        <li class="<?= $cLang === 'fr' ? 'active' : '' ?>"><a href="course.php?cLang=fr">Fr</a></li>
                                    </ul>
                                </div>
                                <div class="widgets_inner">
                                    <h4>System</h4>
                                    <ul class="list">
                                        <li class="<?= $system === 'all' ? 'active' : '' ?>"><a href="course.php?system=all">All</a></li>
                                        <li class="<?= $system === 'windows' ? 'active' : '' ?>"><a href="course.php?system=windows">Windows</a></li>
                                        <li class="<?= $system === 'mac' ? 'active' : '' ?>"><a href="course.php?system=mac">Mac Os</a></li>
                                        <li class="<?= $system === 'ubuntu' ? 'active' : '' ?>"><a href="course.php?system=ubuntu">Ubuntu</a></li>
                                    </ul>
                                </div>
                                <div class="widgets_inner">
                                    <h4>Level</h4>
                                    <ul class="list">
                                        <li class="<?= $level === 'all' ? 'active' : '' ?>"><a href="course.php?level=all">All</a></li>
                                        <li class="<?= $level === 'beginner' ? 'active' : '' ?>"><a href="course.php?level=beginner">Beginner</a></li>
                                        <li class="<?= $level === 'intermediate' ? 'active' : '' ?>"><a href="course.php?level=intermediate">Intermediate</a></li>
                                        <li class="<?= $level === 'pro' ? 'active' : '' ?>"><a href="course.php?level=pro">Professional</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <nav class="cat_page mx-auto" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="course.php?page=<?= $page - 1 ?>" aria-disabled="<?= $page == 1 ?>">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= paginationLeftCount($total_pages, $page); $i++) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="course.php?page=<?= $i ?>"><?= $i ?></a>
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
                                    <a class="page-link" href="course.php?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor ?>
                            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="course.php?page=<?= $page + 1 ?>" aria-disabled="<?= $page == $total_pages ?>">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <!--================End Category Product Area =================-->

    </div>
</div>
<!-- ##### Top Popular Courses Area End ##### -->

<!-- ##### Top Popular Courses Details Area Start ##### -->
<div class="popular-course-details-area wow fadeInUp" data-wow-delay="300ms">
    <div class="single-top-popular-course d-flex align-items-center flex-wrap">
        <div class="popular-course-content">
            <h5>Business for begginers</h5>
            <span>By Dannick Kwengang | March 30, 2020</span>
            <div class="course-ratings">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </div>
            <p>Thanks to Artefact even people at the beginner level will be able to find jobs everywhere.
                Artefact evolves quickly and adapts gradually to market requirements. As a result,
                you will be able to work in many fields ranging from web developer, software developer,
                application developer and even video game developer.</p>
            <a href="business.php" class="btn academy-btn btn-sm mt-15">See More</a>
        </div>
        <div class="popular-course-thumb bg-img" style="background-image: url(img/job/bg-4.jpg);"></div>
    </div>
</div>
<!-- ##### Top Popular Courses Details Area End ##### -->

<!-- ##### Course Area Start ##### -->
<div class="academy-courses-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="300ms">
                    <div class="course-icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="course-content">
                        <h4>Business School</h4>
                        <p>Train yourself! And thanks to our partners, get work around you.</p>
                    </div>
                </div>
            </div>
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="400ms">
                    <div class="course-icon">
                        <i class="icon-worldwide"></i>
                    </div>
                    <div class="course-content">
                        <h4>Web Development</h4>
                        <p>Web development and its concept of responsive design will no longer hold any secrets for you.</p>
                    </div>
                </div>
            </div>
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                    <div class="course-icon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <div class="course-content">
                        <h4>Software Development</h4>
                        <p>Become a master in creating software solutions for computers.</p>
                    </div>
                </div>
            </div>
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="600ms">
                    <div class="course-icon">
                        <i class="icon-responsive"></i>
                    </div>
                    <div class="course-content">
                        <h4>Application Development</h4>
                        <p>Learn how to create fluid and modern applications.</p>
                    </div>
                </div>
            </div>
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="700ms">
                    <div class="course-icon">
                        <i class="fa fa-gamepad"></i>
                    </div>
                    <div class="course-content">
                        <h4>Game Development</h4>
                        <p>Learn to create 2D video games.</p>
                    </div>
                </div>
            </div>
            <!-- Single Course Area -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-course-area d-flex align-items-center mb-100 wow fadeInUp" data-wow-delay="800ms">
                    <div class="course-icon">
                        <i class="icon-message"></i>
                    </div>
                    <div class="course-content">
                        <h4>Design</h4>
                        <p>Become a master in the concept of responsive and modern design.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Course Area End ##### -->

<!-- ##### CTA Area Start ##### -->
<div class="call-to-action-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-content d-flex align-items-center justify-content-between flex-wrap">
                    <h3>Do you want to enrole at our Academy? Get in touch!</h3>
                    <a href="contact.php" class="btn academy-btn">See More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### CTA Area End ##### -->

<?php require 'elements/footer.php' ?>