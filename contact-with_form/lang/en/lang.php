<?php

return [
    'name' => [
        'label' => 'Name and surname',
        'required' => 'You have to fill your name and lastname.',
    ],
    'email' => [
        'label' => 'Email',
        'required' => 'You have to fill your email.',
    ],
    'phone' => [
        'label' => 'Phone',
        'required' => 'You have to fill your phone.',
    ],
    'company' => [
        'label' => 'Company',
    ],
    'message' => [
        'label' => 'Message',
        'required' => 'You have to fill your message.',
        'min' => 'Message should have at least 5 characters.',
    ],
    'sent' => 'Your message has been succesfully sent!',
    'token' => 'Your form expired! Please refresh the webpage.',
    'confirm' => 'Confirmation does not match. You have to type word secret.',
];
