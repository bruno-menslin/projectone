<?php    
    include "../../security/database/connection.php";
    
    $code = NULL;
    $model = $_POST['model'];
    $value = $_POST['value'];
    $description = ($_POST['description'] != '') ? $_POST['description'] : NULL;
    $category_id = $_POST['category_id'];

    $msg = '';

    if ($category_id == '') {
        $msg = 'Selecione uma categoria.';
    } else if ($model == '') {
        $msg = 'Preencha o campo modelo.';
    } else if ($value == '') {
        $msg = 'Preencha o campo valor.';
    } else {

        $sql = "SELECT * FROM products WHERE model = :model AND categories_id = :category_id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':model', $model);
        $stm_sql -> bindParam(':category_id', $category_id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {

            $sql = "INSERT INTO products VALUES (:code, :model, :value, :description, :category_id)";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':code', $code);
            $stm_sql -> bindParam(':model', $model);
            $stm_sql -> bindParam(':value', $value);
            $stm_sql -> bindParam(':description', $description);
            $stm_sql -> bindParam(':category_id', $category_id);
            $result = $stm_sql -> execute();

            if ($result) {
                $msg = "Cadastro efetuado com sucesso!";
            } else {
                $msg = "Falha ao cadastrar!";
            }
        } else {
            $msg = "Este modelo já está cadastrado na categoria selecionada.";
        }
    }
    echo $msg;
?>