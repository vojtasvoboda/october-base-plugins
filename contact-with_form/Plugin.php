<?php namespace Site\Contact;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerNavigation()
    {
        return [
            'contact' => [
                'label' => 'Zprávy',
                'url' => Backend::url('site/contact/messages'),
                'icon' => 'icon-phone',
                'order' => 600,
                'sideMenu' => [
                    'messages' => [
                        'label' => 'Zprávy',
                        'icon' => 'icon-file-text-o',
                        'url' => Backend::url('site/contact/messages'),
                    ],
                ],
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'Site\Contact\Components\ContactForm' => 'contactForm',
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'site.contact::mail.contact' => 'Zpráva z kontaktního formuláře',
        ];
    }
}
