<?
	require_once '../public/common.php';
	require_once '../public/lkw.php';
	require_once '../dosql/mysql-1.0.php';

	$historyId = $_POST['historyId'];

	# 删除历史记录
	$sqlRes=dosql(array(
		'table'=>'history',
		'type'=>'delete',
		'where'=>'historyId='.$historyId,
		
	));

	$request = array(
		'code'=>0,
		'message'=>'删除成功!',
		'sqlRes'=>$sqlRes,
	);

	echo json_encode($request);
?>