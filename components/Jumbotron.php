<?php namespace Pensoft\Jumbotron\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Jumbotron\Models\Jumbotron as JumbotronModel;

class Jumbotron extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Jumbotron',
            'description' => 'Lightweight, flexible component for showcasing hero unit style content.'
        ];
    }

    public $rules = [];

    public function defineProperties()
    {
        return [
            'jumbotron' => [
                'title' => 'Jumbotron',
                'description' => 'Please select your jumbotron',
                'type' => 'dropdown',
            ],
        ];
    }

    public function getJumbotronOptions()
    {
        return JumbotronModel::all()->lists('slug', 'title');
    }

	public function getJumbotron()
	{
        $jumbotron = JumbotronModel::where('slug', $this->property('jumbotron'))->first();

        if (class_exists('\Jenssegers\Agent\Agent')) {
            $Agent = new \Jenssegers\Agent\Agent();
            if ($Agent->isMobile() && $jumbotron->mobile_image) {
                $jumbotron->image = $jumbotron->mobile_image;
            }
        }

        return $jumbotron;
	}
}
