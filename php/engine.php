<?php

require_once 'session.php';
require_once 'toten.php';
$toten = new Toten($_SESSION['curso'], $_SESSION['passwd']);

function getStatistics() {
    global $toten;
    $a = $toten->getStatic();
    if (!$a) {
        return json_encode(['error' => TRUE, 'msg' => $toten->getError()]);
    } else {
        $a['error'] = FALSE;
        return json_encode($a);
    }
}

function rec($dt) {
    global $toten;
    $a = [
        'nome' => $dt['nome'],
        'email' => $dt['email'],
        'sexo' => $dt['sexo'],
        'idade' => (int) $dt['idade'],
        'gostei' => (bool) (int) $dt['gostei'],
        'ngostei' => (bool) (int) $dt['ngostei'],
        'nfarei' => (bool) (int) $dt['nfarei'],
        'tfarei' => (bool) (int) $dt['tfarei'],
        'farei' => (bool) (int) $dt['farei']
    ];
    if ($toten->rec($a)) {
        return json_encode(['error' => false]);
    } else {
        return json_encode([['error'] => true, 'msg' => $toten->getError()]);
    }
}

header('Content-Type: application/json');
switch ($_POST['op']) {
    case 'recData':
        echo rec($_POST['data']);
        break;
    case 'statistics':
        echo getStatistics();
        break;
    default:
        echo json_encode(['error' => TRUE, 'msg' => 'Opção desconhecida!']);
        break;
}