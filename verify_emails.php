<?php
// Receba os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];
$servidor = $_POST['servidor'];

// Configurações de servidor para Gmail e Outlook
if ($servidor == "gmail") {
    $servidor_imap = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
} elseif ($servidor == "outlook") {
    $servidor_imap = '{outlook.office365.com:993/imap/ssl/novalidate-cert}INBOX';
}

// Conectando à caixa de entrada via IMAP
$inbox = imap_open($servidor_imap, $email, $senha) or die('Não foi possível conectar ao servidor: ' . imap_last_error());

// Função para verificar se o e-mail contém palavras-chave de phishing
function is_phishing($email_text) {
    $phishing_keywords = ["senha", "confirme", "urgente", "clique", "phishing", "ganhou", "ação necessária", "fatura"];
    $email_text = strtolower($email_text);
    foreach ($phishing_keywords as $keyword) {
        if (strpos($email_text, $keyword) !== false) {
            return true;
        }
    }
    return false;
}

// Pesquisando e-mails na caixa de entrada
$email_ids = imap_search($inbox, 'ALL');

$results = [];

if ($email_ids) {
    foreach ($email_ids as $email_id) {
        $header = imap_headerinfo($inbox, $email_id);
        $subject = $header->subject;
        $date = date("d/m/Y H:i", strtotime($header->date));

        $is_phishing = is_phishing($subject);
        $result = [
            'subject' => $subject,
            'date' => $date,
            'is_phishing' => $is_phishing,
        ];
        $results[] = $result;
    }
}

// Fechando a conexão com o servidor
imap_close($inbox);


require_once('results.php');
?>



