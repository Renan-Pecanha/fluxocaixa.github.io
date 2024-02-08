<?php
session_start();

$forma_pagamento = isset($_GET['forma_pagamento']) ? $_GET['forma_pagamento'] : null;

// Limpar histórico geral se o parâmetro 'limpar' estiver definido na URL
if ($forma_pagamento === null && isset($_GET['limpar']) && $_GET['limpar'] == 'true') {
    if (isset($_GET['confirmar']) && $_GET['confirmar'] == 'true') {
        $_SESSION['transacoes'] = array(); // Limpar todo o histórico
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Transações</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Histórico de Transações</h2>

    <?php
    // Agrupar transações por forma de pagamento e criar histórico geral
    $transacoes_por_forma_pagamento = array();
    $historico_geral = array();
    $total_geral = 0;

    if (isset($_SESSION['transacoes'])) {
        foreach ($_SESSION['transacoes'] as $index => $transacao) {
            // Adicionar ao histórico geral
            $historico_geral[$index] = $transacao;

            // Adicionar à seção de forma de pagamento específica
            if (!empty($forma_pagamento) && $transacao['forma_pagamento'] == $forma_pagamento) {
                $transacoes_por_forma_pagamento[] = $transacao;
            }
            
            // Calcular o total geral
            $total_geral += floatval(str_replace('R$ ', '', $transacao['valor']));
        }

        if (!empty($forma_pagamento)) {
            echo "<h3>Histórico de Transações - $forma_pagamento</h3>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Produto</th>";
            echo "<th>Valor</th>";
            echo "<th>Nome</th>"; 
            echo "<th>Data</th>";
            echo "</tr>";
        
            foreach ($transacoes_por_forma_pagamento as $index => $transacao) {
                echo "<tr>";
                echo "<td>" . $transacao['produto'] . "</td>";
                echo "<td>R$ " . number_format($transacao['valor'], 2, ',', '.') . "</td>"; // Adiciona "R$" e formata o valor
                echo "<td>" . $transacao['nome'] . "</td>"; // Exibe o nome da pessoa que fez a transação
                echo "<td>" . (isset($transacao['data_registro']) ? $transacao['data_registro'] : 'N/A') . "</td>";
                echo "<td><a href='#' onclick='confirmarExclusao($index,\"$forma_pagamento\")'>Excluir</a></td>"; // Adiciona um link para excluir a transação com confirmação
                echo "</tr>";
            }

            // Exibir total apenas no histórico específico
            $total_forma_pagamento = 0;

            foreach ($transacoes_por_forma_pagamento as $transacao) {
                $total_forma_pagamento += floatval(str_replace('R$ ', '', $transacao['valor']));
            }

            echo "</table>";
            echo "<p>Total $forma_pagamento: R$ " . number_format($total_forma_pagamento, 2, ',', '.') . "</p>";
            
            // Adicionar botão de imprimir apenas no histórico específico
            echo '<button onclick="imprimirHistorico()">Imprimir Histórico</button>';
        } else {
            echo "<h3>Histórico Geral</h3>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Produto</th>";
            echo "<th>Valor</th>";
            echo "<th>Forma de Pagamento</th>";
            echo "<th>Nome</th>"; // Adiciona uma coluna para exibir o nome
            echo "<th>Data</th>";
            
            echo "</tr>";

            foreach ($historico_geral as $index => $transacao) {
                echo "<tr>";
                echo "<td>" . $transacao['produto'] . "</td>";
                echo "<td>R$ " . number_format($transacao['valor'], 2, ',', '.') . "</td>"; // Adiciona "R$" e formata o valor
                echo "<td>" . $transacao['forma_pagamento'] . "</td>";
                echo "<td>" . $transacao['nome'] . "</td>"; // Exibe o nome da pessoa que fez a transação
                echo "<td>" . (isset($transacao['data_registro']) ? $transacao['data_registro'] : 'N/A') . "</td>";
                // Remover esta linha que gera o link de exclusão para o histórico geral
                // echo "<td><a href='#' onclick='confirmarExclusao($index,\"$forma_pagamento\")'>Excluir</a></td>";
                echo "</tr>";
            }
            

            echo "</table>";

            // Exibir total no histórico geral
            echo "<p>Total Geral: R$ " . number_format($total_geral, 2, ',', '.') . "</p>";
            
            // Adicionar botão de imprimir apenas no histórico geral
            echo '<button onclick="imprimirHistorico()">Imprimir Histórico Geral</button>';
        }
    }
    ?>

    <!-- Botões em uma div separada -->
    <div class="botoes-container">
        <a href="index.php">Voltar</a>
        <?php
            if ($forma_pagamento === null) {
                // Exibir botão de limpar histórico no histórico geral
                echo '<a href="?limpar=true&confirmar=true" class="btn-limpar" onclick="return confirm(\'Tem certeza de que deseja limpar o histórico geral?\')">Limpar Histórico Geral</a>';
            }
        ?>
    </div>

    <script>
        function confirmarExclusao(index, forma_pagamento) {
            if (confirm('Tem certeza de que deseja excluir esta transação?')) {
                window.location.href = 'excluir_transacao.php?index=' + index + '&forma_pagamento=' + forma_pagamento;
            }
        }

        function imprimirHistorico() {
            window.print();
        }
    </script>
</body>
</html>
