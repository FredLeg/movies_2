<?php
include_once 'partials/header.php';


/*$desc = $db->query('DESC movies')->fetchAll();
foreach($desc as $key => $field) {
	echo $field['Field'].'|'.$field['Type'].'|'.$field['Null'].'<br>';
}
debug($desc);
goto footer;
*/

$fields = [
	'id'          => [ 'type' => 'int(11)',      'required' => true,  'maxlength' => '11'  ],
	'slug'        => [ 'type' => 'varchar(255)', 'required' => true,  'maxlength' => '255' ],
	'title'       => [ 'type' => 'text',         'required' => true,  'maxlength' => ''    ],
	'year'        => [ 'type' => 'int(11)',      'required' => true,  'maxlength' => '11'  ],
	'genres'      => [ 'type' => 'varchar(255)', 'required' => false, 'maxlength' => '255' ],
	'synopsis'    => [ 'type' => 'text',         'required' => false, 'maxlength' => ''    ],
	'directors'   => [ 'type' => 'varchar(255)', 'required' => false, 'maxlength' => '255' ],
	'actors'      => [ 'type' => 'varchar(255)', 'required' => false, 'maxlength' => '255' ],
	'writers'     => [ 'type' => 'varchar(255)', 'required' => false, 'maxlength' => '255' ],
	'runtime'     => [ 'type' => 'int(11)',      'required' => false, 'maxlength' => '11'  ],
	'mpaa'        => [ 'type' => 'varchar(25)',  'required' => false, 'maxlength' => '25'  ],
	'rating'      => [ 'type' => 'smallint(3)',  'required' => true,  'maxlength' => '3'   ],
	'popularity'  => [ 'type' => 'int(11)',      'required' => false, 'maxlength' => '11'  ],
	'modified'    => [ 'type' => 'datetime',     'required' => true,  'maxlength' => ''    ],
	'created'     => [ 'type' => 'datetime',     'required' => false, 'maxlength' => ''    ],
	'poster_flag' => [ 'type' => 'tinyint(1)',   'required' => true,  'maxlength' => '1'   ],
	'cover'       => [ 'type' => 'blob',         'required' => false, 'maxlength' => ''    ],
];
//debug($fields);

foreach($fields as $field_name => $_) {
	$$field_name = !empty($_POST[$field_name]) ? $_POST[$field_name] : '';
}

$errors = [];

if (empty($_POST)) {
	foreach($fields as $field_name => $field_params) {

		if ($field_params['required'] !== false && empty($_POST[$field_name])) {

			$error_label = !empty($field_params['error']) ? $field_params['error'] : $field_name.' is mandatory';

			$errors[$field_name] = $error_label;
		}
}

if (empty($errors)) {

		$query = $db->prepare('INSERT INTO movies SET slug = :slug, title = :title, year = :year, genres = :genres, synopsis = :synopsis, directors = :directors, actors = :actors, writers = :writers, runtime = :runtime, mpaa = :mpaa, rating = :rating, popularity = :popularity, poster_flag = :poster_flag, modified = NOW(), created = NOW()');
		$query->bindValue('slug', $slug);
		$query->bindValue('title', $title);
		$query->bindValue('year', $year);
		$query->bindValue('genres', $genres);
		$query->bindValue('synopsis', $synopsis);
		$query->bindValue('directors', $directors);
		$query->bindValue('actors', $actors);
		$query->bindValue('writers', $writers);
		$query->bindValue('runtime', $runtime);
		$query->bindValue('mpaa', $mpaa);
		$query->bindValue('rating', $rating);
		$query->bindValue('popularity', $popularity);
		$query->bindValue('poster_flag', $poster_flag);
		$query->execute();

		$result = $db->lastInsertId();

		if (empty($result)) {
			echo '<div class="alert alert-danger" role="danger">Une erreur est survenue</div>';
		} else {
			echo '<div class="alert alert-success" role="success">Le film a bien été ajouté</div>';
			echo redirectJs('movies.php');
		}
		goto footer;
	}
}

if (!empty($errors)) {
	echo '<div class="alert alert-danger" role="danger">';
	foreach($errors as $error) {
		echo $error.'<br>';
	}
	echo '</div>';
}

?>

<form class="form-horizontal" action="" method="POST" novalidate>

<?php
foreach($fields as $field_name => $field_params) {

	$required = $field_params['required'];
	$type = $field_params['type'];
	$maxlength = $field_params['maxlength'];
	$label = ucfirst(!empty($field_params['label']) ? $field_params['label'] : $field_name);

	echo PHP_EOL;

	if ($type == 'textarea') {
	?>
	<div class="form-group">
		<label for="<?= $field_name ?>" class="col-sm-2 control-label"><?= $label ?></label>
		<div class="col-sm-6">
			<textarea id="<?= $field_name ?>" name="<?= $field_name ?>" class="form-control" placeholder="<?= $label ?>" rows="5" style="resize: none;"><?= $$field_name ?></textarea>
		</div>
	</div>
	<?php } else if ($type == 'checkbox') { ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label for="<?= $label ?>">
					<input id="<?= $field_name ?>" type="checkbox" name="<?= $field_name ?>" value="1" <?= $$field_name ? 'checked' : '' ?>> <?= $label ?>
				</label>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="form-group">
		<label for="<?= $field_name ?>" class="col-sm-2 control-label"><?= $label ?></label>
		<div class="col-sm-6">
			<input type="text" id="<?= $field_name ?>" name="<?= $field_name ?>" class="form-control" placeholder="<?= $label ?>" value="<?= $$field_name ?>">
		</div>
	</div>
	<?php
	}
}
?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Envoyer</button>
		</div>
	</div>

</form>

<?php
footer:
include_once 'partials/footer.php';