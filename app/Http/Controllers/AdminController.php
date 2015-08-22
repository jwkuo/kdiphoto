<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Database\Models\User;
use App\Database\Models\Project;
use App\Database\Models\Package;
use App\Database\Models\Item;

class AdminController extends Controller {
	
	function login(Request $request) {
		if($request->method() == 'POST'){
			//Perform authentication
			$input = $request->only(['username', 'password']);
			if(Auth::attempt($input)){
				return redirect('admin');
			}
			return view('login', ['fail' => true]);
		}else{
			//Render login screen
			return view('login', ['fail' => false]);
		}
	}
	
	function adminHome() {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		return view('admin');
	}
	
	function logout() {
		Auth::logout();
		return redirect('admin/login');
	}
	
	function manageUsers(Request $request) {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		//Print the status of a deletion if one exists
		$delete = $request->query('delete');
		//Print the status of an update if one exists
		$update = $request->query('update');
		//Print the status of a create if one exists
		$create = $request->query('create');
		$users = User::all();
		return view('users',['users'=>$users, 'delete'=>$delete, 'update'=>$update, 'create' => $create]);
	}
	
	function editUser(Request $request, $user_id) {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$user = User::find($user_id);
		if($request->method() == 'POST'){
			$user->fill($request->input());
			$user->save();
			return redirect('admin/users?update=true');
		}
		return view('edit-user',['user' => $user]);
	}
	
	function deleteUser($user_id) {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$user = User::find($user_id);
		$logged_in = Auth::user();
		if($user->id == 1){
			//Send a message saying the admin user cannot be deleted
			$delete = -1;
		}elseif($user->id == $logged_in->id) {
			//Send a message saying you can't delete yourself
			$delete = 0;
		}else{
			$user->delete();
			$delete = 1;
		}
		return redirect("admin/users?delete=$delete");
	}
	
	function createUser(Request $request){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		if($request->method() == 'POST'){
			$created = User::create($request->input());
			return redirect("admin/users?create={$created->username}");
		}
		return view('create-user');
	}
	
	function manageProjects(Request $request){
		//Show the list of existing projects
		if(!Auth::check()){
			return redirect('admin/login');
		}
		//Print the status of a deletion if one exists
		$delete = $request->query('delete');
		//Print the status of an update if one exists
		$update = $request->query('update');
		$projects = Project::all();
		return view('projects',['projects'=>$projects, 'delete'=>$delete, 'update'=>$update]);
	}
	
	function createProject(Request $request){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		if($request->method() == 'POST'){
			$project = new Project();
			$project->lookup_id = $request->input('lookup_id');
			$project->directory = $request->input('directory');
			$project->name = $request->input('name');
			$project->save();
			return redirect("admin/projects/{$project->id}");
		}
		return view('create-project');
	}
	
	function editProject(Request $request, $project_id) {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$project = Project::find($project_id);
		if($request->method() == 'POST'){			
			$project->fill($request->input());
			$project->save();
			return redirect('admin/projects?save=true');
		}
		$project->load(['packages','items']);
		return view('edit-project', ['project'=>$project]);
	}
	
	function copyProject($project_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$project = Project::find($project_id);
		$project->load('packages','items');
		$attributes = $project->getAttributes();
		foreach($attributes as $key => $att){
			if(!$project->isFillable($key)){
				unset($attributes[$key]);
			}
		}
		$copy = new Project($attributes);
		$copy->fill($attributes);
		$copy_packages = [];
		$copy_items = [];
		foreach($project->packages as $package){
			$pack_att = $package->getAttributes();
			foreach($pack_att as $key => $att){
				if(!$package->isFillable($key)){
					unset($pack_att[$key]);
				}
			}
			$copy_packages[] = new Package($pack_att);
		}
		foreach($project->items as $item){
			$item_att = $item->getAttributes();
			foreach($item_att as $key => $att){
				if(!$item->isFillable($key)){
					unset($item_att[$key]);
				}
			}
			$copy_items[] = new Item($item_att);
		}
		$copy->save();
		if(!empty($copy_packages)) $copy->packages()->saveMany($copy_packages);
		if(!empty($copy_items)) $copy->items()->saveMany($copy_items);
		return redirect("admin/projects/$copy->id");
	}
	
	function deleteProject($project_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$project = Project::find($project_id);
		$project->load('packages','items');
		foreach($project->packages as $package){
			$package->delete();
		}
		foreach($project->items as $item){
			$item->delete();
		}
		$project->delete();
		return redirect('admin/projects?delete=true');
	}
	
	function createPackage(Request $request, $project_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$project = Project::find($project_id);
		if($request->method() == 'POST'){
			$package = new Package($request->input());
			$project->packages()->save($package);
			return redirect("admin/projects/$project_id");
		}
		return view('create-package',['project_id'=>$project_id]);
	}
	
	function editPackage(Request $request, $project_id, $package_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$package = Package::find($package_id);
		if($request->method() == 'POST'){
			$package->fill($request->input());
			$package->save();
			return redirect("admin/projects/$project_id");
		}
		return view('edit-package',['project_id'=>$project_id, 'package'=>$package]);
	}
	
	function deletePackage($project_id, $package_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$package = Package::find($package_id);
		$package->delete();
		return redirect("admin/projects/$project_id");
	}
	
	function createItem(Request $request, $project_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$project = Project::find($project_id);
		if($request->method() == 'POST'){
			$item = new Item($request->input());
			$project->items()->save($item);
			return redirect("admin/projects/$project_id");
		}
		return view('create-item',['project_id'=>$project_id]);
	}
	
	function editItem(Request $request, $project_id, $item_id) {
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$item = Item::find($item_id);
		if($request->method() == 'POST'){
			$input = $request->input();
			if(empty($input['multi'])){
				$input['multi'] = 0;
			}
			if(empty($input['auto'])){
				$input['auto'] = 0;
			}
			if(empty($input['input_option'])){
				$input['input_option'] = 0;
			}
			$item->fill($input);
			$item->save();
			return redirect("admin/projects/$project_id");
		}
		return view('edit-item',['item' => $item, 'project_id'=>$project_id]);
	}
	
	function deleteItem($project_id, $item_id){
		if(!Auth::check()){
			return redirect('admin/login');
		}
		$item = Item::find($item_id);
		$item->delete();
		return redirect("admin/projects/$project_id");
	}
}