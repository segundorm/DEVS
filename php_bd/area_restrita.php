<?php

session_start();

include "functions.php";

session_checker();

echo "(Mensagem exemplo)<br /><br />";
echo "<hr /><br /><br />";

echo "Bem vindo <strong>". $_SESSION['nome'] ." ". $_SESSION['sobrenome'] ."</strong>! <br />
	Você est&aacute; acessando &aacute;rea restrita para usu&aacute;rios cadastrados!<br /><br />";

echo "Seu n&iacute;vel de usu&aacute;rio &eacute; <strong>". $_SESSION['nivel_usuario']."</strong>.<br />
Com esse n&iacute;vel, voc&ecirc; tem permis&atilde;o de acesso &agrave; algumas &aacute;reas exclusivas do site.<br /><br />";

/*if($_SESSION['nivel_usuario'] == 0){

	echo "- <strong>SITE</strong><br /> - Acesso &agrave; &aacute;reas exclusivas do site<br />";
}

if($_SESSION['nivel_usuario'] == 1){

	echo "- <strong>PAINEL ADMIN</strong><br />Acesso total ao site e painel administrativo para gerenciar todos os usu&aacute;rios do site.<br /><br />";
}*/
 
echo "<a href=\"logout.php\">Sair</a>";

?>