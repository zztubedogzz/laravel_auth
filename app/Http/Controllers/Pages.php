<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sites;
use App\User;



class Pages extends Controller
{
	private function loginFailed(){

		session(['failedLogins'=>session('failedLogins',0)+1]);

	}

	private function checkPermissions($perm,$view){

		if (session('name',null)===null){

			abort(403,'Az oldalt csak bejelentkezés után tekinthetetd meg.');

		} else {

			$role = User::where('name',session('name'))->get()[0]->roles;
			
			if (strpos($role,'*')!==false || strpos($role,$perm)!==false){
			
				return view($view);
			
			} else {
			
				abort(403,'Nincs megfelelő jogköröd az oldal megtekintéséhez.');
			
			}

		}

	}

	private function checkSites($perm,$view){

		$role = User::where('name',session('name'))->get()[0]->roles;

		$sites = sites::where('roles',$role)->get();

	}

	public function admin(){

		return $this->checkPermissions('*','admin');

	}

	public function contentManagement(){

		return $this->checkPermissions('tartalom','content-management');

	}
	public function home(){

		
		if (session('name',null) === null){

			return redirect('/login');

		} else {

			$roles = explode(',',User::where('name',session('name'))->get()[0]->roles);

			if ($roles[0]=='*'){

				$sites = sites::all();

			} else {

				$sites = array();

				foreach($roles as $role){

					array_push($sites, sites::where('roles','LIKE','%'.$role.'%')->get()[0]);

				}

			}
			
			return view('welcome', compact('sites'));
		}
		
	}

	public function user(){

		return $this->checkPermissions('user','user');

	}

	public function logout(){

		session()->forget('name');

		return redirect('/');

	}
	public function userLogin(){

		if (session('failedLogins',0)>2 && strlen(request()->input('g-recaptcha-response'))<1){
			$this->loginFailed();
			abort(403,'Captcha kitöltése kötelező!');
		}

		$users = User::where([['name','=',request()->username]])->get();

		if (count($users)==1) {

			$user = User::where([['name','=',request()->username],['password','=',request()->password]])->get();

			if (count($user)==1) {

				session()->forget('failedLogins');
				session(['name'=>$user[0]->name]);

			} else {

				$this->loginFailed();

			}

			return redirect('/');

		} else {

			if (count($users)>1){

				session()->flash('message','Duplikált felhasználó!');

					$this->loginFailed();

				return redirect('/login');

			} else {

				session()->flash('message','Felhasználó nem létezik!');

					$this->loginFailed();

				return redirect('/login');

			}
		}

		return redirect('/');
	}
}
