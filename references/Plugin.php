<?php namespace Site\References;

use Backend;
use System\Classes\PluginBase;

/**
 * References Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'references' => [
                'label' => 'References',
                'url' => Backend::url('site/references/references'),
                'icon' => 'icon-briefcase',
                'order' => 510,
                'sideMenu'    => [
                    'references' => [
                        'label' => 'References',
                        'url' => Backend::url('site/references/references'),
                        'icon' => 'icon-briefcase',
                        'order' => 100,
                    ],
                ],
            ],
        ];
    }
}
