<?php

class PhishingValidator {

    private $keywords;

    public function __construct() {
        $this->keywords = ["senha", "confirme", "urgente", "clique", "phishing", "ganhou", "ação necessária", "fatura"];
    }

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