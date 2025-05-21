<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Busca todos os usuários cadastrados
$sql = "SELECT UserID, nome, email FROM usuarios";
$result = $conn->query($sql);

// Usuário logado
$usuario_logado = $_SESSION['usuario'] ?? '';
?>

<main>
  <div class="tela usuarios">
    <h2>Usuários do Sistema</h2>

    <table border="1" cellpadding="8" style="margin: 0 auto; width: 80%; text-align: center;">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row['nome']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td>
              <a href="salvar-usuarios.php?id=<?php echo $row['UserID']; ?>" class="btn-acao editar">Editar</a>
              <a href="./action/usuarios.php?acao=excluir&id=<?php echo $row['UserID']; ?>" 
                 onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                 class="btn-acao excluir">Excluir</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

   </div>
</main>

<?php
include_once './include/footer.php';
?>
