<?php 
// includes obrigatórios
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>
  <div class="container">
    <h1>Lista de Funcionários</h1>
    <a href="./salvar-funcionarios.php" class="btn btn-add">Incluir</a> 

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cargo</th>
          <th>Setor</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta SQL com JOINs para trazer nome do cargo e setor
        $sql = "SELECT f.FuncionarioID, f.Nome, c.Nome AS Cargo, s.Nome AS Setor
                FROM funcionarios f
                LEFT JOIN cargos c ON f.CargoID = c.CargoID
                LEFT JOIN setor s ON f.SetorID = s.SetorID
                ORDER BY f.FuncionarioID ASC";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $linha['FuncionarioID'] . "</td>";
                echo "<td>" . $linha['Nome'] . "</td>";
                echo "<td>" . ($linha['Cargo'] ?? '---') . "</td>";
                echo "<td>" . ($linha['Setor'] ?? '---') . "</td>";
                echo "<td>
                        <a href='salvar-funcionarios.php?id=" . $linha['FuncionarioID'] . "' class='btn btn-edit'>Editar</a>
                        <a href='actions/funcionarios.php?acao=excluir&id=" . $linha['FuncionarioID'] . "' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este funcionário?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum funcionário encontrado.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

<?php 
// include do rodapé
include_once './include/footer.php';
?>
