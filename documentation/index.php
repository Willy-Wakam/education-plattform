<?php
require_once '../../utils/dbConfig.php';
require_once '../../utils/auth.php';


$doc = file_get_contents('data/doc.atDoc');
$doc = '{"doc":' . $doc . '}';
$doc = utf8_encode($doc);
$doc = json_decode($doc, true);
$doc = $doc['doc'];

$sect = file_get_contents('data/sectionDesc.json');
$sect = utf8_encode($sect);
$sect = json_decode($sect, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Artefact | Documentation</title>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="IDE, Web, Webdevelopement, UI, Software, Game, Application, Multiplateform, Design" name="keywords">
	<meta content="Create your own Web page, Software, Application and Game as fast as simple." name="description">

	<meta name="author" content="Artefact Company">

	<meta property="og:title" content="Artefact">
	<meta property="og:description" content="Create your own Web page, Software, Application and Game as fast as simple.">
	<meta property="og:image" content="https://artefact.yo.fr/education/img/core-img/logo.png">
	<meta property="og:url" content="https://artefact.yo.fr/">

	<meta name="twitter:title" content="Artefact">
	<meta name="twitter:description" content="Create your own Web page, Software, Application and Game as fast as simple.">
	<meta name="twitter:image" content="https://artefact.yo.fr/education/img/core-img/logo.png">
	<meta name="twitter:card" content="summary_large_image">

	<!-- Favicon -->
	<link rel="icon" href="assets/images/logo.png">
	<link rel="apple-touch-icon" href="assets/images/logo.png">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- FontAwesome JS-->
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/theme.css">

</head>

<body>
	<header class="header fixed-top">
		<div class="branding docs-branding">
			<div class="container-fluid position-relative py-2">
				<div class="docs-logo-wrapper">
					<div class="site-logo"><a class="navbar-brand" href="index.php"><img class="logo-icon mr-2" src="assets/images/logo.png" alt="logo"><span class="logo-text">Artefact<span class="text-alt">Docs</span></span></a></div>
				</div>
				<!--//docs-logo-wrapper-->
				<div class="docs-top-utilities d-flex justify-content-end align-items-center">

					<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
						<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCoCL2zXJgq5OCOmEhm_qLfA"><i class="fab fa-youtube fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/Artefactoffici1"><i class="fab fa-twitter fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://www.facebook.com/artefact.comp.9"><i class="fab fa-facebook fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/artefactofficial"><i class="fab fa-instagram fa-fw"></i></a></li>
					</ul>
					<!--//social-list-->
					<a href="https://artefact.yo.fr/#pricing" class="btn btn-primary d-none d-lg-flex">Download</a>
				</div>
				<!--//docs-top-utilities-->
			</div>
			<!--//container-->
		</div>
		<!--//branding-->
	</header>
	<!--//header-->


	<div class="page-header theme-bg-dark py-5 text-center position-relative">
		<div class="theme-bg-shapes-right"></div>
		<div class="theme-bg-shapes-left"></div>
		<div class="container">
			<h1 class="page-heading single-col-max mx-auto">Documentation</h1>
			<div class="page-intro single-col-max mx-auto">Everything you need to build your software, web site, application or game.</div>
			<div class="main-search-box pt-3 d-block mx-auto">
				<form action="docs-page.php" method="get" class="search-form w-100">
					<input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
					<button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
	<!--//page-header-->
	<div class="page-content">
		<div class="container">
			<div class="docs-overview py-5">
				<div class="row justify-content-center">

					<?php foreach ($doc[0] as $key => $cath) : ?>
						<div class="col-12 col-lg-4 py-3">
							<div class="card shadow-sm">
								<div class="card-body">
									<h5 class="card-title mb-3">
										<span class="theme-icon-holder card-icon-holder mr-2">
											<i class="<?= $sect[strtolower(str_replace(" ", "", $cath))]['icon'] ?>"></i>
										</span>
										<!--//card-icon-holder-->
										<span class="card-title-text"><?= $cath ?></span>
									</h5>
									<div class="card-text">
										<?= $sect[strtolower(str_replace(" ", "", $cath))]['desc'] ?>
									</div>
									<a class="card-link-mask" href="docs-page.php?section=<?= $cath ?>"></a>
								</div>
								<!--//card-body-->
							</div>
							<!--//card-->
						</div>
					<?php endforeach ?>

				</div>
				<!--//row-->
			</div>
			<!--//container-->
		</div>
		<!--//container-->
	</div>
	<!--//page-content-->

	<section class="cta-section text-center py-5 theme-bg-dark position-relative">
		<div class="theme-bg-shapes-right"></div>
		<div class="theme-bg-shapes-left"></div>
		<div class="container">
			<h3 class="mb-2 text-white mb-3">Start your professional career!</h3>
			<div class="section-intro text-white mb-3 single-col-max mx-auto">Would you like to become a PRO today and earn a living with Artefact by selling your Template or plugins or by getting a job as an Artefact expert?</div>
			<div class="pt-3 text-center">
				<a class="btn btn-light" href="http://store.artefact.yo.fr/section/pro.php">Get CoderPro<i class="fas fa-arrow-alt-circle-right ml-2"></i></a>
			</div>
		</div>
	</section>
	<!--//cta-section-->



	<footer class="footer">
		<div class="footer-bottom text-center py-5">
			<ul class="social-list list-unstyled pb-4 mb-0">
						<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCoCL2zXJgq5OCOmEhm_qLfA"><i class="fab fa-youtube fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/Artefactoffici1"><i class="fab fa-twitter fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://www.facebook.com/artefact.comp.9"><i class="fab fa-facebook fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/artefactofficial"><i class="fab fa-instagram fa-fw"></i></a></li>
			</ul>
			<!--//social-list-->
		</div>
	</footer>

	<!-- Javascript -->
	<script src="assets/plugins/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>