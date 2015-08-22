<?php
namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'price', 'multi', 'auto', 'input_option', 'input_label'];
	
	function project() {
		return $this->belongsTo('App\Database\Models\Project');
	}
	
	function setMultiAttribute($value){
		$this->attributes['multi'] = !empty($value) ? 1 : 0;
	}
	
	function setAutoAttribute($value){
		$this->attributes['auto'] = !empty($value) ? 1 : 0;
	}
	
	function setInputOptionAttribute($value){
		$this->attributes['input_option'] = !empty($value) ? 1 : 0;
	}
}