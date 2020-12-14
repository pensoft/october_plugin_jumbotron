<?php namespace Pensoft\Jumbotron\Models;

use Model;

/**
 * Model
 */
class Jumbotron extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_jumbotron';

    public $rules = [];

	public $attachOne = [
		'image' => 'System\Models\File',
		'mobile_image' => 'System\Models\File'
	];
}
