<?php 
// includes obrigatórios
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
<main>
  <div class="container">
    <h1>Lista de Categorias</h1>
    <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta SQL para buscar as categorias
        $sql = "SELECT * FROM categorias ORDER BY CategoriaID ASC";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $linha['CategoriaID'] . "</td>";
                echo "<td>" . $linha['Nome'] . "</td>";
                echo "<td>
                        <a href='salvar-categorias.php?id=" . $linha['CategoriaID'] . "' class='btn btn-edit'>Editar</a>
                        <a href='action/categorias.php?acao=excluir&id=" . $linha['CategoriaID'] . "' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir esta categoria?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhuma categoria encontrada.</td></tr>";
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
