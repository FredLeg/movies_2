<?php
include_once 'header.php';

if (!isset($_GET['id'])) {
	exit('Undefined param id');
}

$id = intval($_GET['id']);

$query = $db->prepare('SELECT * FROM movies WHERE id = :id');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$movie = $query->fetch();

//debug($movie);

if (empty($movie)) {
	exit('Undefined movie');
}

$back_link = 'index.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
	$back_link = $_SERVER['HTTP_REFERER'];
}
?>
<a href="<?= $back_link ?>" class="btn btn-default" role="button">&laquo; Retour</a>

<hr>

<div class="row movie-container">
	<div class="col-xs-12 col-sm-9">
		<div class="media">
			<div class="media-left">
				<img src="<?= getCover($movie['id']) ?>">
			</div>
			<div class="media-body">
				<h2><?= $movie['title'] ?></h2>
				<hr>
				<p><strong>Date de sortie :</strong> <?= $movie['year'] ?> (<?= getDuration($movie['runtime']) ?>)</p>
				<p>
					<strong>Genres :</strong>&nbsp;
					<?= $movie['genres'] ?>
				</p>
				<p>
					<strong>Acteurs :</strong>&nbsp;
					<?= $movie['actors'] ?>
				</p>
				<p>
					<strong>Réalisateurs :</strong>&nbsp;
					<?= $movie['directors'] ?>
				</p>
				<hr>
				<blockquote>
					<p>
					<?= nl2br($movie['synopsis']) ?>
					</p>
				</blockquote>
			</div>
		</div>
	</div>

	<?php include 'sidebar-movie.php'; ?>

</div>

<?php include_once 'footer.php'; ?>