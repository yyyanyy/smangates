<?
	#设置跨域
	header('Access-Control-Allow-Origin:*');

	#返回文本
	header('content-type:text/html;charset=UTF-8');

	#当前路径
	$publicPath = dirname(__file__);
	// 配置文件啊目录
	$configPath = '/config';
	// 转化缓存目录
	$cacheBasePath = '/compress';
	// 封面存放路径
	$posterPath = '/poster';

	$bookmarkPosterPath = '/poster/bookmark';

	// 采用网站外目录
	if (!is_dir('/app/php')) {
		// 在web环境
		$cacheBasePath = '/mnt/hhd-2t/01compress';
		// 封面存放路径
		$posterPath = '/mnt/hhd-2t/02poster';

		$bookmarkPosterPath = '/mnt/hhd-2t/02poster/bookmark';

		$configPath = '/mnt/hhd-2t/04config';
	} else {
		// 在docker环境
		if (!is_dir($cacheBasePath)) mkdir($cacheBasePath,0755,true);
		if (!is_dir($posterPath)) mkdir($posterPath,0755,true);
		if (!is_dir($bookmarkPosterPath)) mkdir($bookmarkPosterPath,0755,true);
	}

/**
 * 异步 扫描
 * @param  [type] $path    [description]
 * @param  [type] $pathId  [description]
 * @param  [type] $mediaId [description]
 * @return [type]          [description]
 */
function scan_path_exec($path,$pathId,$mediaId){
	global $publicPath;

	$command = "php ../scan/scan-path.php \"$path\" \"$pathId\" \"$mediaId\" \"$publicPath\"";

	pclose(popen('nohup '.$command.' & 2>&1','r'));
}

/**
 * 异步 转换
 * @param  [type] $chapterPath  [description]
 * @param  [type] $mediaId      [description]
 * @param  [type] $mangaId      [description]
 * @param  [type] $chapterId    [description]
 * @param  [type] $chapterType  [description]
 * @param  [type] $mangaCover   [description]
 * @param  [type] $chapterCover [description]
 * @param  [type] $userId       [description]
 * @return [type]               [description]
 */
function compress_exec($chapterPath,$mediaId,$mangaId,$chapterId,$chapterType,$mangaCover,$chapterCover,$userId){
	global $publicPath;

	$command = "php ../compress/compress.php \"$chapterPath\" \"$publicPath\" \"$mediaId\" \"$mangaId\" \"$chapterId\" \"$chapterType\" \"$mangaCover\" \"$chapterCover\" \"$userId\"";

	pclose(popen('nohup '.$command.' & 2>&1','r'));
}
?>