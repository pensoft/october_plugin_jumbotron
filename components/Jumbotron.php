<?php namespace Pensoft\Jumbotron\Components;

use Backend\Facades\BackendAuth;
use Cms\Classes\ComponentBase;
use Pensoft\Jumbotron\Models\Jumbotron as JumbotronModel;

class Jumbotron extends ComponentBase
{
    public bool $loggedIn = false;

    public function onRun(): void
    {
        $this->loggedIn = !empty(BackendAuth::getUser());
    }

    public function componentDetails(): array
    {
        return [
            'name'        => 'Jumbotron',
            'description' => 'Lightweight, flexible component for showcasing hero unit style content.'
        ];
    }

    public function defineProperties(): array
    {
        return [
            'jumbotron' => [
                'title' => 'Jumbotron',
                'description' => 'Please select your jumbotron',
                'type' => 'dropdown',
            ],
            'title' => [
                'title' => 'Show title',
                'type' => 'checkbox',
                'default' => false
            ],
            'background' => [
                'title' => 'Set background HEX color',
                'type' => 'string',
                'default' => null
            ],
            'templates' => [
                'title' => 'Select templates',
                'type' => 'dropdown',
                'default' => 'template3'
            ],
            'description_limit' => [
                'title' => 'Description limit',
                'default' => 0
            ],
        ];
    }

    public function getTemplatesOptions(): array
    {
        return [
            'template1' => 'Template 1',
            'template2' => 'Template 2',
            'template3' => 'Template 3',
        ];
    }

    public function hasBackground(): bool
    {
        return !is_null($this->property('background', null));
    }

    public function getJumbotronOptions(): array
    {
        return JumbotronModel::all()->lists('title', 'slug');
    }

    public function getJumbotron(): ?JumbotronModel
    {
        $jumbotron = JumbotronModel::where('slug', $this->property('jumbotron'))->first();

        if (class_exists('\Jenssegers\Agent\Agent')) {
            $Agent = new \Jenssegers\Agent\Agent();
            if ($Agent->isMobile() && $jumbotron && $jumbotron->mobile_image) {
                $jumbotron->image = $jumbotron->mobile_image;
            }
        }

        return $jumbotron;
    }
}
