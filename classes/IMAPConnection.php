<?php

class IMAPConnection {
    private $email;
    private $password;
    private $serverUrl;
    private $imapStream;

    public function __construct($email, $password, $serverName) {
        $this->email     = $email;
        $this->password  = $password;
        $this->serverUrl = $this->getServerUrlByName($serverName);
    }

    public function open() {
        $this->imapStream = imap_open($this->serverUrl, $this->email, $this->password);

        if (!$this->imapStream) {
            die('Não foi possível abrir a conexão IMAP: ' . imap_last_error());
        }
    }

    public function close() {
        if ($this->imapStream) {
            imap_close($this->imapStream);
        }
    }

    public function getImapStream() {
        return $imapStream;
    }

    private function getServerUrlByName($serverName) {
        $servers = [
            'gmail'   => '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX',
            'outlook' => '{outlook.office365.com:993/imap/ssl/novalidate-cert}INBOX',
        ];

        return $servers[$serverName];
    }

    public function getEmailInbox() {
        return imap_search($this->imapStream, 'ALL');
    }

    public function getHeaderInfo($emailId) {
        return imap_headerinfo($this->imapStream, $emailId);
    }
}