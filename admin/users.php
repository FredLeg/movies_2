<?php
include_once 'partials/header.php';
/*
foreach($fields as $fields){
	$$field = !empty($_POST[$field]) ? $_POST[$field] : '';
}
*/


if ( isset($_GET['id']) ) {

	$fields = getFields('users');
	showForm( $fields, $_GET['id'] );

} else {

	showTable( $table_name='users', $file_name='users' );

}
?>


<?php
include_once 'partials/footer.php';