<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verificar se estamos editando um usuário existente
$usuarioID = isset($_GET['id']) ? $_GET['id'] : null;
$nome = '';
$email = '';
$senha = ''; // senha não é mostrada por segurança

if ($usuarioID) {
    // Consultar o usuário no banco para editar
    $sql = "SELECT * FROM usuarios WHERE userid = $usuarioID";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $nome = $usuario['Nome'];
        $email = $usuario['Email'];
    } else {
        header("Location: lista-usuarios.php?erro=Usuário não encontrado!");
        exit;
    }
}
?>

<main>
  <!-- Tela CRUD para Cadastro/Editar Usuários -->
  <div id="usuarios" class="tela">
    <form class="crud-form" action="./action/usuarios.php?acao=<?php echo $usuarioID ? 'editar' : 'inserir'; ?>" method="POST">
      <h2><?php echo $usuarioID ? 'Editar Usuário' : 'Cadastrar Usuário'; ?></h2>
      
      <!-- Campo Nome -->
      <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" placeholder="Nome do Usuário" required>

      <!-- Campo Email -->
      <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email" required>

      <!-- Campo Senha -->
      <input type="password" name="senha" placeholder="<?php echo $usuarioID ? 'Nova Senha (opcional)' : 'Senha'; ?>" <?php echo $usuarioID ? '' : 'required'; ?>>

      <!-- Botão de Salvar -->
      <button type="submit"><?php echo $usuarioID ? 'Atualizar' : 'Salvar'; ?></button>

      <!-- Campo oculto para enviar o ID do usuário (para edição) -->
      <?php if ($usuarioID): ?>
        <input type="hidden" name="id" value="<?php echo $usuarioID; ?>">
      <?php endif; ?>
    </form>
  </div>
</main>

<?php 
// include do rodapé
include_once './include/footer.php';
?>
