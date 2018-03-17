<?php

if (strlen($_POST['senha']) == 32) {
    date_default_timezone_set('America/Sao_Paulo');
    session_cache_expire(1440);
    session_start();
    $curso = $_POST['curso'];
    $passwd = $_POST['senha'];
    require_once 'toten.php';
    $toten = new Toten($curso, $passwd);
    if ($toten->status()) {
        $_SESSION['curso'] = $curso;
        $_SESSION['passwd'] = $passwd;
        $_SESSION['loggedIn'] = time();
        $_SESSION['timeLogged'] = time() + 60;
        header("Location: /index.php");
    } else {
        $msg = $toten->getError();
        header("Location: /login.php?msg=$msg");
    }
}else{
    header("Location: /login.php?msg=A%20autenticação%20não%20é%20segura!");
}