<?php namespace Site\References\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * References Back-end Controller
 */
class References extends Controller
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

        BackendMenu::setContext('Site.References', 'references', 'references');
    }
}
