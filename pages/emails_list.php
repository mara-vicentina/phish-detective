<?php
    require_once('../config.php');
    require_once('../scripts/email_phishing_checker.php');
?>

<!DOCTYPE html>
<html>
<?php
    require_once('../includes/head.php');
?>
<body>
<div id="particles-js"></div>
<div class="container-fluid">
    <div class="container p-5">
        <div class="row">
            <img id="img-logo" src="<?php echo BASE_URL.'assets/img/logo-phish.png' ?>" alt="logo-connected" class="mx-auto d-block">
        </div>
        <div class="row m-5">
            <div class="col-md-10 offset-md-1">
                <div class="card custom-card overflow-auto p-2 bg-whitee">
                    <div class="card-body">
                        <h2 class="text-center main-color">Resultados da Verificação de E-mail</h2>
                        <p class="sec-color mt-2">E-mail: <?php echo $_POST['email']; ?></p>
                        <p class="sec-color mt-2">Servidor: <?php echo $_POST['servidor']; ?></p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="main-color text-left">Assunto</th>
                                        <th class="main-color text-left">Data</th>
                                        <th class="main-color text-left">Phishing Safe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($validatedEmails as $email): ?>
                                        <tr>
                                            <td class="text-left"><?php echo imap_utf8($email['subject']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($email['date']); ?></td>
                                            <td class="text-center">
                                                <?php echo $email['is_phishing'] ? '<span class="text-danger"><i class="bi-patch-exclamation-fill icon-size"></i></span>' : '<span class="text-success"><i class="bi-patch-check-fill icon-size"></i></span>'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <?php
        require_once('js-content.php');
    ?>
</body>
</html>
