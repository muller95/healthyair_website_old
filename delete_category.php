<?php
	require_once('system_inits.php');

	if (!isset($_SESSION['uid']))
		exit(0);

	$user_id = $_SESSION['uid'];
	$category_id = $_POST['category_id'];

	$mysqli->autocommit(FALSE);

	$query = sprintf('DELETE FROM room_categories WHERE user_id=%d AND
		category_id=%d', $user_id, $category_id);
	$result_delete = $mysqli->query($query);

	$query = sprintf('UPDATE stations SET room_category=1 WHERE 
				room_category=%d;', $category_id);
	$result_update = $mysqli->query($query);
	if (!$result_delete || !$result_update) {
		$mysqli->rollback();
		fprintf($stderr, "Error on transaction: %s",  $mysqli->error);
	} else
		$mysqli->commit();
	
?>