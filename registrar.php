<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST['nome']) && isset($_POST['produto']) && isset($_POST['valor']) && isset($_POST['forma_pagamento'])) {
        // Obtem os valores dos campos do formulário
        $nome = $_POST['nome'];
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];
        $forma_pagamento = $_POST['forma_pagamento'];

        // Cria um array associativo com os dados da transação
        $transacao = array(
            'nome' => $nome,
            'produto' => $produto,
            'valor' => $valor,
            'forma_pagamento' => $forma_pagamento,
            'data_registro' => date("Y-m-d H:i:s") // Adiciona a data e hora atual como data de registro
        );

        // Adiciona a transação ao início do array de transações na sessão
        if (!isset($_SESSION['transacoes'])) {
            $_SESSION['transacoes'] = array();
        }
        array_unshift($_SESSION['transacoes'], $transacao);
    } else {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios!";
    }
}

// Redireciona de volta para o index.php após o processamento do formulário
header("Location: index.php");
exit();
?>
