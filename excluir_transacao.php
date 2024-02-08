<?php
session_start();

if (isset($_GET['index']) && isset($_GET['forma_pagamento'])) {
    $index = $_GET['index'];
    $forma_pagamento = $_GET['forma_pagamento'];

    // Verifica se o índice existe no histórico
    if (isset($_SESSION['transacoes'][$index]) && $_SESSION['transacoes'][$index]['forma_pagamento'] == $forma_pagamento) {
        // Remove a transação do histórico
        array_splice($_SESSION['transacoes'], $index, 1);
        $_SESSION['success_message'] = "Transação excluída com sucesso!";
    } else {
        $_SESSION['error_message'] = "Índice de transação inválido ou forma de pagamento incorreta!";
    }
} else {
    $_SESSION['error_message'] = "Índice de transação ou forma de pagamento não fornecidos!";
}

// Redireciona de volta para a página do histórico específico ou geral, dependendo dos parâmetros fornecidos
$forma_pagamento = isset($_GET['forma_pagamento']) ? $_GET['forma_pagamento'] : null;
if ($forma_pagamento !== null) {
    header("Location: historico.php?forma_pagamento=$forma_pagamento");
} else {
    header("Location: historico.php");
}
exit();
?>
