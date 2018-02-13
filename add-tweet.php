<?php // Adding New Tweet page for Tingyutter by Tingyu Studio
	require ('settings.php'); // import Settings.
	require ('functions.php'); // import Functions.
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
	<title>New Tweet</title>
	<link rel="stylesheet" type="text/css" href="asset/style.css">
	<link rel="shortcut icon" href="asset/icon.png">
	<link rel="apple-touch-icon" href="asset/icon.png">
	<script type="text/javascript" src="asset/tingyutter.js"></script>
</head>
<body>
<div class="box">
<?php @$tw=$_POST['tweet']; @$pw=$_POST['password'];

// Before login password.
if (!isset($tw) && !isset($pw)) : ?>
	<form class="center line" method="post">
		<p><input name="password" type="password" placeholder="Password" autocomplete="off"></p>
		<p>
			<input class="button blue" type="submit" value="Login">&nbsp;
			<input class="button" type="button" value="Back" onclick="javascript:history.go(-1)">
		</p>
	</form>

<?php // Wrong login password.
elseif (!isset($tw) && $pw<>PSWD) : ?>
	<div class="center line">
		<p>Wrong Password!</p>
		<p><button class="button" type="button" onclick="javascript:history.go(-1)">Back</button></p>
	</div>

<?php // Looged in, before twitting.
elseif (!isset($tw)) : ?>
	<form method="post" enctype="multipart/form-data">
		<textarea class="ta" name="tweet" placeholder="What's up?" autocomplete="off"></textarea>
		<p class="line">Author: 
			<select name="uid">
				<option value="0" selected>听雨</option>
				<option value="1">听雨的小号</option>
				<option value="2">听雨的喵</option>
			</select>&nbsp;
			<button id="pic-toggle" class="button" type="button" onclick="ptoggle();">添加图片</button>
		</p>
		<p id="pic" class="line" style="display: none;"><input id="imgfile" name="imgf" type="file"></p>
		<p class="line">
			<input class="button blue" type="submit" value="发布">&nbsp;&nbsp;
			<input class="button" type="reset" value="取消" onclick="javascript:location.href='index.php'">
		</p>
	</form>

<?php // Deleting tweet.
/* For me, I only need a simple function to delete my latest tweet.
   If you guys wanna be able to delete any designated tweet,
   you may consider adding certain button to tweets that belong to the logged-in user,
   as well as adding certain database operation. */
elseif (isset($tw) && $tw==DEL) :
	@$db=new mysqli('localhost',DBU,DBP,DBN);
	$rt=$db->query("select id from ".DBT." limit 1"); 
	if ($rt->num_rows) :
		$rm=$db->query("select max(id) from ".DBT); $rmr=$rm->fetch_array(); $rmx=$rmr['max(id)'];
		$qd="delete from ".DBT." where id = ".$rmx; $db->query($qd); // delete the latest tweet.
		$rm=$db->query("select max(id) from ".DBT); $rmr=$rm->fetch_array(); $rmx=$rmr['max(id)']+1;
		$db->query("alter table ".DBT." auto_increment=".$rmx); // set the correct 'auto_increment' id for future new tweet.
		$rm->free(); ?>
		<div class="center"><p>Latest tweet deleted. Back <a href="index.php">Home</a>.</p></div>
	<?php else : ?><div class="center"><p>No tweet to delete. Back <a href="index.php">Home</a>.</p></div>
	<?php endif; $rt->free(); $db->close(); 

// Add new tweet
elseif (isset($tw)) : 
	@$imgf=$_FILES['imgf']; @$uid=$_POST['uid']; @$tw=linkup(trim($tw));
	if ($imgf['error']==0) {
		if (($imgf['type']=='image/jpeg' || $imgf['type']=='image/pjpeg' || $imgf['type']=='image/png') && $imgf['size']<=5000000) {$img=imagination($imgf);}
		else {echo "<div class=\"center\"><p>Illegal image file.</p><p><button class=\"button\" type=\"button\" onclick=\"javascript:history.go(-1)\">Back</button></p></div>"; exit;}
	}
	elseif (!$tw) {echo "<div class=\"center\"><p>Empty tweet.</p><p><button class=\"button\" type=\"button\" onclick=\"javascript:history.go(-1)\">Back</button></p></div>"; exit;}
	@$db=new mysqli('localhost',DBU,DBP,DBN);
	if (mysqli_connect_errno()) {echo "Connection error. Please check Settings."; exit;}
	$db->query("set names utf8");
	if (!isset($img)) {$ik=""; $iv="";} else {$ik=", pic"; $iv=", '".$img."'";}
 	$dt=date("Y-m-d H:i:s"); 
	$qa="insert into ".DBT." (uid, tweet, time".$ik.") values (".$uid.", '".$tw."', '".$dt."'".$iv.")";
	$db->query($qa); $db->close(); ?>
	<div class="center"><p>Added one tweet. Back <a href="index.php">Home</a>.</p></div>
<?php endif; ?>
</div>
</body>
</html>