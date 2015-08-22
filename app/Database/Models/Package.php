<?php
namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'packages';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'price', 'sheet_options'];
	
	function project() {
		return $this->belongsTo('App\Database\Models\Project');
	}
}