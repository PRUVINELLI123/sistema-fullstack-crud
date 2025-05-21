<?php 
// includes obrigatórios
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>
  <div class="container">
    <h1>Lista de Produções</h1>
    <a href="./salvar-producao.php" class="btn btn-add">Incluir</a> 

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta SQL com JOIN para buscar o nome do produto, funcionário e cliente, se necessário
        $sql = "SELECT p.ProducaoID, pr.Nome AS Produto, p.DataProducao, p.DataEntrega
                FROM producao p
                LEFT JOIN produtos pr ON p.ProdutoID = pr.ProdutoID
                ORDER BY p.ProducaoID ASC";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $linha['ProducaoID'] . "</td>";
                echo "<td>" . $linha['Produto'] . "</td>";
                echo "<td>100</td>"; // Substituir por lógica de quantidade real
                echo "<td>" . $linha['DataProducao'] . "</td>";
                echo "<td>
                        <a href='salvar-producao.php?id=" . $linha['ProducaoID'] . "' class='btn btn-edit'>Editar</a>
                        <a href='action/producao.php?acao=excluir&id=" . $linha['ProducaoID'] . "' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir esta produção?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhuma produção encontrada.</td></tr>";
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
