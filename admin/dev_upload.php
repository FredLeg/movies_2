<?php
include_once 'partials/header.php';

debug( $_POST );
debug( $_FILES );

if ( !isset($_POST['image_data']) ) {
	?>

	<form enctype="multipart/form-data" method="post">
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
				<input name="image_data" type="file" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<input type="submit" value="Envoyer le fichier" />
			</div>
		</div>
	</div>
	</form>
	<?php
} else {
	?>
	<div class="col-sm-offset-2 col-sm-10">
	</div>
	<?php
}
?>


<?php
include_once 'partials/footer.php';