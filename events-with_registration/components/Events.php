<?php namespace Site\Events\Components;

use Cms\Classes\ComponentBase;
use Exception;
use Input;
use October\Rain\Exception\AjaxException;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Collection;
use Session;
use Site\Events\Models\Event;
use Site\Events\Models\Registration;

class Events extends ComponentBase
{
    /** @var Collection $events Loaded events collection. */
    public $events;

    /** @var Event $event Event loaded to the registration form. */
    public $event;

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

    public function onShow()
    {
        $slug = Input::get('id');
        $event = Event::enabled()->future()->where('slug', $slug)->first();
        if ($event === null || $event->ongoing() === true) {
            throw new ApplicationException('It is not possible to make a registration on this event.');
        }
        $this->event = $event;

        return true;
    }

    public function onRegistrate()
    {
        // check CSRF token
        if (Session::token() !== Input::get('_token')) {
            throw new AjaxException('Form expired, please refresh the page.');
        }

        // fetch data
        $data = Input::all();
        $data['event'] = Event::where('slug', Input::get('slug'))->future()->first();
        if ($data['event'] === null) {
            throw new AjaxException('Event does not exists. Please reload the page.');
        }

        // save registration
        try {
            Registration::create($data);

        } catch (ValidationException $e) {
            throw new AjaxException($e->getMessage());

        } catch (Exception $e) {
            throw new AjaxException('Something went wrong :-(');
        }
    }
}
