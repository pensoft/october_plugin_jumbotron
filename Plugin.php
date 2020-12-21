<?php namespace Pensoft\Jumbotron;

use Backend;
use System\Classes\PluginBase;

/**
 * Jumbotron Plugin - special box container
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = [
        'pikanji.agent'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Jumbotron',
            'description' => 'Lightweight, flexible component for showcasing hero unit style content.',
            'author'      => 'Pensoft',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Pensoft\Jumbotron\Components\Jumbotron' => 'jumbotron',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'pensoft.jumbotron.permission' => [
                'tab' => 'Jumbotron',
                'label' => 'Permission'
            ],
        ];
    }
}
