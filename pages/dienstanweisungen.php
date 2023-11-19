<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_GET['id'])){
		$sql = "SELECT * FROM dienstanweisungen WHERE id = '".$_GET['id']."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				?>
					<div class="card custom-card  bg-primary tx-white">
						<div class="card-body">
							<h5 class="main-content-label tx-white tx-medium mg-b-10">Dienstanweisung #<?php echo $row['id']; ?></h5>
							<p class="card-text"><?php echo $row['content']; ?></p>
						</div>
						<div class="card-footer">
							<h6 class="mb-0">Erstellt: <?php echo $row['erstellt']; ?> - Ersteller: <?php echo $row['ersteller']; ?></h6>
						</div>
					</div>
				<?php
			}
		} else {
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
		}
	} else {
		?>
			<div class="table-responsive border">
				<table class="table text-nowrap text-md-nowrap mg-b-0">
					<thead>
						<tr>
							<th></th>
							<th>Dienstanweisung</th>
							<th>Erstellt</th>
							<th>Ersteller</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT * FROM dienstanweisungen";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									?>
										<tr>
											<th scope="row">
												<a href="?p=dienstanweisungen&id=<?php echo $row['id']; ?>"><span class="ti ti-zoom-in"></span></a>
											</th>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['erstellt']; ?></td>
											<td><?php echo $row['ersteller']; ?></td>
										</tr>
									<?php
								}
							} else {
								
							}
						?>
						
					</tbody>
				</table>
			</div>
		<?php
	}
?>