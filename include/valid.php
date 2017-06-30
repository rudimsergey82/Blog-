<?php
 //error_reporting(E_ALL);
 //ini_set('display_errors', 1);
require_once 'db.php';
$valid = $link->query("SELECT * FROM login_admin");
$res = $valid ->fetchAll();
for($i=0;$i<count($res);$i++){
    $true_login = $res[$i]['login'];
    $true_password = $res[$i]['password'];
}
if(!empty($_POST['sub'])) {
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        if (($_POST['name'] == $true_login) and ($_POST['password'] == $true_password)) {
            $_SESSION['logined'] = true;
            $_SESSION['user'] = $true_login;
        } else $error_login = "Не верный логин или пароль";
    } else $error_login = "Поля не могут быть пустыми";
}
if(isset($_GET['exit'])) {
    session_destroy();
    #redirect
    header('Location: index.php');
    exit;
}
