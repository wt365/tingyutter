<?php // functions for Tingyutter by Tingyu Studio

// formatting (long) links
function linkup($ss) {
	return preg_replace_callback('/https?:\/\/(?:www\.)?((?:[a-z0-9\-]+\.){1,4}[a-z]{2,6})((?:\/[\w\-\.\/]*)?)/i', function($matches) {
		return '<a href="'.$matches[0].'" target="_blank">'.$matches[1].((strlen($matches[2])>18)?(substr($matches[2],0,15).'...'):$matches[2]).'</a>';
	},$ss);
}

// process (and compress) uploaded image
function imagination($arr) { 
	$imgu="img/".date('ymdH-').rand(1000,9999).'-'.preg_replace('/[^a-z0-9-_.]/i','',$arr['name']);
	move_uploaded_file($arr["tmp_name"],$imgu);
	@$exif=exif_read_data($imgu);
	list($width,$height,$type)=getimagesize($imgu);
	if ($type==2 && isset($exif['Orientation']) && $exif['Orientation']==6) {$im=imagecreatefromjpeg($imgu); $im=imagerotate($im,-90,0); imagejpeg($im,$imgu,99); $temp=$width; $width=$height; $height=$temp;}
	if ($width>MaxW) {
		$imguu=preg_replace('/\./','-x.',$imgu);
		$w=MaxW; $h=floor($w*$height/$width);
		$thumb=imagecreatetruecolor($w, $h);
		switch ($type) {
			case 2: if(!isset($im)) {$im=imagecreatefromjpeg($imgu);} break;
			case 3: $im=imagecreatefrompng($imgu); break;
			default: echo "Wrong Format"; exit; break;
		}
		imagecopyresampled($thumb, $im, 0, 0, 0, 0, $w, $h, $width, $height);
		imagejpeg($thumb,$imguu,80); imagedestroy($im); $imgu=$imguu;
	}
	return $imgu;
}?>