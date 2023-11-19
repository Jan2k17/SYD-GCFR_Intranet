		<div class="sticky">
			<div class="main-menu main-sidebar main-sidebar-sticky side-menu">
				<div class="main-sidebar-header main-container-1 active">
					<div class="sidemenu-logo">
						<a class="main-logo" href="index.php">
							<img src="logo.png" class="header-brand-img desktop-logo" alt="logo">
						</a>
					</div>
					<div class="main-sidebar-body main-body-1">
						<div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
						<ul class="menu-nav nav">
						<?php
							if(isset($_SESSION['dienstnummer']) & isset($_SESSION['name'])){
								?>
									<li class="nav-header"><span class="nav-label">Dashboard</span></li>
									<li class="nav-item">
										<a class="nav-link" href="index.php">
											<span class="shape1"></span>
											<span class="shape2"></span>
											<i class="ti-home sidemenu-icon menu-icon "></i>
											<span class="sidemenu-label">Dashboard</span>
										</a>
									</li>
									<!-- ADMINISTRATION -->
									<?php
										if(nav_granted("showadmin", $_SESSION['dienstnummer'])){
											?>
												<li class="nav-item">
													<a class="nav-link with-sub" href="javascript:void(0)">
														<span class="shape1"></span>
														<span class="shape2"></span>
														<i  class="ti-layout sidemenu-icon menu-icon "></i>
														<span class="sidemenu-label">Administration</span>
														<i class="angle fe fe-chevron-right"></i>
													</a>
													<ul class="nav-sub">
														<li class="side-menu-label1"><a href="javascript:void(0)">Administration</a></li>
														<?php if(nav_granted("adddan", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?adm=dienstanweisungen">Dienstanweisung erstellen</a></li>'; } ?>
														<?php if(nav_granted("addmitar", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?adm=users">Mitarbeiter</a></li>'; } ?>
														<?php if(nav_granted("listausbildung", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?adm=ausbildungen">Ausbildungen</a></li>'; } ?>
														<?php if(nav_granted("addnews", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?adm=news">News</a></li>'; } ?>
														<?php if(nav_granted("editsettings", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?adm=settings">Einstellungen</a></li>'; } ?>
														<!-- <li class="nav-sub-item"><a class="nav-sub-link" href="?adm=kalender">Kalender</a></li> -->
													</ul>
												</li>
											<?php
										}
									?>
									<li class="nav-item">
										<a class="nav-link with-sub" href="javascript:void(0)">
											<span class="shape1"></span>
											<span class="shape2"></span>
											<i class="ti-image sidemenu-icon menu-icon "></i>
											<span class="sidemenu-label">Allgemeines</span>
											<i class="angle fe fe-chevron-right"></i>
										</a>
										<ul class="nav-sub">
											<li class="side-menu-label1"><a href="javascript:void(0)">Allgemeines</a></li>
											<li class="nav-sub-item"><a class="nav-sub-link" href="?p=dienstanweisungen">Dienstanweisungen</a></li>
											<!-- <li class="nav-sub-item"><a class="nav-sub-link" href="?p=kalender">Kalender</a></li> -->
											<?php if(nav_granted("addbericht", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?p=berichte">Einsatzberichte</a></li>'; } ?>
										</ul>
									</li>
									<?php
										if(istAusbilder($_SESSION['dienstnummer'])){
											?>
												<li class="nav-item">
													<a class="nav-link with-sub" href="javascript:void(0)">
														<span class="shape1"></span>
														<span class="shape2"></span>
														<i class="ti-image sidemenu-icon menu-icon "></i>
														<span class="sidemenu-label">Ausbilder-Bereich</span>
														<i class="angle fe fe-chevron-right"></i>
													</a>
													<ul class="nav-sub">
														<li class="side-menu-label1"><a href="javascript:void(0)">Ausbilder-Bereich</a></li>
														<li class="nav-sub-item"><a class="nav-sub-link" href="?aus=ausbildungen">Ausbildungen</a></li>
													</ul>
												</li>
											<?php
										}
									?>
									<li class="nav-item">
										<a class="nav-link with-sub" href="javascript:void(0)">
											<span class="shape1"></span>
											<span class="shape2"></span>
											<i class="ti-user sidemenu-icon menu-icon "></i>
											<span class="sidemenu-label">Patienten</span>
											<i class="angle fe fe-chevron-right"></i>
										</a>
										<ul class="nav-sub">
											<li class="side-menu-label1"><a href="javascript:void(0)">Patienten</a></li>
											<li class="nav-sub-item"><a class="nav-sub-link" href="?p=patienten">Patienten auflisten</a></li>
											<?php if(nav_granted("addpatient", $_SESSION['dienstnummer'])){ echo '<li class="nav-sub-item"><a class="nav-sub-link" href="?p=addPatient">Patient anlegen</a></li>'; } ?>
										</ul>
									</li>
								<?php
							}
						?>
						<div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
					</div>
				</div>
			</div>
		</div>