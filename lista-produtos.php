<?php 
// includes obrigatórios
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>
  <div class="container">
    <h1>Lista de Produtos</h1>
    <a href="./salvar-produtos.php" class="btn btn-add">Incluir</a> 

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Consulta SQL com JOIN para trazer o nome da categoria
        $sql = "SELECT p.ProdutoID, p.Nome, p.Preco, c.Nome AS Categoria
                FROM produtos p
                LEFT JOIN categorias c ON p.CategoriaID = c.CategoriaID
                ORDER BY p.ProdutoID ASC";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $linha['ProdutoID'] . "</td>";
                echo "<td>" . $linha['Nome'] . "</td>";
                echo "<td>" . ($linha['Categoria'] ?? 'Sem Categoria') . "</td>";
                echo "<td>R$ " . number_format($linha['Preco'], 2, ',', '.') . "</td>";
                echo "<td>
                        <a href='salvar-produtos.php?id=" . $linha['ProdutoID'] . "' class='btn btn-edit'>Editar</a>
                        <a href='action/produtos.php?acao=excluir&id=" . $linha['ProdutoID'] . "' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este produto?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
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
