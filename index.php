<?php
include "conexao.php";

$query = "SELECT * FROM usuarios";

$resultado = mysqli_query($conexao, $query);


if (mysqli_num_rows($resultado) > 0) {
  echo "<h1> Lista de usuários </h1> <br>";
  echo ("Número de usuários: <b>" . mysqli_num_rows($resultado) . "<b>" . "<br>");

  while ($usuario = mysqli_fetch_array($resultado)) {
    echo "<a href='editar.php?id=" . $usuario["id"] . "'>Editar usuário " . $usuario["nome"] . "</a> <br>";
    echo "<a href='excluir.php?id=" . $usuario["id"] . "' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir usuário " . $usuario["nome"] . "</a> <br>";
    echo "Nome: " . $usuario["nome"] . "<br>";
    echo "Email: " . $usuario["email"] . "<br>";
    echo "Idade: " . $usuario["idade"] . "<br>";
    echo "<br>";
  }
} else {
  echo "Nenhum dado encontrado";
}

?>

<button type="button"> <a href="novo-usuario.php">Adicionar Usuário</a></button>