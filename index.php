<?php
require_once 'php/session.php';
require_once 'php/toten.php';
$toten = new Toten($_SESSION['curso'], $_SESSION['passwd']);
if ($toten->status()) {
    $dt = $toten->getStatic();
} else {
    $erro = $toten->getError();
}
?>
<!DOCTYPE html5>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <link rel="shortcut icon" type="imagem/x-icon" href="imagens/icon.ico"/>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>

        <meta name="author" content="Wesley, Luiz - SPI3B">
        <title>expoTEC toten</title>
    </head>
    <body>
        <div id="background">
            <video class="backgroundvideo" autoplay="" muted="" loop="" width="100%" height="100%" src="uploads/SPI/videos/background.mp4"></video>
        </div>
        <div id="setup">

            <div id="logobackground">
                <img class="imglogo" src="uploads/SPI/imagens/background.png">
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

                        <div id="questionone" class="slideOn">
                            <div class="opquestions">
                                <h1 class="titlequestion">Você gostou da exposição?</h1>
                                <div class="groupopquestions">
                                    <button id="btnhappy" class="btnquestion" data-type="gostei" data-id="imgbtnquestionhappy" data-src="imagens/yes.gif" ">
                                        <img class="imgbtnquestion" id="imgbtnquestionhappy" alt="SIM :)" src="imagens/yes1.png">
                                    </button>
                                    <button id="btnbad" class="btnquestion" data-type="ngostei" data-id="imgbtnquestionbad" data-src="imagens/not.gif" ">
                                        <img class="imgbtnquestion"id="imgbtnquestionbad" alt="NÃO :(" src="imagens/not0.png">
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="questiontwo" class="slideOff">
                            <div class="opquestions">
                                <h1 class="titlequestion">Pretende se candidatar ao curso?</h1>
                                <div class="groupopquestions">
                                    <button id="btnnot" data-type="nfarei" class="btnquestion" data-id="imgbtnquestionnot" data-src="imagens/not.gif" >
                                        <img class="imgbtnquestion" id="imgbtnquestionnot" alt="SIM :)" src="imagens/not0.png">
                                    </button>
                                    <button id="btnmaybe" data-type="tfarei" class="btnquestion" data-id="imgbtnquestionmaybe" data-src="imagens/talvez.gif">
                                        <img class="imgbtnquestion"id="imgbtnquestionmaybe" alt="Talvez '-'" src="imagens/talvez.png">
                                    </button>
                                    <button id="btnyes" data-type="farei" class="btnquestion" data-id="imgbtnquestionyes" data-src="imagens/yes.gif">
                                        <img class="imgbtnquestion"id="imgbtnquestionyes" alt="NÃO :(" src="imagens/yes1.png">
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="graphicstatistics" class="slideOff">
                            <div class="opquestions">
                                <h1 class="titlequestion">Estatisticas.</h1>
                                <div id="spacegraphics">
                                    <div class="partgraphic">
                                        <h2 class="titlegraphic">Exposição:</h2>
                                        <div class="graphic">
                                            <canvas id="canvas1" class="canvasgraphic"></canvas>
                                        </div>
                                    </div>
                                    <div class="partgraphic">
                                        <h2 class="titlegraphic">Candidatos ao curso:</h2>
                                        <div class="graphic">
                                            <canvas id="canvas2" class="canvasgraphic" ></canvas>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="newlester" class="slideOff">
                            <div class="opquestions">
                                <h1 class="titlequestion">Sobre o curso:</h1>

                                <div id="anwserquestion" style="display: block">
                                    <label style="font-family: sans-serif;font-size: 135%;">Você deseja receber informações?</label>
                                    <button id="positivenewlester" class="btnquestnewlest" type="button">Sim</button>
                                    <button id="negativenewlester" class="btnquestnewlest" type="button">Não</button>
                                </div>

                                <div id="formnewlester" class="formnewlester" style="display: none">
                                    <form id="sendformnewlester" class="formularionewlester">
                                        <h2 class="titlegraphic">Por favor, preencha o formulário:</h2>
                                        <label>Nome completo:</label><br>
                                        <input type="text" id="nomenl" minlength="9" maxlength="100" placeholder="Ex: Seu nome aqui.">
                                        <br>
                                        <br>
                                        <label>Sexo:</label><br>
                                        <select name="sexo" id="sexonl">
                                            <option value="">Escolha</option>
                                            <option value="f">Feminino</option>
                                            <option value="m">Masculino</option>
                                            <option value="o">Outros</option>
                                        </select>
                                        <br>
                                        <br>
                                        <label>Idade:</label><br>
                                        <input type="number" id="idadenl" name="idade" maxlength="3" placeholder="14">
                                        <br>
                                        <br>
                                        <label>Seu email:</label><br>
                                        <input type="email" id="emailnl" name="email" maxlength="100" placeholder="exemplo@provedor.com">
                                        <br>
                                        <br>
                                        <button type="submit">Enviar</button>
                                        <div id="msgform"></div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div id="thanksforfeedback" class="slideOff">
                            <div class="opquestions">
                                <h1 class="titlequestion">Obrigado pelo seu feedback!</h1>
                                <div class="contentbyebye">
                                    <img class="imgbyebye" src="imagens/tchau.gif">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="config">
                        <button class="tagbtnconfig" id="btnlogout" type="button">
                            <img class="imgconfig" src="imagens/close.png">
                        </button>
                        <button class="tagbtnconfig" id="btnstatistics" type="button">
                            <img class="imgconfig" src="imagens/statistics.png">
                        </button>
                        <button class="tagbtnconfig" id="btnhome" type="button">
                            <img class="imgconfig" src="imagens/vote.png">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
