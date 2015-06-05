<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
	
	function logout(){
		Auth::logout();
		return redirect('admin/login');
	}
}