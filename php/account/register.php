<?
	require_once '../public/common.php';
	require_once '../public/lkw.php';
	require_once '../dosql/mysql-1.0.php';

	// 获取post参数
	$userName = $_POST['userName'];
	$passWord = $_POST['passWord'];
	$passMd5 = md5($passWord);

	#执行注册
	$sqlRes=dosql(array(
		'table'=>'user',
		'type'=>'insert',
		'field'=>array('userName','passWord','registerTime','updateTime'),
		'value'=>array($userName,$passMd5,'now()','now()')
	),$dosqlUrl);

	$request = array(
		'code'=>0,
		'message'=>'注册成功!',
		'sqlRes'=>$sqlRes,
		);
	
	echo json_encode($request);
?>