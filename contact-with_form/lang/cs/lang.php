<?php

return [
    'name' => [
    	'label' => 'Jméno a příjmení',
        'required' => 'Musíte vyplnit Vaše jméno a příjmení.',
    ],
    'email' => [
    	'label' => 'E-mail',
        'required' => 'Napište nám prosím i Váš e-mail.',
    ],
    'phone' => [
        'label' => 'Telefon',
        'required' => 'Musíte zadat váš telefon.',
    ],
    'company' => [
        'label' => 'Společnost',
    ],
    'message' => [
    	'label' => 'Zpráva',
        'required' => 'Text zprávy musí mít alespoň 5 znaků.',
        'min' => 'Text zprávy musí mít alespoň 5 znaků.',
    ],
    'sent' => 'Zpráva byla úspěšně odeslána!',
    'token' => 'Platnost formuláře vypršela, obnovte prosím stránku a odešlete formulář znovu.',
    'confirm' => 'Nesouhlasí ověření. Musíte napsat slovo secret.',
];
