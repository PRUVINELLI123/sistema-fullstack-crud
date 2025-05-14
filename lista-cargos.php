<?php 
// includes
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
<main>
  <div class="container">
    <h1>Lista de Cargos</h1>
    <a href="./salvar-cargos.php" class="btn btn-add">Incluir</a>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Teto Salarial</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // consulta os dados da tabela cargos
        $sql = "SELECT * FROM cargos ORDER BY CargoID ASC";
        $resultado = mysqli_query($conn, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          while ($cargo = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>{$cargo['CargoID']}</td>";
            echo "<td>{$cargo['Nome']}</td>";
            echo "<td>R$ " . number_format($cargo['TetoSalarial'], 2, ',', '.') . "</td>";
            echo "<td>
                    <a href='./salvar-cargos.php?id={$cargo['CargoID']}' class='btn btn-edit'>Editar</a>
                    <a href='./action/cargos.php?acao=excluir&id={$cargo['CargoID']}' class='btn btn-delete' onclick=\"return confirm('Tem certeza que deseja excluir este cargo?');\">Excluir</a>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>Nenhum cargo encontrado.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div> 
</main>

<?php 
// include do footer
include_once './include/footer.php';
?>

