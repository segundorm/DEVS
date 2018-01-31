<?php

include "config.php";
include "functions.php";

$nome = trim($_POST['nome']);
$sobrenome = trim($_POST['sobrenome']);
$email = trim($_POST['email']);
$usuario = trim($_POST['usuario']);
$info = trim($_POST['info']);

/* checar erro nos campos */

if ((!$nome) || (!$sobrenome) || (!$email) || (!$usuario)){

	echo "ERRO: Voc&ecirc; n&atilde;o enviou as seguintes informa�&otilde;es requeridas para o cadastro! <br /> <br />";

	if (!$nome){

		echo "Nome &eacute; um campo requerido. <br />";

	}

	if (!$sobrenome){

		echo "Sobrenome &eacute; um campo requerido. <br />";

	}

	if (!$email){

		echo "Email &eacute; um campo requerido.<br />";

	}

	if (!$usuario){

		echo "Nome de Usu&aacute;rio &eacute; um campo requerido. <br />";

	}

	echo "<br />Preencha os campos necess&aacute;rios abaixo: <br /><br />";

	include "formulario_cadastro.php"; 

}
else{

	/* checa se o nome ou mail no bd */

	$sql_email_check = mysql_query("SELECT COUNT(usuario_id) FROM usuarios WHERE email='{$email}'");
	$sql_usuario_check = mysql_query("SELECT COUNT(usuario_id) FROM usuarios WHERE usuario='{$usuario}'");

	$eReg = mysql_fetch_array($sql_email_check);
	$uReg = mysql_fetch_array($sql_usuario_check);

	$email_check = $eReg[0];
	$usuario_check = $uReg[0];
	
	if (($email_check > 0) || ($usuario_check > 0)){

		echo "<strong>ERRO </strong>- Por favor corrija os seguintes erros abaixo: <br /> <br />";

		if ($email_check > 0){

		    echo "Este email ( <strong>".$email."</strong> ) j&aacute; est&aacute; sendo utilizado.<br />Por favor utilize outra conta de email! <br />";

		    unset($email);

		}

		if ($usuario_check > 0){

			echo "Este nome de usu&aacute;rio ( <strong>".$usuario."</strong> ) j&aacute; est&aacute; sendo utilizado.<br />Por favor utilize outro nome de usu&aacute;rio!<br />";

			unset($usuario);

		}

		echo "<br />";
		include "formulario_cadastro.php";

	}
	else
	{

		$email = strtolower(trim($_POST['email']));
		$char = "@";
		$pos = strpos($email, $char);

        if ($pos === false){

			echo "<strong>ERRO:</strong><br />";
			echo "O endere&ccedil;o de email [ <strong><em>".$email."</em></strong> ] que est&aacute; tentando utilizar n&atilde;o &eacute; v&aacute;lido.<br />";
			echo "Por favor, utilize um email v&aacute;lido.<br /><br />";
			include "formulario_cadastro.php"; 

        }else{

            $v_mail = verifica_email($email);

            if ($v_mail){

                /* Se passarmos por esta verifica��o ilesos � hora de finalmente cadastrar
	    	    os dados Vamos utilizar uma fun��o para gerar uma senha rand�mica�*/ 

				function makeRandomPassword(){

					$salt = "abchefghjkmnpqrstuvwxyz0123456789";
					srand((double)microtime()*1000000); 

					$i = 0;

					while($i <= 7){

						$num = rand() % 33;
						$tmp = substr($salt, $num, 1);
						$pass = $pass . $tmp;
						$i++;

					}

					return $pass;

				}

				$senha_randomica = makeRandomPassword();

				$senha = md5($senha_randomica);

				// Inserindo os dados no banco de dados

				$info = htmlspecialchars($info); 

				$sql = mysql_query("INSERT INTO usuarios (nome, sobrenome, email, usuario, senha, info, data_cadastro) 
									VALUES('{$nome}', '{$sobrenome}', '{$email}', '{$usuario}', '{$senha}', '{$info}', now())") 
									or die( mysql_error() );

				if (!$sql){

					echo "Ocorreu algum erro ao criar sua conta, por favor entre em contato com o Webmaster.";

				}
				else {

					$usuario_id = mysql_insert_id();

					// confirma cadastro email

					$headers = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\n";
					$headers .= "From: <conta_mail@cliente>"; // dominio do cliente

					$subject = "Confirma��o de cadastro";
					$mensagem = "Prezado <strong>$nome $sobrenome</strong>,
			
								<br />
			
								Obrigado pelo seu cadastro em nosso site, 
								<a href ='http://www.xupa.com'>www.xupa.com</a>!
						
								<br /><br />

								Para confirmar seu cadastro e ativar sua conta, podendo assim acessar �reas exclusivas, 
								por favor clique no link abaixo ou copie e cole o link na barra de endere�o do seu navegador.
						
								<br /><br /> 

								<a href ='http://www.xupa.com/ativar.php?id=$usuario_id&code=$senha'>
								http://www.xupa.com/ativar.php?id=$usuario_id&code=$senha
								</a>

								<br /> <br />

								Ap�s a ativa��o de sua conta, voc� poder� ter acesso ao conte�do exclusivo, 
								efetuando o login com os dados abaixo:
						
								<br /> <br /> 

								<strong>Usuario</strong>: {$usuario}
						
								<br /> 
						
								<strong>Senha</strong>: {$senha_randomica}
						
								<br /><br /> 

								Obrigado!<br /> <br /> 

								Webmaster<br /> <br /> <br /> 

								Esta � uma mensagem autom�tica, por favor n�o responda!";

					mail($email, $subject, $mensagem, $headers);

					echo "Foi enviado para seu email - ( ".$email." ) um pedido de confirma&ccedil;&atilde;o de cadastro, 
							por favor verifique e sigas as instru&ccedil;&otilde;es!";

				}

            }else{

                echo "<strong>ERRO:</strong><br />";
                echo "O endere&ccedil;o de email [ <strong><em>".$email."</em></strong> ] que est&aacute; tentando utilizar n&atilde;o &eacute; v&aacute;lido.<br />";
                echo "Por favor, utilize um email v&aacute;lido.<br /><br />";
				include "formulario_cadastro.php"; 

            }

        }

    }

}

?>