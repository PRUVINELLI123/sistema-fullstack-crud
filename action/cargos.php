<?php
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'inserir':
        $nome = $_POST['nome'] ?? '';
        $teto = $_POST['teto_salarial'] ?? 0;

        if ($nome && $teto !== '') {
            $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES ('$nome', '$teto')";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-cargos.php?mensagem=Cargo cadastrado com sucesso.");
            } else {
                header("Location: ../lista-cargos.php?erro=Erro ao cadastrar cargo.");
            }
        } else {
            header("Location: ../lista-cargos.php?erro=Preencha todos os campos.");
        }
        break;

    case 'editar':
        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'] ?? '';
        $teto = $_POST['teto_salarial'] ?? 0;

        if ($id && $nome && $teto !== '') {
            $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = '$teto' WHERE CargoID = $id";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-cargos.php?mensagem=Cargo atualizado com sucesso.");
            } else {
                header("Location: ../lista-cargos.php?erro=Erro ao atualizar cargo.");
            }
        } else {
            header("Location: ../lista-cargos.php?erro=Preencha todos os campos.");
        }
        break;

    case 'excluir':
        $id = $_GET['id'] ?? null;

        if ($id) {
            $sql = "DELETE FROM cargos WHERE CargoID = $id";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-cargos.php?mensagem=Cargo excluído com sucesso.");
            } else {
                header("Location: ../lista-cargos.php?erro=Erro ao excluir cargo.");
            }
        } else {
            header("Location: ../lista-cargos.php?erro=ID inválido para exclusão.");
        }
        break;

    default:
        header("Location: ../lista-cargos.php?erro=Ação inválida.");
        break;
}
?>
