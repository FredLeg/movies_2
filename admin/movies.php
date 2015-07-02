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
		echo $field_name.'<br/>';
	}
}

?>

<form class="form-horizontal" action="" method="POST" novalidate>

<?php
foreach($fields as $field) {

echo PHP_EOL;
?>
<div class="form-group">
	<label for="<?= $field ?>" class="col-sm-2 control-label"><?= $field ?></label>
	<div class="col-sm-3">
		<input type="text" id="<?= $field ?>" name="<?= $field ?>" class="form-control" placeholder="<?= $field ?>" value="">
	</div>
</div>
<?php } ?>

</form>

<?php
footer:
include_once 'partials/footer.php';