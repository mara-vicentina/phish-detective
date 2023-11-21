<?php

class HomeController {
    
    //Método responsável por exibir a página inicial, que contém o formulário de entrada de dados.
    public function index() {
        include 'src/Views/form_email.php';
    }

    //Método que processa os dados do formulário, realiza a conexão com o servidor IMAP,
    //obtém a lista de e-mails na caixa de entrada, valida cada e-mail em relação a phishing
    //utilizando o serviço de validação, e exibe a lista resultante na página de visualização de e-mails.
    public function emailsList() {
        $phishingValidator = new PhishingValidatorService();
        $imapConnection = new IMAPConnectionService($_POST['email'], $_POST['senha'], $_POST['servidor']);
        $imapConnection->open();

        $emailIds = $imapConnection->getEmailInbox();
        $validatedEmails = [];

        if ($emailIds) {
            foreach ($emailIds as $emailId) {
                $header = $imapConnection->getHeaderInfo($emailId);

                $email = [
                    'subject'     => $header->subject,
                    'date'        => date("d/m/Y H:i", strtotime($header->date)),
                    'is_phishing' => $phishingValidator->isPhishing($header->subject),
                ];

                array_push($validatedEmails, $email);
            }
        }

        $imapConnection->close();

        include 'src/Views/emails_list.php';
    }
}