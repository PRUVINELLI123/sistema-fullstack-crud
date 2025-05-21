<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verificar se é edição
$produtoID = isset($_GET['id']) ? intval($_GET['id']) : null;
$nome = '';
$preco = '';
$peso = '';
$descricao = '';
$categoria_id = '';

if ($produtoID) {
    $sql = "SELECT * FROM produtos WHERE ProdutoID = $produtoID";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $p = mysqli_fetch_assoc($res);
        $nome = $p['Nome'];
        $preco = $p['Preco'];
        $peso = $p['Peso'];
        $descricao = $p['Descricao'];
        $categoria_id = $p['CategoriaID'];
    } else {
        header("Location: index.php?msg=produto_nao_encontrado");
        exit;
    }
}

// Buscar categorias para o select
$categorias = [];
$cat_res = mysqli_query($conn, "SELECT * FROM categorias ORDER BY Nome");
if ($cat_res && mysqli_num_rows($cat_res) > 0) {
    while ($cat = mysqli_fetch_assoc($cat_res)) {
        $categorias[] = $cat;
    }
}
?>

<main>
  <div id="produtos" class="tela">
    <form class="crud-form" method="post" action="action/produtos.php?acao=<?php echo $produtoID ? 'editar' : 'inserir'; ?>">
      <h2><?php echo $produtoID ? 'Editar Produto' : 'Cadastrar Produto'; ?></h2>

      <input type="text" name="nome" placeholder="Nome do Produto" value="<?php echo htmlspecialchars($nome); ?>" required>
      <input type="number" name="preco" step="0.01" placeholder="Preço" value="<?php echo htmlspecialchars($preco); ?>" required>
      <input type="number" name="peso" step="0.01" placeholder="Peso (g)" value="<?php echo htmlspecialchars($peso); ?>" required>
      <textarea name="descricao" placeholder="Descrição"><?php echo htmlspecialchars($descricao); ?></textarea>

      <select name="categoria_id" required>
        <option value="">Selecione a Categoria</option>
        <?php foreach ($categorias as $cat): ?>
          <option value="<?php echo $cat['CategoriaID']; ?>" <?php echo ($cat['CategoriaID'] == $categoria_id ? 'selected' : ''); ?>>
            <?php echo htmlspecialchars($cat['Nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit"><?php echo $produtoID ? 'Atualizar' : 'Salvar'; ?></button>

      <?php if ($produtoID): ?>
        <input type="hidden" name="id" value="<?php echo $produtoID; ?>">
      <?php endif; ?>
    </form>
  </div>
</main>

<?php 
include_once './include/footer.php';
?>
