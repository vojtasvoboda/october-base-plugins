<?php namespace Site\Events;

use Backend;
use Site\Events\Components\Events;
use Site\Events\Components\TopEvents;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Events::class => 'events',
            TopEvents::class => 'topevents',
        ];
    }

    public function registerNavigation()
    {
        return [
            'events' => [
                'label' => 'Events',
                'url' => Backend::url('site/events/events'),
                'icon' => 'icon-calendar-o',
                'order' => 480,
                'sideMenu' => [
                    'events' => [
                        'label' => 'Events',
                        'url' => Backend::url('site/events/events'),
                        'icon' => 'icon-calendar-o',
                        'order' => 100,
                    ],
                ],
            ],
        ];
    }
}
