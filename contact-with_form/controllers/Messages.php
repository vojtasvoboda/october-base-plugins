<?php namespace Site\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Messages extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController',
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Site.Contact', 'contact', 'messages');
    }
}
