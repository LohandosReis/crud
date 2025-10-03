<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
  die("Erro de conexão com o banco. Detalhes: " . mysqli_connect_error());
}

?>