<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$producaoID = isset($_GET['id']) ? (int)$_GET['id'] : null;

$produtoID = '';
$funcionarioID = '';
$clienteID = '';
$dataProducao = '';
$dataEntrega = '';

if ($producaoID) {
    // Buscar produção para edição
    $sql = "SELECT * FROM producao WHERE ProducaoID = $producaoID";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $producao = mysqli_fetch_assoc($resultado);
        $produtoID = $producao['ProdutoID'];
        $funcionarioID = $producao['FuncionarioID'];
        $clienteID = $producao['ClienteID'];
        $dataProducao = $producao['DataProducao'];
        $dataEntrega = $producao['DataEntrega'];
    } else {
        header("Location: lista-producao.php?erro=Produção não encontrada!");
        exit;
    }
}

// Buscar funcionários para select
$funcionarios = [];
$resFun = mysqli_query($conn, "SELECT FuncionarioID, Nome FROM funcionarios ORDER BY Nome");
while ($f = mysqli_fetch_assoc($resFun)) {
    $funcionarios[] = $f;
}

// Buscar produtos para select
$produtos = [];
$resProd = mysqli_query($conn, "SELECT ProdutoID, Nome FROM produtos ORDER BY Nome");
while ($p = mysqli_fetch_assoc($resProd)) {
    $produtos[] = $p;
}

// Buscar clientes para select
$clientes = [];
$resCli = mysqli_query($conn, "SELECT ClienteID, Nome FROM clientes ORDER BY Nome");
while ($c = mysqli_fetch_assoc($resCli)) {
    $clientes[] = $c;
}
?>

<main>
  <div id="producao" class="tela">
    <form class="crud-form" action="action/producao.php?acao=<?php echo $producaoID ? 'editar' : 'inserir'; ?>" method="POST">
      <h2><?php echo $producaoID ? 'Editar Produção' : 'Cadastrar Produção'; ?></h2>

      <select name="funcionario_id" required>
        <option value="">Funcionário</option>
        <?php foreach ($funcionarios as $f): ?>
          <option value="<?php echo $f['FuncionarioID']; ?>" <?php if ($f['FuncionarioID'] == $funcionarioID) echo 'selected'; ?>>
            <?php echo htmlspecialchars($f['Nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="produto_id" required>
        <option value="">Produto</option>
        <?php foreach ($produtos as $p): ?>
          <option value="<?php echo $p['ProdutoID']; ?>" <?php if ($p['ProdutoID'] == $produtoID) echo 'selected'; ?>>
            <?php echo htmlspecialchars($p['Nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="cliente_id" required>
        <option value="">Cliente</option>
        <?php foreach ($clientes as $c): ?>
          <option value="<?php echo $c['ClienteID']; ?>" <?php if ($c['ClienteID'] == $clienteID) echo 'selected'; ?>>
            <?php echo htmlspecialchars($c['Nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="data_producao">Data da Produção</label>
      <input type="date" name="data_producao" value="<?php echo $dataProducao; ?>" required>

      <label for="data_entrega">Data da Entrega</label>
      <input type="date" name="data_entrega" value="<?php echo $dataEntrega; ?>" required>

      <?php if ($producaoID): ?>
        <input type="hidden" name="id" value="<?php echo $producaoID; ?>">
      <?php endif; ?>

      <button type="submit"><?php echo $producaoID ? 'Atualizar' : 'Salvar'; ?></button>
    </form>
  </div>
</main>

<?php 
include_once './include/footer.php';
?>
