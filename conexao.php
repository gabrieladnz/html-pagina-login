<?php // > Incluir a tag PHP

// > implementar variáveis principais

$host = "localhost";
$usuario = "root";
$senha = "Admin01";
$bd = "site";

// > criar variável que armazena conexão com o BD

$mysqli = new mysqli($host, $usuario, $senha, $bd); // > não pode trocar a ordem

// > função que verifica erro na conexão

if ($mysqli->connect_errno)
    echo "Falha na conexão: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
