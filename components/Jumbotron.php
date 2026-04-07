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
            'description_limit' => [
                'title' => 'Description limit',
                'default' => 0
            ],
        ];
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
