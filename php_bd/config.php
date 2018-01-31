<?php

define('BD_USER', 'root'); // USE O TEU USUÁRIO DE BANCO DE DADOS
define('BD_PASS', 'Pmn@2016'); // USE A TUA SENHA DO BANCO DE DADOS
define('BD_NAME', 'test'); // USE O NOME DO TEU BANCO DE DADOS

$link= mysqli_connect('187.32.167.5', 'BD_USER', 'BD_PASS');
mysqli_select_db($link, 'BD_NAME');


?>