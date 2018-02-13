// Tingyutter javascript by Tingyu Studio

// get element
function $x(o) {return document.getElementById(o);}

// image zoom.
function resize(n) {
	var k='image-frame-'+n;
	$x(k).style.width=($x(k).style.width=='')?'92%':'';
}

// image toggle.
function ptoggle() {
	$x('pic').style.display=($x('pic').style.display=='none')?'block':'none'; 
	$x('pic-toggle').innerHTML=($x('pic-toggle').innerHTML=='添加图片')?'取消图片':'添加图片'; 
	$x('imgfile').value='';
}