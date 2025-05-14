<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verificar se estamos editando um cargo existente
$cargoID = isset($_GET['id']) ? $_GET['id'] : null;
$nome = '';
$teto_salarial = '';

if ($cargoID) {
    // Consultar o cargo no banco para editar
    $sql = "SELECT * FROM cargos WHERE CargoID = $cargoID";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $cargo = mysqli_fetch_assoc($resultado);
        $nome = $cargo['Nome'];
        $teto_salarial = $cargo['TetoSalarial'];
    } else {
        // Caso o cargo não seja encontrado
        header("Location: lista-cargos.php?erro=Cargo não encontrado!");
        exit;
    }
}
?>
<main>
  <!-- Tela CRUD para Cadastro/Editar Cargos -->
  <div id="cargos" class="tela">
    <form class="crud-form" action="./action/cargos.php?acao=<?php echo $cargoID ? 'editar' : 'inserir'; ?>" method="POST">
      <h2><?php echo $cargoID ? 'Editar Cargo' : 'Cadastrar Cargo'; ?></h2>
      
      <!-- Campo Nome do Cargo -->
      <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome do Cargo" required>

      <!-- Campo Teto Salarial -->
      <input type="number" name="teto_salarial" value="<?php echo $teto_salarial; ?>" placeholder="Teto Salarial" required>

      <!-- Botão de Salvar -->
      <button type="submit"><?php echo $cargoID ? 'Atualizar' : 'Salvar'; ?></button>

      <!-- Campo oculto para enviar o ID do cargo (para edição) -->
      <?php if ($cargoID): ?>
        <input type="hidden" name="id" value="<?php echo $cargoID; ?>">
      <?php endif; ?>
    </form>
  </div>
</main>

<?php 
// include do rodapé
include_once './include/footer.php';
?>
