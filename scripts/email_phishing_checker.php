<?php

require_once('../classes/IMAPConnection.php');
require_once('../classes/PhishingValidator.php');

$phishingValidator = new PhishingValidator();
$imapConnection = new IMAPConnection($_POST['email'], $_POST['senha'], $_POST['servidor']);
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