<?php // Tingyutter by Tingyu Studio
require ('settings.php'); // import Settings. ?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
	<title><?php echo Title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<link rel="stylesheet" href="asset/style.css">
	<link rel="shortcut icon" href="asset/icon.png">
	<link rel="apple-touch-icon" href="asset/icon.png">
	<script type="text/javascript" src="asset/tingyutter.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="one home">
		<h1><?php echo Title; ?></h1>
		<h2><?php echo Subtitle; ?></h2>
	</div>
	<?php 
	@$db=new mysqli('localhost',DBU,DBP,DBN);
	if (mysqli_connect_errno()) {echo 'Connection error. Please check Settings.'; exit;}
	$db->query("set names utf8");
	$q="select id, uid, tweet, time, pic from ".DBT." order by id desc";
	$r=$db->query($q); $n=$r->num_rows; if ($n>0) :
		for ($i=0;$i<$n;$i++) : $rr=$r->fetch_assoc(); ?>
			<div class="one<?php echo ($i==$n-1)?' finale':''; ?>">
				<header class="header">
					<div class="avatar"><img src="bio/<?php echo $rr['uid']; ?>.jpg"></div>
					<div class="meta">
						<p class="author"><?php echo $au[$rr['uid']]; ?></p>
						<p class="time"><?php echo $rr['time']; ?></p>
					</div>
				</header>
				<div class="tweet">
					<?php if ($rr['pic']) : ?>
						<section id="image-frame-<? echo $rr['id']; ?>" class="img-frame" onclick="resize(<? echo $rr['id']; ?>);">
							<img src="<?php echo $rr['pic']; ?>">
							<?php if ($rr['tweet']) {echo "<p>".$rr['tweet']."</p>";} ?>
						</section>
					<?php else : ?><p><?php echo $rr['tweet']; ?></p><?php endif; ?>
				</div>
			</div>
		<?php endfor; $r->free(); $db->close();
	else : ?>
		<div class="one"><p class="none">No tweet yet.</p></div>
	<? endif; ?>
</div>
</body>
</html>