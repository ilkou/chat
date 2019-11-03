<?php
include('auth.php');
session_start();
?>
<html><head>

</head>
<?PHP
$error = true;
if ($_POST['login'] && $_POST['passwd']) {
    if (auth($_POST['login'], $_POST['passwd']))
        $error = false;
}
if ($error == false) {
    $_SESSION['loggued_on_user'] = $_POST['login'];
?>
<body>
<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
</html></body>
<?php
}
else {
    $_SESSION['loggued_on_user'] = "";
    echo "ERROR\n";
}
?>
