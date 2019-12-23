<?php
session_start();
date_default_timezone_set('Africa/Casablanca');
if ($_SESSION['loggued_on_user'] !== "") {
    $path = "../private/chat";
    if (!file_exists("../private"))
        mkdir("../private");
    if (!file_exists($path))
        file_put_contents($path, "");
    $fp = fopen($path, "r+");
    if (flock($fp, LOCK_EX))
    {
        $data = unserialize(file_get_contents($path));
        $user['login'] = $_SESSION['loggued_on_user'];
        $user['time'] = time();
        $user['msg'] = $_POST['msg'];
        $data[] = $user;
        file_put_contents($path, serialize($data));
        flock($fp, LOCK_UN);
    }
?>
<html>
<head><script langage="javascript">top.frames['chat'].location = 'chat.php';
</script></head>
<body>
<form method="post" action="speak.php">
Message: <input id="type" type="text" name="msg" />
<input type="submit" name="submit" value="OK" />
</form>
</body></html>
<?php
}
else
    echo "ERROR\n";
?>
