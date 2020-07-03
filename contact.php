<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | CONTACT";

$succes = null;

if (!empty($_POST['message'])) {
    $to = "theatcomp@gmail.com";
    $subject = "Contact | " . $_POST['name'];
    $txt = $_POST['message'];
    $headers = "From: " . $_POST['email'] . "\r\n" .
        "CC: edu-artefact.yo.fr";

    mail($to, $subject, $txt, $headers);

    redirect('contact.php');
    exit();
}

require 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
    <div class="bradcumbContent">
        <h2>Contact</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Google Maps ##### -->
<div class="map-area wow fadeInUp" data-wow-delay="300ms">
    <div id="googleMap"></div>
</div>

<!-- ##### Contact Area Start ##### -->
<section class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-content">
                    <div class="row">
                        <!-- Contact Information -->
                        <div class="col-12 col-lg-5">
                            <div class="contact-information wow fadeInUp" data-wow-delay="400ms">
                                <div class="section-heading text-left">
                                    <span>The Best</span>
                                    <h3>Contact Us</h3>
                                    <p class="mt-30">
                                        At Artefact we remain in a perspective of constant development, pushing the limits.
                                        That’s why everyone’s opinion matters to us. We’re really excited every time we get a message from users like you;
                                        because it shows that there are people who are interested in what we do and who share our vision.
                                    </p>
                                </div>

                                <!-- Contact Social Info -->
                                <div class="contact-social-info d-flex mb-30">
                                    <!-- <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a> -->
                                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="https://gitlab.com/theatcomp" target="_blank"><i class="fa fa-github"></i></a>
                                    <a href="https://www.instagram.com/artefactofficial/" target="_blank"><i class="fa fa-instagram"></i></a>
                                    <!-- <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> -->
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex">
                                    <div class="contact-icon mr-15">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <p>Kaiserslautern, Germany</p>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex">
                                    <div class="contact-icon mr-15">
                                        <i class="icon-telephone-1"></i>
                                    </div>
                                    <p>Main: <a class="text-primary" href="tel:+4917674355424">+4917674355424</a> <br> Office: <a class="text-primary" href="tel:+491775944689">+491775944689</a></p>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex">
                                    <div class="contact-icon mr-15">
                                        <i class="icon-contract"></i>
                                    </div>
                                    <p>theatcomp@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Form Area -->
                        <div class="col-12 col-lg-7">
                            <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                                <form action="contact.php" method="POST">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" require>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="E-mail" require>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message" require></textarea>
                                    <button class="btn academy-btn mt-30" type="submit">Contact Us</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->

<?php require 'elements/footer.php' ?>