<?php
	error_reporting(E_ALL);
	require('inc/config.php');
	require('inc/functions.php');
	
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Intranet für das GCFR von switchyourdream.de">
	<meta name="author" content="Jan2k17">
	<meta name="keywords"
		content="admin dashboard, intranet, dashboard, mitarbeiter, syd, gcfr, switchyourdream, switchyourdream.de, syd gcfr, gcfr switchyourdream, gcfr switchyourdream.de">

	<!-- Favicon -->
	<link rel="icon" href="assets/img/brand/favicon.ico" type="image/x-icon" />

	<!-- Title -->
	<title>GCFR Intranet</title>

	<!-- Bootstrap css-->
	<link  id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

	<!-- Icons css-->
	<link href="assets/plugins/web-fonts/icons.css" rel="stylesheet" />
	<link href="assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="assets/plugins/web-fonts/plugin.css" rel="stylesheet" />

	<!-- Style css-->
	<link href="assets/css/style.css" rel="stylesheet">

	<!-- Select2 css-->
	<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet">
	
	<!-- Internal richtext css-->
	<link rel="stylesheet" href="assets/plugins/wysiwyag/richtext.css">
	
	<!-- Internal Sweet-Alert css-->
	<link href="assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">

</head>

<body class="ltr main-body leftmenu" id="global_body">

	<!-- Loader -->
	<div id="global-loader">
		<img src="assets/img/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->


	<!-- Page -->
	<div class="page">

		<!-- Main Header-->
		<div class="main-header side-header sticky">
			<div class="main-container container-fluid">
				<div class="main-header-left">
					<a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
					<div class="hor-logo">
						<a class="main-logo" href="index.php">
							<h2>GCFR</h2>
						</a>
					</div>
				</div>
				<div class="main-header-center">
					<div class="responsive-logo">
						<h2>GCFR</h2>
					</div>
				</div>
				<div class="main-header-right">
					<button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
						aria-expanded="false" aria-label="Toggle navigation">
						<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
					</button><!-- Navresponsive closed -->
					<div
						class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
						<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
							<div class="d-flex order-lg-2 ms-auto">
								<!-- Theme-Layout -->
								<div class="dropdown d-flex main-header-theme">
									<a class="nav-link icon layout-setting">
										<span class="dark-layout">
											<i class="fe fe-sun header-icons"></i>
										</span>
										<span class="light-layout">
											<i class="fe fe-moon header-icons"></i>
										</span>
									</a>
								</div>
								<!-- Theme-Layout -->
								<!-- Notification -->
								<div class="dropdown main-header-notification">
									<a class="nav-link icon" href="">
										<i class="fe fe-bell header-icons"></i>
										<?php
											if(countWarns($_SESSION['name']) != '0'){
												echo '<span class="badge bg-danger nav-link-badge">'.countWarns($_SESSION['name']).'</span>';
											}
										?>
									</a>
									<div class="dropdown-menu">
										<div class="main-notification-list">
											<div class="media new">
												<?php
													if(countWarns($_SESSION['name']) != '0'){
														echo '<div class="media-body">
															<p>Du hast '.countWarns($_SESSION['name']).' Verwarnung/en erhalten!</p>
														</div>';
													}
												?>
												
											</div>
										</div>
									</div>
								</div>
								<!-- Notification -->
								<!-- Profile -->
								<?php
									if(isset($_SESSION['name']) & isset($_SESSION['rang']) & isset($_SESSION['dienstnummer'])){
										?>
											<div class="dropdown main-profile-menu">
												<a class="d-flex" href="javascript:void(0)">
													<span class="main-img-user"><img alt="avatar"
															src="assets/img/users/1.jpg"></span>
												</a>
												<div class="dropdown-menu">
													<div class="header-navheading">
														<h6 class="main-notification-title"><?php echo $_SESSION['dienstnummer']." - ".$_SESSION['name']; ?></h6>
														<p class="main-notification-text">Dein Rang: <?php echo $_SESSION['rang']; ?></p>
													</div>
													<a class="dropdown-item border-top" href="?p=profile">
														<i class="fe fe-user"></i> Profil
													</a>
													<a class="dropdown-item" href="?logout">
														<i class="fe fe-power"></i> Abmelden
													</a>
												</div>
											</div>
										<?php
									}
								?>
								<!-- Profile -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Main Header-->

		<!-- Sidemenu -->
		<?php
			include('inc/sidenav.php');
		?>
		<!-- End Sidemenu -->

		<!-- Main Content-->
		<div class="main-content side-content pt-0">
			<div class="main-container container-fluid">
				<div class="inner-body">
					
					<!-- Page Header -->
					<?php include('inc/header.php'); ?>
					<!-- End Page Header -->
					
					<!--Row-->
					<?php
						if(!isset($_SESSION['username']) & !isset($_SESSION['rang'])){
							if(isset($_POST['submit']) and $_POST['submit'] == "login"){
								$username = $_POST['dienstnummer'];
								$passwort = md5($_POST['passwort']);
								
								$sql = "SELECT * FROM mitarbeiter WHERE dienstnummer = '$username' AND passwort = '$passwort';";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$_SESSION['dienstnummer'] = $username;
										$_SESSION['name'] = $row['name'];
										$_SESSION['rang'] = $row['rang'];
										
										if($passwort == md5("syd-gcfr")){
											echo '<meta http-equiv="refresh" content="2; URL=index.php?p=profile&password=y">';
										} else {
											echo '<meta http-equiv="refresh" content="2; URL=index.php">';
										}
										?>
											<div class="card alert-message">
												<div class="card-body">
													<div class="text-center text-white">
														<svg style="color: rgb(4, 255, 0);" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="40" preserveAspectRatio="xMidYMid meet" version="1.0">
															<defs>
																<clipPath id="id1">
																	<path d="M 2.847656 4.792969 L 26.796875 4.792969 L 26.796875 24.390625 L 2.847656 24.390625 Z M 2.847656 4.792969 " clip-rule="nonzero" fill="#04ff00"></path>
																</clipPath>
															</defs>
															<g clip-path="url(#id1)">
																<path fill="#04ff00" d="M 11.078125 24.3125 L 2.847656 15.890625 L 6.128906 12.53125 L 11.078125 17.597656 L 23.519531 4.875 L 26.796875 8.230469 Z M 11.078125 24.3125 " fill-opacity="1" fill-rule="nonzero"></path>
															</g>
														</svg>
														<h3 class="mt-4 mb-3">ANGEMELDET</h3>
														<p class="tx-18 text-white-50">Du hast dich erfolgreich angemeldet!</p>
														<a href="index.php" class="btn btn-danger">HOME</a>
													</div>
												</div>
											</div>
										<?php
									}
								} else {
									?>
										<div class="card alert-message">
											<div class="card-body">
												<div class="text-center text-white">
													<svg class="alert-icons" enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
															<path d="m491.38 157.66c-13.149-30.297-31.855-57.697-55.598-81.439-23.742-23.742-51.142-42.448-81.439-55.598-31.529-13.686-64.615-20.625-98.338-20.625s-66.809 6.939-98.338 20.625c-30.297 13.15-57.697 31.856-81.439 55.598s-42.448 51.142-55.598 81.439c-13.686 31.529-20.625 64.615-20.625 98.338s6.939 66.809 20.625 98.338c13.15 30.297 31.856 57.697 55.598 81.439s51.142 42.448 81.439 55.598c31.529 13.686 64.615 20.625 98.338 20.625s66.809-6.939 98.338-20.625c30.297-13.15 57.697-31.856 81.439-55.598s42.448-51.142 55.598-81.439c13.686-31.529 20.625-64.615 20.625-98.338s-6.939-66.809-20.625-98.338zm-235.38 334.34c-127.92 0-236-108.08-236-236s108.08-236 236-236 236 108.08 236 236-108.08 236-236 236z"></path>
															<path d="m451.98 173.8c-10.87-25.256-26.363-48.044-46.049-67.729-19.686-19.687-42.473-35.179-67.73-46.05-26.248-11.297-53.903-17.025-82.196-17.025-38.462 0-78.555 13.134-115.94 37.981-4.6 3.057-5.851 9.264-2.794 13.863 3.057 4.6 9.265 5.85 13.863 2.794 34.1-22.66 70.365-34.638 104.88-34.638 104.62 0 193 88.383 193 193s-88.383 193-193 193-193-88.383-193-193c0-34.504 11.975-70.771 34.629-104.88 3.056-4.601 1.804-10.807-2.796-13.863-4.602-3.056-10.808-1.803-13.863 2.797-24.84 37.397-37.97 77.489-37.97 115.94 0 28.293 5.728 55.948 17.025 82.196 10.87 25.256 26.363 48.044 46.049 67.729 19.686 19.686 42.473 35.179 67.729 46.049 26.249 11.298 53.904 17.026 82.197 17.026s55.948-5.728 82.196-17.025c25.256-10.87 48.044-26.363 67.729-46.049 19.686-19.686 35.179-42.473 46.049-67.729 11.298-26.249 17.026-53.904 17.026-82.197s-5.728-55.948-17.025-82.196z"></path>
															<path d="m312.56 256 41.716-41.716c7.559-7.553 11.722-17.597 11.722-28.284s-4.163-20.731-11.719-28.281c-7.557-7.557-17.6-11.719-28.281-11.719s-20.724 4.162-28.281 11.719l-41.719 41.719-41.719-41.719c-7.557-7.557-17.6-11.719-28.281-11.719s-20.724 4.162-28.278 11.716c-7.559 7.553-11.722 17.597-11.722 28.284s4.163 20.731 11.719 28.281l41.719 41.719-41.716 41.716c-7.559 7.553-11.722 17.597-11.722 28.284s4.163 20.731 11.719 28.281c7.557 7.557 17.601 11.719 28.281 11.719s20.724-4.162 28.281-11.719l41.719-41.719 41.719 41.719c7.557 7.557 17.601 11.719 28.281 11.719s20.724-4.162 28.278-11.716c7.559-7.553 11.722-17.597 11.722-28.284s-4.163-20.731-11.719-28.281l-41.719-41.719zm27.577 84.139c-3.78 3.779-8.801 5.861-14.139 5.861s-10.359-2.082-14.139-5.861l-48.79-48.79c-1.953-1.953-4.512-2.929-7.071-2.929s-5.119 0.976-7.071 2.929l-48.79 48.79c-3.78 3.779-8.801 5.861-14.139 5.861s-10.359-2.082-14.142-5.864c-3.777-3.775-5.858-8.795-5.858-14.136s2.081-10.361 5.861-14.139l48.79-48.79c3.905-3.905 3.905-10.237 0-14.142l-48.793-48.793c-3.777-3.775-5.858-8.795-5.858-14.136s2.081-10.361 5.861-14.139c3.78-3.779 8.801-5.861 14.139-5.861s10.359 2.082 14.139 5.861l48.79 48.79c3.905 3.905 10.237 3.905 14.143 0l48.79-48.791c3.779-3.778 8.8-5.86 14.138-5.86s10.359 2.082 14.142 5.864c3.777 3.775 5.858 8.795 5.858 14.136s-2.081 10.361-5.861 14.139l-48.79 48.791c-3.905 3.905-3.905 10.237 0 14.142l48.793 48.793c3.777 3.774 5.858 8.794 5.858 14.135s-2.081 10.361-5.861 14.139z"></path>
															<path d="m114 105c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10z"></path>
													</svg>
													<h3 class="mt-4 mb-3">ERROR</h3>
													<p class="tx-18 text-white-50">Oops!! Du hast versucht dich mit falschen Daten einzuloggen!</p>
													<a href="index.php" class="btn btn-danger">ZUR&Uuml;CK</a>
												</div>
											</div>
										</div>
									<?php
								}
							} else {
								?>
									<div class="row row-sm">
										<div class="col-sm-12 login_form ">
											<div class="main-container container-fluid">
												<div class="row row-sm">
													<div class="card-body mt-2 mb-2">
														<img src="assets/img/brand/logo.png" class=" d-lg-none header-brand-img text-start float-start mb-4" alt="logo">
														<div class="clearfix"></div>
														<form action="index.php" method="POST">
															<h5 class="text-start mb-2">Melde dich mit deiner Dienstnummer an</h5>
															<p class="mb-4 text-muted tx-13 ms-0 text-start">Signin to create, discover and connect with the global community</p>
															<div class="form-group text-start">
																<label>Dienstnummer</label>
																<input class="form-control" name="dienstnummer" type="number" min="0" max="999">
															</div>
															<div class="form-group text-start">
																<label>Passwort</label>
																<input class="form-control" name="passwort" placeholder="Gebe dein Passwort ein" type="password">
															</div>
															<button name="submit" value="login" class="btn ripple btn-main-primary btn-block">Anbmelden</button>
														</form>
														<div class="text-start mt-5 ms-0">
															<div class="mb-1">Passwort vergessen? Wende dich an deinen Vorgesetzten.</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
							}
						} else {
							if(isset($_GET['p'])){
								if(!file_exists('pages/'.$_GET['p'].'.php')){
									?>
										<div class="container ">
											<div class="construction1 text-center details text-white">
												<div class="">
													<div class="col-lg-12">
														<h1 class="tx-140 mb-0">404</h1>
													</div>
													<div class="col-lg-12 ">
														<h1>Oops.The Page you are looking  for doesn't  exit..</h1>
														<h6 class="tx-15 mt-3 mb-4 text-white-50">You may have mistyped the address or the page may have moved. Try searching below.</h6>
														<a class="btn ripple btn-success text-center mb-2" href="index.php">Back to Home</a>
													</div>
												</div>
											</div>
										</div>
									<?php
								} else {
									include('pages/'.$_GET['p'].'.php');
								}
							} elseif(isset($_GET['adm'])){
								if(!file_exists('adm/'.$_GET['adm'].'.php')){
									?>
										<div class="container ">
											<div class="construction1 text-center details text-white">
												<div class="">
													<div class="col-lg-12">
														<h1 class="tx-140 mb-0">404</h1>
													</div>
													<div class="col-lg-12 ">
														<h1>Oops.The Page you are looking  for doesn't  exit..</h1>
														<h6 class="tx-15 mt-3 mb-4 text-white-50">You may have mistyped the address or the page may have moved. Try searching below.</h6>
														<a class="btn ripple btn-success text-center mb-2" href="index.php">Back to Home</a>
													</div>
												</div>
											</div>
										</div>
									<?php
								} else {
									include('adm/'.$_GET['adm'].'.php');
								}
							} elseif(isset($_GET['aus'])){
								if(!file_exists('aus/'.$_GET['aus'].'.php')){
									?>
										<div class="container ">
											<div class="construction1 text-center details text-white">
												<div class="">
													<div class="col-lg-12">
														<h1 class="tx-140 mb-0">404</h1>
													</div>
													<div class="col-lg-12 ">
														<h1>Oops.The Page you are looking  for doesn't  exit..</h1>
														<h6 class="tx-15 mt-3 mb-4 text-white-50">You may have mistyped the address or the page may have moved. Try searching below.</h6>
														<a class="btn ripple btn-success text-center mb-2" href="index.php">Back to Home</a>
													</div>
												</div>
											</div>
										</div>
									<?php
								} else {
									include('aus/'.$_GET['aus'].'.php');
								}
							} else {
								?>
									<div class="list-group">
										<?php
											$sql = "SELECT * FROM news LIMIT 5";
											$result = $conn->query($sql);
											
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													?>
														<div class="card custom-card">
															<div class="card-body">
																<p class="mg-b-0"><?php echo $row['content']; ?></p>
															</div>
															<div class="card-footer">
																<?php echo $row['erstellt']; ?> von <?php echo $row['ersteller']; ?>
															</div>
														</div>
														</a>
													<?php
												}
											} else {
												?>
													<a href="#" class="list-group-item list-group-item-action active">
														<div class="d-flex w-100 justify-content-between">
															<h5 class="mb-1">News</h5>
															<small>-/-</small>
														</div>
														<p class="mb-1">Keine News gefunden!</p>
														<small>-/-</small>
													</a>
												<?php
											}
										?>
									</div>

								<?php
							}
							if(isset($_GET['logout'])){
								session_unset();
								session_destroy();
								?>
									<div class="card alert-message">
										<div class="card-body">
											<div class="text-center text-white">
												<svg style="color: rgb(4, 255, 0);" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="40" preserveAspectRatio="xMidYMid meet" version="1.0">
													<defs>
														<clipPath id="id1">
															<path d="M 2.847656 4.792969 L 26.796875 4.792969 L 26.796875 24.390625 L 2.847656 24.390625 Z M 2.847656 4.792969 " clip-rule="nonzero" fill="#04ff00"></path>
														</clipPath>
													</defs>
													<g clip-path="url(#id1)">
														<path fill="#04ff00" d="M 11.078125 24.3125 L 2.847656 15.890625 L 6.128906 12.53125 L 11.078125 17.597656 L 23.519531 4.875 L 26.796875 8.230469 Z M 11.078125 24.3125 " fill-opacity="1" fill-rule="nonzero"></path>
													</g>
												</svg>
												<h3 class="mt-4 mb-3">ABGEMELDET</h3>
												<p class="tx-18 text-white-50">Du hast dich erfolgreich abgemeldet!</p>
												<a href="index.php" class="btn btn-danger">HOME</a>
											</div>
										</div>
									</div>
								<?php
								echo '<meta http-equiv="refresh" content="3; URL=index.php">';
							}
						}
					?>
					<!-- Row end -->
				</div>
			</div>
		</div>
		<!-- End Main Content-->

		<!-- Main Footer-->
		<div class="main-footer text-center">
			<div class="container">
				<div class="row row-sm">
					<div class="col-md-12">
						<span>Copyright © 2023 <a href="javascript:void(0)">Jan2k17</a>. Designed by <a
								href="https://www.spruko.com/">Spruko</a> All rights reserved.</span>
					</div>
				</div>
			</div>
		</div>
		<!--End Footer-->

		<!-- Sidebar -->
		<div class="sidebar sidebar-right sidebar-animate">
			<div class="sidebar-icon">
				<a href="javascript:void(0)" class="text-end float-end text-dark fs-20" data-bs-toggle="sidebar-right"
					data-bs-target=".sidebar-right"><i class="fe fe-x"></i></a>
			</div>
			<div class="sidebar-body">
				<h5>Todo</h5>
				<div class="d-flex p-3">
					<label class="ckbox"><input checked type="checkbox"><span>Hangout With friends</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input checked type="checkbox"><span>System Updated</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input type="checkbox"><span>Do something more</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input type="checkbox"><span>System Updated</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top">
					<label class="ckbox"><input type="checkbox"><span>Find an Idea</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<div class="d-flex p-3 border-top mb-0">
					<label class="ckbox"><input type="checkbox"><span>Project review</span></label>
					<span class="ms-auto">
						<i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Edit"></i>
						<i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
							data-bs-placement="top" data-bs-original-title="Delete"></i>
					</span>
				</div>
				<h5>Overview</h5>
				<div class="p-4">
					<div class="main-traffic-detail-item">
						<div>
							<span>Founder &amp; CEO</span> <span>24</span>
						</div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="20"
								class="progress-bar progress-bar-xs wd-20p" role="progressbar"></div>
						</div><!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div>
							<span>UX Designer</span> <span>1</span>
						</div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="15"
								class="progress-bar progress-bar-xs bg-secondary wd-15p" role="progressbar"></div>
						</div><!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div>
							<span>Recruitment</span> <span>87</span>
						</div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45"
								class="progress-bar progress-bar-xs bg-success wd-45p" role="progressbar"></div>
						</div><!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div>
							<span>Software Engineer</span> <span>32</span>
						</div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25"
								class="progress-bar progress-bar-xs bg-info wd-25p" role="progressbar"></div>
						</div><!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div>
							<span>Project Manager</span> <span>32</span>
						</div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25"
								class="progress-bar progress-bar-xs bg-danger wd-25p" role="progressbar"></div>
						</div><!-- progress -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

	</div>
	<!-- End Page -->

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

	<!-- Jquery js-->
	<script src="assets/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap js-->
	<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Perfect-scrollbar js -->
	<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<!-- Sidemenu js -->
	<script src="assets/plugins/sidemenu/sidemenu.js"></script>
	
	<!-- Sidebar js -->
	<script src="assets/plugins/sidebar/sidebar.js"></script>

	<!-- Select2 js-->
	<script src="assets/plugins/select2/js/select2.min.js"></script>
	<script src="assets/js/select2.js"></script>
	
	<!-- Internal Datepicker js -->
	<script src="assets/plugins/model-datepicker/js/datepicker.js"></script>
	<script src="assets/plugins/model-datepicker/js/main.js"></script>

	<!-- Color Theme js -->
	<script src="assets/js/themeColors.js"></script>

	<!-- Sticky js -->
	<script src="assets/js/sticky.js"></script>
	
	<!-- Modal js -->
	<script src="assets/js/modal.js"></script>

	<!-- Custom js -->
	<script src="assets/js/custom.js"></script>
	
	<!-- INTERNAL WYSIWYG Editor JS -->
	<script src="assets/plugins/wysiwyag/jquery.richtext.js"></script>
	<script src="assets/plugins/wysiwyag/wysiwyag.js"></script>
	
    <!--- Internal Notify js -->
	<script src="assets/plugins/notify/js/notifIt.js" defer></script>
	<script src="assets/plugins/notify/js/notifit-custom.js" defer></script>
	
	<!-- Internal Sweet-Alert js-->
	<script src="assets/plugins/sweet-alert/sweetalert.min.js"></script>
	<script src="inc/js/jquery.sweet-alert.js"></script>


</body>

</html>