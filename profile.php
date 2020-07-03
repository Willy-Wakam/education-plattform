<?php
require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

$title = "Artefact | PROFILE";

$query = $db->prepare('SELECT * FROM users WHERE email= ?');
$query->execute([$_SESSION['edu-artefact']['user']['email']]);
$user = $query->fetch();

$favorites = $db->prepare('SELECT * FROM favorite WHERE userId= ?');
$favorites->execute([$user['id']]);

$courses = $db->prepare('SELECT * FROM courses WHERE id= ?');

require_once 'elements/header.php' ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
	<div class="bradcumbContent">
		<h2>Profile</h2>
	</div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Register Area Start ##### -->
<div class="blog-area mt-50 section-padding-100">

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="pt-2 login_form_inner">
						<img class="rounded-circle pb-2 pr-5 pl-5 pt-2 w-75" src="img/profile/<?= $_SESSION['edu-artefact']['user']['profileImage'] ?>" alt="">
						<div class="w-100 row p-2 ml-0">
							<div class="col-12">
								<h6><?= $_SESSION['edu-artefact']['user']['name'] ?></h6>
							</div>
							<div class="col-12">
								<h7 class="badge badge-primary"><?= $_SESSION['edu-artefact']['user']['email'] ?></h7>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="p-2 login_form_inner">
						<!--------------------============ Tab =============------------>
						<div class="academy-tabs-content">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active show" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Your informations</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="tab--2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Your courses</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="tab--3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Edit</a>
								</li>
							</ul>

							<div class="tab-content mb-100" id="myTabContent">
								<div class="tab-pane fade active show" id="tab1" role="tabpanel" aria-labelledby="tab--1">
									<div class="academy-tab-content">
										<!-- Tab Text -->
										<div class="academy-tab-text">
											<ul class="list-group">
												<li class="list-group-item text-left"><span class="badge badge-primary font-weight-bold p-2">Name</span> <span class="ml-2"><?= $user['name'] ?></span></li>
												<li class="list-group-item text-left"><span class="badge badge-primary font-weight-bold p-2">Email</span> <span class="ml-2"><?= $user['email'] ?></span></li>
												<li class="list-group-item text-left"><span class="badge badge-primary font-weight-bold p-2">Language</span> <span class="ml-2"><?= $user['language'] ?></span></li>
												<li class="list-group-item text-left"><span class="badge badge-primary font-weight-bold p-2">Tel</span> <span class="ml-2"><?= $user['telephone'] ?></span></li>
												<li class="list-group-item text-left"><span class="badge badge-primary font-weight-bold p-2">Country</span> <span class="ml-2"><?= $user['country'] ?></span></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab--2">
									<div class="academy-tab-content">
										<!-- Tab Text -->
										<div class="academy-tab-text">
											<ul class="list-group list-group-flush">
												<?php foreach ($favorites as $favorite) :
													$courses->execute([$favorite['courseId']]);
													$cour = $courses->fetch(); ?>
													<a href="corses.php?id=<?= $cour['id'] ?>" class="list-group-item list-group-item-action text-left"><?= $cour['title'] ?></a>
												<?php endforeach ?>
											</ul>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab--3">
									<div class="academy-tab-content">
										<!-- Tab Text -->
										<div class="academy-tab-text">
											<p>3</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--------------------============== End Tab ==============------------>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

</div>
<!-- ##### Blog Area End ##### -->

<?php require 'elements/footer.php' ?>