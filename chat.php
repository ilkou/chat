<?php
session_start();
date_default_timezone_set('Africa/Casablanca');
$path = "../private/chat";
if (!file_exists('../private'))
	mkdir('../private');
if (!file_exists($path))
	file_put_contents($path, "");
if ($_SESSION['loggued_on_user'] != "") {
	$fp = fopen($path, "r+");
	if (flock($fp, LOCK_SH))
	{
		$data = unserialize(file_get_contents($path));
		if ($data) {
			foreach ($data as $key => $value) {
				$time = date('G:i', $value['time']);
?>
<html>
<head><script langage="javascript">window.setInterval(function(){
  location.reload();
  }, 3000);</script></head>
<body>
[<?= $time?>] <b><?= $value['login']?></b>: <?= $value['msg']?><br />
</body></html>
<?php
			}
		}
		flock($fp, LOCK_UN);
	}
}
?>
