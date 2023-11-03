<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="header">
	<div class="left">
	<h1>Seite erstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ ADMIN / 
			<li><a href="#" class="active">Seite erstellen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<?php
		if(isset($_POST['submit'])){
			$title = $_POST['title'];
			$content = $conn -> real_escape_string($_POST['editordata']);
			$creator = $_POST['creator'];
			$url = $_POST['url'];
			$navbar = $_POST['navbar'];
			
			$sql = "INSERT INTO pages (title, url, content, creator, navbar)
			VALUES ('".$title."', '".$url."', '".$content."', '".$creator."', '".$navbar."')";

			if ($conn->query($sql) === TRUE) {
				echo "Seite wurde erstellt!<br />";
			} else {
				echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
			}
			//add_sites($title,$content,$creator,$url,$navbar);
		}
	?>
	<div class="orders">
		<form action="index.php?p=adm_addPage" method="POST">
			<div class="form-input">
				<input type="text" placeholder="Titel" name="title" required>
			</div>
			<div class="form-input">
				<input type="text" placeholder="?p=XXX" name="url" required>
			</div>
			<div class="form-input">
				<input type="text" placeholder="Ersteller" name="creator" required>
			</div>
			<div class="form-input">
				<select name="navbar">
					<option value="top" selected>Head-Navigation</option>
					<option value="side">Side-Navigation</option>
				</select>
			</div>
			
			<textarea id="summernote" name="editordata"></textarea>
			
			<div class="form-input">
				<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function() {
			$('#summernote').summernote({
				placeholder: 'Hello stand alone ui',
				tabsize: 2,
				height: 120,
				toolbar: [
				  ['style', ['style']],
				  ['font', ['bold', 'underline', 'clear']],
				  ['color', ['color']],
				  ['para', ['ul', 'ol', 'paragraph']],
				  ['table', ['table']],
				  ['insert', ['link', 'picture', 'video']],
				  ['view', ['fullscreen', 'codeview', 'help']]
				]
			  });
		});
	</script>
</div>