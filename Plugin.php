<?php namespace Pensoft\Jumbotron;

use Backend;
use System\Classes\PluginBase;
use SaurabhDhariwal\Revisionhistory\Classes\Diff as Diff;
use System\Models\Revision as Revision;

/**
 * Jumbotron Plugin - special box container
 */
class Plugin extends PluginBase
{
    public function boot(){
        /* Extetions for revision */
        Revision::extend(function($model){
            /* Revison can access to the login user */
            $model->belongsTo['user'] = ['Backend\Models\User'];

            /* Revision can use diff function */
            $model->addDynamicMethod('getDiff', function() use ($model){
                return Diff::toHTML(Diff::compare($model->old_value, $model->new_value));
            });
        });
    }

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

    public function registerNavigation()
    {
        return [
            'main-menu-item' => [
                'label'       => 'Jumbotron',
                'url'         => \Backend::url('pensoft/jumbotron/jumbotron'),
                'icon'        => 'icon-leaf',
                'permissions' => ['pensoft.jumbotron.*'],
            ],
        ];
    }
}
