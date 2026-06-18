<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - Dimitri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4 ">
        <div class="row">
            <div class="d-flex justify-content-between mb-3">
                <h4>Minhas Tarefas</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                    + Nova Tarefa
                </button>
            </div>
            <div class="col bg-white rounded shadow-sm p-3" id="coluna-a-fazer" style="min-height: 400px;">
                <h6 class="fw-bold text-uppercase mb-3">A fazer</h6>
            </div>
            <div class="col bg-white rounded shadow-sm p-3" id="coluna-fazendo" style="min-height: 400px;">
                <h6 class="fw-bold text-uppercase mb-3">Em Andamento</h6>
            </div>
            <div class="col bg-white rounded shadow-sm p-3" id="coluna-concluido" style="min-height: 400px;">
                <h6 class="fw-bold text-uppercase mb-3">Concluido</h6>
            </div>
        </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalTarefa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="mb-3">
                                <div class="col">
                                    <label for="titulo" class="form-label">Titulo:</label>
                                    <input id="titulo" name="titulo" type="text" class="form-control" required>
                                    <div class="alert alert-danger d-none" id='erro-titulo'>
                                        <label id='lblTitulo' for=""></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="col">
                                    <label for="detalhes" class="form-label">Detalhes:</label>

                                    <textarea class="form-control" id="detalhes" name="detalhes" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prazo" class="form-label">Prazo:</label>
                                    <input type="datetime-local" class="form-control" id="prazo" name="prazo">
                                    <div class="alert alert-danger d-none" id='erro-prazo'>
                                        <label id='lblPrazo' for=""></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="A fazer">A fazer</option>
                                    <option value="Fazendo">Fazendo</option>
                                    <option value="Concluido">Concluído</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="alertaErroModal" class="alert alert-danger d-none mt-3">
                        Erro ao cadastrar tarefa!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSalvarCadastro" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const tarefas = <?=json_encode($tarefas)?>;

        console.log(tarefas)



        function limpaErros(){
            document.getElementById('alertaErroModal').classList.add('d-none');
        };

        document.getElementById('modalTarefa').addEventListener('hidden.bs.modal', function() {
            document.getElementById('titulo').value = '';
            document.getElementById('detalhes').value = '';
            document.getElementById('prazo').value = '';
            document.getElementById('status').value = 'A fazer';
            limpaErros();
        });

        function validarCamposModal() {
            let lblPrazo = document.getElementById('lblPrazo');
            let lblTitulo = document.getElementById('lblTitulo');
            let titulo = document.getElementById('titulo').value;
            let prazo = document.getElementById('prazo').value;
            let status = document.getElementById('status').value;

            let divErroTitulo = document.getElementById('erro-titulo');
            let divErroPrazo = document.getElementById('erro-prazo');

            if (titulo.trim() == '' || titulo == null) {
                lblTitulo.textContent = 'O Título é obrigatório!';
                divErroTitulo.classList.remove('d-none');
                return false;
            } else {
                divErroTitulo.classList.add('d-none');
            }

            if (!prazo) {
                lblPrazo.textContent = 'O prazo é obrigatório!';
                divErroPrazo.classList.remove('d-none'); // Mostra o alerta do Bootstrap
                return false;
            } else {
                divErroPrazo.classList.add('d-none');
            }

            let dataPrazo = new Date(prazo);
            let dataAgora = new Date();

            if (status == 'A fazer' || status == 'Fazendo') {
                if (dataPrazo < dataAgora) {
                    lblPrazo.textContent = 'O prazo não pode ser em uma data ou hora passada!';
                    divErroPrazo.classList.remove('d-none');
                    return false;
                }

            }

            divErroPrazo.classList.add('d-none');
            divErroTitulo.classList.add('d-none');
            return true;

        }

        

        botaoSalvarCad = document.getElementById('btnSalvarCadastro');

        


        botaoSalvarCad.addEventListener("click", function() {
            if (validarCamposModal()) {
                const baseUrl = "<?= site_url() ?>";
                console.log(baseUrl)

                const dados = {
                    titulo: document.getElementById('titulo').value,
                    detalhes: document.getElementById('detalhes').value,
                    prazo: document.getElementById('prazo').value,
                    status: document.getElementById('status').value,
                };

                fetch(baseUrl + 'tarefas', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(dados)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Erro HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Resposta:', data);
                        if (data.status === 'sucesso') {
                            bootstrap.Modal.getInstance(document.getElementById('modalTarefa')).hide();
                            const toast = new bootstrap.Toast(document.getElementById('toastSucesso'));
                            toast.show();
                        } else {
                            document.getElementById('alertaErroModal').textContent = data.mensagem;
                            document.getElementById('alertaErroModal').classList.remove('d-none');
                        }
                    }).catch(error => {
                        document.getElementById('alertaErroModal').textContent = 'Erro de conexão: ' + error.message;
                        document.getElementById('alertaErroModal').classList.remove('d-none');
                        
                    });

            }
        });
    </script>
    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastSucesso" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    Tarefa cadastrada com sucesso!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <div id="toastErro" class="toast align-items-center text-bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                Erro ao cadastrar tarefa!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</body>

</html>