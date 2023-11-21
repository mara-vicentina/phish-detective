<!DOCTYPE html>
<html>
<?php
    require_once('src/Views/includes/head.php');
?>
<body>
<div id="particles-js"></div>

<div class="container-fluid">
    <div class="container p-5">
        <div class="row">
            <img id="img-logo" src="<?php echo BASE_URL.'/assets/img/logo-phish.png' ?>" alt="logo-connected" class="mx-auto d-block">
        </div>
        <div class="row m-5">
            <div class="col-md-6 offset-md-3">
                <div class="card bg-whitee">
                    <div class="card-body">
                        <h2 class="card-title text-center main-color">Verificação de E-mail</h2>
                        <form action="<?= BASE_PATH?>/listagem" method="POST">
                            <div class="form-group">
                                <label for="email" class="sec-color mt-2">E-mail:</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="senha" class="sec-color mt-2">Senha:</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="servidor" class="sec-color mt-2">Servidor:</label>
                                <select name="servidor" class="form-select">
                                    <option value="gmail">Gmail</option>
                                    <option value="outlook">Outlook</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 btn-custom">Verificar E-mails</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('src/Views/includes/js_content.php');
?>
</body>
</html>