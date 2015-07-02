<?php
include_once 'partials/header.php';

// echo true? 'ok':@_;

$pagi = pagination( 'movies' );

$query = $db->prepare('SELECT * FROM movies ORDER BY modified DESC LIMIT :start, :nb_items');
$query->bindValue('start', ($pagi['page'] - 1) * $pagi['nb_items_per_page'], PDO::PARAM_INT);
$query->bindValue('nb_items', $pagi['nb_items_per_page'], PDO::PARAM_INT);
$query->execute();
$movies = $query->fetchAll();
?>
<h1>Liste des films</h1>

<?php include 'partials/pagination.php' ?>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cover</th>
			<th>Title</th>
			<th>Genres</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($movies as $movie) { ?>
		<tr>
			<td><?= $movie['id'] ?></td>
			<td><img height="30" src="<?= getCover($movie['id']) ?>"></td>
			<td><?= $movie['title'] ?></td>
			<td><?= $movie['genres'] ?></td>
			<td>-</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php include 'partials/pagination.php' ?>

<?php
include_once 'partials/footer.php';