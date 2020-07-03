<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | TEACHERS";
$lang = 'en';
$total_pages = 1;
$limit = 12;

$page = getFilterAttribut_Get('page', 1);
$starting_limit = ($page - 1) * $limit;

$teachers = $db->prepare('SELECT * FROM users WHERE status="teacher" ORDER BY registerDate DESC LIMIT :sl,:l');
$teachers->bindValue(':sl', $starting_limit, PDO::PARAM_INT);
$teachers->bindValue(':l', $limit, PDO::PARAM_INT);
$teachers->execute();

$count = $db->prepare('SELECT * FROM users WHERE status="teacher"');
$count->execute();

$total_results = $count->rowCount();
$total_pages = ceil($total_results / $limit);

require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>Teachers</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area mt-50 section-padding-100">

    <!--================Teacher Area =================-->
    <section class="teachers-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                        <span>The Best</span>
                        <h3>Meet the Teachers</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach ($teachers as $teacher) : ?>
                    <!-- Single Teachers -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-teachers-area text-center mb-100 wow fadeInUp" data-wow-delay="400ms">
                            <!-- Thumbnail -->
                            <div class="teachers-thumbnail">
                                <img class="w-100" src="img/profile/<?= $teacher['profileImage'] ?>" alt="">
                            </div>
                            <!-- Meta Info -->
                            <div class="teachers-info mt-30">
                                <h5><?= $teacher['name'] ?></h5>
                                <span><?= substr($teacher['description'], 0, 200) ?>...</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="teacher.php?page=<?= $page - 1 ?>" aria-disabled="<?= $page == 1 ?>">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= paginationLeftCount($total_pages, $page); $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href="teacher.php?page=<?= $i ?>"><?= $i ?></a>
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
                            <a class="page-link" href="teacher.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="teacher.php?page=<?= $page + 1 ?>" aria-disabled="<?= $page == $total_pages ?>">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <!--================Teacher Area =================-->

</div>
<!-- ##### Blog Area End ##### -->

<?php require 'elements/footer.php' ?>