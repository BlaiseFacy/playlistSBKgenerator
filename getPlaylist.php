<?php

// Takes raw data from the request
$data = file_get_contents("php://input");

$filename = "filePlaylistSBK.tmp";

// Converts it into a PHP object
$playlist = json_decode($data);

if ($playlist <> "")
{
	$playlist = json_decode($data);
	$f = fopen($filename, 'w');
	for($i = 0; $i < count($playlist); ++$i)
	{
		fwrite($f, $playlist[$i]."\r\n");
	}
	fclose($f);
}

/*
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Length: ". filesize("$filename").";");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/octet-stream; "); 
header("Content-Transfer-Encoding: binary");
*/

readfile($filename);

?>
