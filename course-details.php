<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | COURSE DETAILS";

if (!is_connected() || empty($_GET['id'])) {
	if (empty($_POST['id'])) {
		redirect('login.php');
		exit();
	}
}

if (!empty($_POST['message'])) {
	$query = $db->prepare('INSERT into comments (userId, courseId, comment) VALUES (?, ?, ?)');
	$query->execute([$_SESSION['edu-artefact']['user']['id'], $_POST['id'], $_POST['message']]);
	redirect('course-details.php?id=' . $_POST['id']);
	exit();
}


if (empty($_GET['id'])) {
	$id = $_POST['id'];
} else {
	$id = $_GET['id'];
}

$courses = $db->prepare('SELECT * FROM courses WHERE id = ?');
$courses->execute([$id]);

if ($courses->rowCount() == 0) {
	redirect('course.php');
	exit();
}

$course = $courses->fetch();

$teachers = $db->prepare('SELECT * FROM users WHERE status="teacher" AND id=?');
$teachers->execute([$course['teacherId']]);
$teacher = $teachers->fetch();

$comments = $db->prepare('SELECT * FROM comments WHERE replie=0 AND courseId=?');
$comments->execute([$course['id']]);

$replies = $db->prepare('SELECT * FROM comments WHERE replie=1 AND courseId=? AND repliedId=?');

$sendUsers = $db->prepare('SELECT * FROM users WHERE id=?');
$replieUsers = $db->prepare('SELECT * FROM users WHERE id=?');

require_once 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
	<div class="bradcumbContent">
		<h2>Course Details</h2>
	</div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area mt-50 section-padding-100">

	<!--================Course Details Area =================-->
	<section class="course_details_area p_120">
		<div class="container">
			<div class="row course_details_inner">
				<div class="col-lg-8">
					<div class="c_details_img video-container">
						<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= $course['videoLink'] ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Objectives</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Eligibility</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Course Outline</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="objctive_text">
								<?= $course['objectives'] ?>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="objctive_text">
								<?= $course['eligibility'] ?>
							</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div class="objctive_text">
								<ul class="list">
									<?php
									$outlines = explode(",", $course['outline']);
									foreach ($outlines as $outline) :
									?>
										<li><a href="#"><?= $outline ?></a></li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						<div class="tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
							<div class="comments-area">
								<h4><?= $comments->rowCount() ?> Comments</h4>

								<?php foreach ($comments as $comment) : ?>
									<?php
									$sendUsers->execute([$comment['userId']]);
									$sendUser = $sendUsers->fetch();
									$replies->execute([$course['id'], $comment['id']]);
									?>
									<div class="comment-list">
										<div class="single-comment justify-content-between d-flex">
											<div class="user justify-content-between d-flex">
												<div class="thumb col-4 col-md-2">
													<img src="img/profile/<?= $sendUser['profileImage'] ?>" alt="">
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
										$replieUsers->execute([$replie['userId']]);
										$replieUser = $replieUsers->fetch();
										?>
										<div class="comment-list left-padding">
											<div class="single-comment justify-content-between d-flex">
												<div class="user justify-content-between d-flex">
													<div class="thumb col-4 col-md-2">
														<img src="img/profile/<?= $replieUser['profileImage'] ?>" alt="">
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
								<form action="course-details.php" method="POST">
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
					</div>
				</div>
				<div class="col-lg-4">
					<div class="c_details_list">
						<ul class="list">
							<li><a href="#">Trainer’s Name <span><?= $teacher['name'] ?></span></a></li>
							<!--<li><a href="#">Course Fee <span>$230</span></a></li>
								<li><a href="#">Available Seats <span>15</span></a></li> --->
							<li><a href="#">Upload <span><?= $course['createDate'] ?></span></a></li>
							<li><a href="#">Language <span><?= $course['language'] ?></span></a></li>
							<li><a href="#">Level <span><?= $course['level'] ?></span></a></li>
							<li><a href="#">System <span><?= $course['system'] ?></span></a></li>
						</ul>
						<a class="main_btn" href="#">Enroll the Course</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Course Details Area =================-->

</div>
<!-- ##### Blog Area End ##### -->

<?php require_once 'elements/footer.php' ?>