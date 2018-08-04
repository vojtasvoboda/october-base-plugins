<?php namespace Site\Galleries;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerNavigation()
    {
        return [
            'galleries' => [
                'label' => 'Galerie',
                'url' => Backend::url('site/galleries/galleries'),
                'icon' => 'icon-picture-o',
                'order' => 500,
                'sideMenu' => [
                    'galleries' => [
                        'label' => 'Galerie',
                        'url' => Backend::url('site/galleries/galleries'),
                        'icon' => 'icon-picture-o',
                        'order' => 100,
                    ],
                ],
            ],
        ];
    }
}
