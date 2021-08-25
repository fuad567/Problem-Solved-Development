<?php
	// WORK
	// header("Content-type: application/pdf");
	// header("Content-Disposition: inline; filename=filename.pdf");
	// @readfile('pdf/filename.pdf');

	// ATAU
	$file = 'pdf/filename.pdf';
	$filename = 'filename.pdf';
	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($file));
	header('Accept-Ranges: bytes');
	@readfile($file);

?>
