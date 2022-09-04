<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
class UserController extends Controller
{

     use AuthenticatesUsers;


// protected function authenticated(Request $request, $user)
// {
// if ( $user ) {// do your magic here
//     return redirect()->route('dashboard');
// }

//  return redirect('/login');
// }
    //
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

    public function index(Request $request)
    {

    }

    public function all()
    {
      $users = DB::table('users')->get();
      return response()->json(['Fetch Successfully', $users]);
    }
    public function frmedit(Request $request){

        $update = DB::table('users')->where('id', $request->all()['id'])
        ->update([
            'updated_at' =>  date('Y-m-d G:i:s'),
            'name' => $request->all()['name'],
            'position' =>$request->all()['position'],
            'password'=> bcrypt($request->all()['password'])
        ]);
        return response()->json(['status' => 200]);
    }
    public function delete($id){
        $users = DB::table('users')->where('id','=',$id)->delete();

        return response()->json(['status' => 200]);
    }
    public function edit($id)
    {
        $users = DB::table('users')->where('id', '=', $id)->get();

        // session(['nameselectsession' => $users->name]);
        // session(['positionselectsession' => $users->position]);
        // session(['passwordselectsession' => $users->password]);
        return view('edit',["data" => $users]);

        //return view('edit');
        //return response()->json(['Fetch one data Successfully', $id]);
        // $users = DB::table('users')->where('id', '=', $id)->get();

        // session(['nameselectsession' => $users->name]);
        // session(['positionselectsession' => $users->position]);
        // session(['passwordselectsession' => $users->password]);
        // return redirect()->route('edit')->with(['name' => $users->name, 'position' => $user->position, 'password' => $user->password]);

        //return response()->json(['Fetch one data Successfully', $users]);
      }
}
