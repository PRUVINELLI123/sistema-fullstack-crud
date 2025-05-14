<?php 
// includes
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se está editando
$id = $_GET['id'] ?? '';
$nome = '';
$andar = '';
$cor = '';

if ($id) {
    $sql = "SELECT * FROM setor WHERE SetorID = $id";
    $resultado = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($resultado);
    if ($linha) {
        $nome = $linha['Nome'];
        $andar = $linha['Andar'];
        $cor = $linha['Cor'];
    }
}
?>

<main>
  <div id="setores" class="tela">
    <form class="crud-form" method="post" action="./action/setores.php?acao=<?= $id ? 'editar' : 'inserir' ?>">
      <h2><?= $id ? 'Editar' : 'Cadastro de' ?> Setores</h2>

      <?php if ($id): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
      <?php endif; ?>

      <input type="text" name="nome" placeholder="Nome do Setor" value="<?= htmlspecialchars($nome) ?>" required>
      <input type="text" name="andar" placeholder="Andar" value="<?= htmlspecialchars($andar) ?>" required>
      <input type="text" name="cor" placeholder="Cor" value="<?= htmlspecialchars($cor) ?>" required>

      <button type="submit">Salvar</button>
    </form>
  </div>
</main>

<?php 
include_once './include/footer.php';
?>
