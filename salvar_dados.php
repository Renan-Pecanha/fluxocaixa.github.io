<?php
// Verifica se os dados foram enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o conteúdo foi recebido
    if (isset($_POST['conteudo'])) {
        // Filtra e sanitiza o conteúdo recebido
        $conteudo = filter_var($_POST['conteudo'], FILTER_SANITIZE_STRING);

        // Caminho do arquivo onde os dados serão salvos
        $caminho_arquivo = 'dados.json';

        // Verifica se o arquivo já existe
        if (!file_exists($caminho_arquivo)) {
            // Se o arquivo não existe, tenta criá-lo
            if (!touch($caminho_arquivo)) {
                // Se não for possível criar o arquivo, retorna uma resposta JSON com erro
                echo json_encode(['status' => 'error', 'message' => 'Erro ao criar o arquivo.']);
                exit();
            }
        }

        // Tenta salvar os dados no arquivo JSON
        if (file_put_contents($caminho_arquivo, $conteudo) !== false) {
            // Se a escrita for bem-sucedida, retorna uma resposta JSON com sucesso
            echo json_encode(['status' => 'success', 'message' => 'Dados salvos com sucesso.']);
            exit();
        } else {
            // Se ocorrer um erro ao salvar, retorna uma resposta JSON com erro
            echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar os dados.']);
            exit();
        }
    } else {
        // Se o conteúdo não foi recebido, retorna uma resposta JSON com erro
        echo json_encode(['status' => 'error', 'message' => 'Nenhum conteúdo recebido.']);
        exit();
    }
} else {
    // Se a requisição não foi feita via POST, retorna uma resposta JSON com erro
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
    exit();
}
?>
