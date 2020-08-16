<?php
    // conexão com o banco de dados através do PDO - PHP Data Object
    try { // validação da conexão
        $db_connection = new PDO("mysql:host=127.0.0.1;dbname=db_projectone;charset=utf8", "root", ""); // variável para armazenar o PDO
    } catch (PDOexception $error) { // se não der certo, armazenar o erro (exceção) em uma variável
        die("Falha ao conectar ao banco de dados: " . $error -> getCode()); // retorna o código da exceção 
    }

?>