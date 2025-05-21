<?php 
// Includes essenciais
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>
  <div class="tela">
    <h2>Relatório de Produção por Funcionário</h2>
    
    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr>
          <th>Funcionário</th>
          <th>Produto</th>
          <th>Data de Produção</th>
          <th>Data de Entrega</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta de produção com join em funcionários e produtos
        $sql = "
          SELECT 
            f.Nome AS funcionario,
            p.Nome AS produto,
            pr.DataProducao,
            pr.DataEntrega
          FROM producao pr
          LEFT JOIN funcionarios f ON f.FuncionarioID = pr.FuncionarioID
          LEFT JOIN produtos p ON p.ProdutoID = pr.ProdutoID
          ORDER BY pr.DataProducao DESC
        ";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($linha['funcionario']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['produto']) . "</td>";
                echo "<td>" . date("d/m/Y", strtotime($linha['DataProducao'])) . "</td>";
                echo "<td>" . date("d/m/Y", strtotime($linha['DataEntrega'])) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum registro de produção encontrado.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

<?php include_once './include/footer.php'; ?>
