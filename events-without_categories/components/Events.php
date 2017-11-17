<?php namespace Site\Events\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Support\Collection;
use Site\Events\Models\Event;

class Events extends ComponentBase
{
    /** @var Collection $events */
    public $events;

    public function componentDetails()
    {
        return [
            'name' => 'Events',
            'description' => 'Event stream',
        ];
    }

    public function defineProperties()
    {
        return [
            'tops' => [
                'title' => 'Include top events',
                'description' => 'If include top events or not',
                'type' => 'checkbox',
                'default' => false,
            ],
        ];
    }

    public function onRun()
    {
        // include tops?
        $tops = $this->property('tops');

        // load events
        $eventsQuery = Event::enabled()->future();
        if ($tops !== true) {
            $eventsQuery->where('top', false);
        }
        $this->events = $eventsQuery->orderBy('date_from')->get();
    }
}
