<?php namespace Site\Events\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Support\Collection;
use Site\Events\Models\Event;

class TopEvents extends ComponentBase
{
    /** @var Collection $events */
    public $events;

    public function componentDetails()
    {
        return [
            'name' => 'TopEvents Component',
            'description' => 'Top event stream',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->events = Event::enabled()->future()->where('top', true)->orderBy('date_from')->get();
    }
}
