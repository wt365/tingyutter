<?php // Settings for Tingyutter by Tingyu Studio

	// Site
	define('Title', 'Tingyutter'); // site title
	define('Subtitle', 'A twitter-like microblog by Tingyu'); // subtitle
	date_default_timezone_set('Asia/Shanghai'); // timezone


	// Database
	define('DBN', 'tingyutter'); // database name
	define('DBU', 'tytr_admin'); // database username
	define('DBP', '123456790JQKA'); // database user password
	define('DBT', 'Tweets'); // database table name


	// User Accounts
	define('PSWD', 'myloginpassword'); // screen login password
	/* For me, with one login password, 
	   I can access 3 profiles (sets of useruame & profile picture). 
	   So I simply use an array. */
	$au=['听雨','听雨的小号','听雨的喵'];
	// The correspondent profile pictures are located here: /bio/0.jpg, /bio/1.jpg, and /bio/2.jpg.

	/* For you guys, 
	   if you wanna have a more open system with unlimitted users possible, 
	   you may consider building a full signup/login system. */

	
	// Max image width
	define('MaxW', 900); // uploaded image wider than that will be compressed.

	// Magic delete word
	define('DEL', '$DELETE$LATEST$'); // tweet the magic word to delete the latest tweet.
?>