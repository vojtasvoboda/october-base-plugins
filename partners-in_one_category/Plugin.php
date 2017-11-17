<?php namespace Site\Partners;

use Backend;
use Site\Partners\Components\Partners;
use System\Classes\PluginBase;

/**
 * Partners Plugin Information File
 */
class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Partners::class => 'partners',
        ];
    }

    public function registerNavigation()
    {
        return [
            'partners' => [
                'label'       => 'Partners',
                'url'         => Backend::url('site/partners/partners'),
                'icon'        => 'icon-users',
                'permissions' => ['site.partners.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'partners' => [
                        'label'       => 'Partners',
                        'url'         => Backend::url('site/partners/partners'),
                        'icon'        => 'icon-users',
                        'permissions' => ['site.partners.*'],
                        'order'       => 100,
                    ],
                    'categories' => [
                        'label'       => 'Categories',
                        'url'         => Backend::url('site/partners/categories'),
                        'icon'        => 'icon-folder',
                        'permissions' => ['site.partners.*'],
                        'order'       => 200,
                    ],
                ]
            ],
        ];
    }
}
