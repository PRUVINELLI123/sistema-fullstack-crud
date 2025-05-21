<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se é edição
$categoriaID = isset($_GET['id']) ? intval($_GET['id']) : null;
$nome = '';
$descricao = '';

if ($categoriaID) {
    $sql = "SELECT * FROM categorias WHERE CategoriaID = $categoriaID";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $cat = mysqli_fetch_assoc($res);
        $nome = $cat['Nome'];
        $descricao = $cat['Descricao'];
    } else {
        header("Location: index.php?msg=categoria_nao_encontrada");
        exit;
    }
}
?>

<main>
  <div id="categorias" class="tela">
    <form class="crud-form" method="post" action="action/categorias.php?acao=<?php echo $categoriaID ? 'editar' : 'inserir'; ?>">
      <h2><?php echo $categoriaID ? 'Editar Categoria' : 'Cadastrar Categoria'; ?></h2>

      <input type="text" name="nome" placeholder="Nome da Categoria" value="<?php echo htmlspecialchars($nome); ?>" required>
      <textarea name="descricao" placeholder="Descrição"><?php echo htmlspecialchars($descricao); ?></textarea>

      <button type="submit"><?php echo $categoriaID ? 'Atualizar' : 'Salvar'; ?></button>

      <?php if ($categoriaID): ?>
        <input type="hidden" name="id" value="<?php echo $categoriaID; ?>">
      <?php endif; ?>
    </form>
  </div>
</main>

<?php 
include_once './include/footer.php';
?>

