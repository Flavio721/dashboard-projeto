<?php
include 'processa.php'
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="imagens/logo-branca.png">
    <title>Reuniões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="templates/static/style4.css">
  </head>
  <body>
    <!-- Começo do topo -->
    <header class="topo">
        <section class="nav">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Menu</button>
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu lateral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <a href="templates/inicio.html" class="link">Início</a> <br>
                <a href="templates/index.html" class="link">Controle de ações</a> <br>
            </div>
            </div>
        </section>
        <div class="item1">
            <img src="imagens/logo.png" alt="" height="150px">
        </div>
        <div class="item2">
            <a href="templates/inicio.html" target="_blank">
                <span class="material-symbols-outlined">
                    logout
                </span>
            </a>
            <a href="templates/perfil.html" target="_blank">
                <span class="material-symbols-outlined">
                    account_circle
                </span>
            </a>
        </div>
    </header>
    <!-- FIM DO TOPO -->
     <!-- Começo do conteúdo principal -->
      <article class="reuniao">
        <div class="item3">
            <h2>Última reunião</h2>
            <p>Data: 28/06/2025</p>
            <p>Participantes: Flávio Inocêncio, Livia de Lima, João Silva, Matheus Lima</p>
            <p>Duração: 1hr</p>
            <ul>
                Pontos discutidos:
                <li>Análise de desempenho de carteira no último bimestre</li>
                <li>Discussão sobre oportunidades de mercado</li>
                <li>Atualização sobre o cenário econômico atual</li>
                <li>Revisão de metas de captação de relacionamento com investidores</li>
                <li>Planejamento de novos serviços</li>
            </ul>
            <ul>
                Próximos passos:
                <li>Ajustar portfólios conforme nova estratégia</li>
                <li>Agendar reunião com equipe de marketing para divulgação de novos serviços</li>
                <li>Atualizar relatórios para clientes até 03/07/2025</li>
            </ul>
        </div>
        <div class="item4">
            <h2>Próximas reuniões</h2>
            <div class="container text-center">
                <div class="row row-cols-2" id="listaReunioes">
                    <?php
                      $resultado = $conexao->query("SELECT * FROM reunioes ORDER BY dia ASC");

                      while($reuniao = $resultado->fetch_assoc()){
                        echo '<div class="col" data-reuniao="' . $reuniao['dia'] . '" style="border: 3px solid blue; width: 300px;">';
                        echo '<p>Data: ' . date('d/m/Y', strtotime($reuniao['dia'])) . '</p>';
                        echo '<p>Participantes: ' . htmlspecialchars($reuniao['participantes']) . '</p>';
                        echo '<button type="button" class="btn btn-success btn-concluir">Marcar como concluída</button>';
                        echo '</div>';
                      }
                    ?>
                </div>
            </div>
            <button type="button" class="btn btn-primary" style="height: 50px; margin-top: 10px;" data-bs-toggle="modal" data-bs-target="#modalAdicionarReuniao">Agendar próxima reunião</button>
            <button type="button" class="btn btn-danger" style="height: 50px; margin-top: 10px;" data-bs-toggle="modal" data-bs-target="#modalCancelar">Cancelar reunião</button>
        </div>
      </article>
      <div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="modalCancelarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formCancelar" class="modal-content" method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCancelarLabel">Cancelar reunião</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
            <label for="reuniaoSelect" class="form-label">Selecione uma reunião:</label>
            <select class="form-select" id="reuniaoSelect" required>
            <option value="">Escolha...</option>
            <?php
              $resultado = $conexao->query("SELECT * FROM reunioes ORDER BY dia ASC");

              while($reuniao = $resultado->fetch_assoc()){
                $dataFormatada = date('d/m/Y', strtotime($reuniao['dia']));
                echo "<option value=\"{$reuniao['dia']}\">{$dataFormatada} - " . htmlspecialchars($reuniao['participantes']) . "</option>";
              }
            ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Remover</button>
        </div>
        </form>
    </div>
    </div>

    <div class="modal fade" id="modalAdicionarReuniao" tabindex="-1" aria-labelledby="modalAdicionarReuniaoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formAdicionarReuniao" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarReuniaoLabel">Adicionar Nova Reunião</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="dataNovaReuniao" class="form-label">Data</label>
          <input type="date" class="form-control" id="dataNovaReuniao" required />
        </div>
        <div class="mb-3">
          <label for="participantesNovaReuniao" class="form-label">Participantes</label>
          <input type="text" class="form-control" id="participantesNovaReuniao" placeholder="Separados por vírgula" required />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
    </form>
    </div>
    </div>

    <div id="listaReunioes">
  <!-- reuniões aparecem aqui -->
    </div>

      <script>
        // Código para o botão de cancelar reunião
        document.getElementById('formCancelar').addEventListener('submit', function (e) {
    e.preventDefault(); // Impede o comortamento padrão de atualizar a pagina
    const select = document.getElementById('reuniaoSelect'); // Pega o select com as opções de reuniões 
    
    const dataSelecionada = select.value //  Captura o valor selecionado
    const reuniao = select.value;
    // Verifica se uma reunião foi selecionada
    if (dataSelecionada) {
      // Encontra o elemento da reunião com o atributo data-reuniao correspondente
      const itemReuniao = document.querySelector('[data-reuniao="' + dataSelecionada + '"]');
      // Envia a requisição para o servidor para deletar a reunião
    fetch('deletar_reuniao.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded' // Indica que estamos enviando valores do formulário
    },
    body: 'dia=' + encodeURIComponent(dataSelecionada) // Envia a data como parâmetro 
    })
    .then(response => response.text()) //Recebe a resposta como texto
    .then(resposta => {
    if (resposta.trim() === 'sucesso') {
      // Remove o item da tela se o banco confirmar o cancelamento
        if (itemReuniao) {
        itemReuniao.remove(); // Agora sim, só após o banco confirmar
        }
        alert('Reunião do dia ' + dataSelecionada + ' foi cancelada no banco de dados.');
    } else {
        alert('Erro ao cancelar reunião: ' + resposta);
    }
    })
    .catch(error => {
    console.error('Erro na requisição:', error);
    alert('Erro ao se comunicar com o servidor.');
    });

      // Fecha o modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalCancelar'));
      modal.hide();

      // Limpa o select
      select.value = '';
    } else {
      alert('Por favor, selecione uma reunião.');
    }
    if (reuniao) {
      alert('Reunião do dia ' + reuniao + ' cancelada!');
      // Aqui você pode adicionar integração com Flask usando fetch() ou redirecionamento
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalCancelar'));
      modal.hide();
      select.value = '';
    } else {
      alert('Por favor, selecione uma reunião para cancelar.');
    }
    });

    // Código para botão de adicionar reunião
    document.getElementById('formAdicionarReuniao').addEventListener('submit', function(e) {
  e.preventDefault();

  const data = document.getElementById('dataNovaReuniao').value;
  const participantes = document.getElementById('participantesNovaReuniao').value.trim();

  if (!data || !participantes) {
    alert('Preencha todos os campos.');
    return;
  }

  const formData = new URLSearchParams();
  formData.append('dia', data);
  formData.append('participantes', participantes);

  fetch('adicionar_reuniao.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: formData.toString()
  })
  .then(response => response.text())
  .then(resposta => {
    if (resposta.trim() === 'sucesso') {
      const lista = document.getElementById('listaReunioes');

      const novaDiv = document.createElement('div');
      novaDiv.classList.add('col');
      novaDiv.setAttribute('data-reuniao', data);
      novaDiv.style.border = '3px solid blue';
      novaDiv.style.width = '300px';
      novaDiv.style.margin = '10px';
      novaDiv.innerHTML = `
        <p>Data: ${data.split('-').reverse().join('/')}</p>
        <p>Participantes: ${participantes}</p>
        <button type="button" class="btn btn-success">Marcar como concluída</button>
      `;

      lista.appendChild(novaDiv);

      // Fechar modal
      const modalEl = document.getElementById('modalAdicionarReuniao');
      const modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();

      // Limpar form
      this.reset();

      alert('Reunião adicionada com sucesso!');
    } else {
      alert('Erro ao adicionar reunião: ' + resposta);
    }
  })
  .catch(err => {
    console.error(err);
    alert('Erro na comunicação com o servidor.');
  });
});

    // Código para botão de marcar como concluida
      document.addEventListener('DOMContentLoaded', () => { //Aguarda o carregamento completo do DOM
    document.querySelectorAll('.btn-concluir').forEach(botao => { //Seleciona todos botões de concluido 
      botao.addEventListener('click', function() { // Cria um evento de click para cada um
        const divReuniao = this.closest('[data-reuniao]'); // Encontra o elemento pai da reunião (árvore DOM)
        if (!divReuniao) return alert('Erro: reunião não identificada.'); 

        const dia = divReuniao.getAttribute('data-reuniao'); //Pega o valor do atributo data-reuniao
        // Envia a requisição para o PHP remover o item do database
        fetch('deletar_reuniao.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // Formato de formulário tradicional
          body: 'dia=' + encodeURIComponent(dia) // Codifica a data no corpo da requisição
        })
        .then(response => response.text()) // Converte a data para string
        .then(resposta => {
          if (resposta.trim() === 'sucesso') {
            divReuniao.remove(); // Remove a reunião da tela
            alert('Reunião do dia ' + dia.split('-').reverse().join('/') + ' marcada como concluída e removida.');
          } else {
            alert('Erro ao concluir reunião: ' + resposta);
          }
        })
        .catch(() => alert('Erro na comunicação com o servidor.'));
      });
    });
  });

      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>