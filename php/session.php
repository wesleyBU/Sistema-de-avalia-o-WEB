<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION['curso']) || !isset($_SESSION['passwd'])) {
    header("Location: login.php?msg=Você%20deve%20fazer%20login!");
    session_destroy();
    die();
} else {
    if (isset($_SESSION['timeLogged']) && time() > $_SESSION['timeLogged']) {
        header("Location: login.php?msg=Hey ".$_SESSION['curso'].". Você%20ficou%20inativo%20mais%20de%201%20minuto!");
        unset($_SESSION);
        session_destroy();
        die();
    } else {
        $_SESSION['timeLogged'] = time() + 3600;
    }
}
