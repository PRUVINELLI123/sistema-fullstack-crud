<?php 
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$funcionarioID = isset($_GET['id']) ? $_GET['id'] : null;

// valores padrão (em branco)
$nome = '';
$data_nascimento = '';
$email = '';
$ramal = '';
$salario = '';
$sexo = '';
$cpf = '';
$rg = '';
$altura = '';
$cargo_id = '';
$setor_id = '';

if ($funcionarioID) {
    $sql = "SELECT * FROM funcionarios WHERE FuncionarioID = $funcionarioID";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $f = mysqli_fetch_assoc($resultado);
        $nome = $f['Nome'];
        $data_nascimento = $f['DataNascimento'];
        $email = $f['Email'];
        $ramal = $f['Ramal'];
        $salario = $f['Salario'];
        $sexo = $f['Sexo'];
        $cpf = $f['CPF'];
        $rg = $f['RG'];
        $altura = $f['Altura'];
        $cargo_id = $f['CargoID'];
        $setor_id = $f['SetorID'];
    } else {
        header("Location: funcionarios/index.php?msg=erro_nao_encontrado");
        exit;
    }
}
?>

<main>
  <div id="funcionarios" class="tela">
    <form class="crud-form" action="./action/funcionarios.php?acao=<?php echo $funcionarioID ? 'editar' : 'inserir'; ?>" method="POST">
      <h2><?php echo $funcionarioID ? 'Editar Funcionário' : 'Cadastrar Funcionário'; ?></h2>

      <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome" required>
      <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required>
      <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
      <input type="text" name="ramal" value="<?php echo $ramal; ?>" placeholder="Ramal" maxlength="4">
      <input type="number" step="0.01" name="salario" value="<?php echo $salario; ?>" placeholder="Salário" required>

      <select name="sexo" required>
        <option value="">Sexo</option>
        <option value="M" <?php echo $sexo == 'M' ? 'selected' : ''; ?>>Masculino</option>
        <option value="F" <?php echo $sexo == 'F' ? 'selected' : ''; ?>>Feminino</option>
      </select>

      <input type="text" name="cpf" value="<?php echo $cpf; ?>" placeholder="CPF" required>
      <input type="text" name="rg" value="<?php echo $rg; ?>" placeholder="RG" required>
      <input type="number" step="0.01" name="altura" value="<?php echo $altura; ?>" placeholder="Altura (em metros)" required>

      <!-- Cargo (select dinâmico) -->
      <select name="cargo_id" required>
        <option value="">Cargo</option>
        <?php
        $sqlCargo = "SELECT CargoID, Nome FROM cargos ORDER BY Nome";
        $resCargo = mysqli_query($conn, $sqlCargo);
        while ($cargo = mysqli_fetch_assoc($resCargo)) {
            $selected = $cargo['CargoID'] == $cargo_id ? 'selected' : '';
            echo "<option value='{$cargo['CargoID']}' $selected>{$cargo['Nome']}</option>";
        }
        ?>
      </select>

      <!-- Setor (select dinâmico) -->
      <select name="setor_id" required>
        <option value="">Setor</option>
        <?php
        $sqlSetor = "SELECT SetorID, Nome FROM setor ORDER BY Nome";
        $resSetor = mysqli_query($conn, $sqlSetor);
        while ($setor = mysqli_fetch_assoc($resSetor)) {
            $selected = $setor['SetorID'] == $setor_id ? 'selected' : '';
            echo "<option value='{$setor['SetorID']}' $selected>{$setor['Nome']}</option>";
        }
        ?>
      </select>

      <button type="submit"><?php echo $funcionarioID ? 'Atualizar' : 'Salvar'; ?></button>

      <?php if ($funcionarioID): ?>
        <input type="hidden" name="id" value="<?php echo $funcionarioID; ?>">
      <?php endif; ?>
    </form>
  </div>
</main>

<?php 
include_once './include/footer.php';
?>
