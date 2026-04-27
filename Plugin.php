<?php namespace Pensoft\Jumbotron;

use Backend;
use System\Classes\PluginBase;
use Pensoft\Jumbotron\Components\Jumbotron as JumbotronComponent;

/**
 * Jumbotron Plugin - special box container
 */
class Plugin extends PluginBase
{
    public function boot(): void {}

    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
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
     */
    public function registerComponents(): array
    {
        return [
            JumbotronComponent::class => 'jumbotron',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'pensoft.jumbotron.permission' => [
                'tab' => 'Jumbotron',
                'label' => 'Permission'
            ],
        ];
    }

    public function registerNavigation(): array
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