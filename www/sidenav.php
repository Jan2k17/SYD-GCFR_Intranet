<ul class="side-menu">
	<?php
		if(isset($_SESSION['steamid'])){
			?>
				<li <?php if($_GET['p'] == ""){echo 'class="active"';} ?>><a href="index.php"><i class="bx bxs-dashboard"></i>Dashboard</a></li>
				<li <?php if($_GET['p'] == "calendar"){echo 'class="active"';} ?>><a href="?p=calendar"><i class='bx bx-calendar'></i>Kalender</a></li>
				
				<!-- <li <?php if($_GET['p'] == "analytics"){echo 'class="active"';} ?>><a href="?p=analytics"><i class="bx bx-analyse"></i>Statistiken</a></li> -->
				<?php
					if(get_mediclevel($_SESSION['steamid']) >= get_setting("listpatienten")){
						?>
							<li <?php if($_GET['p'] == "patienten"){echo 'class="active"';} ?>><a href="?p=patienten"><i class="bx bx-group"></i>Patienten</a></li>
						<?php
					}
				?>
				
				<li <?php if($_GET['p'] == "listCrew"){echo 'class="active"';} ?>><a href="?p=listCrew"><i class="bx bx-group"></i>Mitarbeiter</a></li>
				
				<?php
					$sql = "SELECT * FROM pages WHERE navbar='side'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						echo '<li></li>';
						while($row = $result->fetch_assoc()) {
							?>
								<li <?php if($_GET['p'] == $row['url']){echo 'class="active"';} ?>><a href="?p=<?php echo $row['url']; ?>"><i class='bx bxs-right-arrow' ></i><?php echo $row['title']; ?></a></li>
							<?php
						}
					}
				?>
			<?php
		} else {
			?>
				<li <?php if($_GET['p'] == ""){echo 'class="active"';} ?>><a href="index.php"><i class="bx bxs-dashboard"></i>Home</a></li>
			<?php
		}
	?>
</ul>