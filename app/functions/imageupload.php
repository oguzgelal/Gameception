<?php

function validFile($file, $allowedSize=5000000, $allowedExt=array('png','jpg','jpeg','gif')){
	$temp = explode(".", $file["name"]);
	$extension = end($temp);
	if (!($file["size"] <= $allowedSize)){
		//echo "file too large";
	}
	else if (!in_array($extension, $allowedExt)){
		//echo "file extension not allowed";
	}
	else if ($file["error"] > 0){
		//echo "error";
	}
	return (($file["size"] <= $allowedSize) && in_array($extension, $allowedExt) && $file["error"] <= 0);
}

function moveFileTo($file, $dir){
	$temp = explode(".", $file["name"]);
	$extension = end($temp);
	$file['name'] = generateRandomString().".".$extension;
	while(file_exists($dir.$file['name'])){
		$file['name'] = generateRandomString().".".$extension;
	}
	if (!file_exists($dir.$file['name'])){
		move_uploaded_file($file["tmp_name"], $dir.$file['name']);
		return $file['name'];
	}
}
function removeOldPhoto($filename, $dir){
	if (file_exists($dir.$filename)){
		unlink($dir.$filename);
	}
}

?>