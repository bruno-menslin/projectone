<?php    
    $codigo = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $valor = $_POST['valor'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : NULL;
    $categoria_id = $_POST['categoria_id'];

    $msg = '';
    $link = "main.php?folder=products/&file=frmupd.php&codigo=" . $codigo;

    if ($categoria_id == '') {
        $msg = 'Selecione uma categoria.';
    } else if ($modelo == '') {
        $msg = 'Preencha o campo modelo.';
    } else if ($valor == '') {
        $msg = 'Preencha o campo valor.';
    } else {

        //se ja tem mesmo modelo na mesma categoria com codigo diferente (o mesmo codigo é o proprio produto em alteracao)
        $sql = "SELECT * FROM produtos WHERE modelo = :modelo AND categorias_id = :categoria_id AND codigo <> :codigo";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':modelo', $modelo);
        $stm_sql -> bindParam(':categoria_id', $categoria_id);
        $stm_sql -> bindParam(':codigo', $codigo);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            $sql = "UPDATE produtos SET modelo = :modelo, valor = :valor, descricao = :descricao, categorias_id = :categoria_id WHERE codigo = :codigo";
            
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':modelo', $modelo);
            $stm_sql -> bindParam(':valor', $valor);
            $stm_sql -> bindParam(':descricao', $descricao);
            $stm_sql -> bindParam(':categoria_id', $categoria_id);
            $stm_sql -> bindParam(':codigo', $codigo);
            
            $result = $stm_sql -> execute();

            $msg = ($result) ? "Alteração efetuada com sucesso!" : "Falha ao alterar!";

            $link = "main.php?folder=products/&file=frmins.php";
        } else {
            $msg = "Este modelo já está cadastrado no banco de dados.";
        }
    }
    header("Location: " . $link . "&mensagem=" . $msg);
?>