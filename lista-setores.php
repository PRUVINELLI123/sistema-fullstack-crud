<?php 
// includes obrigatórios
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
<main>
  <div class="container">
    <h1>Lista de Setores</h1>
    <a href="./salvar-setores.php" class="btn btn-add">Incluir</a>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Andar</th>
          <th>Cor</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta SQL para buscar os setores
        $sql = "SELECT * FROM setor ORDER BY SetorID ASC";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $linha['SetorID'] . "</td>";
                echo "<td>" . $linha['Nome'] . "</td>";
                echo "<td>" . $linha['Andar'] . "</td>";
                echo "<td>" . $linha['Cor'] . "</td>";
                echo "<td>
                        <a href='salvar-setores.php?id=" . $linha['SetorID'] . "' class='btn btn-edit'>Editar</a>
                        <a href='action/setores.php?acao=excluir&id=" . $linha['SetorID'] . "' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este setor?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum setor encontrado.</td></tr>";
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
