<?php
if ($_POST['submit'] !== "OK" || $_POST['login'] == "" || $_POST['oldpw'] == "" || $_POST['newpw'] == "" ) {
    echo "ERROR1\n";
}
else {
    $path = "../private/passwd";
    $data = unserialize(file_get_contents($path));
    if ($data == false) {
        echo "ERROR2\n";
        return (0);
    }
    else {
        $error = false;
        foreach ($data as $log => $pass) {
            if ($pass['login'] == $_POST['login']) {
                $error = true;
                if ($pass['passwd'] != hash('whirlpool', $_POST['oldpw']))
                    $error = false;
                if ($error == true) {
                    $data[$log]['passwd'] = hash('whirlpool', $_POST['newpw']);
                    file_put_contents($path, serialize($data)."\n");
                    header('Location: index.html');
                    echo "OK\n";
                    return (1);
                }
                break ;
            }
        }
    }
    echo "ERROR3\n";
    return (0);
}
?>
