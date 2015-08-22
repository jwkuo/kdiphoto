<?php
namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['lookup_id', 'directory', 'name', 'sheet_options', 'sheet_prices'];
	/**
	 * The base directory for looking up photos
	 * 
	 * @var string
	 */
	protected $photo_base_dir = '';
	
	function __construct() {
		parent::__construct();
		$this->photo_base_dir = base_path() . 'public/photos';
	}
	
	function packages(){
		return $this->hasMany('App\Database\Models\Package');
	}
	
	function items(){
		return $this->hasMany('App\Database\Models\Item');
	}
}