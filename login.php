<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
if (isset($_SESSION['curso']) || isset($_SESSION['passwd'])) {
    if (isset($_SESSION['timeLogged']) && time() > $_SESSION['timeLogged']) {
        header("Location: login.php?msg=Hey " . $_SESSION['curso'] . ". Você%20ficou%20inativo%20mais%20de%201%20minuto!");
        unset($_SESSION);
        session_destroy();
        die();
    } else {
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html5>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <link rel="shortcut icon" type="imagem/x-icon" href="imagens/icon.ico"/>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/md5.min.js"></script>
        <meta name="author" content="Wesley, Luiz - SPI3B">
        <title>Login do toten</title>
    </head>
    <body>
        <div id="background">
            <img class="backgroundimg" src="imagens/fieb.jpg">
            <!--<video class="backgroundvideo" autoplay="" muted="" loop="" width="100%" height="100%" src="uploads/SPI/videos/backgroun.mp4"></video>-->
        </div>
        <div id="setup" style="background-color: rgba(255, 255, 255, 0.59);">
            <div id="logobackground">
                <!--<img class="imglogo" src="uploads/SPI/imagens/background.png">-->
            </div>
            <div id="content">
                <div id="logos">
                    <div class="logoleft">
                        <img class="logoleftimg" src="imagens/expotec2017.png">
                    </div>
                    <div class="logoright">
                        <img class="logorightimg" src="imagens/itbmoacyr.png">
                    </div>
                </div>
                <div id="questions">
                    <div id="variavel">

                        <div id="questionone" class="slideOpen">
                            <div class="opquestions">
                                <!--<h1 class="titlequestion">Autenticação necessária.</h1>-->
                                <div class="formulario">

                                    <form id="formlogin" method="POST" action="php/auth.php">
                                        <h1 class="titlequestion" style="text-align: center">Autenticação necessária.</h1>
                                        <label>Curso:</label></br>
                                        <input type="text" name="curso" id="inputcurso" maxlength="10" placeholder="Ex: SPI"/>
                                        </br>
                                        <label>Senha:</label></br>
                                        <input type="password" id="inputpasswd" name="senha" placeholder="**********"/>
                                        </br>
                                        <button type="submit">Autenticar</button>
                                        <div id="msg"><?php echo isset($_GET['msg']) ? $_GET['msg'] : NULL; ?></div>
                                    </form>
                                    <script type="text/javascript">
                                        $('#formlogin').on('submit', function (e) {
                                            if ($('#inputcurso').val() == "" && $('#inputpasswd').val() == "") {
                                                $('#msg').html('Digite o curso e senha!');
                                                e.preventDefault();
                                            } else if ($('#inputcurso').val() == "") {
                                                $('#msg').html('Digite o curso!');
                                                e.preventDefault();
                                            } else if ($('#inputpasswd').val() == "") {
                                                $('#msg').html('Digite a senha!');
                                                e.preventDefault();
                                            } else {
                                                $('#inputpasswd').val(md5($('#inputpasswd').val()));
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
