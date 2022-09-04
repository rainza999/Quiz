<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected function redirectTo(){
        if(auth()->user()){
            return '/dashboard';
        }
        return '/';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//     protected function logout(Request $request)
// {
//     Auth::logout();

//     $request->session()->invalidate();

//     $request->session()->regenerateToken();

//     return redirect('/');
// }
    public function index(){
        return view('welcome');
    }
    public function login(Request $request){
        $input = $request->all();

        $this->validate($request, [
            'email'=>'required|email',
            'password'=> 'required'
        ]);
      $users = DB::table('users')
        ->where('email', '=', $input['email'])
        ->first();
        if(auth()->attempt(array('email'=> $input['email'], 'password' => $input['password']))){

                if(password_verify($input['password'],$users->password)){
            $usersupdate = DB::table('users')
            ->where('id', $users->id)
              ->update(['updated_at' =>  date('Y-m-d G:i:s')]);



            if(auth()->user()){
                return redirect()->route('dashboard');
            }
        }
            else{
                return redirect()->route('login');
            }


        }

    }
}
