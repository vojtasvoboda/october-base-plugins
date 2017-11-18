<?php

return [
    'name' => [
        'required' => 'You have to fill your name and lastname.',
    ],
    'email' => [
        'required' => 'You have to fill your email.',
    ],
    'phone' => [
        'required' => 'You have to fill your phone.',
    ],
    'message' => [
        'required' => 'You have to fill your message.',
        'min' => 'Message should have at least 5 characters.',
    ],
    'sent' => 'Your message has been succesfully sent!',
    'token' => 'Your form expired! Please refresh the webpage.',
    'confirm' => 'Confirmation does not match. You have to type word secret.',
];
