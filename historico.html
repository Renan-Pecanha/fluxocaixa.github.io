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
    session_start();

    // Verifica se há transações na sessão
    if (isset($_SESSION['transacoes']) && !empty($_SESSION['transacoes'])) {
        // Exibe a tabela de transações
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Produto</th>";
        echo "<th>Valor</th>";
        echo "<th>Forma de Pagamento</th>";
        echo "<th>Nome</th>";
        echo "<th>Data</th>";
        echo "</tr>";

        // Itera sobre as transações na sessão
        foreach ($_SESSION['transacoes'] as $transacao) {
            echo "<tr>";
            echo "<td>" . $transacao['produto'] . "</td>";
            echo "<td>R$ " . number_format($transacao['valor'], 2, ',', '.') . "</td>";
            echo "<td>" . $transacao['forma_pagamento'] . "</td>";
            echo "<td>" . $transacao['nome'] . "</td>";
            echo "<td>" . (isset($transacao['data_registro']) ? $transacao['data_registro'] : 'N/A') . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // Se não houver transações na sessão, exibe uma mensagem indicando isso
        echo "<p>Não há transações registradas.</p>";
    }
    ?>

    <!-- Botões em uma div separada -->
    <div class="botoes-container">
        <a href="index.html">Voltar</a>
        <?php
        // Exibe o botão de limpar histórico apenas se houver transações na sessão
        if (isset($_SESSION['transacoes']) && !empty($_SESSION['transacoes'])) {
            echo '<a href="?limpar=true&confirmar=true" class="btn-limpar" onclick="return confirm(\'Tem certeza de que deseja limpar o histórico geral?\')">Limpar Histórico Geral</a>';
        }
        ?>
    </div>

    <script>
        // Mantenha as funções JavaScript como estão
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
