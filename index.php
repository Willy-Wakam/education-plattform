<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | HOME";
$user = null;
$lang = 'en';

if ($connected) {
    $lang = $_SESSION['edu-artefact']['user']['language'];
}

$testimonials = $db->prepare('SELECT * FROM testimonials WHERE language=? LIMIT 4');
$testimonials->execute(array($lang));

$courses = $db->prepare('SELECT * FROM courses WHERE language=? ORDER BY popularity LIMIT 4');
$courses->execute(array($lang));

$users = $db->prepare('SELECT * FROM users WHERE id=? LIMIT 1');
$teachers = $db->prepare('SELECT * FROM users WHERE status="teacher" AND id=? LIMIT 1');

require 'elements/header.php'
?>

<!-- ##### Hero Area Start ##### -->
<section class="hero-area">
    <div class="hero-slides owl-carousel">

        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg-1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <h4 data-animation="fadeInUp" data-delay="100ms">All the courses you need</h4>
                            <h2 data-animation="fadeInUp" data-delay="400ms">Wellcome to our <br>Online University</h2>
                            <a href="#" class="btn academy-btn" data-animation="fadeInUp" data-delay="700ms">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/bg-2.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <h4 data-animation="fadeInUp" data-delay="100ms">All2 the courses you need</h4>
                            <h2 data-animation="fadeInUp" data-delay="400ms">Wellcome to our <br>Online University</h2>
                            <a href="#" class="btn academy-btn" data-animation="fadeInUp" data-delay="700ms">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Top Feature Area Start ##### -->
<div class="top-features-area wow fadeInUp" data-wow-delay="300ms">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="features-content">
                    <div class="row no-gutters">
                        <!-- Single Top Features -->
                        <div class="col-12 col-md-4">
                            <div class="single-top-features d-flex align-items-center justify-content-center">
                                <i class="icon-agenda-1"></i>
                                <h5>Online Courses</h5>
                            </div>
                        </div>
                        <!-- Single Top Features -->
                        <div class="col-12 col-md-4">
                            <div class="single-top-features d-flex align-items-center justify-content-center">
                                <i class="icon-assistance"></i>
                                <h5>Amazing Teachers</h5>
                            </div>
                        </div>
                        <!-- Single Top Features -->
                        <div class="col-12 col-md-4">
                            <div class="single-top-features d-flex align-items-center justify-content-center">
                                <i class="icon-telephone-3"></i>
                                <h5>Great Support</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Top Feature Area End ##### -->

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
        <div class="row">
            <div class="col-12">
                <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="800ms">
                    <a href="testimonials.php" class="btn academy-btn">See More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Testimonials Area End ##### -->

<!-- ##### Top Popular Courses Area Start ##### -->
<div class="top-popular-courses-area section-padding-100-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                    <span>The Best</span>
                    <h3>Top Popular Courses</h3>
                </div>
            </div>
        </div>
        <div class="row">

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
                            <p><?= substr($cours['objectives'], 0, 200) ?>...</p>
                            <a href="course-details.php?id=<?= $cours['id'] ?>" class="btn academy-btn btn-sm">See More</a>
                        </div>
                        <div class="popular-course-thumb bg-img" style="background-image: url(img/courses/<?= $cours['descriptionImage'] ?>);"></div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>
</div>
<!-- ##### Top Popular Courses Area End ##### -->

<!-- ##### Partner Area Start ##### -->
<div class="partner-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="partners-logo d-flex align-items-center justify-content-between flex-wrap">
                    <a href="#"><img src="img/clients-img/partner-1.png" alt=""></a>
                    <a href="#"><img src="img/clients-img/partner-2.png" alt=""></a>
                    <a href="#"><img src="img/clients-img/partner-3.png" alt=""></a>
                    <a href="#"><img src="img/clients-img/partner-4.png" alt=""></a>
                    <a href="#"><img src="img/clients-img/partner-5.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Partner Area End ##### -->

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