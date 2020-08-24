<?php    
    $codigo = NULL;
    $modelo = $_POST['modelo'];
    $valor = $_POST['valor'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : NULL;
    $categoria_id = $_POST['categoria_id'];

    $msg = '';

    if ($categoria_id == '') {
        $msg = 'Selecione uma categoria.';
    } else if ($modelo == '') {
        $msg = 'Preencha o campo modelo.';
    } else if ($valor == '') {
        $msg = 'Preencha o campo valor.';
    } else {

        $sql = "SELECT * FROM produtos WHERE modelo = :modelo AND categorias_id = :categoria_id";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':modelo', $modelo);
        $stm_sql -> bindParam(':categoria_id', $categoria_id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            $sql = "INSERT INTO produtos VALUES (:codigo, :modelo, :valor, :descricao, :categoria_id)";

            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':codigo', $codigo);
            $stm_sql -> bindParam(':modelo', $modelo);
            $stm_sql -> bindParam(':valor', $valor);
            $stm_sql -> bindParam(':descricao', $descricao);
            $stm_sql -> bindParam(':categoria_id', $categoria_id);
            
            $result = $stm_sql -> execute();

            $msg = ($result) ? "Cadastro efetuado com sucesso!" : "Falha ao cadastrar!";
        } else {
            $msg = "Este modelo já está cadastrado na categoria selecionada.";
        }
    }
    header("Location: main.php?folder=products/&file=frmins.php&mensagem=" . $msg);
?>