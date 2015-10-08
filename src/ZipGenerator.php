<?php

	$comp = $_GET['comparison'];

	if ($comp != "yes" )
	{
		$filename_plot1 = "../download/Publication.svg";
		$filename_plot2 = "../download/Funding.svg";
		$zipname = '../download/ScholarPlot-Export.zip';
	}
	else
	{
		$filename_plot1 = "../download/Publication_Compare.svg";
		$filename_plot2 = "../download/Funding_Compare.svg";
		$zipname = '../download/ScholarCompare-Export.zip';
	}

	if(isset($_POST['plot1']) && isset($_POST['plot2']))
	{
		$image1 = getImage($_POST['plot1']);
		$image2 = getImage($_POST['plot2']);

		// create directory to save images if it does not exist
		if(!is_dir('../download'))
			mkdir('../download');

		file_put_contents($filename_plot1, $image1);
		file_put_contents($filename_plot2, $image2);

		$files = array($filename_plot1, $filename_plot2);

		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
			$zip->addFile($file);
		}
		$zip->close();
		echo "success";
	}
	else {
		echo "error";
	}

	function getImage($plot) {
		$data = $plot;
		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);

		$data = base64_decode($data);
		return $data;
	}

?>