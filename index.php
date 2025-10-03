<?php
  include "conexao.php";

  $query = "SELECT * FROM usuarios";

  $resultado = mysqli_query($conexao, $query);


  if (mysqli_num_rows($resultado) > 0) {
    echo "<h1> Lista de usuários </h1> <br>";
    echo ("Número de usuários: <b>" . mysqli_num_rows($resultado) . "<b>" . "<br>");

    while ($usuario = mysqli_fetch_array($resultado)) {
      echo "Nome: " . $usuario["nome"] . "<br>";
      echo "Email: " . $usuario["email"] . "<br>";
      echo "Idade: " . $usuario["idade"] . "<br>";
    }
  } else {
    echo "Nenhum dado encontrado";
  }

