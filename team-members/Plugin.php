<?php namespace Site\Team;

use Backend;
use System\Classes\PluginBase;

/**
 * Team Plugin Information File
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
            'team' => [
                'label' => 'Team',
                'url' => Backend::url('site/team/members'),
                'icon' => 'icon-users',
                'order' => 530,
                'sideMenu' => [
                    'members' => [
                        'label' => 'Team',
                        'url' => Backend::url('site/team/members'),
                        'icon' => 'icon-users',
                        'order' => 100,
                    ],
                ]
            ],
        ];
    }
}
