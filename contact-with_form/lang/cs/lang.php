<?php

return [
    'name' => [
        'required' => 'Musíte vyplnit Vaše jméno a příjmení.',
    ],
    'email' => [
        'required' => 'Napište nám prosím i Váš e-mail.',
    ],
    'phone' => [
        'required' => 'Musíte zadat váš telefon.',
    ],
    'message' => [
        'required' => 'Text zprávy musí mít alespoň 5 znaků.',
        'min' => 'Text zprávy musí mít alespoň 5 znaků.',
    ],
    'sent' => 'Zpráva byla úspěšně odeslána!',
    'token' => 'Platnost formuláře vypršela, obnovte prosím stránku a odešlete formulář znovu.',
    'confirm' => 'Nesouhlasí ověření. Musíte napsat slovo secret.',
];
