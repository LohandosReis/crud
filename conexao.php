<?php
// Define o endereço do servidor do banco de dados
$servidor = "localhost";

// Define o usuário do banco de dados
$usuario = "root";

// Define a senha do usuário (nesse caso está vazia)
$senha = "";

// Define o nome do banco de dados que será usado
$banco = "crud";

// Tenta se conectar ao banco de dados usando os dados acima
// A função mysqli_connect retorna a conexão se der certo, ou false se falhar
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se a conexão falhou
if (!$conexao) {
  // Se falhar, exibe uma mensagem de erro e encerra o script
  die("Erro de conexão com o banco. Detalhes: " . mysqli_connect_error());
}
