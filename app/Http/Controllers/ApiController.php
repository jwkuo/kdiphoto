<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Database\Models\Project;
use App\Database\Models\Package;
use App\Database\Models\Item;

class ApiController extends Controller {
	function getProject($project_id){
		
		$projects = Project::where('lookup_id', '=', $project_id)->get();
		
		return $projects[0]->toJson();
	}
	function getAllPackages() {
		$packages = Package::with('project')->get();
		return $packages->toJson();
	}
	function getAllItems() {
		$items = Item::with('project')->get();
		return $items->toJson();
	}
}