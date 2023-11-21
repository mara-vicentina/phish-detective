<?php

class IMAPConnectionService {
    private $email;
    private $password;
    private $serverUrl;
    private $imapStream;

    public function __construct($email, $password, $serverName) {
        $this->email     = $email;
        $this->password  = $password;
        $this->serverUrl = $this->getServerUrlByName($serverName);
    }

    //Abre a conexão IMAP com o servidor usando as credenciais fornecidas.
    public function open() {
        $this->imapStream = imap_open($this->serverUrl, $this->email, $this->password);

        if (!$this->imapStream) {
            die('Não foi possível abrir a conexão IMAP: ' . imap_last_error());
        }
    }

    //Fecha a conexão IMAP previamente aberta, se existir.
    public function close() {
        if ($this->imapStream) {
            imap_close($this->imapStream);
        }
    }

    //Retorna o stream IMAP atualmente aberto.
    public function getImapStream() {
        return $imapStream;
    }

    //Obtém a URL do servidor IMAP com base no nome do servidor fornecido.
    private function getServerUrlByName($serverName) {
        $servers = [
            'gmail'   => '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX',
            'outlook' => '{outlook.office365.com:993/imap/ssl/novalidate-cert}INBOX',
        ];

        return $servers[$serverName];
    }

    //Obtém uma lista de IDs de e-mails na caixa de entrada.
    public function getEmailInbox() {
        return imap_search($this->imapStream, 'ALL');
    }

    //Obtém informações do cabeçalho de um e-mail específico com base no ID fornecido.
    public function getHeaderInfo($emailId) {
        return imap_headerinfo($this->imapStream, $emailId);
    }
}