<?php
include 'processa.php'; // conexão com o banco

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dia = $_POST['dia'] ?? '';

    if (!empty($dia)) {
        // Verifique o que chegou
        file_put_contents("log.txt", "Valor recebido: $dia\n", FILE_APPEND);

        $sql = "DELETE FROM reunioes WHERE dia = ?";
        $stmt = $conexao->prepare($sql);

        if (!$stmt) {
            echo "Erro na preparação: " . $conexao->error;
            exit;
        }

        $stmt->bind_param("s", $dia);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "sucesso";
            } else {
                echo "nenhuma_linha_afetada"; // isso significa que o valor não existe
            }
        } else {
            echo "Erro ao executar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "dia_vazio";
    }
} else {
    echo "metodo_invalido";
}



