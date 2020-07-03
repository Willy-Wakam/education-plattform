<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | TESTIMONIALS";
$lang = 'en';
$total_pages = 1;
$limit = 4;

if (!empty($_POST['message'])) {
    $query = $db->prepare('INSERT into testimonials (userId, title, message) VALUES (?, ?, ?)');
    $query->execute([$_SESSION['edu-artefact']['user']['id'], $_POST['title'], $_POST['message']]);
    redirect('testimonials.php');
    exit();
}

$page = getFilterAttribut_Get('page', 1);
$starting_limit = ($page - 1) * $limit;

$testimonials = $db->prepare('SELECT * FROM testimonials ORDER BY postedDate DESC LIMIT :sl,:l');
$testimonials->bindValue(':sl', $starting_limit, PDO::PARAM_INT);
$testimonials->bindValue(':l', $limit, PDO::PARAM_INT);
$testimonials->execute();

$count = $db->prepare('SELECT * FROM testimonials');
$count->execute();

$total_results = $count->rowCount();
$total_pages = ceil($total_results / $limit);

$users = $db->prepare('SELECT * FROM users WHERE id=? LIMIT 1');

require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>Testimonials</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area mt-50 section-padding-100">

    <!-- ##### Testimonials Area Start ##### -->
    <div class="testimonials-area section-padding-100 bg-img bg-overlay" style="background-image: url(img/bg-img/bg-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center mx-auto white wow fadeInUp" data-wow-delay="300ms">
                        <span>our testimonials</span>
                        <h3>See what our satisfied customers are saying about us</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($testimonials as $testi) :
                    $users->execute(array($testi['userId']));
                    $user = $users->fetch(); ?>

                    <!-- Single Testimonials Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="400ms">
                            <div class="testimonial-thumb">
                                <img src="img/profile/<?= $user['profileImage'] ?>" alt="">
                            </div>
                            <div class="testimonial-content">
                                <h5><?= $testi['title'] ?></h5>
                                <p><?= substr($testi['message'], 0, 300) ?>...</p>
                                <h6><span><?= $user['name'] ?>,</span> Student</h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="testimonials.php?page=<?= $page - 1 ?>" aria-disabled="<?= $page == 1 ?>">
                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= paginationLeftCount($total_pages, $page); $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href="testimonials.php?page=<?= $i ?>"><?= $i ?></a>
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
                            <a class="page-link" href="testimonials.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="testimonials.php?page=<?= $page + 1 ?>" aria-disabled="<?= $page == $total_pages ?>">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- ##### Testimonials Area End ##### -->

    <div class="comment-form">
        <h4>Leave a Testimonial</h4>
        <form action="testimonials.php" method="POST">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <input class="form-control" type="text" name="title" placeholder="Title" require>
            <div class="form-group form-inline">
            </div>
            <div class="form-group">
                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required></textarea>
            </div>
            <input type="submit" class="btn academy-btn btn-3" value="Post Testimonial">
        </form>
    </div>
</div>
<!-- ##### Blog Area End ##### -->

<?php require 'elements/footer.php' ?>