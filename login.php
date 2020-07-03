<?php 
$title = "Artefact | LOGIN";
$error = null;

require_once '../utils/dbConfig.php';
require_once '../utils/auth.php';

if(is_connected()){
	redirect('index.php');
	exit();
}

if(array_not_empty_post(['email', 'password'])){
	$check = false;
	$id = null;
	$name = null;
	$profileImg = null;

	#check in database
	$query = $db->prepare('SELECT * FROM users WHERE email= ?');
	$query->execute([$_POST['email']]);
	$user = $query->fetch();
	$check = (password_verify($_POST['password'], $user['password']));

	if($check){
		logIn($user['id'], $user['name'], $_POST['email'], $user['password'], $user['profileImage'], $user['language']);
		redirect('index.php');
		exit();
	} else {
		$error = "Identification error";
	}
}

require 'elements/header.php' ?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="bradcumbContent">
            <h2>Login</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### LogIn Area Start ##### -->
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
								<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
								<a class="btn academy-btn btn-sm" href="registration.php">Create an Account</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="login_form_inner">
							<h3>Log in to enter</h3>
							<form class="row login_form" action="login.php" method="post" id="contactForm">
								<div class="col-md-12 form-group">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
								</div>
								<div class="col-md-12 form-group">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
								</div>
								<div class="col-md-12 form-group">
									<div class="creat_account">
										<input type="checkbox" id="f-option2" name="selector">
										<label for="f-option2">Keep me logged in</label>
									</div>
								</div>
								<div class="col-md-12 form-group">
									<button type="submit" value="submit" class="btn academy-btn btn-sm">Log In</button>
									<a href="#">Forgot Password?</a>
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
