{\rtf1\ansi\ansicpg1252\deff0\deflang1046{\fonttbl{\f0\fswiss\fcharset0 Arial;}}
{\*\generator Msftedit 5.41.15.1515;}\viewkind4\uc1\pard\f0\fs20 CREATE TABLE usuarios(  \par
     usuario_id int(5) NOT NULL auto_increment,  \par
     nome varchar(50) NOT NULL default '',  \par
     sobrenome varchar(50) NOT NULL default '',  \par
     email varchar(100) NOT NULL default '',  \par
     usuario varchar(32) NOT NULL default '',  \par
     senha varchar(32) NOT NULL default '',  \par
     info text NOT NULL,  \par
     nivel_usuario enum('0','1','2') NOT NULL default '0',  \par
     data_cadastro datetime NOT NULL default '0000-00-00 00:00:00',  \par
     data_ultimo_login datetime NOT NULL default '0000-00-00 00:00:00',  \par
     ativado enum('0','1') NOT NULL default '0',  \par
     PRIMARY KEY  (usuario_id)  \par
) ENGINE = MYISAM CHARACTER SET latin1 COLLATE latin1_general_ci COMMENT = '';  \par
}
 