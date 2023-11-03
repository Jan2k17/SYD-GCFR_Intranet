<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="header">
	<div class="left">
	<h1>News erstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ ADMIN / 
			<li><a href="#" class="active">News erstellen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<?php
		if(isset($_POST['submit'])){
			$title = $_POST['title'];
			$content = $conn -> real_escape_string($_POST['editordata']);
			$creator = $_POST['creator'];
			
			$sql = "INSERT INTO news (title, content, ersteller)
			VALUES ('".$title."', '".$content."', '".$creator."')";

			if ($conn->query($sql) === TRUE) {
				echo "News wurde erstellt!<br />";
			} else {
				echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
			}
		}
	?>
	<div class="orders">
		<form action="index.php?p=adm_addNews" method="POST">
			<div class="form-input">
				<input type="text" placeholder="Titel" name="title" required>
			</div>
			<div class="form-input">
				<input type="text" placeholder="Ersteller" name="creator" required>
			</div>
			
			<textarea id="summernote" name="editordata" required></textarea>
			
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