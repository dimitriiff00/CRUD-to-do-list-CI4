<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">To-Do List</h4>

                        <form action="<?= site_url('auth/autenticar') ?>" method="post" onsubmit="return verificarCampos();">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario">
                                <div class="alert alert-danger d-none" id='erro-usuario'>
                                    <label for="">O campo usuario deve ser preenchido.</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                                <div class="alert alert-danger d-none" id='erro-senha'>
                                    <label for="">O campo senha deve ser preenchido.</label>
                                </div>
                            </div>
                            <?php if (session()->getFlashdata('erro')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('erro') ?>
                                </div>
                            <?php endif; ?>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function verificarCampos() {
            let usuario = document.getElementById('usuario').value;
            let divErroUsuario = document.getElementById('erro-usuario');
            let divErroSenha = document.getElementById('erro-senha');
            let senha = document.getElementById('senha').value;                    

            if (usuario == '' || usuario == null) {
                divErroUsuario.classList.remove('d-none');
                return false;

            }else if(senha == '' || senha == null){
               divErroSenha.classList.remove('d-none');
                return false;                 
            }

            return true;

        }
    </script>


</body>

</html>