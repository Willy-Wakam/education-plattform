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

$section = 'AtScript';

if(!empty($_GET['section'])){
	$section = $_GET['section'];
}

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

	<!-- Plugins CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.2/styles/atom-one-dark.min.css">

	<!-- Theme CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/theme.css">

</head>

<body class="docs-page">
	<header class="header fixed-top">
		<div class="branding docs-branding">
			<div class="container-fluid position-relative py-2">
				<div class="docs-logo-wrapper">
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible mr-2 d-xl-none" type="button">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<div class="site-logo"><a class="navbar-brand" href="index.php"><img class="logo-icon mr-2" src="assets/images/logo.png" alt="logo"><span class="logo-text">Artefact<span class="text-alt">Docs</span></span></a></div>
				</div>
				<!--//docs-logo-wrapper-->
				<div class="docs-top-utilities d-flex justify-content-end align-items-center">
					<div class="top-search-box d-none d-lg-flex">
						<form class="search-form">
							<input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
							<button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
						</form>
					</div>

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

	<div class="docs-wrapper">
		<div id="docs-sidebar" class="docs-sidebar">
			<div class="top-search-box d-lg-none p-3">
				<form action="#" method="get" class="search-form">
					<input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
					<button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
				</form>
			</div>
			<nav id="docs-nav" class="docs-nav navbar">
				<ul class="section-items list-unstyled nav flex-column pb-3">

					<?php foreach ($doc[0] as $key => $cath) : ?>
						<li class="nav-item section-title">
							<a class="nav-link <?= $cath == $section? 'active' : '' ?>" href="?section=<?= $cath ?>"><span class="theme-icon-holder mr-2"><i class="<?= $sect[strtolower(str_replace(" ", "", $cath))]['icon'] ?>"></i></span><?= $cath ?></a>
						</li>


						<?php if ($section == $cath): ?>
							<?php for ($i = 1; $i < count($doc); $i++) : ?>
								<?php if ($doc[$i]['categorie'] == $cath) : ?>
									<li class="nav-item"><a class="nav-link scrollto" href="#item-<?= $cath ?>-<?= $i ?>"><?= $doc[$i]['type'] ?></a></li>
								<?php endif ?>
							<?php endfor ?>
						<?php endif ?>
					<?php endforeach ?>

				</ul>

			</nav>
			<!--//docs-nav-->
		</div>
		<!--//docs-sidebar-->
		<div class="docs-content">
			<div class="container">

					<article class="docs-article" id="section-<?= $section ?>">
						<header class="docs-header">
							<h1 class="docs-heading"><?= $section ?></h1>
							<section class="docs-intro">
								<p><?= $sect[strtolower(str_replace(" ", "", $section))]['desc'] ?></p>
							</section>
							<!--//docs-intro-->
						</header>

						<?php for ($i = 1; $i < count($doc); $i++) : ?>
							<?php if ($doc[$i]['categorie'] == $section) : ?>
								<section class="docs-section" id="item-<?= $section ?>-<?= $i ?>">
									<h2 class="section-heading"><?= $doc[$i]['type'] ?></h2>
									<!-- <p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p> -->

									<div class="pl-5">

										<?php foreach ($doc[$i]['doc'] as $item) : ?>

											<?php if ($item['type'] == 'DocuText') : ?>
												<section class="docs-section" id="<?= $item['title'] ?>">
													<h3 class="section-heading text-secondary sub-section"><?= $item['title'] ?></h3>
													<p><?= $item['value'] ?></p>
												</section>
											<?php elseif ($item['type'] == 'DocuCodeShow') : ?>
												<section class="docs-section" id="<?= $item['title'] ?>">
													<h3 class="section-heading text-secondary sub-section"><?= $item['title'] ?></h3>
													<p><?= $item['value'] ?></p>

													<figure class="figure docs-figure py-3">
														<a href="assets/images/demo/<?= $doc[$i]['type'] ?>.gif" data-title="Image Lightbox Example" data-toggle="lightbox">
															<img class="figure-img img-fluid shadow rounded" src="assets/images/demo/<?= $doc[$i]['type'] ?>.gif" alt="">
														</a>
													</figure>

													<!-- At code -->
													<?php if (!(empty($item['code']['at']) || $item['code']['at'] == "...")) : ?>
														<h5>.at</h5>
														<div class="docs-code-block">
															<pre class="shadow-lg rounded"><code class="scss hljs"><?= $item['code']['at'] ?></code></pre>
														</div>
													<?php endif ?>

													<!-- Obj code -->
													<?php if (!(empty($item['code']['js']) || $item['code']['js'] == "...")) : ?>
														<h5>.atObj</h5>
														<div class="docs-code-block">
															<pre class="shadow-lg rounded"><code class="java hljs"><?= $item['code']['js'] ?></code></pre>
														</div>
													<?php endif ?>

													<!-- AtStyle code -->
													<?php if (!(empty($item['code']['css']) || $item['code']['css'] == "...")) : ?>
														<h5>.atStyle</h5>
														<div class="docs-code-block">
															<pre class="shadow-lg rounded"><code class="scss hljs"><?= $item['code']['css'] ?></code></pre>
														</div>
													<?php endif ?>

												</section>
											<?php elseif ($item['type'] == 'DocuCode') : ?>
												<section class="docs-section" id="<?= $item['title'] ?>">
													<h3 class="section-heading text-secondary sub-section"><?= $item['title'] ?><span class="ml-2 type badge badge-info"><?= $item['inputType'] ?></span></h3>
													<p><?= $item['value'] ?></p>

													<?php if (!(empty($item['code']) || $item['code'] == "...")) : ?>
														<div class="docs-code-block">
															<pre class="shadow-lg rounded"><code class="json hljs"><?= $item['code'] ?></code></pre>
														</div>
													<?php endif ?>

												</section>
											<?php elseif ($item['type'] == 'CalloutNote') : ?>

												<div class="callout-block callout-block-info">
													<div class="content">
														<h4 class="callout-title">
															<span class="callout-icon-holder mr-1">
																<i class="fas fa-info-circle"></i>
															</span>
															<!--//icon-holder-->
															Note
														</h4>
														<p><?= $item['value'] ?></p>
													</div>
													<!--//content-->
												</div>
												<!--//callout-block-->

											<?php elseif ($item['type'] == 'CalloutWarning') : ?>

												<div class="callout-block callout-block-warning">
													<div class="content">
														<h4 class="callout-title">
															<span class="callout-icon-holder mr-1">
																<i class="fas fa-bullhorn"></i>
															</span>
															<!--//icon-holder-->
															Warning
														</h4>
														<p><?= $item['value'] ?></p>
													</div>
													<!--//content-->
												</div>
												<!--//callout-block-->

											<?php elseif ($item['type'] == 'CalloutTip') : ?>

												<div class="callout-block callout-block-success">
													<div class="content">
														<h4 class="callout-title">
															<span class="callout-icon-holder mr-1">
																<i class="fas fa-thumbs-up"></i>
															</span>
															<!--//icon-holder-->
															Tip
														</h4>
														<p><?= $item['value'] ?></p>
													</div>
													<!--//content-->
												</div>
												<!--//callout-block-->

											<?php elseif ($item['type'] == 'CalloutDanger') : ?>
												
												<div class="callout-block callout-block-danger mr-1">
													<div class="content">
														<h4 class="callout-title">
															<span class="callout-icon-holder">
																<i class="fas fa-exclamation-triangle"></i>
															</span>
															<!--//icon-holder-->
															Danger
														</h4>
														<p><?= $item['value'] ?></p>
													</div>
													<!--//content-->
												</div>
												<!--//callout-block-->

											<?php endif ?>

										<?php endforeach ?>

									</div>

								</section>
								<!--//section-->
							<?php endif ?>
						<?php endfor ?>

					</article>
					<!--//docs-article-->

				<footer class="footer">
					<div class="container text-center py-5">
						<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
						<small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="theme-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
						<ul class="social-list list-unstyled pt-4 mb-0">
							<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCoCL2zXJgq5OCOmEhm_qLfA"><i class="fab fa-youtube fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="https://twitter.com/Artefactoffici1"><i class="fab fa-twitter fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="https://www.facebook.com/artefact.comp.9"><i class="fab fa-facebook fa-fw"></i></a></li>
							<li class="list-inline-item"><a href="https://www.instagram.com/artefactofficial"><i class="fab fa-instagram fa-fw"></i></a></li>
						</ul>
						<!--//social-list-->
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!--//docs-wrapper-->



	<!-- Javascript -->
	<script src="assets/plugins/jquery-3.4.1.min.js"></script>
	<!-- <script src="assets/plugins/popper.min.js"></script> -->
	<!-- <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  -->

	<!-- Bootstrap CDN -->
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


	<!-- Page Specific JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
	<script src="assets/js/highlight-custom.js"></script>
	<script src="assets/plugins/jquery.scrollTo.min.js"></script>
	<script src="assets/plugins/lightbox/dist/ekko-lightbox.min.js"></script>
	<script src="assets/js/docs.js"></script>

</body>

</html>