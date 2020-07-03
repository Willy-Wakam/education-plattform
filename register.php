<?php 
$title = "Artefact | REGISTER";
$error = null;

require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';
require_once '../utils/functions.php';

if(is_connected()){
	redirect('index.php');
	exit();
}

if(!empty($_POST['pass']) & !empty($_POST['repPass'])){
	if($_POST['pass'] != $_POST['repPass']){
		$error = "The given Password don't match!";
	}
}

if(array_not_empty_post(['name', 'email', 'password']) & $error == null){
	$check = false;
	$id = null;
	$name = null;
	$profileImg = null;

	#check in database
	$query = $db->prepare('SELECT id FROM users WHERE email= ?');
	$query->execute([$_POST['email']]);
	$check = ($query->fetchColumn() == 0);

	if($check){
		$hashedPW = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$query = $db->prepare('INSERT into users (name, email, password) VALUES (?, ?, ?)');
		$query->execute([$_POST['name'], $_POST['email'], $hashedPW]);

		$query = $db->prepare('SELECT id FROM users WHERE email= ?');
		$query->execute([$_POST['email']]);
		$id = $query->fetch();

		logIn($id, $_POST['name'], $_POST['email'], $hashedPW, '', 'en');
		redirect('index.php');
		exit();
	} else {
		$error = "Identification error";
	}
}


require_once 'elements/header.php' ?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Register</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Register Area Start ##### -->
    <div class="blog-area mt-50 section-padding-100">
		<!--======== Check for error ==========-->
		<?php if ($error): ?>
			<div class="mr-2 ml-2 alert alert-danger">
				<?= $error ?>
			</div>
		<?php endif ?>
		<!--======== Check for error ==========-->
          
		<!--================Login Box Area =================-->
		<section class="login_box_area section_gap">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="login_box_img">
							<img class="img-fluid" src="img/login/login.jpg" alt="">
							<div class="hover">
								<h4>New to our website?</h4>
								<p>Create an account and start now to learn how to create your own software, applications, website and video games thanks to Artefact.</p>
								<a class="btn academy-btn btn-sm" href="registration.html">Login to your Account</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="login_form_inner">
							<h3>Create an Account</h3>
							<form class="row login_form" action="register.php" method="post" id="contactForm">
								<div class="col-md-12 form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
								</div>
								<div class="col-md-12 form-group">
									<input type="text" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
								</div>
								<div class="col-md-12 form-group">
									<input type="text" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
								</div>
								<div class="col-md-12 form-group">
									<input type="text" class="form-control" id="repPass" name="repPass" placeholder="Repeat Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Repeat Password'" required>
								</div>
								<div class="col-md-12 form-group">
									<input type="submit" value="submit" class="btn academy-btn btn-sm" value="register">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--================End Login Box Area =================-->
             
    </div>
    <!-- ##### Blog Area End ##### -->

<?php require 'elements/footer.php' ?>
