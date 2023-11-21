<?php

class PhishingValidatorService {

    private $keywords;

    public function __construct() {
        $this->keywords = ["senha", "confirme", "urgente", "clique", "phishing", "ganhou", "ação necessária", "fatura"];
    }

    //Verifica se o texto fornecido contém palavras-chave associadas a e-mails de phishing.
    //Converte o texto para minúsculas antes da comparação para garantir que não seja sensível a maiúsculas.
    //Retorna verdadeiro se o texto contiver uma palavra-chave de phishing, caso contrário, retorna falso.
    public function isPhishing($text) {
        $text = strtolower($text);

        foreach ($this->keywords as $keyword) {
            if (strpos($text, $keyword) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
}