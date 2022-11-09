<?php
ob_start ('ob_gzhandler');
define("FOLDER_NAME",'scripts');
$js_original = FOLDER_NAME.'/'.$_GET['js'];
header("Content-type: text/javascript;  charset:UTF-8");
header('Content-Encoding: gzip');
header('Cache-Control: no-cache');
$offset = 60 * 60 * 60 * 60 ;
$ExpStr = 'Expires: '. gmdate('D, d M Y H:i:s', time() + $offset) . ' GMT';

if(!file_exists($js_original)) die ('alert(\'Javascript file error\')');
require('jsmin.php');
$minified = JSMin::minify(file_get_contents($js_original));
header($ExpStr);
echo $minified;

?>