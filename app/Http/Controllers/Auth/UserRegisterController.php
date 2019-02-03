<?php
namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserRegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm(Request $request)
    {
        return view('register');
    }

    public function register(Request $req){

        $this->validate($req, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'state' => 'required|string|max:20',
            'contact' => 'required|string|max:10',
            'city' => 'required|string|max:20',
            'type' => 'required|string|max:10',
            'zipcode' => 'required|string|max:300',
            'password' => 'required|string|min:6',
        ]);

        $user_name = $req->input('name');
        $user_email = $req->input('email');
        $user_city = $req->input('city');
        $user_contact = $req->input('contact');
        $user_type = $req->input('type');
        $user_state = $req->input('state');
        $user_zipcode = $req->input('zipcode');
        $user_password = $req->input('password');



      $data = array('name' => $user_name, 'email' => $user_email,'password' => bcrypt($user_password), 'state' => $user_state, 'city' => $user_city, 'zipcode' => $user_zipcode, 'contact' => $user_contact, 'type' => $user_type);

      DB::table('users')->insert($data);

      return redirect('/user-register')->with('success','User Details Were Saved');


    }


}
