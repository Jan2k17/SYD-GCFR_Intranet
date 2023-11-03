<?php
	error_reporting(0);
	require('config.php');
	require('functions.php');
	require('rest.php');
	require('steamauth/steamauth.php');
	include('steamauth/userInfo.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>GCFR | INTRANET</title>
	
	<?php
		if($_GET['p'] == "calendar"){
			?>
				<link href="calendar.css" rel="stylesheet" type="text/css">
			<?php
		}
		if($_GET['p'] == "adm_addPage" || $_GET['p'] == "adm_addNews" || $_GET['p'] == "addEintrag"){
			?>
				<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
				<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
				<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
				
				<!-- summernote plugins -->
				<script type="text/javascript" src="/js/summernote/br.summernote.js"></script>
			<?php
		}
	?>
</head>

<body class="dark">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxs-capsule'></i>
            <div class="logo-name"><span>GC</span>FR</div>
        </a>
        <?php
			include('sidenav.php');
		?>
        <ul class="side-menu">
			<?php
				if(isset($_SESSION['steamid'])){
					?>
						<li><a href="?logout" class="logout"><i class='bx bx-log-out-circle'></i>Logout</a></li>
					<?php
				} else {
					?>
						<li><a href="?login" class="login"><i class='bx bx-log-in-circle'></i>Login</a></li>
					<?php
				}
			?>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
			<?php
				if(isset($_SESSION['steamid'])){
					?>
						<div class="dropdown">
							<button class="dropbtn" onclick="myFunction()">Administration
								<i class="fa fa-caret-down"></i>
							</button>
							<div class="dropdown-content" id="myDropdown">
								<ul>
									<?php
										/*if(get_mediclevel($_SESSION['steamid']) == get_setting("addpage")){
											?>
												<li><a href="?p=adm_addPage"><i class='bx bx-plus' ></i>Seite erstellen</a></li>
											<?php
										}
										if(get_mediclevel($_SESSION['steamid']) == get_setting("listpage")){
											?>
												<li><a href="?p=adm_listPage"><i class='bx bx-list-ul' ></i>Seiten auflisten</a></li>
											<?php
										}
										if(get_mediclevel($_SESSION['steamid']) == get_setting("addnews")){
											?>
												<li><a href="?p=adm_addNews"><i class='bx bx-plus' ></i>News erstellen</a></li>
											<?php
										}
										//if(get_mediclevel($_SESSION['steamid']) == get_setting("listnews")){
										//	?>
										//		<li><a href="?p=adm_listNews"><i class='bx bx-list-ul' ></i>News auflisten</a></li>
										//	<?php
										//}
										if(get_mediclevel($_SESSION['steamid']) == get_setting("editsettings")){
											?>
												<li><a href="?p=settings"><i class='bx bx-cog' ></i>Einstellungen</a></li>
											<?php
										}*/
									?>
									<li><a href="?p=adm_addPage"><i class='bx bx-plus' ></i>Seite erstellen</a></li>
									<!-- <li><a href="?p=adm_listPage"><i class='bx bx-list-ul' ></i>Seiten auflisten</a></li>-->
									<li><a href="?p=adm_addNews"><i class='bx bx-plus' ></i>News erstellen</a></li>
									<!-- <li><a href="?p=adm_listNews"><i class='bx bx-list-ul' ></i>News auflisten</a></li> -->
									<li><a href="?p=adm_listCrew"><i class='bx bx-group' ></i>Mitarbeiter-Administration</a></li>
									<li><a href="?p=adm_cal"><i class='bx bx-calendar' ></i>Kalender</a></li>
									<li><a href="?p=settings"><i class='bx bx-cog' ></i>Einstellungen</a></li>
								</ul>
							</div>
						</div>
					<?php
				}
				$sql = "SELECT * FROM pages WHERE navbar='top'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						?>
							<a href="?p=<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a>
						<?php
					}
				}
			?>
        </nav>

        <!-- End of Navbar -->

        <main>
			<?php
				if($_GET['p'] != ""){
					if(file_exists('pages/'.$_GET['p'].'.php')){
						include('pages/'.$_GET['p'].'.php');
					} else {
						if(get_site($_GET['p']) != "404") {
							$page = get_site($_GET['p']);
							?>
								<div class="header">
									<div class="left">
										<h1><?php echo $page[0]; ?></h1>
										<ul class="breadcrumb">
											<li><a href="index.php">
													INTRANET
												</a></li>
											/
											<li><a href="?p=<?php echo $_GET['p']; ?>" class="active"><?php echo $page[0]; ?></a></li>
										</ul>
									</div>
								</div>
								<div class="bottom-data">
									<?php
										echo $page[1];
									?>
								</div>
							<?php
						} else {
							?>
								<div class="header">
									<div class="left">
										<h1>ERROR</h1>
										<ul class="breadcrumb">
											<li><a href="#">
													Error
												</a></li>
											/
											<li><a href="#" class="active">404</a></li>
										</ul>
									</div>
								</div>
								<div class="bottom-data">
									<i class='bx bxs-sad'></i> Page not found<br />
								</div>
							<?php
						}
					}
				} else {
					if(isset($_SESSION['steamid'])){
						?>
							<div class="header">
								<div class="left">
									<h1>Dashboard</h1>
									<ul class="breadcrumb">
										<li><a href="#">
												INTRANET
											</a></li>
										/
										<li><a href="#" class="active">Dashboard</a></li>
									</ul>
								</div>
							</div>
							
							<ul class="insights">
								<li>
									<i class='bx bx-group'></i>
									<span class="info">
										<h3>
											<?php
												$sql_d_p = "SELECT COUNT(id) AS patientenc FROM patienten;";
												$result_d_p = $conn->query($sql_d_p);
												if ($result_d_p->num_rows > 0) {
													while($row = $result_d_p->fetch_assoc()) {
														echo $row["patientenc"];
													}
												} else {
													echo "0";
												}
											?>
										</h3>
										<p>Patienten</p>
									</span>
								</li>
								<li>
									<i class='bx bx-clipboard' ></i>
									<span class="info">
										<h3>
											<?php
												$sql_d_eb = "SELECT COUNT(id) AS berichte FROM patienten_eintragungen WHERE berichtart = 'einsatz';";
												$result_d_eb = $conn->query($sql_d_eb);
												if ($result_d_eb->num_rows > 0) {
													while($row = $result_d_eb->fetch_assoc()) {
														echo $row["berichte"];
													}
												} else {
													echo "0";
												}
											?>
										</h3>
										<p>Einsatzberichte</p>
									</span>
								</li>
								<li>
									<i class='bx bx-plus-medical' ></i>
									<span class="info">
										<h3>
											<?php
												$sql_d_mg = "SELECT COUNT(id) AS gutachten FROM patienten_eintragungen WHERE berichtart = 'medgut';";
												$result_d_mg = $conn->query($sql_d_mg);
												if ($result_d_mg->num_rows > 0) {
													while($row = $result_d_mg->fetch_assoc()) {
														echo $row["gutachten"];
													}
												} else {
													echo "0";
												}
											?>
										</h3>
										<p>Medizinische Gutachten</p>
									</span>
								</li>
								<li>
									<i class='bx bxs-skull' ></i>
									<span class="info">
										<h3>
											<?php
												$sql_d_tg = "SELECT COUNT(id) AS todg FROM patienten_eintragungen WHERE berichtart = 'tod';";
												$result_d_tg = $conn->query($sql_d_tg);
												if ($result_d_tg->num_rows > 0) {
													while($row = $result_d_tg->fetch_assoc()) {
														echo $row["todg"];
													}
												} else {
													echo "0";
												}
											?>
										</h3>
										<p>Todesbescheinigungen</p>
									</span>
								</li>
							</ul>
							<div class="bottom-data">
								<!-- NEWS -->
								<div class="reminders">
									<div class="header">
										<i class='bx bx-news' ></i>
										<h3>News</h3>
									</div>
									<ul class="task-list">
										<?php
											$sql_getNews = "SELECT * FROM news LIMIT 5;";
											$result_getNews = $conn->query($sql_getNews);
											if ($result_getNews->num_rows > 0) {
												while($row = $result_getNews->fetch_assoc()) {
													?>
														<li class="completed">
															<div class="task-title">
																<?php echo $row['content']; ?>
															</div>
															<div class="tooltip">
																<i class='bx bx-time'> <?php echo $row['erstellt']; ?></i>
																<span class="tooltiptext">Ersteller: <?php echo $row['ersteller']; ?></span>
															</div>
														</li>
													<?php
												}
											} else {
												?>
													<li class="not-completed">
														<div class="task-title">
															Keine News vorhanden
														</div>
														<div class="tooltip">
															<i class='bx bx-time'> 0000-00-00</i>
															<span class="tooltiptext">Ersteller: -/-</span>
														</div>
													</li>
												<?php
											}
										?>
									</ul>
								</div>
							</div>
						<?php
					}
				}
			?>
        </main>
    </div>
    <script src="index.js"></script>
</body>

</html>