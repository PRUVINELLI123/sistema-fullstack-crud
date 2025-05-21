<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_GET['acao'] ?? '';

// Ativa exceções para erros do MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

switch ($acao) {
    case 'inserir':
        $nome = $_POST['nome'] ?? '';
        $andar = $_POST['andar'] ?? '';
        $cor = $_POST['cor'] ?? '';

        if ($nome && $andar !== '' && $cor) {
            $sql = "INSERT INTO setor (Nome, Andar, Cor) VALUES ('$nome', '$andar', '$cor')";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-setores.php?mensagem=Setor cadastrado com sucesso.");
            } else {
                header("Location: ../lista-setores.php?erro=Erro ao cadastrar setor.");
            }
        } else {
            header("Location: ../lista-setores.php?erro=Preencha todos os campos.");
        }
        break;

    case 'editar':
        $id = $_POST['id'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $andar = $_POST['andar'] ?? '';
        $cor = $_POST['cor'] ?? '';

        if ($id && $nome && $andar !== '' && $cor) {
            $sql = "UPDATE setor SET Nome = '$nome', Andar = '$andar', Cor = '$cor' WHERE SetorID = $id";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-setores.php?mensagem=Setor atualizado com sucesso.");
            } else {
                header("Location: ../lista-setores.php?erro=Erro ao atualizar setor.");
            }
        } else {
            header("Location: ../lista-setores.php?erro=Preencha todos os campos.");
        }
        break;

    case 'excluir':
        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                $sql = "DELETE FROM setor WHERE SetorID = $id";
                mysqli_query($conn, $sql);
                header("Location: ../lista-setores.php?mensagem=Setor excluído com sucesso.");
            } catch (mysqli_sql_exception $e) {
                // Mensagem amigável
                header("Location: ../lista-setores.php?erro=Não foi possível excluir o setor. Verifique se ele está sendo usado em outras partes do sistema.");
            }
        } else {
            header("Location: ../lista-setores.php?erro=ID inválido para exclusão.");
        }
        break;

    default:
        header("Location: ../lista-setores.php?erro=Ação inválida.");
        break;
}
?>
