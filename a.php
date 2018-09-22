<?php // HTTP Headers for ZIP File Downloads


$filename = $_GET['filename'];


// http headers for zip downloads

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($filename));
ob_end_flush();
readfile($filename);
unlink($filename);



?>
