<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
   public function reset(Request $request){
       $this->validate($request, [
            'password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6'
        ]);

        $user = Auth::user();
        $user_email = $user->email;
        $data = $request->input();
        if(Auth::attempt([ 'email'=> $user_email, 'password'=>$data['password']])){

            DB::table('users')
            ->where('email', $user_email)
            ->update(['password' => bcrypt($data['new_password']) ]);

            $type = DB::table('users')
            ->where('email',  $user_email)
            ->value('type');

            if($type=='admin'){
              return redirect()->back()->with('success','Password Changed');
            }

            else if($type=='editor'){
                return redirect()->back()->with('success','Password Changed');
            }
        }

         else
         {
            return redirect()->back()->with('success','Old Password is not Correct');
         }
   }
}
