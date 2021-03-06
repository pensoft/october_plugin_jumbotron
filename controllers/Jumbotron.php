<?php namespace Pensoft\Jumbotron\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Jumbotron extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Pensoft.Jumbotron', 'main-menu-item');
    }
}
