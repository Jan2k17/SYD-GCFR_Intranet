<?php
	if(isset($_GET['adm'])) {
		?>
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5">GCFR-Intranet</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">INTRANET / ADMINISTRATION</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($_GET['adm']); ?></li>
					</ol>
				</div>
			</div>
		<?php
	} else if(isset($_GET['p'])) {
		?>
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5">GCFR-Intranet</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">INTRANET</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($_GET['p']); ?></li>
					</ol>
				</div>
			</div>
		<?php
	} else if(isset($_GET['aus'])) {
		?>
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5">GCFR-Intranet</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">INTRANET / AUSBILDER-BEREICH</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($_GET['p']); ?></li>
					</ol>
				</div>
			</div>
		<?php
	} else {
		?>
			<div class="page-header">
				<div>
					<h2 class="main-content-title tx-24 mg-b-5">GCFR-Intranet</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">INTRANET</a></li>
						<li class="breadcrumb-item active" aria-current="page">DASHBOARD</li>
					</ol>
				</div>
			</div>
		<?php
	}
?>