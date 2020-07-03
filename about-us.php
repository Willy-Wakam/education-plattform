<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$teachers = $db->prepare('SELECT * FROM users WHERE status="teacher" LIMIT 4');
$teachers->execute();

$title = "Artefact | ABOUT-US";
require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>About Us</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### About Us Area Start ##### -->
<section class="about-us-area mt-50 section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                    <span>The Best</span>
                    <h3>We are the Academy</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                <p> At Artefact, code is our passion. For more than 5 years, we have been striving to create the most powerful and efficient development tool in the world.
                    By automating routine checks and corrections, our tools accelerate production and allow developers to grow, discover and create.
                    Therefore, our team set up this platform; in order to allow everyone to learn how to use the different resources offered by Artefact.
                </p>
            </div>
            <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="500ms">
                <p> Our mission is to
                    <ul>
                        <li><i class="fa fa-check-circle p-2 text-success"></i>Make tutorials with supporting exercises available to anyone wishing to learn to use Artefact</li>
                        <li><i class="fa fa-check-circle p-2 text-success"></i>Put you in contact with tutors capable of guiding you if necessary</li>
                        <li><i class="fa fa-check-circle p-2 text-success"></i>Provide you with partner training centers, where you will have better support</li>
                    </ul>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="about-slides owl-carousel mt-100 wow fadeInUp" data-wow-delay="600ms">
                    <img src="img/bg-img/bg-3.jpg" alt="">
                    <img src="img/bg-img/bg-2.jpg" alt="">
                    <img src="img/bg-img/bg-1.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### About Us Area End ##### -->

<!-- ##### Team Area Start ##### -->
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

        <div class="row">
            <div class="col-12">
                <div class="view-all text-center wow fadeInUp" data-wow-delay="800ms">
                    <a href="teacher.php" class="btn academy-btn">All Teachers</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Features Area Start ##### -->

<?php require 'elements/footer.php' ?>