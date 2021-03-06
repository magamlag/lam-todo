<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 */
class Task extends Model {

	public static $rules = [
			'name'        => [ 'required', 'min:3' ],
			'slug'        => [ 'required' ],
			'description' => [ 'required' ],
	];

	protected $guarded = [];

	/**
	 * Find all tasks which will belongs to concrete project
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}
}