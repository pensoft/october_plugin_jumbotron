<?php namespace Pensoft\Jumbotron\Models;

use Model;
use BackendAuth;
use Validator;

/**
 * Model
 */
class Jumbotron extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array Translatable fields
     */
    public $translatable = [
        'title',
        'slug',
        'body',
        'button_name',
    ];

    // For Revisionable namespace
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id", "title", "slug", "body"];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_jumbotron';

    public $rules = [];

	public $attachOne = [
		'image' => 'System\Models\File',
		'mobile_image' => 'System\Models\File'
	];

    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }
    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }


            /**
     * Add translation support to this model, if available.
     *
     * @return void
     */
    public static function boot()
    {
        Validator::extend(
            'json',
            function ($attribute, $value, $parameters) {
                json_decode($value);

                return json_last_error() == JSON_ERROR_NONE;
            }
        );

        // Call default functionality (required)
        parent::boot();

        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {
            return;
        }

        // Extend the constructor of the model
        self::extend(
            function ($model) {

                // Implement the translatable behavior
                $model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';
            }
        );
    }
}
