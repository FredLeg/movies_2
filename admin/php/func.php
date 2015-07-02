<?php


function getFields( $table_name ){
	global $db;
	$desc = $db->query( 'DESC '. $table_name )->fetchAll();
	$fields = [];
	foreach($desc as $key => $field) {
		$fields[] = $field['Field'];
	}
	return $fields;
	}
function showForm( $fields, $id ) {
	global $db;
	$query = $db->prepare( 'SELECT * FROM users WHERE id = :id' );
	$query->bindValue(':id', intval($id), PDO::PARAM_INT);
	$query->execute();
	$row  = $query->fetch();
	echo '<form class="form-horizontal" action="" method="POST" novalidate>';
		foreach($fields as $field):
			echo PHP_EOL;
			?>
			<div class="form-group">
				<label for="<?= $field ?>" class="col-sm-2 control-label"><?= $field ?></label>
				<div class="col-sm-3">
					<input type="text" id="<?= $field ?>" name="<?= $field ?>" class="form-control" placeholder="<?= $field ?>" value="<?= $row[$field] ?>">
				</div>
			</div>
			<?php endforeach;
	?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Enregistrer</button>
		</div>
	</div>
	</form>
	<?php
	}
function toggleNavClassActive( $wanted_name ){
    $script_name = strtolower( $_SERVER['SCRIPT_NAME'] );
    if ( $script_name=='/'.$wanted_name.'.php' ) return ' class="active"';
    return '';
	}
function tabs( $nbr ) {
    return str_repeat( "\t", $nbr );
	}
function showTable( $table_name, $file_name ) {
	global $db;
	$fields = getFields($table_name);
	$query = $db->prepare(
		'SELECT * FROM '.$table_name.' LIMIT 100'
	);
	$query->execute();
	$count = $query->rowCount(); // TODO: pagination
	$rows  = $query->fetchAll();
	?>
	<table class="table table-hover">
	<thead>
		<tr>
<?php foreach($fields as $field) echo tabs(3).'<th>'.ucfirst($field).'</th>'.PHP_EOL; ?>
		</tr>
	</thead>
	<tbody>
<?php foreach($rows as $row) {
	echo tabs(2).'<tr>'.PHP_EOL;
	foreach($row as $key=>$field) {
		if ($key=='id') echo tabs(3).'<td><a href="'.$file_name.'.php?id='.$field.'">'.$field.'</a></td>'.PHP_EOL;
		else echo tabs(3).'<td>'.$field.'</td>'.PHP_EOL;
		}
	echo tabs(2).'</tr>'.PHP_EOL;
	}
?>
	</tbody>
	</table>
<?php
}

