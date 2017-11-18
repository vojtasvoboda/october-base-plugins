<?php namespace Site\Events\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Registrations Back-end Controller
 */
class Registrations extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Site.Events', 'events', 'registrations');
    }
}
