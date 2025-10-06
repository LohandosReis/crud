<?php
// index.php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Cria uma query SQL para buscar todos os usuários, ordenando do mais recente para o mais antigo
$sql = "SELECT id, nome, email, idade FROM usuarios ORDER BY id DESC";

// Executa a query e guarda o resultado em $result
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Lista de Usuários - CRUD</title>
  <!-- Link para o arquivo CSS que vai deixar a tabela e botões estilizados -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <header>
      <h1>Agenda de Contatos (CRUD)</h1>
      <!-- Botão para adicionar um novo usuário -->
      <a class="btn-primary" href="novo-usuario.php">Novo Usuário</a>
    </header>

    <main>
      <!-- Verifica se a query retornou resultados -->
      <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Idade</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop para exibir cada usuário em uma linha da tabela -->
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <!-- htmlspecialchars previne ataques XSS, mostrando os dados como texto -->
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nome']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['idade']); ?></td>
                <td class="actions">
                  <!-- Botões para editar ou excluir o usuário -->
                  <a class="btn-edit" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                  <a class="btn-delete" href="excluir.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <!-- Caso não haja usuários no banco -->
      <?php else: ?>
        <p>Nenhum usuário encontrado. <a href="novo-usuario.php">Adicione o primeiro usuário</a>.</p>
      <?php endif; ?>
    </main>

    <footer>
      <p>Projeto CRUD - LTP III</p>
    </footer>
  </div>
</body>

</html>

<?php
// Fecha a conexão com o banco de dados (libera recursos)
mysqli_close($conexao);
?>