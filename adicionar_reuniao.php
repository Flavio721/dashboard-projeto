<?php
include 'processa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $dia = $_POST['dia'] ?? '';
  $participantes = $_POST['participantes'] ?? '';

  if (empty($dia) || empty($participantes)) {
    echo 'dados_incompletos';
    exit;
  }

  $sql = "INSERT INTO reunioes (dia, participantes) VALUES (?, ?)";
  $stmt = $conexao->prepare($sql);

  if (!$stmt) {
    echo 'erro_preparacao: ' . $conexao->error;
    exit;
  }

  $stmt->bind_param('ss', $dia, $participantes);

  if ($stmt->execute()) {
    echo 'sucesso';
  } else {
    echo 'erro_execucao: ' . $stmt->error;
  }

  $stmt->close();
} else {
  echo 'metodo_invalido';
}
